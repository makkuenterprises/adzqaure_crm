<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">


    <meta name="description" content="Achieve top global search rankings with Adzquare's expert SEO and SEM strategies. We specialize in driving organic traffic and maximizing ad spend for businesses in the USA, UK, India, and Australia.">

    <link rel="shortcut icon" type="image/png" href="admin_new/images/favicon.png">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&family=Orbitron:wght@400;500;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="/css/sub_style.css">
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
                    <h3>Send Us Your Project Brief or Inquiry</h3>
                     <form action="{{ route('inquiry.store') }}" method="POST"> <!-- Remember to set up form backend -->
                        @csrf
                        <input type="text" name="name" placeholder="Your Full Name" required>
                        <input type="email" name="email" placeholder="Your Business Email Address" required>
                        <input type="tel" name="phone" placeholder="Your Phone Number (with country code)">
                        <input type="text" name="company" placeholder="State & Country of Operation" required>
                        <textarea name="message" rows="5" placeholder="Briefly describe your project, requirements, or inquiry..." required style="width:100%; padding:14px; margin-bottom:18px; border-radius:8px; border:1px solid var(--border-color); background-color:rgba(10,10,15,0.5); color:var(--text-color); font-family:var(--font-body); font-size:0.95rem;"></textarea>
                        <button type="submit" class="cta-button">Submit Global Inquiry Now</button>
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
