from app.services.course_service import CourseService
from app.services.enrollment_service import EnrollmentService
from app.services.user_service import UserService
from app.models.course import Course

def setup_sample(cs: CourseService, us: UserService, es: EnrollmentService):
    us.clear_users()
    cs.clear_courses()
    es.clear_enrollments()

    # create a course and two students
    cs.add_course(Course("T101", "Test", "Prof", 1, 3, ""))
    us.register_student("s1", "S One", "pw1") 
    us.register_student("s2", "S Two", "pw2")

def test_enroll_and_drop():
    us = UserService()
    cs = CourseService()
    es = EnrollmentService(us)

    setup_sample(cs, us, es)

    course = cs.get_course("T101")

    # Case-insensitive enrollment
    assert es.enroll("s1", cs.get_course("t101")) is True  # works with different case

    # Capacity = 1 → second student cannot enroll
    assert es.enroll("s2", course) is False

    # Schedule includes 'enrolled_at'
    sched = es.get_student_schedule("s1", cs.courses)
    assert len(sched) == 1
    assert sched[0]["course_id"].lower() == "t101"
    assert "enrolled_at" in sched[0]

    # Drop
    assert es.drop("s1", course) is True
    assert es.drop("s1", course) is False

    # Now s2 can enroll
    assert es.enroll("s2", course) is True

def test_view_enrollments_structure():
    us = UserService()
    cs = CourseService()
    es = EnrollmentService(us)

    setup_sample(cs, us, es)
    course = cs.get_course("T101")
    es.enroll("s1", course)

    all_en = es.view_enrollments()
    assert "T101" in all_en
    assert isinstance(all_en["T101"], list)
    assert all_en["T101"][0]["username"] == "s1"