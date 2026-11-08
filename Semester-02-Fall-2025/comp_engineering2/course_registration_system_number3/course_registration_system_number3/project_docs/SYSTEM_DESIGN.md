                                                    System Design — Advanced Course Registration & Student Management System
1. Purpose & Scope

This document describes the architecture, major components, data model, flows, and non-functional considerations for the project. It explains why design choices were made and how the system meets the course requirements (OOP, file persistence, analytics, roles).

2. High-level Architecture (Overview)

Type: Single-process modular CLI application (can be extended to web later).

Languages / Libraries: Python 3.8+ (standard library only).

Layers:

CLI / Presentation Layer — app/main.py, app/cli.py (user interaction).

Service Layer — app/services/* (business logic: user, course, enrollment, analytics).

Model Layer — app/models/* (domain objects: Student, Course, Admin).

Persistence / DB Layer — app/services/database.py (safe JSON read/write, backups).

Utils — app/utils/* (hashing, validators).

Storage: JSON files in data/:

users.json — students and admins.

courses.json — course catalog.

enrollments.json — enrollment lists with timestamps.

Backups stored in data/backups/ (timestamped copies before writes).

3. Component Summary

Models

Student: username, full_name, password_hash, student_id, metadata

Admin: username, full_name, password_hash

Course: course_id, title, instructor, capacity, credits, description

Services

UserService: registration, authentication, profile updates, default admin creation

CourseService: create/update/delete/list courses, sample creation

EnrollmentService: enroll/drop, student schedule, view enrollments, persist enrollments

AnalyticsService: popular courses, capacity status, student workload, enrollment trend

Database (service): safe load/save + backup

CLI

Student and Admin menus with intuitive options

main.py orchestrates startup and high-level menu

4. Data Model (ERD summary)

Three primary entities:

Student (student_id, username, full_name, metadata)

Course (course_id, title, instructor, capacity, credits, description)

Enrollment (student_id, course_id, timestamp)

Relationships:

Student —< Enrollment >— Course
(Each Student can have many Enrollments; each Course can have many Enrollments; Enrollment links a Student and Course and stores enrollment timestamp.)

(ERD image has been created and can be included in docs: it shows Student and Course linking to Enrollment with one-to-many relationships.)

5. Sequence Flows (examples)
a) Student enroll flow

Student logs in (UserService authenticate).

CLI shows available courses (CourseService.list_courses).

Student picks course_id.

EnrollmentService.enroll checks:

course exists,

student not already enrolled,

capacity not exceeded.

On success, enrollment record appended with ISO timestamp; EnrollmentService.persist() writes enrollments.json (backups created first).

b) Admin adding course

Admin logs in (UserService.authenticate_admin).

Admin enters course details via CLI.

CourseService.add_course validates course_id uniqueness and persists courses.json.

6. Persistence & Reliability

Safe save pattern: Write to temporary file then atomic replace -> reduces corruption risk.

Backups: Before major writes, the system stores age-stamped backups to data/backups/.

Corrupt file handling: On JSON decode error, the DB service warns and uses default empty structures (prevents crash).

Isolation for tests: Tests monkeypatch data paths into temporary directories.

7. Security considerations

Passwords: Stored hashed using SHA-256 (demonstration-level).

For production, replace with salted PBKDF2 / bcrypt / Argon2 with per-user salt.

Access control: Role-based CLI panels (Student vs Admin).

Data privacy: Local files — restrict OS permissions (not handled in code).

Sensitive operations: Admin-only (course creation/removal, export reports).

8. Scalability & Extensibility

Scale up storage: Replace JSON layer with an RDBMS (Postgres/SQLite) by implementing new database layer methods.

Authentication enhancements: Add session tokens, multi-factor auth, password reset flows.

Concurrency: Current design is single-threaded. For multi-user concurrency (web), use transactional DB and locking mechanisms.

9. Testing Strategy

Unit tests for services and utils (provided under tests/): user_service, course_service, enrollment_service, validators, hashing.

Integration tests: run main program flows in a temp directory to ensure persistence works end-to-end.

CI: Add a GitHub Actions workflow to run pytest on push/pull requests.

10. Deployment & Run

Local CLI: python -m app.main or cd app && python main.py.

Dependencies: Standard library only — no external pip packages required.

Configuration: app/config.py holds data paths & constants. Tests monkeypatch these for isolation.

11. Future Improvements

Use SQLite/Postgres and ORM (SQLAlchemy) for real persistence.

Implement a web UI (Flask/FastAPI + simple HTML/JS).

Use bcrypt / Argon2 for password hashing.

Add role management and audit logs.

Improve analytics (time-series graphs), export to Excel, or integrate with visualization libraries.