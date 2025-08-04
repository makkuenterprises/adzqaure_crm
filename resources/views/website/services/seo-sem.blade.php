<!DOCTYPE html>
<html lang="en">

<title>SEO & SEM Services | Adzquare - Global Search Engine Supremacy</title>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">


    <meta name="description" content="Achieve top global search rankings with Adzquare's expert SEO and SEM strategies. We specialize in driving organic traffic and maximizing ad spend for businesses in the USA, UK, India, and Australia.">

    <link rel="shortcut icon" type="image/png" href="admin_new/images/favicon.png">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&family=Orbitron:wght@400;500;700&display=swap" rel="stylesheet">
    <style>
        :root {
            --bg-color: #0D0D0D;
            --surface-color: #1A1A1A;
            --card-bg: #1F1F1F;
            --primary-accent: #FF7A00;
            --secondary-accent: #E66A00;
            --text-color: #EAEAEA;
            --text-muted-color: #A0A0A0;
            --border-color: #383838;
            --glow-color: rgba(255, 122, 0, 0.3);
            --gradient-primary: linear-gradient(135deg, var(--primary-accent), var(--secondary-accent));
            --gradient-bg-subtle: linear-gradient(180deg, rgba(26, 26, 26, 0.03) 0%, rgba(13,13,13,0.1) 100%);
            --gradient-text: linear-gradient(90deg, var(--primary-accent), #FFB800);
            --font-heading: 'Orbitron', sans-serif;
            --font-body: 'Poppins', sans-serif;
        }

        * { margin: 0; padding: 0; box-sizing: border-box; }
        html { scroll-behavior: smooth; font-size: 16px; }
        body {
            font-family: var(--font-body);
            line-height: 1.7;
            color: var(--text-color);
            background-color: var(--bg-color);
            overflow-x: hidden;
            position: relative;
        }

        .container { width: 90%; max-width: 1200px; margin: auto; padding: 0 20px; }

        header {
            background: rgba(13, 13, 13, 0.6); backdrop-filter: blur(15px);
            padding: 1rem 0; border-bottom: 1px solid var(--border-color);
            position: sticky; top: 0; z-index: 1000;
        }
        header .container { display: flex; justify-content: space-between; align-items: center; }
        header .logo {
            font-family: var(--font-heading); font-size: 1.9rem; font-weight: 700;
            text-decoration: none; letter-spacing: 1px;
            background-image: var(--gradient-text);
            -webkit-background-clip: text; background-clip: text; color: transparent;
        }
        header nav ul { list-style: none; display: flex; align-items: center; margin: 0; }
        header nav ul li { margin-left: 28px; }
        header nav ul li a {
            text-decoration: none; color: var(--text-muted-color);
            font-weight: 500; font-family: var(--font-heading); font-size: 0.9rem;
            padding: 8px 0; transition: color 0.3s ease; position: relative;
        }
        header nav ul li a:hover, header nav ul li a.active { color: var(--primary-accent); }
        .menu-toggle { display: none; flex-direction: column; justify-content: space-around; width: 30px; height: 25px; background: transparent; border: none; cursor: pointer; z-index: 1001; }
        .menu-toggle .bar { width: 100%; height: 3px; background-color: var(--text-color); border-radius: 10px; transition: all 0.3s ease-in-out; }

        footer {
            background: linear-gradient(to top, #0A0A0A, var(--bg-color) 90%);
            color: var(--text-muted-color); text-align: center; padding: 60px 20px 30px;
            margin-top: 50px; border-top: 1px solid var(--border-color);
        }
        .footer-bottom-text { font-size: 0.9rem; }

        .service-hero { padding: 100px 0 80px 0; text-align: center; position: relative; overflow: hidden; background: radial-gradient(ellipse at 50% -20%, var(--surface-color) 0%, var(--bg-color) 70%); }
        .service-hero h1 { font-family: var(--font-heading); font-size: 3.2rem; font-weight: 700; line-height: 1.3; color: var(--text-color); margin-bottom: 20px; }
        .service-hero .highlight { background-image: var(--gradient-text); -webkit-background-clip: text; background-clip: text; color: transparent; }
        .service-hero .subtitle { font-size: 1.2rem; color: var(--text-muted-color); max-width: 800px; margin: 0 auto 35px auto; }
        .breadcrumb { font-family: var(--font-heading); font-size: 0.9rem; color: var(--text-muted-color); }
        .breadcrumb a { color: var(--text-muted-color); text-decoration: none; transition: color 0.3s ease; }
        .breadcrumb a:hover { color: var(--primary-accent); }
        .breadcrumb span { color: var(--primary-accent); }

        .section { padding: 80px 0; position: relative; overflow: hidden; }
        .section-title { font-family: var(--font-heading); font-size: 2.4rem; text-align: center; margin-bottom: 20px; color: var(--text-color); }
        .section-title span { background-image: var(--gradient-text); -webkit-background-clip: text; background-clip: text; color: transparent; }
        .section-subtitle { text-align: center; font-size: 1.15rem; color: var(--text-muted-color); max-width: 800px; margin: 0 auto 50px auto; line-height: 1.8; }

        .cta-button { display: inline-block; background-image: var(--gradient-primary); color: #fff; padding: 15px 35px; text-decoration: none; border-radius: 50px; font-weight: 600; font-family: var(--font-heading); font-size: 1rem; transition: transform 0.3s ease, box-shadow 0.3s ease; border: none; box-shadow: 0 6px 20px var(--glow-color); }
        .cta-button:hover { transform: translateY(-3px) scale(1.03); box-shadow: 0 10px 30px rgba(255, 122, 0, 0.5); }

        #service-content { background: var(--gradient-bg-subtle); }
        .content-layout { display: flex; flex-direction: column; gap: 40px; }
        .content-block { background: var(--card-bg); padding: 40px; border-radius: 12px; border: 1px solid var(--border-color); box-shadow: 0 8px 25px rgba(0,0,0,0.2); }
        .content-block h2 { font-family: var(--font-heading); font-size: 1.8rem; color: var(--primary-accent); margin-bottom: 15px; }
        .content-block p { font-size: 1.05rem; line-height: 1.8; color: var(--text-muted-color); }

        #key-accelerators { background-color: var(--bg-color); }
        .accelerators-grid { display: grid; grid-template-columns: repeat(auto-fit, minmax(300px, 1fr)); gap: 30px; margin-top: 40px; }
        .accelerator-card { background: var(--surface-color); padding: 30px; border-radius: 10px; border: 1px solid var(--border-color); transition: transform 0.3s ease, box-shadow 0.3s ease, border-color 0.3s ease; text-align: center; }
        .accelerator-card:hover { transform: translateY(-8px); border-color: var(--primary-accent); box-shadow: 0 10px 25px var(--glow-color); }
        .accelerator-card .icon { font-size: 3rem; background-image: var(--gradient-text); -webkit-background-clip: text; background-clip: text; color: transparent; margin-bottom: 20px; line-height: 1; }
        .accelerator-card h3 { font-family: var(--font-heading); font-size: 1.4rem; color: var(--text-color); margin-bottom: 10px; }
        .accelerator-card p { font-size: 0.95rem; color: var(--text-muted-color); line-height: 1.6; }

        #service-cta { background: linear-gradient(145deg, var(--surface-color), var(--card-bg)); padding: 60px 0; }
        .cta-form { max-width: 750px; margin: auto; background: var(--card-bg); padding: 40px; border-radius: 12px; border: 1px solid var(--border-color); box-shadow: 0 10px 30px rgba(0,0,0,0.3); }
        .cta-form h3 { font-family: var(--font-heading); color: var(--primary-accent); margin-bottom: 25px; font-size: 1.6rem; text-align: center; }
        .cta-form input, .cta-form textarea { width: 100%; padding: 14px; margin-bottom: 18px; border-radius: 8px; border: 1px solid var(--border-color); background-color: #222; color: var(--text-color); font-family: var(--font-body); font-size: 0.95rem; transition: border-color 0.3s, box-shadow 0.3s; }
        .cta-form input:focus, .cta-form textarea:focus { outline: none; border-color: var(--primary-accent); box-shadow: 0 0 0 3px var(--glow-color); }
        .cta-form .cta-button { width: 100%; padding: 14px; }

        .section-3d-bg { position: absolute; top: 0; left: 0; width: 100%; height: 100%; perspective: 1500px; z-index: -1; overflow: hidden; pointer-events: none; }

        /* --- Responsive Adjustments --- */
        @media (max-width: 992px) {
            header nav ul { display: none; flex-direction: column; position: absolute; top: 100%; left: 0; width: 100%; background: rgba(19, 19, 19, 0.98); backdrop-filter: blur(10px); padding: 15px 0; border-top: 1px solid var(--border-color); }
            header nav ul.open { display: flex; }
            header nav ul li { margin: 10px 0; width: 100%; text-align: center; }
            .menu-toggle { display: flex; }
            .menu-toggle.open .bar:nth-child(1) { transform: rotate(45deg) translate(6px, 6px); }
            .menu-toggle.open .bar:nth-child(2) { opacity: 0; }
            .menu-toggle.open .bar:nth-child(3) { transform: rotate(-45deg) translate(7px, -7px); }

            .service-hero h1 { font-size: 2.5rem; }
            .section-title { font-size: 2.1rem; }
            .content-block, .cta-form { padding: 30px; }
        }

        @media (max-width: 768px) {
            html { font-size: 15px; }
            .service-hero { padding: 80px 0 60px; }
            .service-hero h1 { font-size: 2rem; line-height: 1.4; }
            .service-hero .subtitle { font-size: 1.1rem; }
            .section { padding: 60px 0; }
            .section-title { font-size: 1.8rem; }
            .section-subtitle { font-size: 1rem; }
            .accelerators-grid { grid-template-columns: 1fr; }
        }

        @media (max-width: 480px) {
            .service-hero h1 { font-size: 1.8rem; }
            .content-block h2 { font-size: 1.5rem; }
            .cta-form h3 { font-size: 1.4rem; }
            .content-block, .cta-form { padding: 25px; }
        }
    </style>
</head>
<body>

     @include('website.layouts.header')

    <main>
        <section class="service-hero">
            <div class="container">
                <div class="breadcrumb"><a href="index.html">Home</a> > <a href="#">Services</a> > <span>SEO & SEM</span></div>
                <h1>Search Engine <span class="highlight">Supremacy</span></h1>
                <p class="subtitle">Achieve top global search rankings. We craft advanced SEO & SEM strategies, fine-tuned for diverse international markets like the US, UK, India, and Australia.</p>
                <a href="#service-cta" class="cta-button">Start Your Ascent</a>
            </div>
        </section>

        <section id="service-content" class="section">
            <div class="container">
                <div class="content-layout">
                    <div class="content-block">
                        <h2>The Core Challenge: Navigating the Digital Noise</h2>
                        <p>In today's hyper-competitive digital landscape, simply having a website isn't enough. If you're not on the first page of search results, you are virtually invisible. The challenge is cutting through the noise and outranking global and local competitors to capture the attention of high-intent users.</p>
                    </div>
                    <div class="content-block">
                        <h2>Our Strategic Solution: A Unified Approach to Visibility</h2>
                        <p>Our "Search Engine Supremacy" service is an integrated ecosystem where SEO and SEM work in perfect harmony. We build a powerful organic foundation through technical excellence (SEO) while deploying precision-targeted paid campaigns (SEM) to capture immediate traffic. This dual approach ensures both long-term growth and short-term results.</p>
                    </div>
                </div>
            </div>
        </section>

        <section id="key-accelerators" class="section">
            <div class="container">
                <h2 class="section-title">Core <span>Service Accelerators</span></h2>
                <p class="section-subtitle">The essential components we deploy to dominate search engine results pages.</p>
                <div class="accelerators-grid">
                    <div class="accelerator-card"><div class="icon"><i class="fas fa-globe"></i></div><h3>Multilingual Keyword Intelligence</h3><p>We uncover high-intent keywords specific to the cultural and linguistic nuances of each target market.</p></div>
                    <div class="accelerator-card"><div class="icon"><i class="fas fa-wrench"></i></div><h3>Advanced Technical SEO Audits</h3><p>Our audits ensure your site is perfectly optimized for speed, mobile-friendliness, and crawlability worldwide.</p></div>
                    <div class="accelerator-card"><div class="icon"><i class="fas fa-bullseye"></i></div><h3>Global & Localized PPC Campaigns</h3><p>We manage hyper-targeted Google & Bing Ads campaigns with localized ad copy that resonates and converts.</p></div>
                    <div class="accelerator-card"><div class="icon"><i class="fas fa-project-diagram"></i></div><h3>Cross-Border Link Ecosystems</h3><p>We build your site's authority by acquiring high-quality, relevant backlinks from reputable sources in your target countries.</p></div>
                    <div class="accelerator-card"><div class="icon"><i class="fas fa-chart-line"></i></div><h3>Conversion Rate Optimization (CRO)</h3><p>We analyze user behavior from search to continuously optimize your landing pages, ensuring visitors convert into leads.</p></div>
                    <div class="accelerator-card"><div class="icon"><i class="fas fa-file-alt"></i></div><h3>Transparent Performance Reporting</h3><p>You receive clear, concise reports showing the direct impact of our efforts on your traffic, leads, and ROI.</p></div>
                </div>
            </div>
        </section>

        <section id="service-cta" class="section">
            <div class="container">
                <h2 class="section-title">Ready to Dominate <span>Search?</span></h2>
                <p class="section-subtitle">Let's build your strategy for global visibility. Fill out the form below to connect with one of our specialists.</p>
                <div class="cta-form">
                    <h3>Start Your Project Inquiry</h3>
                    <form action="#" method="POST">
                        <input type="text" name="name" placeholder="Your Full Name" required>
                        <input type="email" name="email" placeholder="Your Business Email Address" required>
                        <input type="tel" name="phone" placeholder="Your Phone Number">
                        <textarea name="message" rows="4" placeholder="Briefly describe your business and search engine goals..."></textarea>
                        <button type="submit" class="cta-button">Request My Free Consultation</button>
                    </form>
                </div>
            </div>
        </section>
    </main>

    @extends('website.layouts.footer')

   <!-- ===== JAVASCRIPT FOR LOADER ===== -->
<script>
    document.addEventListener('DOMContentLoaded', () => {

        // --- Preloader Logic ---
        const loader = document.getElementById('loader-wrapper');

        // Fallback to hide loader after a few seconds if 'load' event fails
        const fallback = setTimeout(() => {
             if(loader) {
                loader.classList.add('loaded');
            }
        }, 5000); // 5 seconds

        // Hide the loader once the page and all its content (images, scripts) are fully loaded
        window.addEventListener('load', function() {
            clearTimeout(fallback); // Clear the fallback timer
            if(loader) {
                loader.classList.add('loaded');
            }
        });

    });
</script>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // --- Mobile Menu Toggle ---
        const navMenu = document.getElementById('nav-menu');
        const menuToggleButton = document.getElementById('menu-toggle-button');
        if (menuToggleButton && navMenu) {
            menuToggleButton.addEventListener('click', () => {
                navMenu.classList.toggle('open');
                menuToggleButton.classList.toggle('open');
                menuToggleButton.setAttribute('aria-expanded', navMenu.classList.contains('open'));
            });
        }
        const navLinks = document.querySelectorAll('#nav-menu a');
        navLinks.forEach(link => {
            link.addEventListener('click', () => {
                if (navMenu.classList.contains('open')) {
                    navMenu.classList.remove('open');
                    menuToggleButton.classList.remove('open');
                    menuToggleButton.setAttribute('aria-expanded', 'false');
                }
            });
        });

        // --- Current Year ---
        const currentYearSpan = document.getElementById('currentYear');
        if (currentYearSpan) {
            currentYearSpan.textContent = new Date().getFullYear();
        }

        // --- Header Scroll Effect ---
        const mainHeader = document.getElementById('main-header');
        window.addEventListener('scroll', () => {
            if (window.scrollY > 50) {
                mainHeader.classList.add('scrolled');
            } else {
                mainHeader.classList.remove('scrolled');
            }
        });

        // --- Active Nav Link on Scroll ---
        const sections = document.querySelectorAll('section[id]');
        function changeActiveLink() {
            let current = '';
            sections.forEach(section => {
                const sectionTop = section.offsetTop;
                if (pageYOffset >= sectionTop - (mainHeader.offsetHeight + 70) ) {
                    current = section.getAttribute('id');
                }
            });
            navLinks.forEach(link => {
                link.classList.remove('active');
                if (link.getAttribute('href') && link.getAttribute('href').substring(1) === current) {
                    link.classList.add('active');
                }
            });
            if (!current && navLinks.length > 0 && pageYOffset < sections[0].offsetTop - (mainHeader.offsetHeight + 70)) {
                 navLinks.forEach(link => link.classList.remove('active'));
                 const homeLink = document.querySelector('#nav-menu a[href="#hero"]');
                 if (homeLink) homeLink.classList.add('active');
             }
        }
        window.addEventListener('scroll', changeActiveLink);
        changeActiveLink();

        // --- Scroll Animations ---
        const animatedElements = document.querySelectorAll('.animate-on-scroll');
        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('is-visible');
                } else {
                    // entry.target.classList.remove('is-visible'); // Optional: replay animation
                }
            });
        }, { rootMargin: '0px 0px -10% 0px', threshold: 0.1 });
        animatedElements.forEach(el => observer.observe(el));

        // --- FAQ Accordion ---
        const detailsElements = document.querySelectorAll('.faq-item');
        detailsElements.forEach(details => {
            details.addEventListener('toggle', function() {
                if (this.open) {
                    detailsElements.forEach(otherDetails => {
                        if (otherDetails !== this && otherDetails.open) {
                            otherDetails.open = false;
                        }
                    });
                }
            });
        });


        // --- Animated Backgrounds: Bubbles and Particles ---
        const bubblesContainer = document.querySelector('.bubbles');
        if (bubblesContainer) {
            const numberOfBubbles = 15;
            for (let i = 0; i < numberOfBubbles; i++) {
                const bubble = document.createElement('span');
                const size = Math.random() * 15 + 5;
                bubble.style.width = `${size}px`;
                bubble.style.height = `${size}px`;
                bubble.style.left = `${Math.random() * 100}%`;
                bubble.style.animationDelay = `${Math.random() * 25}s`;
                bubble.style.animationDuration = `${Math.random() * 20 + 15}s`;
                bubble.style.opacity = `${Math.random() * 0.4 + 0.1}`;
                bubblesContainer.appendChild(bubble);
            }
        }

        const particleContainer = document.querySelector('.bg-animation-container');
        if (particleContainer) {
            const numberOfParticles = 30;
            for (let i = 0; i < numberOfParticles; i++) {
                const particle = document.createElement('div');
                particle.classList.add('bg-particle');
                const size = Math.random() * 3 + 1;
                particle.style.width = `${size}px`;
                particle.style.height = `${size}px`;
                particle.style.left = `${Math.random() * 100}%`;
                particle.style.animationDelay = `${Math.random() * 10}s`;
                particle.style.animationDuration = `${Math.random() * 5 + 5}s`;
                particleContainer.appendChild(particle);
            }
        }
    });

    </script>

    @if (session('success'))
    <script>
        window.addEventListener('DOMContentLoaded', () => {
            Toastify({
                text: "{{ session('success') }}",
                duration: 5000,
                gravity: "top",
                position: "right",
                backgroundColor: "#28a745",
                close: true
            }).showToast();
        });
    </script>
@endif
<script src="https://cdn.jsdelivr.net/npm/toastify-js"></script>
</body>
</html>
