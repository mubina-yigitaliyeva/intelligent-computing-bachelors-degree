#ifndef QUESTION_H
#define QUESTION_H

#define MAX_QUESTIONS 100
#define MAX_TEXT 512
#define MAX_TOPIC 100
#define MAX_DATE 30
#define MAX_ANSWER 512

#define MAX_SUBJECT 100

typedef struct {
    int id;
    char text[MAX_TEXT];
    char topic[MAX_TOPIC];
    char subject[MAX_SUBJECT];    
    int semester;                 
    char date[MAX_DATE];
    char answer[MAX_ANSWER];
} Question;


void addQuestion(const char *text, const char *topic, const char *subject, int semester);
void answerQuestionById(int id, const char *answer);
void saveQuestions();
void loadQuestions();
void displayQuestionsByTopic(const char *topic);
void displayAllQuestions(int answered);
void printQuestionWithAnswer(Question *q);
void searchQuestionsByKeyword(const char *keyword);
void displayQuestionsBySemester(int semester) ;
void displayQuestionsBySubjectAndTopic(const char *subject, const char *topic);
void displaySummary();
void loadingAnimation(const char *message, int repeat);

#endif