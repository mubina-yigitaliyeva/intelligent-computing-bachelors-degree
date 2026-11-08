# app/models/course.py
from typing import Dict

class Course:
    def __init__(self, course_id: str, title: str, instructor: str, capacity: int, credits: int, description: str = "", schedule: str = ""):
        self.course_id = course_id
        self.title = title
        self.instructor = instructor
        self.capacity = int(capacity)
        self.credits = int(credits)
        self.description = description
        self.schedule = schedule

    def to_dict(self) -> Dict:
        return {
            "course_id": self.course_id,
            "title": self.title,
            "instructor": self.instructor,
            "capacity": self.capacity,
            "credits": self.credits,
            "description": self.description,
            "schedule": self.schedule
        }

    @staticmethod
    def from_dict(d: Dict) -> "Course":
        return Course(d["course_id"], d["title"], 
                      d["instructor"], d["capacity"], d["credits"], 
                      d.get("description", ""), d.get("schedule", ""))
