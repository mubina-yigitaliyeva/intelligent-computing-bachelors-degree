# app/main.py
from app.services.user_service import UserService
from app.services.course_service import CourseService
from app.services.enrollment_service import EnrollmentService
from app.cli import student_panel, admin_panel, clear, pause
from getpass import getpass

def main():
    user_svc = UserService()
    course_svc = CourseService()
    enroll_svc = EnrollmentService(user_svc)

    # ensure default admin and sample courses
    user_svc.create_default_admin()
    course_svc.create_sample_courses()

    while True:
        clear()
        print("=== Advanced Course Registration & Student Management System ===")
        print("1. Login (Student)")
        print("2. Login (Admin)")
        print("3. Register (Student)")
        print("4. Quit")
        choice = input("Select: ").strip()
        if choice == "1":
            username = input("Username: ").strip()
            password = getpass("Password: ")
            stud = user_svc.authenticate_student(username, password)
            if stud:
                pause()
                student_panel(user_svc, course_svc, enroll_svc, stud)
            else:
                print("[ERROR] Invalid credentials.")
                pause()
        elif choice == "2":
            username = input("Admin username: ").strip()
            password = getpass("Password: ")
            adm = user_svc.authenticate_admin(username, password)
            if adm:
                pause()
                admin_panel(user_svc, course_svc, enroll_svc, adm)
            else:
                print("[ERROR] Invalid admin credentials.")
                pause()
        elif choice == "3":
            username = input("Choose username: ").strip()
            full_name = input("Full name: ").strip()
            password = getpass("Password: ")
            password2 = getpass("Confirm password: ")
            if password != password2:
                print("[ERROR] Passwords do not match.")
                pause()
                continue
            ok = user_svc.register_student(username, full_name, password)
            print("[OK]" if ok else "[ERROR] Registration failed (username might exist).")
            pause()
        elif choice == "4":
            print("Goodbye!")
            break
        else:
            print("Unknown option.")
            pause()

if __name__ == "__main__":
    main()
