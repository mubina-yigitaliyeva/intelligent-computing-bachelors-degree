#include <stdio.h>
#include <stdlib.h>
#include <windows.h>
#include "interface.h"
#include "reflection.h"

#ifndef CP_UTF8
#define CP_UTF8 65001
#endif

#define RED     "\x1b[31m"
#define GREEN   "\x1b[32m"
#define YELLOW  "\x1b[33m"
#define BLUE    "\x1b[34m"
#define RESET   "\x1b[0m"

int main() {
    SetConsoleOutputCP(CP_UTF8);  //UTF-8 output on Windows
    int lang = select_language();
    int choice;

    while (1) {
        printf("\n" GREEN "%s\n" RESET, menu_texts[lang][0]); 
        for (int i = 1; i <= 5; i++) {
            printf(YELLOW "%s\n" RESET, menu_texts[lang][i]);
        }
        printf(BLUE "%s" RESET, input_prompt[lang]);  
        scanf("%d", &choice);
        getchar(); 

        switch (choice) {
            case 1:
                run_reflection_session(lang);
                break;
            case 2:
                view_reflections(lang);
                break;
            case 3:
                export_to_json(lang);
                break;
            case 4:
                self_development(lang);
                break;
            case 5:
                printf(GREEN "%s\n" RESET, goodbye_text[lang]);
                exit(0);
            default:
                printf(RED "%s\n" RESET, invalid_choice_text[lang]);  
        }
    }
    return 0;
}
