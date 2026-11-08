# app/utils/validators.py
import re

def valid_username(username: str) -> bool:
    return bool(re.match(r"^[A-Za-z0-9_.-]{3,30}$", username))

def valid_course_id(course_id: str) -> bool:
    return bool(re.match(r"^[A-Za-z0-9_-]{2,20}$", course_id))

def positive_int(value) -> bool:
    try:
        v = int(value)
        return v >= 0
    except Exception:
        return False
