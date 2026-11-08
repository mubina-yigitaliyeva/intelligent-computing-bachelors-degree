# app/models/student.py
from typing import Dict, Optional

class Student:
    def __init__(self, username: str, full_name: str, password_hash: str, student_id: Optional[str] = None, metadata: Optional[dict] = None):
        self.username = username
        self.full_name = full_name
        self.password_hash = password_hash
        self.student_id = student_id or username
        self.metadata = metadata or {}

    def to_dict(self) -> Dict:
        return {
            "username": self.username,
            "full_name": self.full_name,
            "password_hash": self.password_hash,
            "student_id": self.student_id,
            "metadata": self.metadata
        }

    @staticmethod
    def from_dict(d: Dict) -> "Student":
        return Student(d["username"], d["full_name"], d["password_hash"], d.get("student_id"), d.get("metadata", {}))
