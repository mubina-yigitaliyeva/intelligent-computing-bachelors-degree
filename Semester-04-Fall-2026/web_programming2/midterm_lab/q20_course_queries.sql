
-- Query 1: Computer Science courses and tuition

SELECT
    course_code,
    title,
    credits,
    lab_fee,
    (credits * 120 + lab_fee) AS est_tuition
FROM courses
WHERE department = 'CS'
ORDER BY lab_fee ASC;


SELECT
    course_code,
    title,
    department,
    max_seats
FROM courses
WHERE is_online = 1
AND title LIKE '%Design%'
ORDER BY course_code ASC;
