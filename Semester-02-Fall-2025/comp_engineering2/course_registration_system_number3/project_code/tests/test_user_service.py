import pytest
from app.services.user_service import UserService

def test_register_and_authenticate_student():
    us = UserService()
    us.clear_users()  # reset

    # register
    ok = us.register_student("alice", "Alice A", "pw123")
    assert ok is True

    # duplicate fails
    assert us.register_student("alice", "Alice A", "pw123") is False

def test_update_student_profile():
    us = UserService()
    us.register_student("bob", "Bob B", "pw")

    updated = us.update_student("bob", full_name="Robert B", metadata={"year": "2"})
    assert updated is True

    s = us.students["bob"]
    assert s.full_name == "Robert B"
    assert s.metadata.get("year") == "2"


def test_admin_auth_and_default_creation():
    us = UserService()
    us.clear_users()

    # create default admin
    us.create_default_admin()

    # wrong password
    assert us.authenticate_admin("admin", "wrong") is None
