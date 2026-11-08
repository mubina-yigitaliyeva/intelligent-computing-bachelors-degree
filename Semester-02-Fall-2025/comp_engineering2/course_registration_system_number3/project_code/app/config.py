# app/config.py
import os

BASE_DIR = os.path.dirname(os.path.dirname(os.path.abspath(__file__)))

DATA_DIR = os.path.join(BASE_DIR, "data")
USERS_FILE = os.path.join(DATA_DIR, "users.json")
COURSES_FILE = os.path.join(DATA_DIR, "courses.json")
ENROLLMENTS_FILE = os.path.join(DATA_DIR, "enrollments.json")
BACKUP_DIR = os.path.join(DATA_DIR, "backups")

DATE_FORMAT = "%Y-%m-%d %H:%M:%S"
