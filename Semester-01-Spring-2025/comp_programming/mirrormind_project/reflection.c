#include <stdio.h>
#include <stdlib.h>
#include <string.h>
#include <time.h>
#include "interface.h"

#define RED     "\x1b[31m"
#define GREEN   "\x1b[32m"
#define YELLOW  "\x1b[33m"
#define BLUE    "\x1b[34m"
#define RESET   "\x1b[0m"

// Questions and insights in 5 languages
const char *questions[5][5] = {
    // Uzbek, English, Indonesian, Nepali, Bengali
    {
        "Baxt siz uchun nimani anglatadi?",
        "O'zingizni chinakam tirik his qilgan lahzani tasvirlab bering.",
        "Sizni eng ko'p qo'rqitadigan narsa nima va nega?",
        "Muvaffaqiyatni qanday tariflaysiz?",
        "Hayotingizda sizni nima to'sib qo'ymoqda?"
    },
    {
        "What does happiness mean to you?",
        "Describe a moment you felt truly alive.",
        "What do you fear the most and why?",
        "How do you define success?",
        "What is holding you back in life?"
    },
    {
        "Apa arti kebahagiaan bagi Anda?",
        "Gambarkan saat ketika Anda merasa benar-benar hidup.",
        "Apa yang paling Anda takuti dan mengapa?",
        "Bagaimana Anda mendefinisikan kesuksesan?",
        "Apa yang menghalangi Anda dalam hidup?"
    },
    {
        "तपाईंको लागि खुशीको अर्थ के हो?",
        "तपाईं साँच्चै जीवित महसुस गर्नुभएको क्षण वर्णन गर्नुहोस्।",
        "तपाईंलाई सबैभन्दा डर लागेको कुरा के हो र किन?",
        "तपाईं सफलता कसरी परिभाषित गर्नुहुन्छ?",
        "तपाईंको जीवनमा केले तपाईंलाई रोकिराखेको छ?"
    },
    {
        "আপনার কাছে সুখের মানে কী?",
        "একটি মুহূর্ত বর্ণনা করুন যখন আপনি সত্যিই জীবিত বোধ করেছিলেন।",
        "আপনি সবচেয়ে বেশি কী ভয় পান এবং কেন?",
        "আপনি সফলতাকে কীভাবে সংজ্ঞায়িত করেন?",
        "জীবনে কী আপনাকে আটকে রেখেছে?"
    }
};

const char *insights[5][5] = {
    {
        "Savol bering, o'zingizni o'stiring.",
        "Haqiqat o'zingizga rostgo'ylik bilan boshlanadi.",
        "Kichik qadamlar katta o'zgarishlar keltiradi.",
        "Siz o'z hikoyangizning muallifisiz.",
        "O'z-o'zini anglash — o'zgarishning birinchi bosqichi."
    },
    {
        "Keep questioning, keep growing.",
        "Truth begins with honesty to yourself.",
        "Small steps create big changes.",
        "You are the author of your story.",
        "Awareness is the first step to change."
    },
    {
        "Terus bertanya, terus berkembang.",
        "Kebenaran dimulai dengan kejujuran pada diri sendiri.",
        "Langkah kecil menciptakan perubahan besar.",
        "Anda adalah penulis kisah Anda sendiri.",
        "Kesadaran adalah langkah pertama menuju perubahan."
    },
    {
        "सधैं प्रश्न गरिरहनुहोस्, सधैं बढ्दै जानुहोस्।",
        "सत्य तपाईं आफैंसँगको इमानदारीबाट सुरु हुन्छ।",
        "सानो कदमले ठूलो परिवर्तन ल्याउँछ।",
        "तपाईं आफ्नो कथाका लेखक हुनुहुन्छ।",
        "चेतना परिवर्तनतर्फको पहिलो पाइला हो।"
    },
    {
        "প্রশ্ন করে যান, নিজের উন্নতি ঘটান।",
        "সত্য নিজেকে সৎ থাকার মধ্যেই শুরু হয়।",
        "ছোট পদক্ষেপ বড় পরিবর্তন আনে।",
        "আপনি আপনার কাহিনির লেখক।",
        "সচেতনতা হল পরিবর্তনের প্রথম ধাপ।"
    }
};

void run_reflection_session(int lang) {
    srand((unsigned int)time(NULL));
    int q = rand() % 5;

    printf("\n%s\n", questions[lang][q]);

    const char *prompt[] = {
        "Javobingiz: ",
        "Your answer: ",
        "Jawaban Anda: ",
        "तपाईंको उत्तर: ",
        "আপনার উত্তর: "
    };
    printf("%s%s", BLUE, prompt[lang]);

    char answer[1024];
    fgets(answer, sizeof(answer), stdin);
    answer[strcspn(answer, "\n")] = 0;

    FILE *f = fopen("reflections.txt", "a");
    if (f) {
        time_t now = time(NULL);
        fprintf(f, "[%s] Q: %s\nA: %s\n\n", ctime(&now), questions[lang][q], answer);
        fclose(f);
        printf("\n💡 %s\n", insights[lang][q]);
    } else {
        printf(RED "Failed to save your reflection.\n" RESET);
    }
}

void view_reflections(int lang) {
    const char *headers[] = {
        "Oldingi refleksiyalar",
        "Past Reflections",
        "Refleksi Sebelumnya",
        "अघिल्ला प्रतिबिम्बहरू",
        "পূর্ববর্তী প্রতিচিন্তা"
    };
    printf("\n--- %s ---\n" RESET, headers[lang]);

    FILE *f = fopen("reflections.txt", "r");
    if (!f) {
        const char *not_found[] = {
            "Refleksiyalar topilmadi.",
            "No reflections found.",
            "Tidak ada refleksi yang ditemukan.",
            "प्रतिबिम्बहरू फेला परेन।",
            "কোনো প্রতিচিন্তা পাওয়া যায়নি।"
        };
        printf(RED "%s\n" RESET, not_found[lang]);
        return;
    }

    char line[256];
    while (fgets(line, sizeof(line), f)) {
        printf("%s", line);
    }
    fclose(f);
}

void export_to_json(int lang) {
    FILE *in = fopen("reflections.txt", "r");
    FILE *out = fopen("reflections.json", "w");
    if (!in || !out) {
        printf(RED "Error exporting to JSON.\n" RESET);
        if (in) fclose(in);
        if (out) fclose(out);
        return;
    }

    fprintf(out, "[\n");
    char line[256], question[1024] = "", answer[1024] = "", date[128] = "";
    int first = 1;

    while (fgets(line, sizeof(line), in)) {
        if (line[0] == '[') {
            strncpy(date, line, sizeof(date));
            date[strcspn(date, "\n")] = 0;
        } else if (strncmp(line, "Q: ", 3) == 0) {
            strncpy(question, line + 3, sizeof(question));
            question[strcspn(question, "\n")] = 0;
        } else if (strncmp(line, "A: ", 3) == 0) {
            strncpy(answer, line + 3, sizeof(answer));
            answer[strcspn(answer, "\n")] = 0;
            if (!first) fprintf(out, ",\n");
            first = 0;
            fprintf(out, "  {\"date\": \"%s\", \"question\": \"%s\", \"answer\": \"%s\"}", date, question, answer);
        }
    }

    fprintf(out, "\n]\n");
    fclose(in);
    fclose(out);

    const char *done[] = {
        "Refleksiyalar JSON formatida saqlandi.",
        "Reflections exported to JSON.",
        "Refleksi diekspor ke JSON.",
        "प्रतिबिम्बहरू JSON मा निर्यात गरियो।",
        "প্রতিচিন্তা JSON-এ এক্সপোর্ট হয়েছে।"
    };
    printf(GREEN "%s\n" RESET, done[lang]);
}

void self_development(int lang) {
    const char *files[] = {
        "quotes_uz.txt", "quotes_en.txt", "quotes_id.txt", "quotes_np.txt", "quotes_bn.txt"
    };

    FILE *file = fopen(files[lang], "r");
    if (!file) {
        printf(RED "Could not open quote file: %s\n" RESET, files[lang]);
        return;
    }

    char *quotes[1000];
    char buffer[1024];
    int count = 0;

    while (fgets(buffer, sizeof(buffer), file) && count < 1000) {
        buffer[strcspn(buffer, "\n")] = 0;
        quotes[count++] = strdup(buffer);
    }
    fclose(file);

    if (count == 0) {
        printf(RED "No quotes found.\n" RESET);
        return;
    }

    const char *titles[] = {
        "O'z-o'zini rivojlantirish",
        "Self-Development Tip",
        "Tips Pengembangan Diri",
        "आत्म-विकास सुझाव",
        "আত্মোন্নয়ন পরামর্শ"
    };
    srand((unsigned int)time(NULL));
    printf("\n=== %s%s%s ===\n", GREEN, titles[lang], RESET);
    printf("- %s\n\n", quotes[rand() % count]);

    for (int i = 0; i < count; i++) {
        free(quotes[i]);
    }
}