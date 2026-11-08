#include <stdio.h>
#include <string.h>
#include <stdlib.h>
#include "teacher_auth.h"

// Simple hash function (djb2) for password hashing
unsigned long hashPassword(const char *str) {
    unsigned long hash = 5381;
    int c;
    while ((c = *str++))
        hash = ((hash << 5) + hash) + c;
    return hash;
}

typedef struct {
    char username[MAX_USERNAME];
    unsigned long passwordHash;
} TeacherRecord;

int registerTeacher(const char *username, const char *password) {
    FILE *file = fopen("teachers.data", "ab+");
    if (!file) {
        perror("Failed to open teachers.dat");
        return 0;
    }

    // Check if username already exists
    TeacherRecord record;
    while (fread(&record, sizeof(TeacherRecord), 1, file) == 1) {
        if (strcmp(record.username, username) == 0) {
            fclose(file);
            printf("\033[1;31mUsername already exists.\033[0m\n");
            return 0;
        }
    }

    // Add new teacher
    strncpy(record.username, username, MAX_USERNAME);
    record.passwordHash = hashPassword(password);

    fwrite(&record, sizeof(TeacherRecord), 1, file);
    fclose(file);
    printf("\033[1;32mRegistration successful!\033[0m\n");
    printf("\033[1;33mPlease restart the program and login to continue.\033[0m\n");
    return 1;
}

int loginTeacher(const char *username, const char *password) {
    FILE *file = fopen("teachers.data", "rb");
    if (!file) {
        printf("\033[1;31mNo registered teachers. Please register first.\033[0m\n");
        return 0;
    }

    TeacherRecord record;
    unsigned long hashedInput = hashPassword(password);

    while (fread(&record, sizeof(TeacherRecord), 1, file) == 1) {
        if (strcmp(record.username, username) == 0) {
            fclose(file);
            if (record.passwordHash == hashedInput) {
                printf("\033[1;32mLogin successful!\033[0m\n");
                return 1;
            } else {
                printf("\033[1;31mIncorrect password.\033[0m\n");
                return 0;
            }
        }
    }
    fclose(file);
    printf("\033[1;31mUsername not found.\033[0m\n");
    return 0;
}
