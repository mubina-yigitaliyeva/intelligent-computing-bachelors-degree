# app/services/analytics_service.py
from typing import List, Dict, Tuple
from app.models.course import Course

class AnalyticsService:
    def __init__(self, enrollment_service, course_service):
        self.enrollment_service = enrollment_service
        self.course_service = course_service

    def popular_courses(self, top_n: int = 5) -> List[Tuple[str, int]]:
        counts = []
        for cid, lst in self.enrollment_service.enrollments.items():   # {"CS101": [student1, student2], "MATH101": [student3]}
            counts.append((cid, len(lst)))
        counts.sort(key=lambda x: x[1], reverse=True)
        res = []
        for cid, cnt in counts[:top_n]:
            c = self.course_service.get_course(cid)
            res.append((c.title if c else cid, cnt))
        return res

    def course_capacity_status(self) -> List[Dict]:
        out = []
        for cid, c in self.course_service.courses.items():
            used = len(self.enrollment_service.enrollments.get(cid, []))
            out.append({
                "course_id": cid,
                "title": c.title,
                "capacity": c.capacity,
                "enrolled": used,
                "free_slots": max(0, c.capacity - used)
            })
        return out

    def student_workload(self, username: str) -> Dict:
        sched = self.enrollment_service.get_student_schedule(username, self.course_service.courses)
        total_credits = sum(item["credits"] for item in sched)
        return {"username": username, "total_courses": len(sched), "total_credits": total_credits, "courses": sched}

    def enrollment_trend(self) -> List[Tuple[str, int]]:
        trend = {} # {"2025-12-09": 3, "2025-12-08": 5}
        for _, lst in self.enrollment_service.enrollments.items():
            for e in lst:
                timestamp = e.get("timestamp")
                if not timestamp:
                    continue
                date = timestamp.split("T")[0] # "YYYY-MM-DDTHH:MM:SS"
                trend[date] = trend.get(date, 0) + 1
        return sorted(trend.items())
