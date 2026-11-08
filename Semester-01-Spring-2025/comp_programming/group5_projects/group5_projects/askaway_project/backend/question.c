#include <stdio.h>
#include <string.h>
#include <strings.h>
#include <stdlib.h>
#include <windows.h>
#include "question.h"
#include "utils.h"

#define RED     "\x1b[31m"
#define GREEN   "\x1b[32m"
#define YELLOW  "\x1b[33m"
#define BLUE    "\x1b[34m"
#define RESET   "\x1b[0m"

Question questionDB[MAX_QUESTIONS];
int questionCount = 0;

void addQuestion(const char *text, const char *topic, const char *subject, int semester) {
    if (questionCount >= MAX_QUESTIONS) return;
    questionDB[questionCount].id = questionCount + 1;
    strncpy(questionDB[questionCount].text, text, MAX_TEXT);
    strncpy(questionDB[questionCount].topic, topic, MAX_TOPIC);
    strncpy(questionDB[questionCount].subject, subject, MAX_SUBJECT);
    questionDB[questionCount].semester = semester;
    getCurrentTime(questionDB[questionCount].date, MAX_DATE);
    strcpy(questionDB[questionCount].answer, "Not answered yet");
    questionCount++;
    saveQuestions();
}

void answerQuestionById(int id, const char *answer) {
    for (int i = 0; i < questionCount; i++) {
        if (questionDB[i].id == id) {
            strncpy(questionDB[i].answer, answer, MAX_ANSWER);
            saveQuestions();
            return;
        }
    }
    printf("\033[1;31mQuestion with ID %d not found.\033[0m\n", id);
}

void saveQuestions() {
    FILE *file = fopen("questions.json", "w");
    fprintf(file, "[\n");
    for (int i = 0; i < questionCount; i++) {
    fprintf(file, "  {\"id\": %d, \"topic\": \"%s\", \"subject\": \"%s\", \"semester\": %d, \"text\": \"%s\", \"date\": \"%s\", \"answer\": \"%s\"}%s\n",
        questionDB[i].id, questionDB[i].topic, questionDB[i].subject, questionDB[i].semester,
        questionDB[i].text, questionDB[i].date, questionDB[i].answer,
        i < questionCount - 1 ? "," : "");
    }
    fprintf(file, "]\n");
    fclose(file);
}

void loadQuestions() {
    FILE *file = fopen("questions.json", "r");
    if (!file) {
        printf("Could not open questions.json\n");
        return;
    }

    char ch;
    fscanf(file, " %c", &ch); 
    if (ch != '[') {
        printf("Invalid JSON format (missing [)\n");
        fclose(file);
        return;
    }

    questionCount = 0;

    while (1) {
        int read = fscanf(file,
            " {\"id\": %d, \"topic\": \"%99[^\"]\", \"subject\": \"%99[^\"]\", \"semester\": %d, \"text\": \"%511[^\"]\", \"date\": \"%29[^\"]\", \"answer\": \"%511[^\"]\"}",
            &questionDB[questionCount].id,
            questionDB[questionCount].topic,
            questionDB[questionCount].subject,
            &questionDB[questionCount].semester,
            questionDB[questionCount].text,
            questionDB[questionCount].date,
            questionDB[questionCount].answer);

        if (read != 7) {
            break; 
        }

        questionCount++;

        fscanf(file, " %c", &ch);
        if (ch != ',') {
            break; 
        }
    }

    fclose(file);
    printf("Loaded %d questions from JSON\n", questionCount);
}


void displayQuestionsByTopic(const char *topic) {
    printf("\nSearching for topic: %s\n", topic);
    int found = 0;
    printf("\033[1;36mQuestions on topic: %s\033[0m\n", topic);
    for (int i = 0; i < questionCount; i++) {
        if (strcasecmp(questionDB[i].topic, topic) == 0) {
            printQuestionWithAnswer(&questionDB[i]);
            found = 1;
        }
    }
    if (!found) {
        printf("\033[1;31mNo questions found for topic '%s'.\033[0m\n", topic);
    }
}


void loadingAnimation(const char *message, int repeat) {
    for (int i = 0; i < repeat; i++) {
        printf("\r%s%d", message, i+1);  // print the message
        fflush(stdout);           // flush buffer
        Sleep(500);               // sleep 500 milliseconds

        printf("\r");             // return cursor to start
        for (int j = 0; j < (int)strlen(message); j++) {
            printf(" ");          // overwrite message with spaces
        }
        fflush(stdout);
        Sleep(500);               // sleep 500 milliseconds
        printf("\r");             // return cursor again
    }
};

void displayAllQuestions(int answered) {
    loadingAnimation("Loading questions...", 2);
    if (questionCount == 0) {
        printf("\033[1;31mNo questions available.\033[0m\n");
        return;
    }

    printf("\n\t ===== ALL QUESTIONS ===== \n\n");
    for (int i = 0; i < questionCount; i++) {
        Question q = questionDB[i];
        if (!answered && strcmp(q.answer, "Not answered yet") != 0) {
            continue;
        }
        printf("\033[1;34m<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<\033[0m\n");
        printf("ID       : %d\n", q.id);
        printf("Topic    : %s\n", q.topic);
        printf("Subject  : %s\n", q.subject);
        printf("Semester : %d\n", q.semester);
        printf(RED "Question : %s\n", q.text);
        printf(RESET "Date     : %s\n", q.date);
        printf(GREEN "Answer   : %s\n", q.answer);        
        printf("\033[1;34m>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>\033[0m\n");
    }
}

void printQuestionWithAnswer(Question *q) {
    printf("ID: %d\nQuestion: %s\nTopic: %s\nSubject: %s\nSemester: %d\n",
           q->id, q->text, q->topic, q->subject, q->semester);
    if (strlen(q->answer) > 0) {
        printf("Answer: %s\n", q->answer);
    } else {
        printf("Answer: (No answer yet)\n");
    }
    printf("----------------------\n");
}

void searchQuestionsByKeyword(const char *keyword) {
    int found = 0;
    for (int i = 0; i < questionCount; i++) {
        if (strstr(questionDB[i].text, keyword) != NULL) {
            printQuestionWithAnswer(&questionDB[i]);
            found = 1;
        }
    }
    if (!found) {
        printf("\033[1;31mNo questions found matching '%s'.\033[0m\n", keyword);
    }
}

void displayQuestionsBySemester(int semester) {
    int found = 0;
    for (int i = 0; i < questionCount; i++) {
        if (questionDB[i].semester == semester) {
            printQuestionWithAnswer(&questionDB[i]);
            found = 1;
        }
    }
    if (!found) {
        printf("\033[1;31mNo questions found for semester %d.\033[0m\n", semester);
    }
}

void displayQuestionsBySubjectAndTopic(const char *subject, const char *topic) {
    int found = 0;
    for (int i = 0; i < questionCount; i++) {
        if (strcasecmp(questionDB[i].subject, subject) == 0 &&
            strcasecmp(questionDB[i].topic, topic) == 0) {
            printQuestionWithAnswer(&questionDB[i]);
            found = 1;
        }
    }
    if (!found) {
        printf("\033[1;31mNo questions found for subject '%s' and topic '%s'.\033[0m\n", subject, topic);
    }
}


void displaySummary() {
    int answered = 0, unanswered = 0;
    int semesterCounts[10] = {0};
    printf("\n\033[1;36m========== QUESTION SUMMARY ==========\033[0m\n");
    printf("Total questions: \033[1;33m%d\033[0m\n", questionCount);

    for (int i = 0; i < questionCount; i++) {
        if (strcmp(questionDB[i].answer, "Not answered yet") == 0)
            unanswered++;
        else
            answered++;
        if (questionDB[i].semester >= 1 && questionDB[i].semester <= 10)
            semesterCounts[questionDB[i].semester]++;
    }

    printf("Answered questions: \033[1;32m%d\033[0m\n", answered);
    printf("Unanswered questions: \033[1;31m%d\033[0m\n", unanswered);

    printf("\nQuestions per semester:\n");
    for (int i = 1; i <= 10; i++) {
        if (semesterCounts[i] > 0)
            printf("  Semester %d: \033[1;34m%d\033[0m questions\n", i, semesterCounts[i]);
    }

    printf("\033[1;36m=========================================\033[0m\n");
}
