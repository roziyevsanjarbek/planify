<!DOCTYPE html>
<html lang="uz">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Planify Login</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">

    <style>

        *{
            margin:0;
            padding:0;
            box-sizing:border-box;
        }

        body{
            font-family:'Inter',sans-serif;
            height:100vh;
            display:flex;
            justify-content:center;
            align-items:center;
            background:#f3f6fb;
            padding:20px;
        }

        .login-card{
            width:100%;
            max-width:430px;
            background:#fff;
            border-radius:24px;
            padding:40px;
            box-shadow:0 10px 35px rgba(0,0,0,0.08);
        }

        .logo{
            text-align:center;
            margin-bottom:30px;
        }

        .logo h1{
            font-size:38px;
            color:#111827;
        }

        .logo span{
            color:#2563eb;
        }

        .logo p{
            margin-top:10px;
            color:#6b7280;
            font-size:15px;
        }

        .form-group{
            margin-bottom:20px;
        }

        .form-group label{
            display:block;
            margin-bottom:8px;
            font-weight:600;
            color:#374151;
        }

        .form-control{
            width:100%;
            padding:15px;
            border:1px solid #d1d5db;
            border-radius:14px;
            outline:none;
            font-size:15px;
            transition:0.3s;
        }

        .form-control:focus{
            border-color:#2563eb;
            box-shadow:0 0 0 4px rgba(37,99,235,0.1);
        }

        .extra{
            display:flex;
            justify-content:space-between;
            align-items:center;
            margin-bottom:25px;
            font-size:14px;
        }

        .remember{
            display:flex;
            align-items:center;
            gap:8px;
            color:#6b7280;
        }

        .forgot{
            text-decoration:none;
            color:#2563eb;
            font-weight:600;
        }

        .btn{
            width:100%;
            border:none;
            background:#2563eb;
            color:#fff;
            padding:15px;
            border-radius:14px;
            font-size:16px;
            font-weight:600;
            cursor:pointer;
            transition:0.3s;
        }

        .btn:hover{
            background:#1d4ed8;
        }

        .footer{
            text-align:center;
            margin-top:24px;
            color:#6b7280;
            font-size:14px;
        }

    </style>
</head>
<body>

<div class="login-card">

    <div class="logo">
        <h1>Plan<span>ify</span></h1>
        <p>Admin panelga kirish</p>
    </div>

    <form>

        <div class="form-group">
            <label>Email</label>
            <input
                type="email"
                class="form-control"
                placeholder="admin@planify.com"
            >
        </div>

        <div class="form-group">
            <label>Password</label>
            <input
                type="password"
                class="form-control"
                placeholder="********"
            >
        </div>


        <button class="btn">
            Login
        </button>

    </form>

    <div class="footer">
        © 2026 Planify Admin Panel
    </div>

</div>

</body>
</html>
