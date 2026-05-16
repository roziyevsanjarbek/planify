<!DOCTYPE html>
<html lang="uz">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Planify</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    <style>

        *{
            margin:0;
            padding:0;
            box-sizing:border-box;
        }

        body{
            font-family:'Inter',sans-serif;
            background:#f5f7fb;
            color:#111827;
        }

        .container{
            width:90%;
            max-width:1200px;
            margin:auto;
        }

        header{
            padding:25px 0;
        }

        .navbar{
            display:flex;
            justify-content:space-between;
            align-items:center;
        }

        .logo{
            font-size:34px;
            font-weight:800;
        }

        .logo span{
            color:#2563eb;
        }

        .nav-links{
            display:flex;
            gap:30px;
            align-items:center;
        }

        .nav-links a{
            text-decoration:none;
            color:#374151;
            font-weight:500;
        }

        .login-btn{
            background:#2563eb;
            color:#fff !important;
            padding:12px 22px;
            border-radius:14px;
        }

        .hero{
            min-height:85vh;
            display:flex;
            align-items:center;
        }

        .hero-content{
            display:grid;
            grid-template-columns:1fr 1fr;
            gap:60px;
            align-items:center;
        }

        .hero-text h1{
            font-size:64px;
            line-height:1.1;
            margin-bottom:24px;
        }

        .hero-text h1 span{
            color:#2563eb;
        }

        .hero-text p{
            font-size:18px;
            line-height:1.7;
            color:#6b7280;
            margin-bottom:35px;
        }

        .buttons{
            display:flex;
            gap:16px;
        }

        .btn{
            text-decoration:none;
            padding:16px 28px;
            border-radius:16px;
            font-weight:600;
            transition:0.3s;
        }

        .btn-primary{
            background:#2563eb;
            color:#fff;
        }

        .btn-primary:hover{
            background:#1d4ed8;
        }

        .btn-secondary{
            background:#fff;
            color:#111827;
            border:1px solid #d1d5db;
        }

        .hero-card{
            background:#fff;
            border-radius:28px;
            padding:35px;
            box-shadow:0 15px 40px rgba(0,0,0,0.08);
        }

        .card-top{
            display:flex;
            justify-content:space-between;
            margin-bottom:30px;
        }

        .mini-card{
            background:#f3f6fb;
            padding:20px;
            border-radius:18px;
            width:48%;
        }

        .mini-card h3{
            color:#6b7280;
            font-size:14px;
            margin-bottom:10px;
        }

        .mini-card .number{
            font-size:28px;
            font-weight:700;
        }

        .payment-box{
            background:#2563eb;
            color:#fff;
            padding:28px;
            border-radius:22px;
        }

        .payment-box h2{
            margin-bottom:10px;
            font-size:30px;
        }

        .payment-box p{
            opacity:0.9;
            line-height:1.6;
        }

        @media(max-width:900px){

            .hero-content{
                grid-template-columns:1fr;
            }

            .hero-text{
                text-align:center;
            }

            .buttons{
                justify-content:center;
                flex-wrap:wrap;
            }

            .hero-text h1{
                font-size:46px;
            }

            .nav-links{
                display:none;
            }
        }

    </style>
</head>
<body>

<header>
    <div class="container navbar">

        <div class="logo">
            Plan<span>ify</span>
        </div>

        <div class="nav-links">
            <a href="#">Home</a>
            <a href="#">Tariffs</a>
            <a href="#">About</a>
            <a href="#">Contact</a>
            <a href="{{ route('login') }}" class="login-btn">Admin Login</a>
        </div>

    </div>
</header>

<section class="hero">

    <div class="container hero-content">

        <div class="hero-text">

            <h1>
                Smart Telegram <span>Subscription</span> Platform
            </h1>

            <p>
                You can send and purchase plans through Planify and manage all subscriptions through the admin panel.
            </p>

            <div class="buttons">
                <a href="{{ route('login') }}" class="btn btn-primary">
                    Get Started
                </a>
            </div>

        </div>

        <div class="hero-card">

            <div class="card-top">

                <div class="mini-card">
                    <h3>Total Users</h3>
                    <div class="number">12K+</div>
                </div>

                <div class="mini-card">
                    <h3>Active Plans</h3>
                    <div class="number">3.4K</div>
                </div>

            </div>

            <div class="payment-box">

                <h2>Premium Plan</h2>

                <p>
                    Automatic tariff sales, admin panel management, and payment monitoring via Telegram bot.
                </p>

            </div>

        </div>

    </div>

</section>

</body>
</html>
