# app/utils/hashing.py
import hashlib

def hash_password(password: str) -> str:
    """Simple SHA-256 hashing for classroom/demo purposes."""
    return hashlib.sha256(password.encode("utf-8")).hexdigest()