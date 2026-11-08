# app/cli.py
import os
from getpass import getpass
from app.services.user_service import UserService
from app.services.course_service import CourseService
from app.services.enrollment_service import EnrollmentService
from app.services.analytics_service import AnalyticsService
from app.utils.validators import valid_username, valid_course_id, positive_int
from app.models.course import Course

def clear():
    os.system("cls" if os.name == "nt" else "clear")

def pause():
    input("\nPress Enter to continue...")

def student_panel(user_service: UserService, course_service: CourseService, enroll_service: EnrollmentService, student):
    while True:
        clear()
        print(f"Student: {student.full_name} ({student.username})")
        print("1. Browse courses")
        print("2. Enroll")
        print("3. Drop")
        print("4. My schedule")
        print("5. Update profile")
        print("6. Logout")
        choice = input("Select: ").strip()
        if choice == "1":
            clear()
            for c in course_service.list_courses():
                enrolled = len(enroll_service.enrollments.get(c.course_id, []))
                print(f"[{c.course_id}] {c.title} | {enrolled}/{c.capacity} | {c.credits} credits | {c.instructor}")
            pause()
        elif choice == "2":
            cid = input("Course ID: ").strip()
            course = course_service.get_course(cid)
            if not course:
                print("[ERROR] Course not found.")
                pause()
                continue
            ok = enroll_service.enroll(student.username, course)
            print("[OK]" if ok else "[ERROR] Could not enroll.")
            pause()
        elif choice == "3":
            cid = input("Course ID to drop: ").strip()
            ok = enroll_service.drop(student.username, cid)
            print("[OK]" if ok else "[ERROR] Could not drop.")
            pause()
        elif choice == "4":
            clear()
            sched = enroll_service.get_student_schedule(student.username, course_service.courses)
            if not sched:
                print("No enrollments.")
            else:
                for s in sched:
                    print(f"- [{s['course_id']}] {s['title']} ({s['credits']} credits) | {s['instructor']} | Enrolled at {s['enrolled_at']}")
            pause()
        elif choice == "5":
            newname = input(f"Full name [{student.full_name}]: ").strip() or student.full_name
            user_service.update_student(student.username, full_name=newname)
            print("[INFO] Profile updated.")
            pause()
        elif choice == "6":
            break
        else:
            print("Unknown option.")
            pause()

def admin_panel(user_service: UserService, course_service: CourseService, enroll_service: EnrollmentService, admin):
    analytics = AnalyticsService(enroll_service, course_service)
    while True:
        clear()
        print(f"Admin: {admin.full_name} ({admin.username})")
        print("1. Add course")
        print("2. Update course")
        print("3. Remove course")
        print("4. View enrollments")
        print("5. Analytics")
        print("6. Export enrollments CSV")
        print("7. Logout")
        choice = input("Select: ").strip()
        if choice == "1":
            cid = input("Course ID: ").strip()
            if not valid_course_id(cid):
                print("[ERROR] Invalid course id.")
                pause()
                continue
            title = input("Title: ").strip()
            instructor = input("Instructor: ").strip()
            try:
                capacity = int(input("Capacity: ").strip())
                credits = int(input("Credits: ").strip())
            except ValueError:
                print("[ERROR] Capacity/credits must be integers.")
                pause()
                continue
            desc = input("Description: ").strip()
            ok = course_service.add_course(Course(cid, title, instructor, capacity, credits, desc))
            print("[OK]" if ok else "[ERROR] Course exists.")
            pause()
        elif choice == "2":
            cid = input("Course ID to update: ").strip()
            c = course_service.get_course(cid)
            if not c:
                print("[ERROR] Not found.")
                pause()
                continue
            title = input(f"New title [{c.title}]: ").strip() or c.title
            instructor = input(f"New instructor [{c.instructor}]: ").strip() or c.instructor
            capacity = input(f"New capacity [{c.capacity}]: ").strip() or c.capacity
            credits = input(f"New credits [{c.credits}]: ").strip() or c.credits
            desc = input(f"New description [{c.description}]: ").strip() or c.description
            course_service.update_course(cid, title=title, instructor=instructor, capacity=int(capacity), credits=int(credits), description=desc)
            print("[INFO] Updated.")
            pause()
        elif choice == "3":
            cid = input("Course ID to remove: ").strip()
            confirm = input(f"Remove {cid}? (yes/no): ").strip().lower()
            if confirm == "yes":
                ok = course_service.remove_course(cid)
                print("[OK]" if ok else "[ERROR] Not removed.")
            else:
                print("Cancelled.")
            pause()
        elif choice == "4":
            clear()
            what = input("Show (all/<course_id>): ").strip() or "all"
            if what == "all":
                for cid, lst in enroll_service.view_enrollments().items():
                    course = course_service.get_course(cid)
                    print(f"- [{cid}] {course.title if course else ''}: {len(lst)} enrolled")
            else:
                lst = enroll_service.view_enrollments(what)
                if not lst:
                    print("No enrollments.")
                else:
                    for e in lst:
                        print(f"- {e['username']} at {e['timestamp']}")
            pause()
        elif choice == "5":
            clear()
            print("Analytics:")
            print("1. Popular courses")
            print("2. Course capacity")
            print("3. Enrollment trend")
            print("4. Student workload")
            ac = input("Choice: ").strip()
            if ac == "1":
                top = analytics.popular_courses()
                for title, cnt in top:
                    print(f"- {title}: {cnt}")
            elif ac == "2":
                for s in analytics.course_capacity_status():
                    print(f"- [{s['course_id']}] {s['title']} {s['enrolled']}/{s['capacity']} free {s['free_slots']}")
            elif ac == "3":
                for date, cnt in analytics.enrollment_trend():
                    print(f"- {date}: {cnt}")
            elif ac == "4":
                uname = input("Student username: ").strip()
                w = analytics.student_workload(uname)
                print(f"{uname}: {w['total_courses']} courses, {w['total_credits']} credits")
                for c in w["courses"]:
                    print(f"  - {c['course_id']} {c['title']} ({c['credits']})")
            else:
                print("Unknown.")
            pause()
        elif choice == "6":
            path = input("CSV filename (default enrollments_report.csv): ").strip() or "enrollments_report.csv"
            # build CSV
            import csv
            rows = []
            for cid, lst in enroll_service.view_enrollments().items():
                course = course_service.get_course(cid)
                for e in lst:
                    rows.append({
                        "course_id": cid,
                        "course_title": course.title if course else "",
                        "username": e["username"],
                        "timestamp": e["timestamp"]
                    })
            with open(path, "w", newline='', encoding="utf-8") as fp:
                writer = csv.DictWriter(fp, fieldnames=["course_id","course_title","username","timestamp"])
                writer.writeheader()
                writer.writerows(rows)
            print(f"[INFO] Exported to {path}")
            pause()
        elif choice == "7":
            break
        else:
            print("Unknown option.")
            pause()
