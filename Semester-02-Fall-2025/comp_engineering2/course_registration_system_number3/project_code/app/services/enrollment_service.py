# app/services/enrollment_service.py
from typing import Dict, List
from app.services.database import load_enrollments, save_enrollments
from app.models.course import Course
from app.services.user_service import UserService
from datetime import datetime

class EnrollmentService:
    def __init__(self, user_service: UserService):
        self._raw = load_enrollments()
        self.enrollments: Dict[str, List] = self._raw or {}
        self.user_service = user_service

    def _now(self):
        return datetime.now().isoformat(timespec="seconds")


    def persist(self):
        save_enrollments(self.enrollments)

    def set_user_service(self, user_service):
        self.user_service = user_service

    def enroll(self, username, course):
        # check capacity
        lst = self.enrollments.setdefault(course.course_id, [])
        if any(e["username"] == username for e in lst):
            return False
        if len(lst) >= course.capacity:
            return False

        stud = self.user_service.students.get(username)
        if not stud:
            return False

        entry = {
            "username": username,
            # "student": stud,
            "timestamp": self._now()
        }
        lst.append(entry)
        self.persist()
        return True

    def drop(self, username, course_or_id):
        cid = course_or_id if isinstance(course_or_id, str) else course_or_id.course_id
        lst = self.enrollments.get(cid, [])

        for i, e in enumerate(lst):
            if e["username"] == username:
                lst.pop(i)
                return True

        return False

    def view_enrollments(self, course_id: str = None):
        """
        If course_id is None -> return full enrollment dictionary.
        If course_id is provided -> return list of enrollments for that course (case-insensitive).
        """
        if course_id is None:
            return self.enrollments

        # Normalize to lowercase for case-insensitive matching
        course_id_lower = course_id.lower()
        for cid, lst in self.enrollments.items():
            if cid.lower() == course_id_lower:
                return lst
        return []



    def get_student_schedule(self, username, courses):
        out = []
        for cid, lst in self.enrollments.items():
            for e in lst:
                if e["username"] == username:
                    c = courses[cid]
                    out.append({
                        "course_id": c.course_id,
                        "title": c.title,
                        "credits": c.credits,
                        "schedule": getattr(c, "schedule", None),
                        "instructor": c.instructor,
                        "enrolled_at": e.get("timestamp")
                    })
        return out

    
    def clear_enrollments(self):
        """Clears all in-memory enrollments and persists an empty state."""
        self.enrollments = {}
        self.persist()
