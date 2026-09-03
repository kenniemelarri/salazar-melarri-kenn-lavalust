<?php defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed'); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Desk | LavaLust</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=DM+Mono:wght@400;500&family=Space+Grotesk:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        :root {
            --bg: #f6f2ff;
            --bg-deep: #efe5ff;
            --panel: rgba(255, 255, 255, 0.6);
            --card: #f1eaff;
            --lavender: #8b5cf6;
            --lavender-deep: #6d28d9;
            --lavender-soft: #d9c8ff;
            --lavender-pale: #f0e7ff;
            --text: #221533;
            --muted: #5f4f7a;
            --line: rgba(109, 40, 217, 0.16);
            --shadow: 0 20px 50px rgba(109, 40, 217, 0.12);
        }

        * { box-sizing: border-box; }

        body {
            margin: 0;
            min-height: 100vh;
            color: var(--text);
            background:
                radial-gradient(circle at top right, rgba(192, 132, 252, 0.35), transparent 30%),
                linear-gradient(135deg, var(--bg) 0%, var(--bg-deep) 100%);
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
        nav div:last-child { display: flex; gap: 8px; }

        nav a, nav button {
            color: var(--text);
            text-decoration: none;
            padding: 10px 14px;
            border-radius: 999px;
            border: 1px solid transparent;
            background: transparent;
            font: inherit;
            cursor: pointer;
            transition: .2s ease;
        }

        nav a:hover, nav button:hover, nav a.active {
            background: var(--lavender);
            color: #fff;
            border-color: var(--lavender);
            box-shadow: 0 10px 20px rgba(139, 92, 246, 0.2);
        }

        nav form { display: inline; }

        main {
            max-width: 1040px;
            margin: auto;
            padding: 76px 24px 100px;
        }

        .kicker {
            color: var(--lavender-deep);
            font: 500 12px 'DM Mono', monospace;
            letter-spacing: .12em;
            text-transform: uppercase;
        }

        h1 {
            max-width: 720px;
            margin: 16px 0;
            font-size: clamp(3rem, 8vw, 7rem);
            line-height: .9;
            letter-spacing: -.07em;
        }

        .intro {
            max-width: 540px;
            color: var(--muted);
            font-size: 1.15rem;
            line-height: 1.6;
        }

        .student-strip {
            display: grid;
            grid-template-columns: 1fr auto;
            gap: 24px;
            align-items: center;
            margin-top: 62px;
            padding: 28px;
            background: linear-gradient(135deg, rgba(139, 92, 246, 0.12), rgba(216, 180, 254, 0.18));
            border: 1px solid var(--line);
            border-radius: 22px;
            box-shadow: var(--shadow);
        }

        .student-strip strong { display: block; font-size: 1.5rem; }
        .student-strip small {
            display: block;
            margin-top: 7px;
            color: var(--muted);
            font: 12px 'DM Mono', monospace;
        }

        .cta {
            border: 0;
            background: linear-gradient(135deg, var(--lavender) 0%, var(--lavender-deep) 100%);
            color: #fff;
            font: inherit;
            padding: 14px 18px;
            border-radius: 12px;
            font-weight: 600;
            cursor: pointer;
            box-shadow: 0 12px 24px rgba(109, 40, 217, 0.18);
        }

        @media (max-width: 600px) {
            nav { align-items: flex-start; gap: 18px; }
            nav div:last-child { flex-direction: column; gap: 2px; }
            main { padding-top: 52px; }
            .student-strip { grid-template-columns: 1fr; }
        }
    </style>
</head>

<body>

    <nav>
        <div class="brand"><span>//</span> student desk</div>

        <div>
            <a class="active" href="<?= site_url('student'); ?>">Home</a>

            <a href="<?= site_url('users'); ?>">Users</a>

            <form action="<?= site_url('student/profile'); ?>" method="post">
                <button type="submit">Profile</button>
            </form>
        </div>
    </nav>

    <main>
        <div class="kicker">LavaLust laboratory / 01</div>

        <h1>Make your work<br>legible.</h1>

        <p class="intro">
            A small student information page demonstrating routing, controllers, views, data passing, and middleware in one focused flow.
        </p>

        <section class="student-strip">
            <div>
                <strong><?= htmlspecialchars($student['name'], ENT_QUOTES, 'UTF-8'); ?></strong>

                <small>
                    <?= htmlspecialchars($student['course'], ENT_QUOTES, 'UTF-8'); ?>
                    /
                    <?= htmlspecialchars($student['year'], ENT_QUOTES, 'UTF-8'); ?>
                </small>
            </div>

            <form action="<?= site_url('student/profile'); ?>" method="post">
                <button class="cta" type="submit">Open profile &rarr;</button>
            </form>
        </section>
    </main>

</body>
</html>