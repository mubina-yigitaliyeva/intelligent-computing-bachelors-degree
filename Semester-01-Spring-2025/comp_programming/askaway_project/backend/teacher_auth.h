#ifndef AUTH_H
#define AUTH_H

#define MAX_USERNAME 50
#define MAX_PASSWORD 50

int registerTeacher(const char *username, const char *password);
int loginTeacher(const char *username, const char *password);

#endif
