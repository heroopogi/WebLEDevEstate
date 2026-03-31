<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>DevEstate | Modern Real Estate Interface</title>
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=manrope:400,500,600,700,800|playfair-display:600,700&display=swap" rel="stylesheet" />
        <link rel="stylesheet" href="../css/app.css">
    </head>
    <body>
        <div class="page-shell">
            <header class="site-header">
                <div class="container nav-bar">
                    <a href="#home" class="brand">
                        <span class="brand-mark">DE</span>
                        <span class="brand-stack">
                            <strong>DevEstate</strong>
                            <span>Luxury Property Platform</span>
                        </span>
                    </a>
                    <nav class="nav-links">
                        <a href="#listings">Properties</a>
                        <a href="#details">Details</a>
                        <a href="location.php">Locations</a>
                        <a href="admin.php">Admin</a>
                        <a href="login.php">Login</a>
                    </nav>
                    <div class="nav-actions">
                        <a href="admin_dashboard.php" class="btn btn-outline" style="color:#FFFFFF; border-color:rgba(255,255,255,0.36);">Dashboard</a>
                        <a href="#listings" class="btn btn-accent">View Listings</a>
                    </div>
                </div>
            </header>

            <main>
                <section class="hero" id="home">
                    <div class="container hero-grid">
                        <article class="hero-panel">
                            <div class="hero-content">
                                <div class="hero-copy">
                                    <span class="eyebrow">Premier Real Estate Interface</span>
                                    <h1>Find refined spaces built for modern living.</h1>
                                    <p>
                                        A clean, professional property platform designed for trust, speed, and premium presentation.
                                        This interface showcases landing, listings, search, property details, admin, and mobile experiences using a unified navy and gold system.
                                    </p>
                                    <div class="hero-actions">
                                        <a href="#listings" class="btn btn-accent">Browse Properties</a>
                                        <a href="#details" class="btn btn-outline" style="color:#FFFFFF; border-color:rgba(255,255,255,0.35);">View Showcase</a>
                                    </div>
                                </div>
                                <div class="stats-row">
                                    <div class="stat-card">
                                        <strong>240+</strong>
                                        <span>Curated premium listings</span>
                                    </div>
                                    <div class="stat-card">
                                        <strong>18</strong>
                                        <span>High-demand city districts</span>
                                    </div>
                                    <div class="stat-card">
                                        <strong>96%</strong>
                                        <span>Client match satisfaction</span>
                                    </div>
                                </div>
                            </div>
                        </article>

                        <div class="stack">
                            <section class="panel search-panel">
                                <div class="panel-head">
                                    <div>
                                        <h2>Search & Filter</h2>
                                        <p class="muted">Corporate search experience with clear hierarchy and gold active tags.</p>
                                    </div>
                                    <a href="search_now.php" class="btn btn-primary">Search Now</a>
                                </div>
                                <div class="search-grid">
                                    <div class="field">
                                        <label for="location">Location</label>
                                        <input id="location" type="text" value="Makati City" readonly>
                                    </div>
                                    <div class="field">
                                        <label for="type">Property Type</label>
                                        <select id="type"><option>Condominium</option></select>
                                    </div>
                                    <div class="field">
                                        <label for="budget">Budget</label>
                                        <input id="budget" type="text" value="$350,000 - $900,000" readonly>
                                    </div>
                                    <div class="field">
                                        <label for="bedrooms">Bedrooms</label>
                                        <select id="bedrooms"><option>3+ Bedrooms</option></select>
                                    </div>
                                </div>
                                <div class="tags">
                                    <span class="tag">Waterfront</span>
                                    <span class="tag">Pet Friendly</span>
                                    <span class="tag">Ready for Move-In</span>
                                </div>
                            </section>

                            <section class="card mini-card">
                                <span class="eyebrow">Consultation</span>
                                <h3>Trusted guidance from inquiry to closing.</h3>
                                <p>
                                    The layout keeps calls-to-action prominent while supporting premium property storytelling, agent credibility, and quick decision-making.
                                </p>
                                <div class="kpi">
                                    <div>
                                        <strong>24/7</strong>
                                        <span class="muted">Concierge response</span>
                                    </div>
                                    <a href="#login" class="btn btn-success">Contact Advisor</a>
                                </div>
                            </section>
                        </div>
                    </div>
                </section>


                <section class="section" id="mobile">
                    <div class="container mobile-layout">
                        <div>
                            <span class="eyebrow">Mobile Responsive Design</span>
                            <h2 class="section-title" style="margin-top:1rem;">A compact mobile experience with a navy bottom navigation.</h2>
                            <p class="section-copy" style="margin-top:1rem;">
                                The responsive pattern preserves the same premium palette across cards, actions, and navigation, while gold active states keep orientation obvious on smaller screens.
                            </p>
                        </div>
                        <aside class="phone-shell">
                            <div class="phone-top">
                                <strong style="color:var(--navy);">DevEstate Mobile</strong>
                                <span class="tag" style="margin:0;">Responsive Preview</span>
                            </div>
                            <div class="phone-screen">
                                <div class="phone-card">
                                    <img src="https://images.unsplash.com/photo-1600607687644-aac4c3eac7f4?auto=format&fit=crop&w=900&q=80" alt="Mobile property card">
                                    <div class="mobile-menu">
                                        <span class="tag">For Sale</span>
                                        <span class="tag">Smart Home</span>
                                    </div>
                                    <h4 style="margin:0.9rem 0 0.35rem; color:var(--navy);">City Crest Loft</h4>
                                    <p class="muted" style="margin:0 0 0.8rem;">Refined city living with concierge access and private lounge amenities.</p>
                                    <div class="price-row" style="margin-top:0;">
                                        <span class="price">$540,000</span>
                                        <button class="btn btn-primary" type="button">View</button>
                                    </div>
                                </div>
                                <div class="phone-bottom-nav">
                                    <div class="nav-icon active">
                                        <strong>H</strong>
                                        <span>Home</span>
                                    </div>
                                    <div class="nav-icon">
                                        <strong>S</strong>
                                        <span>Search</span>
                                    </div>
                                    <div class="nav-icon">
                                        <strong>M</strong>
                                        <span>Map</span>
                                    </div>
                                    <div class="nav-icon">
                                        <strong>P</strong>
                                        <span>Profile</span>
                                    </div>
                                </div>
                            </div>
                        </aside>
                    </div>
                </section>
            </main>
            <footer class="footer">
                DevEstate interface concept focused on layout, styling, and visual components only.
            </footer>
        </div>
    </body>
</html>
