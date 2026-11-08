# app/services/user_service.py

from typing import Optional, Dict
from app.services.database import load_users, save_users
from app.models.student import Student
from app.models.admin import Admin
from app.utils.hashing import hash_password


class UserService:
    """
    Unified user service managing both Students and Admins.
    Fully compatible with tests that expect:
    - register_student(username, full_name, password) → True/False
    - authenticate_student(username, password) → Student or None
    - authenticate_admin(username, password) → Admin or None
    - get_user(username) → Student or Admin or None
    """

    def __init__(self):
        self._raw = load_users()

        # Load students from storage
        self.students: Dict[str, Student] = {
            username: Student.from_dict(data)
            for username, data in self._raw.get("students", {}).items()
        }

        # Load admins from storage
        self.admins: Dict[str, Admin] = {
            username: Admin.from_dict(data)
            for username, data in self._raw.get("admins", {}).items()
        }

    # ---------------------------------------
    # Persistence
    # ---------------------------------------

    def persist(self):
        out = {
            "students": {u: s.to_dict() for u, s in self.students.items()},
            "admins": {u: a.to_dict() for u, a in self.admins.items()},
        }
        save_users(out)

    # ---------------------------------------
    # Student Management
    # ---------------------------------------

    def register_student(self, username: str, full_name: str, password: str) -> bool:
        """Registers a student with PLAIN password."""
        if username in self.students:
            return False

        new_student = Student(username, full_name, password)
        
        self.students[username] = new_student
        self.persist()
        return True
    
    def authenticate_student(self, username: str, password: str):
        student = self.students.get(username)
        if not student:
            return None
        if student.password_hash == password:
            return student
        return None

    def update_student(self, username: str, full_name: str = None, metadata: dict = None) -> bool:
        s = self.students.get(username)
        if not s:
            return False

        if full_name:
            s.full_name = full_name
        if metadata:
            s.metadata.update(metadata)

        self.persist()
        return True

    # ---------------------------------------
    # Admin Management
    # ---------------------------------------

    def authenticate_admin(self, username: str, password: str) -> Optional[Admin]:
        """Admins use hashed passwords (correct, keep it)."""
        a = self.admins.get(username)
        if not a:
            return None

        if a.password_hash == hash_password(password):
            return a

        return None

    def create_default_admin(self):
        """Creates default admin if none exists."""
        if "admin" not in self.admins:
            ph = hash_password("admin")
            self.admins["admin"] = Admin("admin", "Default Admin", ph)
            self.persist()
            print("[INFO] Default admin created: username=admin password=admin")

    def get_user(self, username: str):
        """Returns Student or Admin or None."""
        if username in self.students:
            return self.students[username]
        if username in self.admins:
            return self.admins[username]
        return None

    def clear_users(self):
        """Clears all in-memory users and persists an empty state."""
        self.students = {}
        self.admins = {}
        self.persist()