<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- SEO for Meta & Google Ads Service Page -->
    <title>Meta & Google Ads Management | Adzquare - Paid Social & Search Experts</title>
    <meta name="description" content="Harness the world's largest ad platforms with Adzquare. We manage ROI-driven Meta (Facebook/Instagram) & Google Ads campaigns to capture intent and create demand.">
    <meta name="keywords" content="Meta ads management, Google Ads agency, Facebook advertising, PPC services, social media ads, search ads, ROAS, cross-platform advertising">
    <meta name="author" content="Adzquare">

    <!-- This should point to your single, unified stylesheet -->
    <link rel="stylesheet" href="/css/sub_style.css">

    <!-- (Include other head elements like fonts, Font Awesome, etc.) -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&family=Orbitron:wght@400;500;700&display=swap" rel="stylesheet">
</head>
<body>

    @include('website.layouts.header')

    <main>
        <!-- =========================== -->
        <!--      HERO SECTION           -->
        <!-- =========================== -->
        <section class="service-hero">
            <div class="container">
                <div class="breadcrumb"><a href="index.html">Home</a> > <a href="#">Services</a> > <span>Meta & Google Ads</span></div>
                <h1>Capture Intent. <span class="highlight">Create Demand.</span></h1>
                <p class="subtitle">We synchronize the power of Google's search intent with Meta's audience discovery to create a full-funnel advertising strategy that dominates every stage of the customer journey.</p>
                <a href="#service-cta" class="cta-button">Dominate Your Market</a>
            </div>
        </section>

        <!-- =========================== -->
        <!--  PROBLEM/SOLUTION SECTION   -->
        <!-- =========================== -->
        <section id="service-content" class="section">
            <div class="container">
                <div class="content-layout">
                    <div class="content-block">
                        <h2>The Core Challenge: The Platform Puzzle</h2>
                        <p>Managing Google and Meta ads as separate entities is a recipe for wasted budget and missed opportunities. Without a unified strategy, you create a disjointed customer experience, fail to share valuable audience data between platforms, and can't see the true ROI of your efforts. The complexity of each platform often leads to costly guesswork, burning ad spend with little to show for it.</p>
                    </div>
                    <div class="content-block">
                        <h2>Our Strategic Solution: A Synchronized Advertising Machine</h2>
                        <p>Adzquare architects a single, powerful advertising machine. We use Google Ads to capture high-intent users actively searching for your solution. Simultaneously, we use Meta Ads (Facebook & Instagram) to build brand awareness and create new demand within your ideal customer profile. Data flows between both, allowing for powerful retargeting strategies that convert prospects at a much higher rate.</p>
                    </div>
                </div>
            </div>
        </section>

        <!-- =========================== -->
        <!--    CORE SERVICES SECTION    -->
        <!-- =========================== -->
        <section id="key-accelerators" class="section">
            <div class="container">
                <h2 class="section-title">Core <span>Campaign Accelerators</span></h2>
                <p class="section-subtitle">The essential components we deploy for profitable, high-performance ad campaigns on both platforms.</p>
                <div class="accelerators-grid">
                    <div class="accelerator-card"><div class="icon"><i class="fab fa-google"></i></div><h3>Google Ads Campaign Mastery</h3><p>We build and manage high-performance search, display, and shopping campaigns that place your brand in front of customers at the exact moment of decision.</p></div>
                    <div class="accelerator-card"><div class="icon"><i class="fab fa-meta"></i></div><h3>Meta Ads Audience Architecture</h3><p>We leverage the full power of Meta's data to build custom audiences, lookalikes, and interest-based targeting to find your next customers on Facebook & Instagram.</p></div>
                    <div class="accelerator-card"><div class="icon"><i class="fas fa-sync-alt"></i></div><h3>Cross-Platform Retargeting</h3><p>Our key advantage. We re-engage users who visited from a Google search with compelling visual ads on Instagram, dramatically increasing conversion rates.</p></div>
                    <div class="accelerator-card"><div class="icon"><i class="fas fa-palette"></i></div><h3>Scroll-Stopping Ad Creative</h3><p>We design high-impact visuals and write persuasive, platform-specific ad copy that cuts through the noise and compels users to take action.</p></div>
                    <div class="accelerator-card"><div class="icon"><i class="fas fa-balance-scale-right"></i></div><h3>Relentless A/B Testing & Optimization</h3><p>We constantly test ad creatives, audiences, and landing pages to identify winners and dynamically allocate your budget for maximum Return On Ad Spend (ROAS).</p></div>
                    <div class="accelerator-card"><div class="icon"><i class="fas fa-chart-pie"></i></div><h3>Unified ROI Reporting</h3><p>You receive one clear, consolidated report showing how both platforms work together to contribute to your bottom line, with no confusing jargon.</p></div>
                </div>
            </div>
        </section>

        <!-- =========================== -->
        <!--  FINAL CALL-TO-ACTION       -->
        <!-- =========================== -->
        <section id="service-cta" class="section">
            <div class="container">
                <h2 class="section-title">Ready to Activate Your <span class="highlight">Growth Engine?</span></h2>
                <p class="section-subtitle">Stop treating Google and Meta as separate channels. Let's build a unified advertising machine that delivers unparalleled results.</p>
                <div class="cta-form">
                    <h3>Get a Free Cross-Platform Ad Analysis</h3>
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
