#include <stdio.h>
#include <stdlib.h>
#include <string.h>
#include "question.h"
#include "utils.h"
#include "teacher_auth.h"
#define RED     "\x1b[31m"
#define GREEN   "\x1b[32m"
#define YELLOW  "\x1b[33m"
#define BLUE    "\x1b[34m"
#define RESET   "\x1b[0m"

void teacherMenu();
void studentMenu();
void clearWindow();
void pauseAfterDisplay();  

int main() {
    loadQuestions();
    #ifdef _WIN32
        system("cls");
    #else
        system("clear");
    #endif
    int roleChoice;
    printf("\033[1;34mWelcome to AskAway!\033[0m\n");
    printf("1. Student\n2. Teacher\nChoose role: ");
    scanf("%d", &roleChoice);
    clearInputBuffer();

    if (roleChoice == 1) {
        studentMenu();
    } else if (roleChoice == 2) {
        int authChoice;
        printf("1. Login\n2. Register\nChoose option: ");
        scanf("%d", &authChoice);
        clearInputBuffer();

        if (authChoice == 1) {
            char username[MAX_USERNAME], password[MAX_PASSWORD];
            printf("Enter username: ");
            fgets(username, sizeof(username), stdin);
            username[strcspn(username, "\n")] = 0;
            printf("Enter password: ");
            fgets(password, sizeof(password), stdin);
            password[strcspn(password, "\n")] = 0;

            if (loginTeacher(username, password)) {
                teacherMenu();
            }
        } else if (authChoice == 2) {
            char username[MAX_USERNAME], password[MAX_PASSWORD];
            printf("Choose username: ");
            fgets(username, sizeof(username), stdin);
            username[strcspn(username, "\n")] = 0;
            printf("Choose password: ");
            fgets(password, sizeof(password), stdin);
            password[strcspn(password, "\n")] = 0;

            registerTeacher(username, password);
        } else {
            printf("\033[1;31mInvalid option\033[0m\n");
        }
    } else {
        printf("\033[1;31mInvalid choice\033[0m\n");
    }
    return 0;
}

void studentMenu() {
    int option;
    while (1) {
        printf("\n\033[1;34m=========================================\033[0m\n");
        printf("\033[1;36m         STUDENT QUESTION MENU        \033[0m\n");
        printf("\033[1;34m=========================================\033[0m\n");
        printf("1. Ask a new question\n");
        printf("2. Search questions by keyword\n");
        printf("3. View all questions\n");
        printf("4. View questions by topic\n");
        printf("5. View questions by semester\n");
        printf("6. View by subject & topic\n");
        printf("7. Exit\n");
        printf("\033[1;34m=========================================\033[0m\n");
        printf("\033[1;33mChoose an option: \033[0m");
        scanf("%d", &option);
        clearInputBuffer();

        if (option == 1) {
            clearWindow();
            char text[MAX_TEXT], topic[MAX_TOPIC], subject[MAX_SUBJECT];
            int semester;

            printf("Enter your question: ");
            fgets(text, sizeof(text), stdin);
            text[strcspn(text, "\n")] = 0;

            printf("Enter topic: ");
            fgets(topic, sizeof(topic), stdin);
            topic[strcspn(topic, "\n")] = 0;

            printf("Enter subject: ");
            fgets(subject, sizeof(subject), stdin);
            subject[strcspn(subject, "\n")] = 0;

            do {
                printf("Enter semester (1-8): ");
                scanf("%d", &semester);
                clearInputBuffer();
            } while (semester < 1 || semester > 8);

            addQuestion(text, topic, subject, semester);
            printf("\033[1;32mQuestion added successfully!\033[0m\n");
            pauseAfterDisplay();

        } else if (option == 2) {
            clearWindow();
            char keyword[MAX_TEXT];
            printf("Enter keyword to search: ");
            fgets(keyword, sizeof(keyword), stdin);
            keyword[strcspn(keyword, "\n")] = 0;
            searchQuestionsByKeyword(keyword);
            pauseAfterDisplay();

        } else if (option == 3) {
            // loadQuestions();
            clearWindow();
            displayAllQuestions(1);
            pauseAfterDisplay();

        } else if (option == 4) {
            clearWindow();
            char topic[MAX_TOPIC];
            printf("Enter topic: ");
            fgets(topic, sizeof(topic), stdin);
            topic[strcspn(topic, "\n")] = 0;
            displayQuestionsByTopic(topic);
            pauseAfterDisplay();

        } else if (option == 5) {
            clearWindow();
            int semester;
            do {
                printf("Enter semester (1-8): ");
                scanf("%d", &semester);
                clearInputBuffer();
            } while (semester < 1 || semester > 8);
            displayQuestionsBySemester(semester);
            pauseAfterDisplay();

        } else if (option == 6) {
            clearWindow();
            char subject[MAX_SUBJECT], topic[MAX_TOPIC];
            printf("Enter subject: ");
            fgets(subject, sizeof(subject), stdin);
            subject[strcspn(subject, "\n")] = 0;

            printf("Enter topic: ");
            fgets(topic, sizeof(topic), stdin);
            topic[strcspn(topic, "\n")] = 0;

            displayQuestionsBySubjectAndTopic(subject, topic);
            pauseAfterDisplay();

        } else if (option == 7) {
            break;

        } else {
            printf("\033[1;31mInvalid option\033[0m\n");
        }
    }
}


void teacherMenu() {
    int option;

    while (1) {
        printf(BLUE "\n+--------------------------------------+\n");
        printf(RED "|           TEACHER MENU               |\n");
        printf(BLUE "+--------------------------------------+\n");
        printf("|  1. View all questions               |\n");
        printf("|  2. View by topic                    |\n");
        printf("|  3. View all unanswered questions    |\n");
        printf("|  4. Answer a question                |\n");
        printf("|  5. Display summary                  |\n");
        printf("|  6. Exit                             |\n");
        printf(BLUE "+--------------------------------------+\n");


        printf("\n\033[1;33mEnter your choice: \033[0m");
        scanf("%d", &option);
        clearInputBuffer();

        switch (option) {
            case 1:
                displayAllQuestions(1);
                pauseAfterDisplay();
                break;
            case 2: {
                char topic[MAX_TOPIC];
                printf("Enter topic: ");
                fgets(topic, sizeof(topic), stdin);
                topic[strcspn(topic, "\n")] = 0;
                displayQuestionsByTopic(topic);
                pauseAfterDisplay();
                break;
            }
            case 3: {
                displayAllQuestions(0);
                pauseAfterDisplay();
                break;
            }
            case 4: {
                int id;
                char answer[MAX_ANSWER];
                printf("Enter question ID: ");
                scanf("%d", &id);
                clearInputBuffer();
                printf("Enter your answer: ");
                fgets(answer, sizeof(answer), stdin);
                answer[strcspn(answer, "\n")] = 0;
                answerQuestionById(id, answer);
                pauseAfterDisplay();
                break;
            }
            case 5:
                displaySummary();
                pauseAfterDisplay();
                break;
            case 6:
                printf("\033[1;32mExiting Teacher Menu. Goodbye!\033[0m\n");
                return;
            default:
                printf("\033[1;31mInvalid option. Please try again.\033[0m\n");
        }
    }
}

void clearWindow() {
    #ifdef _WIN32
        system("cls");
    #else
        system("clear");
    #endif
}

void pauseAfterDisplay() {
    char input[10];
    printf("\n\033[1;35mPress Enter to return to the menu or type 'q' to quit: \033[0m");
    fgets(input, sizeof(input), stdin);
    if (input[0] == 'q' || input[0] == 'Q') {
        printf("\033[1;32mGoodbye!\033[0m\n");
        exit(0);
    }
    // If Enter is pressed, it returns to menu
}
