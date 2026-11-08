#include <stdio.h>
#include "interface.h"

#define RED     "\x1b[31m"
#define GREEN   "\x1b[32m"
#define YELLOW  "\x1b[33m"
#define BLUE    "\x1b[34m"
#define RESET   "\x1b[0m"

const char *menu_texts[5][6] = {
    // Uzbek
    {
        "******************************\n**  MirrorMind Refleksiya  **\n******************************",
        "1. Fikr yuritish sessiyasini boshlash",
        "2. Avvalgi mulohazalarni ko‘rish",
        "3. Refleksiyalarni JSON-ga eksport qilish",
        "4. O'z-o'zini rivojlantirish bo'yicha maslahatlar",
        "5. Chiqish"
    },
    // English
    {
        "******************************\n**  MirrorMind Reflection  **\n******************************",
        "1. Start reflection session",
        "2. View past reflections",
        "3. Export reflections to JSON",
        "4. Self-development tips",
        "5. Exit"
    },
    // Indonesian
    {
        "******************************\n**  Refleksi MirrorMind  **\n******************************",
        "1. Mulai sesi refleksi",
        "2. Lihat refleksi sebelumnya",
        "3. Ekspor refleksi ke JSON",
        "4. Tips pengembangan diri",
        "5. Keluar"
    },
    // Nepali
    {
        "******************************\n**  MirrorMind आत्म-प्रतिबिम्ब  **\n******************************",
        "1. आत्म-प्रतिबिम्ब सत्र सुरु गर्नुहोस्",
        "2. अघिल्ला प्रतिबिम्बहरू हेर्नुहोस्",
        "3. प्रतिबिम्बहरू JSON मा निर्यात गर्नुहोस्",
        "4. आत्म-विकास सल्लाहहरू",
        "5. बाहिर निस्कनुहोस्"
    },
    // Bengali (Bangladesh)
    {
        "******************************\n**  MirrorMind আত্ম-চিন্তা  **\n******************************",
        "1. আত্ম-চিন্তার সেশন শুরু করুন",
        "2. পূর্বের চিন্তাগুলি দেখুন",
        "3. JSON-এ এক্সপোর্ট করুন",
        "4. আত্মোন্নয়ন পরামর্শ",
        "5. প্রস্থান করুন"
    }
};

const char *input_prompt[5] = {
    "Tanlang: ",
    "Choice: ",
    "Pilihan: ",
    "चयन गर्नुहोस्: ",
    "নির্বাচন করুন: "
};

const char *goodbye_text[5] = {
    "Xayr, fikrlaringiz uchun rahmat!",
    "Goodbye, thank you for reflecting!",
    "Sampai jumpa, terima kasih telah merenung!",
    "विदा, प्रतिबिम्बका लागि धन्यवाद!",
    "বিদায়, চিন্তার জন্য ধন্যবাদ!"
};

const char *invalid_choice_text[5] = {
    "Noto'g'ri tanlov. Iltimos, qaytadan urinib ko'ring.",
    "Invalid choice. Please try again.",
    "Pilihan tidak valid. Silakan coba lagi.",
    "अमान्य विकल्प। कृपया फेरि प्रयास गर्नुहोस्।",
    "ভুল নির্বাচন। অনুগ্রহ করে আবার চেষ্টা করুন।"
};

int select_language() {
    printf(BLUE "Select Language / Tilni tanlang / Pilih bahasa / भाषा चयन गर्नुहोस् / ভাষা নির্বাচন করুন:\n" RESET);
    printf("1. Uzbek\n2. English\n3. Indonesian\n4. Nepali\n5. Bengali\n");
    int lang;
    if (scanf("%d", &lang) != 1) {
        while(getchar() != '\n');  
        return 1;
    }
    while(getchar() != '\n');
    if (lang < 1 || lang > 5) return 1;
    return lang - 1;
}