# app/services/database.py
import json
import os
import shutil
from typing import Any
from datetime import datetime
from app.config import DATA_DIR, BACKUP_DIR, USERS_FILE, COURSES_FILE, ENROLLMENTS_FILE

def ensure_dirs(): # Make sure folders exist
    os.makedirs(DATA_DIR, exist_ok=True)
    os.makedirs(BACKUP_DIR, exist_ok=True)

def backup_file(path: str): # Make a backup of the current JSON
    if not os.path.exists(path):
        return
    ts = datetime.now().strftime("%Y%m%d_%H%M%S")
    base = os.path.basename(path)
    shutil.copy(path, os.path.join(BACKUP_DIR, f"{base}.{ts}.bak"))

def safe_load(path: str, default: Any): # loads data from JSON file
    if not os.path.exists(path):
        return default
    try:
        with open(path, "r", encoding="utf-8") as fp:
            return json.load(fp)
    except (json.JSONDecodeError, IOError):
        print(f"[WARN] Unable to read {path}. Using default.")
        return default

def safe_save(path: str, data: Any):  # Save new data directly
    with open(path, "w", encoding="utf-8") as fp:
        json.dump(data, fp, indent=2, ensure_ascii=False)

def load_users():
    ensure_dirs()
    default = {"students": {}, "admins": {}}
    return safe_load(USERS_FILE, default)

def save_users(data):
    ensure_dirs()
    backup_file(USERS_FILE)
    safe_save(USERS_FILE, data)

def load_courses():
    ensure_dirs()
    return safe_load(COURSES_FILE, {})

def save_courses(data):
    ensure_dirs()        # Make sure folders exist
    backup_file(COURSES_FILE)  # Make a backup of the current JSON
    safe_save(COURSES_FILE, data)  # Save new data safely

def load_enrollments():
    ensure_dirs()
    return safe_load(ENROLLMENTS_FILE, {})

def save_enrollments(data):
    ensure_dirs()
    backup_file(ENROLLMENTS_FILE)
    safe_save(ENROLLMENTS_FILE, data)
