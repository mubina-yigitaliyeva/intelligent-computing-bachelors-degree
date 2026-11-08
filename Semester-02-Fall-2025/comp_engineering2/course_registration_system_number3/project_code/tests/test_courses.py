from app.services.course_service import CourseService
from app.models.course import Course

def test_add_update_remove_course():
    cs = CourseService()
    cs.clear_courses()

    c = Course("CSX100", "X Course", "Dr. X", 10, 2, "desc")
    assert cs.add_course(c) is True
    # duplicate add fails
    assert cs.add_course(c) is False

    found = cs.get_course("CSX100")
    assert found is not None
    assert found.title == "X Course"

    # update
    cs.update_course("CSX100", title="X Course 2", capacity=20)
    updated = cs.get_course("CSX100")
    assert updated.title == "X Course 2"
    assert updated.capacity == 20

    # remove
    assert cs.remove_course("CSX100") is True
    assert cs.get_course("CSX100") is None
