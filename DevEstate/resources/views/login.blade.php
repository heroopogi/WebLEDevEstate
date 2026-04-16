<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DevEstate Login</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=manrope:400,500,600,700,800|playfair-display:600,700&display=swap" rel="stylesheet" />
    <style>
        :root {
            --navy: #142F56;
            --navy-soft: #1f426d;
            --gold: #D4A017;
            --gold-dark: #b8870f;
            --white: #ffffff;
            --bg: #f5f7fb;
            --card: #ffffff;
            --text: #1f2937;
            --muted: #596175;
            --border: #dce3ee;
            --radius: 24px;
            --shadow: 0 24px 60px rgba(15, 23, 42, 0.12);
        }

        * { box-sizing: border-box; }
        html, body { margin: 0; min-height: 100%; }
        body {
            background: linear-gradient(180deg, #f3f6fb 0%, #eef2f7 55%, #f8fafc 100%);
            color: var(--text);
            font-family: 'Manrope', sans-serif;
        }

        a { color: inherit; text-decoration: none; }
        button, input { font: inherit; }

        .page-shell { min-height: 100vh; padding: 2rem 1rem; display: grid; place-items: center; }
        .login-panel {
            width: min(1080px, 100%);
            display: grid;
            grid-template-columns: 1fr 0.95fr;
            gap: 2rem;
            padding: 2.25rem;
            border-radius: 32px;
            background: rgba(255,255,255,0.95);
            box-shadow: var(--shadow);
            border: 1px solid rgba(37, 78, 133, 0.08);
        }

        .brand-bar { display: flex; align-items: center; gap: 1rem; margin-bottom: 1.5rem; }
        .brand-mark {
            width: 52px; height: 52px; border-radius: 18px;
            background: linear-gradient(135deg, var(--gold), #f0c96a);
            display: grid; place-items: center; color: var(--navy); font-weight: 800;
            box-shadow: 0 12px 24px rgba(212, 160, 23, 0.2);
        }
        .brand-copy h1 { margin: 0; font-size: 1.3rem; letter-spacing: 0.03em; }
        .brand-copy span { display: block; color: var(--muted); margin-top: 0.25rem; font-size: 0.95rem; }

        .hero-side {
            padding: 2rem 2.3rem;
            border-radius: 28px;
            background: linear-gradient(180deg, rgba(30,58,95,0.96), rgba(30,58,95,0.84));
            color: var(--white);
            display: flex;
            flex-direction: column;
            justify-content: space-between;
        }
        .hero-side h2 { margin: 0 0 1rem; font-family: 'Playfair Display', serif; font-size: clamp(2rem, 3.4vw, 3rem); line-height: 1.05; }
        .hero-side p { margin: 0 0 1.5rem; color: rgba(255,255,255,0.82); line-height: 1.75; }
        .hero-stats { display: grid; gap: 1rem; }
        .stat-pill { display: inline-flex; align-items: center; gap: 0.75rem; padding: 0.9rem 1rem; border-radius: 16px; background: rgba(255,255,255,0.08); border: 1px solid rgba(255,255,255,0.12); }
        .stat-pill strong { font-size: 1rem; }

        .login-card { padding: 2.4rem; border-radius: 28px; background: var(--white); border: 1px solid rgba(37, 78, 133, 0.08); }
        .login-card h1 { margin: 0 0 0.8rem; font-size: clamp(2rem, 2.5vw, 2.4rem); color: var(--navy); }
        .login-card p { margin: 0 0 1.8rem; color: var(--muted); line-height: 1.8; }

        .field { display: grid; gap: 0.6rem; margin-bottom: 1rem; }
        .field label { font-weight: 700; font-size: 0.95rem; color: var(--text); }
        .field input {
            width: 100%; min-height: 52px; border-radius: 16px;
            border: 1px solid var(--border); padding: 0 1rem;
            background: #f8fafc;
            color: var(--text);
        }
        .field input:focus { outline: none; border-color: var(--navy); box-shadow: 0 0 0 4px rgba(30, 58, 95, 0.07); }

        .btn { display: inline-flex; align-items: center; justify-content: center; min-height: 52px; width: 100%; border: none; border-radius: 16px; background: var(--navy); color: var(--white); font-weight: 700; cursor: pointer; transition: transform 0.2s ease, background 0.2s ease; }
        .btn:hover { transform: translateY(-1px); background: var(--navy-soft); }

        .notice { margin-top: 1rem; font-size: 0.95rem; color: var(--muted); }
        .notice strong { color: var(--text); }

        .error-box {
            margin-bottom: 1rem; padding: 1rem 1.1rem; border-radius: 16px; background: rgba(239, 68, 68, 0.12); color: #991B1B; border: 1px solid rgba(239, 68, 68, 0.22);
        }

        @media (max-width: 960px) {
            .login-panel { grid-template-columns: 1fr; }
        }
    </style>
</head>
<body>
    <div class="page-shell">
        <div class="login-panel">
            <div class="hero-side">
                <div>
                    <div class="brand-bar">
                        <div class="brand-mark">DE</div>
                        <div class="brand-copy">
                            <h1>DevEstate</h1>
                            <span>Luxury Property Platform</span>
                        </div>
                    </div>
                    <h2>Welcome back, administrator.</h2>
                    <p>Access the DevEstate admin portal with the temporary credentials while the database is being prepared.</p>
                </div>
                <div class="hero-stats">
                    <div class="stat-pill"><strong>Admin login only</strong><span>Secure preview mode</span></div>
                    <div class="stat-pill"><strong>No signup yet</strong><span>Preconfigured credentials</span></div>
                </div>
            </div>

            <div class="login-card">
                <span class="eyebrow" style="display:inline-flex; padding:0.6rem 1rem; border-radius:999px; background:#f8f5ea; color:#7d680d; font-size:0.83rem; letter-spacing:0.09em; text-transform:uppercase; font-weight:800;">Admin Login</span>
                <h1>Sign in to continue</h1>

                @if ($errors->has('credentials'))
                    <div class="error-box">{{ $errors->first('credentials') }}</div>
                @endif
                @if ($errors->any() && ! $errors->has('credentials'))
                    <div class="error-box">
                        Please fill in both username and password.
                    </div>
                @endif

                <form method="POST" action="/login">
                    @csrf
                    <div class="field">
                        <label for="username">Username</label>
                        <input id="username" type="text" name="username" value="{{ old('username', 'Admin') }}" placeholder="Admin" required autofocus>
                    </div>

                    <div class="field">
                        <label for="password">Password</label>
                        <input id="password" type="password" name="password" placeholder="123" required>
                    </div>

                    <button type="submit" class="btn">Login</button>
                </form>

            </div>
        </div>
    </div>
</body>
</html>
