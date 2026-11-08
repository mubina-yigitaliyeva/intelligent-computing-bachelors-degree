from typing import Dict, List
from app.services.database import load_courses, save_courses
from app.models.course import Course

class CourseService:
    def __init__(self):
        # self._raw is a dict: course_id -> dict (course info -> title, instructor, capacity etc.)
        self._raw = load_courses()
        """
        {
            "CS101": <Course object>,
            "MATH101": <Course object>
        }

        """
        self.courses: Dict[str, Course] = {
            cid: Course.from_dict(d) for cid, d in self._raw.items()  
        }

    def persist(self):
        out = {cid: c.to_dict() for cid, c in self.courses.items()}
        save_courses(out)

    def add_course(self, course: Course) -> bool:
        if course.course_id in self.courses:
            return False
        self.courses[course.course_id] = course
        self.persist()
        return True

    def update_course(self, course_id: str, **kwargs) -> bool:
        c = self.courses.get(course_id)
        if not c:
            return False

        if "title" in kwargs and kwargs["title"] is not None:
            c.title = kwargs["title"]
        if "instructor" in kwargs and kwargs["instructor"] is not None:
            c.instructor = kwargs["instructor"]
        if "capacity" in kwargs and kwargs["capacity"] is not None:
            c.capacity = int(kwargs["capacity"])
        if "credits" in kwargs and kwargs["credits"] is not None:
            c.credits = int(kwargs["credits"])
        if "description" in kwargs and kwargs["description"] is not None:
            c.description = kwargs["description"]

        self.persist()
        return True

    def remove_course(self, course_id: str) -> bool:
        if course_id not in self.courses:
            return False
        self.courses.pop(course_id)
        self.persist()
        return True

    def get_course(self, course_id: str):
        course_id = course_id.lower()
        for cid, c in self.courses.items():
            if cid.lower() == course_id:
                return c
        return None


    def list_courses(self) -> List[Course]:
        return list(self.courses.values())

    def create_sample_courses(self):
        if self.courses:
            return

        samples = [
            Course("CS101", "Intro to CS", "Dr. Kim", 40, 3, "Intro programming"),
            Course("CS201", "Data Structures", "Prof. Lee", 35, 3, "Lists, trees, hashes"),
            Course("MATH101", "Calculus I", "Dr. Park", 50, 4, "Limits and derivatives")
        ]

        for c in samples:
            self.courses[c.course_id] = c

        self.persist()

    def clear_courses(self):
        """Clears all in-memory courses and persists an empty state."""
        self.courses = {}
        self.persist()