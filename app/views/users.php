<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Users</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=DM+Mono:wght@400;500&family=Space+Grotesk:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        :root {
            --bg: #f6f2ff;
            --bg-deep: #efe5ff;
            --panel: rgba(255, 255, 255, 0.7);
            --lavender: #8b5cf6;
            --lavender-deep: #6d28d9;
            --lavender-soft: #d9c8ff;
            --text: #221533;
            --muted: #5f4f7a;
            --line: rgba(109, 40, 217, 0.16);
            --shadow: 0 20px 50px rgba(109, 40, 217, 0.12);
        }

        * { box-sizing: border-box; }

        body {
            margin: 0;
            min-height: 100vh;
            font-family: 'Space Grotesk', sans-serif;
            color: var(--text);
            background: linear-gradient(135deg, var(--bg) 0%, var(--bg-deep) 100%);
        }

        .wrap {
            max-width: 1080px;
            margin: 0 auto;
            padding: 32px 24px 80px;
        }

        nav {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 16px;
            padding: 18px 0 28px;
            border-bottom: 1px solid var(--line);
        }

        .brand {
            font-weight: 700;
            letter-spacing: .08em;
            text-transform: uppercase;
        }

        .brand span { color: var(--lavender); }

        .nav-links {
            display: flex;
            gap: 10px;
            flex-wrap: wrap;
        }

        .nav-links a {
            text-decoration: none;
            color: var(--text);
            padding: 10px 14px;
            border-radius: 999px;
            transition: .2s ease;
        }

        .nav-links a:hover, .nav-links a.active {
            background: var(--lavender);
            color: #fff;
            box-shadow: 0 10px 20px rgba(139, 92, 246, 0.2);
        }

        .card {
            background: var(--panel);
            border: 1px solid var(--line);
            border-radius: 24px;
            box-shadow: var(--shadow);
            padding: 28px;
            margin-top: 26px;
            backdrop-filter: blur(10px);
        }

        h1 {
            margin: 0 0 8px;
            font-size: clamp(2.2rem, 5vw, 3.5rem);
            letter-spacing: -.06em;
        }

        .subtitle {
            margin: 0 0 24px;
            color: var(--muted);
            font-size: 1.05rem;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            overflow: hidden;
            border-radius: 18px;
            background: rgba(255,255,255,0.25);
        }

        th, td {
            padding: 14px 16px;
            border-bottom: 1px solid var(--line);
            text-align: left;
        }

        th {
            background: rgba(139, 92, 246, 0.08);
            color: var(--lavender-deep);
            font: 12px 'DM Mono', monospace;
            letter-spacing: .08em;
            text-transform: uppercase;
        }

        tbody tr:hover {
            background: rgba(139, 92, 246, 0.05);
        }

        @media (max-width: 700px) {
            .card { padding: 18px; }
            table { display: block; overflow-x: auto; }
            nav { align-items: flex-start; flex-direction: column; }
        }
    </style>
</head>

<body>
    <div class="wrap">
        <nav>
            <div class="brand"><span>//</span> user management</div>
            <div class="nav-links">
                <a class="active" href="<?= site_url('users'); ?>">Manage</a>
            </div>
        </nav>

        <section class="card">
            <h1>User Management</h1>
            <p class="subtitle">Manage and view registered users.</p>

            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>First Name</th>
                        <th>Last Name</th>
                        <th>Email</th>
                        <th>Username</th>
                    </tr>
                </thead>

                <tbody>
                    <?php foreach ($users as $user): ?>
                        <tr>
                            <td><?= $user['id'] ?></td>
                            <td><?= $user['firstname'] ?></td>
                            <td><?= $user['lastname'] ?></td>
                            <td><?= $user['email'] ?></td>
                            <td><?= $user['username'] ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </section>
    </div>
</body>
</html>