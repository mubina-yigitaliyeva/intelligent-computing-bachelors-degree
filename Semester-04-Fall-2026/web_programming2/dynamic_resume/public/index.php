
<?php
require_once __DIR__ . '/../config/database.php';
require_once __DIR__ . '/../includes/functions.php';

$stmt = $pdo->prepare(
    "SELECT id, full_name, headline, summary,
            email, avatar_path
     FROM users
     WHERE email = :email"
);

$stmt->execute([
    'email' => 'admin@example.com'
]);

$user = $stmt->fetch();

if (!$user) {
    http_response_code(404);
    exit('Profile not found.');
}

$stmt = $pdo->prepare(
    "SELECT entry_type, title, organization,
            start_date, end_date, description
     FROM resume_entries
     WHERE user_id = :user_id
     ORDER BY start_date DESC"
);

$stmt->execute([
    'user_id' => $user['id']
]);

$entries = $stmt->fetchAll();

$education = [];
$experience = [];
$projects = [];

foreach ($entries as $entry) {
    switch ($entry['entry_type']) {
        case 'education':
            $education[] = $entry;
            break;

        case 'experience':
            $experience[] = $entry;
            break;

        case 'project':
            $projects[] = $entry;
            break;
    }
}

$stmt = $pdo->prepare(
    "SELECT skill_name, proficiency
     FROM skills
     WHERE user_id = :user_id
     ORDER BY skill_name ASC"
);

$stmt->execute([
    'user_id' => $user['id']
]);

$skills = $stmt->fetchAll();

$avatar = 'assets/photo.jpeg';

if (!empty($user['avatar_path'])) {
    $avatarFilename = basename($user['avatar_path']);

    $avatarFile = __DIR__ . '/../uploads/' . $avatarFilename;

    if (is_file($avatarFile)) {
        $avatar = '../uploads/' . rawurlencode($avatarFilename);
    }
}

$pageTitle = $user['full_name'] . ' - Resume';

require_once '../includes/header.php';
?>

    <header class="header">

        <img
            src="<?= e($avatar) ?>"
            alt="Profile Photo"
            class="profile-img"
        >

        <div class="header-info">

            <h1>
                <?= e($user['full_name']) ?>
            </h1>

            <p class="title">
                <?= e($user['headline']) ?>
            </p>

            <p class="location">
                Dong-eui University, South Korea
            </p>

            <div class="contact-info">

                <a href="mailto:<?= e($user['email']) ?>">
                    <?= e($user['email']) ?>
                </a>

                <a href="https://www.deu.ac.kr"
                   target="_blank"
                   rel="noopener noreferrer">
                    Dong-eui University
                </a>

            </div>

            <p class="tagline">
                Passionate about technology,
                problem solving, and building
                meaningful solutions.
            </p>

        </div>
    </header>

    <main class="main-grid">
        <section class="card about">
            <h2>ABOUT ME</h2>
            <p>
                <?= nl2br(e($user['summary'])) ?>
            </p>
        </section>

        <section class="card education">
            <h2>EDUCATION</h2>
            <?php if (!empty($education)): ?>
                <?php foreach ($education as $item): ?>
                    <h3>
                        <?= e($item['organization']) ?>
                    </h3>
                    <p>
                        <strong>
                            <?= e($item['title']) ?>
                        </strong>
                    </p>
                    <p>
                        <?= displayDate($item['start_date']) ?>
                        -
                        <?= displayDate($item['end_date']) ?>
                    </p>
                    <p>
                        <?= nl2br(e($item['description'])) ?>
                    </p>
                    <br>
                <?php endforeach; ?>
            <?php else: ?>
                <p>No education records available.</p>
            <?php endif; ?>
        </section>

        <section class="card experience full-width">
            <h2>EXPERIENCE</h2>
            <div class="exp-grid">
                <?php if (!empty($experience)): ?>
                    <?php foreach ($experience as $item): ?>
                        <div class="exp-item">
                            <strong>
                                <?= e($item['title']) ?>
                            </strong>
                            <p>
                                <?= e($item['organization']) ?>
                                (
                                <?= displayDate($item['start_date']) ?>
                                -
                                <?= displayDate($item['end_date']) ?>
                                )
                            </p>
                            <p>
                                <?= nl2br(e($item['description'])) ?>
                            </p>
                        </div>
                    <?php endforeach; ?>
                <?php else: ?>
                    <p>No experience records available.</p>
                <?php endif; ?>
            </div>
        </section>

        <section class="card projects full-width">
            <h2>PROJECTS</h2>
            <?php if (!empty($projects)): ?>
                <?php foreach ($projects as $item): ?>
                    <div class="exp-item">
                        <strong>
                            <?= e($item['title']) ?>
                        </strong>
                        <p>
                            <?= e($item['organization']) ?>
                        </p>
                        <p>
                            <?= displayDate($item['start_date']) ?>
                            -
                            <?= displayDate($item['end_date']) ?>
                        </p>
                        <p>
                            <?= nl2br(e($item['description'])) ?>
                        </p>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <p>No projects added yet.</p>
            <?php endif; ?>
        </section>

        <section class="card skills">
            <h2>SKILLS</h2>
            <?php if (!empty($skills)): ?>
                <table>
                    <thead>
                        <tr>
                            <th>Skill</th>
                            <th>Level</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($skills as $skill): ?>
                            <tr>
                                <td>
                                    <?= e($skill['skill_name']) ?>
                                </td>
                                <td>
                                    <?= e($skill['proficiency']) ?>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            <?php else: ?>
                <p>No skills added yet.</p>
            <?php endif; ?>
        </section>

        <section class="card contact">
            <h2>CONTACT</h2>
            <p>
                Email:
                <a href="mailto:<?= e($user['email']) ?>">
                    <?= e($user['email']) ?>
                </a>
            </p>
            <br>
            <p>Location: South Korea</p>
            <br>
            <p>
                University:
                <a href="https://www.deu.ac.kr"
                   target="_blank"
                   rel="noopener noreferrer">
                    Visit Website
                </a>
            </p>
            <br>
            <p>
                <em>Feel free to reach out!</em>
            </p>
        </section>
    </main>

    <br><br>


<?php require_once '../includes/footer.php'; ?>
