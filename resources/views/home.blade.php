<!doctype html>
<html lang="uz">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>{{ $title ?? 'Home' }}</title>

    <style>
        :root{
            --bg: #0f172a;
            --card: #0b1220;
            --accent: #06b6d4;
            --text: #e6eef7;
        }

        *{box-sizing:border-box}
        body{
            margin:0;
            font-family: Inter, system-ui, -apple-system, "Segoe UI", Roboto, "Helvetica Neue", Arial;
            background: linear-gradient(135deg, #071426 0%, #0b2438 100%);
            color: var(--text);
            min-height:100vh;
            display:flex;
            align-items:center;
            justify-content:center;
        }

        .container{
            width: 100%;
            max-width:1100px;
            padding:24px;
        }

        .nav{
            display:flex;
            justify-content:center;
            gap:18px;
            margin-bottom:40px;
        }

        .nav a{
            text-decoration:none;
            color:var(--text);
            padding:10px 16px;
            border-radius:10px;
            font-weight:600;
            background: rgba(255,255,255,0.03);
            transition: transform .14s ease, background .14s ease;
        }

        .nav a:hover{
            transform:translateY(-3px);
            background: rgba(255,255,255,0.06);
        }

        .card{
            background: linear-gradient(180deg, rgba(255,255,255,0.02), rgba(255,255,255,0.01));
            border-radius:18px;
            padding:48px;
            box-shadow: 0 8px 30px rgba(2,6,23,0.6);
            text-align:center;
        }

        .main-title{
            font-size: clamp(28px, 6vw, 64px);
            line-height: 1.02;
            margin:0;
            font-weight:700;
            letter-spacing: -0.02em;
            color: #fff;
        }

        .subtitle{
            margin-top:12px;
            font-size:16px;
            color: rgba(230,238,247,0.85);
        }

        .footer{
            margin-top:28px;
            display:flex;
            justify-content:center;
            gap:10px;
            color: rgba(230,238,247,0.6);
            font-size:14px;
        }

        @media (max-width:600px){
            .nav{
                flex-wrap:wrap;
            }
            .card{ padding:28px; }
        }
    </style>
</head>
<body>
<div class="container">
    <nav class="nav" aria-label="Main menu">
            <a href="/">Home</a>
            <a href="/users-from-db">List From DB</a>
            <a href="/users-from-cache">List From Cache</a>
            <a href="/pagination-from-db">Pagination </a>
            <a href="/pagination-from-cache">Pagination From Cache</a>
    </nav>

    <div class="card" role="main">
        <h1 class="main-title">Caching in Laravel</h1>
        <p class="subtitle">Performance test</p>

        <div class="footer">
            <span>Tezkor</span>
            <span>·</span>
            <span>Oson</span>
            <span>·</span>
            <span>Keshlangan sahifa</span>
        </div>
    </div>
</div>
</body>
</html>
