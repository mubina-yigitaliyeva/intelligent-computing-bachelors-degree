function loadQuestions() {
  return JSON.parse(localStorage.getItem("questions") || "[]");
}

function saveQuestions(questions) {
  localStorage.setItem("questions", JSON.stringify(questions));
}

function renderQuestions(questions, container, isAdmin = false) {
  container.innerHTML = "";

  if (questions.length === 0) {
    container.innerHTML = "<p>No questions found.</p>";
    return;
  }

  questions.forEach((q, index) => {
    const div = document.createElement("div");
    div.className = "question-item";
    div.innerHTML = `
      <strong>${q.subject} - ${q.topic} (Semester ${q.semester})</strong>
      <p><strong>Q:</strong> ${q.questionText}</p>
      ${
        q.answer
          ? `<p><strong>A:</strong> ${q.answer}</p>`
          : `<p style="color: red;"><em>Not answered yet</em></p>`
      }
      ${
        isAdmin && !q.answer
          ? `<button data-index="${index}" class="answerBtn">Answer</button>`
          : ""
      }
    `;
    container.appendChild(div);
  });

  // Bind answer buttons (admin only)
  if (isAdmin) {
    document.querySelectorAll(".answerBtn").forEach((btn) => {
      btn.addEventListener("click", () => {
        const index = btn.dataset.index;
        showAnswerSection(index);
      });
    });
  }
}

// === Student Page ===
function setupStudentPage() {
  const form = document.getElementById("questionForm");
  const questionsList = document.getElementById("questionsList");

  form.addEventListener("submit", (e) => {
    e.preventDefault();
    const questions = loadQuestions();
    const newQuestion = {
      subject: document.getElementById("subject").value,
      topic: document.getElementById("topic").value,
      semester: parseInt(document.getElementById("semester").value),
      questionText: document.getElementById("questionText").value,
      answer: null
    };
    questions.push(newQuestion);
    saveQuestions(questions);
    form.reset();
    alert("Question submitted!");
    renderQuestions(questions, questionsList);
  });

  renderQuestions(loadQuestions(), questionsList);

  document.getElementById("applyFiltersBtn").addEventListener("click", () => {
    const filtered = filterQuestions(
      loadQuestions(),
      document.getElementById("filterSubject").value,
      document.getElementById("filterTopic").value,
      document.getElementById("filterSemester").value
    );
    renderQuestions(filtered, questionsList);
  });
}

// === Admin Page ===
function setupAdminPage() {
  const questionsList = document.getElementById("unansweredQuestionsList");

  renderQuestions(loadQuestions(), questionsList, true);

  document.getElementById("applyAdminFiltersBtn").addEventListener("click", () => {
    const filtered = filterQuestions(
      loadQuestions(),
      document.getElementById("adminFilterSubject").value,
      document.getElementById("adminFilterTopic").value,
      document.getElementById("adminFilterSemester").value
    );
    renderQuestions(filtered, questionsList, true);
  });

  document.getElementById("submitAnswerBtn").addEventListener("click", () => {
    const index = parseInt(document.getElementById("answer-section").dataset.index);
    const answer = document.getElementById("answerText").value;
    const questions = loadQuestions();
    questions[index].answer = answer;
    saveQuestions(questions);
    alert("Answer submitted!");
    location.reload();
  });

  document.getElementById("cancelAnswerBtn").addEventListener("click", () => {
    document.getElementById("answer-section").style.display = "none";
  });
}

function filterQuestions(questions, subject, topic, semester) {
  return questions.filter((q) => {
    return (
      (!subject || q.subject.toLowerCase().includes(subject.toLowerCase())) &&
      (!topic || q.topic.toLowerCase().includes(topic.toLowerCase())) &&
      (!semester || q.semester === parseInt(semester))
    );
  });
}

function showAnswerSection(index) {
  const questions = loadQuestions();
  const q = questions[index];
  const section = document.getElementById("answer-section");

  document.getElementById("currentQuestionText").textContent = q.questionText;
  document.getElementById("answerText").value = "";
  section.style.display = "block";
  section.dataset.index = index;
}

// === Detect page and run ===
document.addEventListener("DOMContentLoaded", () => {
  if (document.getElementById("questionForm")) {
    setupStudentPage();
  } else if (document.getElementById("unansweredQuestionsList")) {
    setupAdminPage();
  }
});
