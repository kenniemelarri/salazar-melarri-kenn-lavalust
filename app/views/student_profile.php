<?php defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed'); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= htmlspecialchars($student['name'], ENT_QUOTES, 'UTF-8'); ?> | Student Profile</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=DM+Mono:wght@400;500&family=Space+Grotesk:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        :root {
            --bg: #f6f2ff;
            --bg-deep: #efe5ff;
            --panel: rgba(255, 255, 255, 0.62);
            --lavender: #8b5cf6;
            --lavender-deep: #6d28d9;
            --lavender-soft: #ddd0ff;
            --text: #221533;
            --muted: #5f4f7a;
            --line: rgba(109, 40, 217, 0.15);
            --shadow: 0 20px 50px rgba(109, 40, 217, 0.12);
        }

        * { box-sizing: border-box; }

        body {
            margin: 0;
            min-height: 100vh;
            color: var(--text);
            background: linear-gradient(135deg, var(--bg) 0%, var(--bg-deep) 100%);
            font-family: 'Space Grotesk', sans-serif;
        }

        nav {
            display: flex;
            justify-content: space-between;
            align-items: center;
            max-width: 1040px;
            margin: auto;
            padding: 28px 24px;
            border-bottom: 1px solid var(--line);
        }

        .brand {
            font-weight: 700;
            letter-spacing: .08em;
            text-transform: uppercase;
        }

        .brand span { color: var(--lavender); }
        nav a {
            color: var(--text);
            text-decoration: none;
            padding: 10px 14px;
            border-radius: 999px;
            transition: .2s ease;
        }

        nav a:hover {
            background: var(--lavender);
            color: #fff;
            box-shadow: 0 10px 20px rgba(139, 92, 246, 0.18);
        }

        main {
            max-width: 1040px;
            margin: auto;
            padding: 70px 24px;
        }

        .eyebrow {
            color: var(--lavender-deep);
            font: 500 12px 'DM Mono', monospace;
            letter-spacing: .12em;
            text-transform: uppercase;
        }

        h1 {
            margin: 14px 0 8px;
            font-size: clamp(2.8rem, 7vw, 6rem);
            line-height: .95;
            letter-spacing: -.07em;
        }

        .lead {
            color: var(--muted);
            max-width: 500px;
            line-height: 1.6;
        }

        .profile {
            display: grid;
            grid-template-columns: 1fr 1.2fr;
            gap: 42px;
            align-items: start;
            margin-top: 54px;
        }

        .portrait {
            display: grid;
            place-items: center;
            aspect-ratio: 1;
            max-width: 330px;
            background: linear-gradient(135deg, var(--lavender) 0%, var(--lavender-deep) 100%);
            border-radius: 24px;
            color: #fff;
            font-size: clamp(5rem, 15vw, 10rem);
            font-weight: 700;
            letter-spacing: -.12em;
            box-shadow: var(--shadow);
        }

        dl {
            display: grid;
            grid-template-columns: minmax(100px, .7fr) 1.5fr;
            margin: 0;
            border-top: 1px solid var(--line);
            background: rgba(255,255,255,.18);
            border-radius: 18px;
            overflow: hidden;
        }

        dt, dd {
            margin: 0;
            padding: 16px 18px;
            border-bottom: 1px solid var(--line);
        }

        dt {
            color: var(--muted);
            font: 12px 'DM Mono', monospace;
            text-transform: uppercase;
            background: rgba(139, 92, 246, 0.04);
        }

        dd { font-weight: 600; }
        .note {
            margin-top: 24px;
            color: var(--muted);
            line-height: 1.6;
        }

        .back {
            display: inline-block;
            margin-top: 34px;
            color: var(--lavender-deep);
            font-weight: 600;
            text-decoration: none;
        }

        @media (max-width: 700px) {
            body { background: var(--bg); }
            nav { gap: 12px; }
            .profile { grid-template-columns: 1fr; gap: 28px; }
            .portrait { width: 150px; justify-self: start; }
        }
    </style>
</head>
<body>
    <nav><div class="brand"><span>//</span> student desk</div><a href="<?= site_url('student'); ?>">&larr; Back home</a></nav>
    <main>
        <div class="eyebrow">Protected profile / middleware verified</div>
        <h1><?= htmlspecialchars($student['name'], ENT_QUOTES, 'UTF-8'); ?></h1>
        <p class="lead">A quick profile for the person behind the coursework, with the route protected by <strong>StudentMiddleware</strong>.</p>
        <section class="profile">
            <div class="portrait" aria-hidden="true">AS</div>
            <div>
                <dl>
                    <dt>Student ID</dt><dd><?= htmlspecialchars($student['student_id'], ENT_QUOTES, 'UTF-8'); ?></dd>
                    <dt>Course</dt><dd><?= htmlspecialchars($student['course'], ENT_QUOTES, 'UTF-8'); ?></dd>
                    <dt>Year level</dt><dd><?= htmlspecialchars($student['year'], ENT_QUOTES, 'UTF-8'); ?></dd>
                    <dt>Section</dt><dd><?= htmlspecialchars($student['section'], ENT_QUOTES, 'UTF-8'); ?></dd>
                    <dt>Email</dt><dd><?= htmlspecialchars($student['email'], ENT_QUOTES, 'UTF-8'); ?></dd>
                </dl>
                <p class="note"><?= htmlspecialchars($student['focus'], ENT_QUOTES, 'UTF-8'); ?></p>
                <a class="back" href="<?= site_url('student'); ?>">Return to student desk &rarr;</a>
            </div>
        </section>
    </main>
</body>
</html>