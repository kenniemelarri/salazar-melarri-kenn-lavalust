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
        :root { --ink: #17211f; --muted: #63716d; --paper: #f5f1e8; --mint: #b8e3d2; --coral: #ef755e; --line: #d8d2c5; }
        * { box-sizing: border-box; }
        body { margin: 0; min-height: 100vh; color: var(--ink); background: radial-gradient(circle at 85% 10%, #dbeee4 0, transparent 35%), var(--paper); font-family: 'Space Grotesk', sans-serif; }
        nav { display: flex; justify-content: space-between; align-items: center; max-width: 1040px; margin: auto; padding: 28px 24px; border-bottom: 1px solid var(--line); }
        .brand { font-weight: 700; letter-spacing: .08em; text-transform: uppercase; }
        .brand span { color: var(--coral); }
        nav div:last-child { display: flex; gap: 8px; }
        nav a { color: var(--ink); text-decoration: none; padding: 9px 13px; border-radius: 5px; }
        nav a:hover, nav a.active { background: var(--ink); color: var(--paper); }
        main { max-width: 1040px; margin: auto; padding: 76px 24px 100px; }
        .kicker { color: var(--coral); font: 500 12px 'DM Mono', monospace; letter-spacing: .12em; text-transform: uppercase; }
        h1 { max-width: 720px; margin: 16px 0; font-size: clamp(3rem, 8vw, 7rem); line-height: .9; letter-spacing: -.07em; }
        .intro { max-width: 540px; color: var(--muted); font-size: 1.15rem; line-height: 1.6; }
        .student-strip { display: grid; grid-template-columns: 1fr auto; gap: 24px; align-items: center; margin-top: 62px; padding: 28px; background: var(--mint); border: 1px solid #8bc8b0; border-radius: 8px; }
        .student-strip strong { display: block; font-size: 1.5rem; }
        .student-strip small { display: block; margin-top: 7px; color: #45665a; font: 12px 'DM Mono', monospace; }
        .cta { background: var(--coral); color: #fff; text-decoration: none; padding: 14px 18px; border-radius: 5px; font-weight: 600; }
        @media (max-width: 600px) { nav { align-items: flex-start; gap: 18px; } nav div:last-child { flex-direction: column; gap: 2px; } main { padding-top: 52px; } .student-strip { grid-template-columns: 1fr; } }
    </style>
</head>
<body>
    <nav>
        <div class="brand"><span>//</span> student desk</div>
        <div><a class="active" href="<?= site_url('student'); ?>">Home</a><a href="<?= site_url('student/profile'); ?>">Profile</a></div>
    </nav>
    <main>
        <div class="kicker">LavaLust laboratory / 01</div>
        <h1>Make your work<br>legible.</h1>
        <p class="intro">A small student information page demonstrating routing, controllers, views, data passing, and middleware in one focused flow.</p>
        <section class="student-strip">
            <div><strong><?= htmlspecialchars($student['name'], ENT_QUOTES, 'UTF-8'); ?></strong><small><?= htmlspecialchars($student['course'], ENT_QUOTES, 'UTF-8'); ?> / <?= htmlspecialchars($student['year'], ENT_QUOTES, 'UTF-8'); ?></small></div>
            <a class="cta" href="<?= site_url('student/profile'); ?>">Open profile &rarr;</a>
        </section>
    </main>
</body>
</html>