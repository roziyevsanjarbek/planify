<!DOCTYPE html>
<html lang="uz">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Planify Admin Panel</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', sans-serif;
            background: #f5f7fb;
            color: #1f2937;
            display: flex;
            min-height: 100vh;
        }

        .sidebar {
            width: 260px;
            background: #111827;
            color: white;
            padding: 24px;
            display: flex;
            flex-direction: column;
            gap: 24px;
        }

        .logo {
            font-size: 28px;
            font-weight: 700;
        }

        .logo span {
            color: #60a5fa;
        }

        .menu {
            display: flex;
            flex-direction: column;
            gap: 10px;
        }

        .menu a {
            text-decoration: none;
            color: #d1d5db;
            padding: 14px 16px;
            border-radius: 12px;
            transition: 0.3s;
            font-size: 15px;
            font-weight: 500;
        }

        .menu a:hover,
        .menu a.active {
            background: #2563eb;
            color: white;
        }

        .main {
            flex: 1;
            padding: 30px;
        }

        .topbar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 30px;
        }

        .title h1 {
            font-size: 28px;
            margin-bottom: 5px;
        }

        .title p {
            color: #6b7280;
        }

        .admin {
            background: white;
            padding: 12px 18px;
            border-radius: 14px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.05);
            font-weight: 600;
        }

        .cards {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
            gap: 20px;
            margin-bottom: 30px;
        }

        .card {
            background: white;
            padding: 24px;
            border-radius: 18px;
            box-shadow: 0 4px 20px rgba(0,0,0,0.05);
        }

        .card h3 {
            color: #6b7280;
            margin-bottom: 10px;
            font-size: 15px;
        }

        .card .number {
            font-size: 32px;
            font-weight: 700;
        }

        .table-wrapper {
            background: white;
            border-radius: 20px;
            padding: 24px;
            box-shadow: 0 4px 20px rgba(0,0,0,0.05);
            overflow-x: auto;
        }

        .table-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }

        .table-header h2 {
            font-size: 22px;
        }

        .search {
            padding: 12px 14px;
            border: 1px solid #d1d5db;
            border-radius: 12px;
            width: 260px;
            outline: none;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        table th,
        table td {
            padding: 16px;
            text-align: left;
            border-bottom: 1px solid #e5e7eb;
            font-size: 14px;
        }

        table th {
            color: #6b7280;
            font-weight: 600;
        }

        .badge {
            padding: 8px 12px;
            border-radius: 999px;
            font-size: 12px;
            font-weight: 600;
            display: inline-block;
        }

        .pending {
            background: #fef3c7;
            color: #92400e;
        }

        .approved {
            background: #dcfce7;
            color: #166534;
        }

        .premium {
            background: #dbeafe;
            color: #1d4ed8;
        }

        .standard {
            background: #ede9fe;
            color: #6d28d9;
        }

        .actions {
            display: flex;
            gap: 10px;
        }

        .btn {
            border: none;
            padding: 10px 14px;
            border-radius: 10px;
            cursor: pointer;
            font-weight: 600;
            transition: 0.3s;
        }

        .btn-approve {
            background: #22c55e;
            color: white;
        }

        .btn-reject {
            background: #ef4444;
            color: white;
        }

        .btn:hover {
            opacity: 0.9;
        }

        @media(max-width: 900px) {
            body {
                flex-direction: column;
            }

            .sidebar {
                width: 100%;
            }

            .topbar {
                flex-direction: column;
                align-items: flex-start;
                gap: 16px;
            }

            .table-header {
                flex-direction: column;
                gap: 14px;
                align-items: flex-start;
            }

            .search {
                width: 100%;
            }
        }
    </style>
</head>
<body>

<aside class="sidebar">
    <div class="logo">Plan<span>ify</span></div>

    <div class="menu">
        <a href="#" class="active">Dashboard</a>
        <a href="#">Subscriptions</a>
        <a href="#">Payments</a>
        <a href="#">Users</a>
        <a href="#">Tariffs</a>
        <a href="#">Settings</a>
    </div>
</aside>

<main class="main">

    <div class="topbar">
        <div class="title">
            <h1>Admin Dashboard</h1>
            <p>Planify subscription management panel</p>
        </div>

        <div class="admin">
            👨‍💻 Admin
        </div>
    </div>

    <div class="cards">
        <div class="card">
            <h3>Total Users</h3>
            <div class="number">1,248</div>
        </div>

        <div class="card">
            <h3>Premium Users</h3>
            <div class="number">486</div>
        </div>

        <div class="card">
            <h3>Pending Payments</h3>
            <div class="number">24</div>
        </div>

        <div class="card">
            <h3>Total Revenue</h3>
            <div class="number">$8,420</div>
        </div>
    </div>

    <div class="table-wrapper">

        <div class="table-header">
            <h2>Latest Subscriptions</h2>
            <input type="text" class="search" placeholder="Search user...">
        </div>

        <table>
            <thead>
            <tr>
                <th>User</th>
                <th>Phone</th>
                <th>Tariff</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
            </thead>

            <tbody>
            <tr>
                <td>Sanjarbek Ro'ziyev</td>
                <td>+998901234567</td>
                <td>
                    <span class="badge standard">Standard</span>
                </td>
                <td>
                    <span class="badge pending">Pending</span>
                </td>
                <td>
                    <div class="actions">
                        <button class="btn btn-approve">Approve</button>
                        <button class="btn btn-reject">Reject</button>
                    </div>
                </td>
            </tr>

            <tr>
                <td>Ali Valiyev</td>
                <td>+998998887766</td>
                <td>
                    <span class="badge premium">Premium</span>
                </td>
                <td>
                    <span class="badge approved">Approved</span>
                </td>
                <td>
                    <div class="actions">
                        <button class="btn btn-approve">Approve</button>
                        <button class="btn btn-reject">Reject</button>
                    </div>
                </td>
            </tr>
            </tbody>
        </table>
    </div>

</main>

</div>

</body>
</html>
