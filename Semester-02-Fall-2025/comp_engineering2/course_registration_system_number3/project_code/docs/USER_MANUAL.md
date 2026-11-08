User Manual — Advanced Course Registration & Student Management System
Table of Contents

Quick Start (Install & Run)

File structure & where data is stored

Default accounts & sample data

Student user guide (register, login, enroll/drop, view schedule, update profile)

Admin user guide (login, add/update/remove courses, view enrollments, analytics, export CSV)

Command examples & screenshots (CLI text)

Troubleshooting & FAQs

Advanced usage (running tests, backups)

Contact & contributions

1. Quick Start (Install & Run)
Requirements

Python 3.8 or newer installed.

Optional: virtualenv or venv for environment isolation.

pytest to run tests (optional).

Steps

Clone or copy the project into a folder course_registration_system/.

From the project root, run:

python -m app.main


or:

cd course_registration_system/app
python main.py


The CLI menu will appear.

2. File Structure & Data Location
course_registration_system/
├── app/                # application code
├── data/               # created automatically on first run
│   ├── users.json
│   ├── courses.json
│   ├── enrollments.json
│   └── backups/
├── tests/              # pytest unit tests
└── README.md


data/ is created automatically. If you want to reset data, stop the app and remove files in data/ (or use backups).

3. Default Accounts & Sample Data

Default admin (auto-created on first run):

Username: admin

Password: admin123
(Change or delete this account after first use.)

The system can populate sample courses automatically the first time.

4. Student User Guide
Register new student

From main menu choose 3. Register (Student).

Provide:

Choose username: (alphanumeric, underscores allowed; 3–30 chars)

Full name:

Password and Confirm password

On success: message [OK] Registration successful.

Login as student

From main menu choose 1. Login (Student).

Enter Username and Password.

Student Panel options

Browse courses: lists all courses with capacity usage and credits.

Enroll in a course:

Choose Enroll and enter Course ID (e.g., CS101).

Enrollment checks: not already enrolled, course not full.

Drop a course:

Choose Drop and enter Course ID.

View schedule: shows enrolled courses with timestamps and credits.

Update profile: change full name and add metadata (key=value).

Logout returns to main menu.

Example flow:

Select: 1  # Login Student
Username: alice
Password: ****
# after login:
Select: 2  # Enroll
Course ID: CS101
[OK] or [ERROR]

5. Admin User Guide
Login as admin

From main menu choose 2. Login (Admin) and enter admin credentials.

Admin Panel options

Add course

Provide: Course ID, Title, Instructor, Capacity, Credits, Description.

Course ID must be unique.

Update course

Enter existing Course ID; leave fields blank to keep existing values.

Remove course

Provide Course ID. If enrollments exist, system warns; confirm to remove.

View enrollments

Show all or specific course enrollments.

Analytics

Popular courses (top N)

Course capacity status (enrolled vs capacity)

Enrollment trend by date

Student workload (total credits)

Export enrollments CSV

Provide filename (default enrollments_report.csv). CSV contains course_id,course_title,username,timestamp.

Logout

Example: Add course

Select: 1  # Add course
Course ID: CS301
Title: Algorithms
Instructor: Prof. Lee
Capacity: 40
Credits: 3
Description: Advanced algorithms
[OK]

6. Command Examples & Screenshots

This is a CLI app, so screenshots are terminal text. Example key commands:

Start: python -m app.main

Register: follow menu 3. Register (Student)

Admin export: login as admin → Admin Panel → Export enrollments CSV

(If you want, I can produce images showing the terminal flow for your slides.)

7. Troubleshooting & FAQs

Q: The app shows [WARN] Unable to read data file.
A: One of the JSON files is corrupted (invalid JSON). The app will use defaults. Recover data from data/backups/.

Q: I forgot admin password.
A: Remove data/users.json (or edit it) to reset, or create a new admin by modifying users.json. (For classroom use, re-create default admin: set file to empty {} and re-run: the system will create default admin again.)

Q: Enrollment fails but course not full.
A: Check if user is already enrolled (duplicate enrollment blocked).

Q: How to change data directory?
A: Modify app/config.py constants DATA_DIR etc. (Be careful — tests assume default behavior.)

8. Advanced Usage
Running tests

Install pytest: pip install pytest

From project root:

pytest -q

Tests use tests/conftest.py to place app data into a temporary directory — they will not touch your data/ folder.