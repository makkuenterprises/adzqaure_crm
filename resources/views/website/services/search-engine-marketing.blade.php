<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- SEO for SEM Service Page -->
    <title>SEM Services | Adzquare - Instant Search Visibility & Results</title>
    <meta name="description" content="Dominate search results today with Adzquare's expert SEM services. We create and manage ROI-focused Google & Bing Ads campaigns that capture high-intent customers instantly.">
    <meta name="keywords" content="SEM services, search engine marketing, PPC agency, Google Ads management, Bing Ads, paid search marketing, SEM company">
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
                <div class="breadcrumb"><a href="index.html">Home</a> > <a href="#">Services</a> > <span>Search Engine Marketing</span></div>
                <h1>Instant Visibility. <span class="highlight">Immediate Results.</span></h1>
                <p class="subtitle">While SEO builds your long-term authority, our SEM strategies place you at the top of search results *today*, capturing high-intent customers the moment they decide to act.</p>
                <a href="#service-cta" class="cta-button">Launch Your Campaign</a>
            </div>
        </section>

        <!-- =========================== -->
        <!--  PROBLEM/SOLUTION SECTION   -->
        <!-- =========================== -->
        <section id="service-content" class="section">
            <div class="container">
                <div class="content-layout">
                    <div class="content-block">
                        <h2>The Core Challenge: The High Cost of Waiting</h2>
                        <p>Every minute your business isn't at the top of the search results for your most valuable keywords, your competitors are capturing your potential customers. In the fast-paced digital marketplace, waiting for organic rankings to mature means actively losing revenue. The biggest challenge is gaining immediate visibility without gambling away your budget on ineffective campaigns.</p>
                    </div>
                    <div class="content-block">
                        <h2>Our Strategic Solution: Engineering Profitability at Speed</h2>
                        <p>Adzquare transforms SEM from an expense into a strategic, high-return investment. We use surgical precision to target users who are actively searching for your solution. Our methodology is ruthlessly focused on ROI, eliminating wasteful spending and optimizing every element of your campaign—from keyword to landing page—to turn clicks into customers and ad spend into predictable profit.</p>
                    </div>
                </div>
            </div>
        </section>

        <!-- =========================== -->
        <!--    CORE SERVICES SECTION    -->
        <!-- =========================== -->
        <section id="key-accelerators" class="section">
            <div class="container">
                <h2 class="section-title">Core <span>SEM Accelerators</span></h2>
                <p class="section-subtitle">The essential components we deploy for profitable, high-performance paid search campaigns.</p>
                <div class="accelerators-grid">
                    <div class="accelerator-card"><div class="icon"><i class="fas fa-gavel"></i></div><h3>Strategic Keyword Bidding</h3><p>We research and target high-intent keywords, implementing advanced bidding strategies to secure top positions at the most cost-effective price.</p></div>
                    <div class="accelerator-card"><div class="icon"><i class="fas fa-pencil-ruler"></i></div><h3>High-Conversion Ad Copy</h3><p>Our team crafts compelling, psychologically-driven ad copy and utilizes extensions to maximize click-through rates and dominate the search results page.</p></div>
                    <div class="accelerator-card"><div class="icon"><i class="fas fa-tachometer-alt"></i></div><h3>Landing Page Optimization (CRO)</h3><p>We ensure your ad traffic arrives at a fast, persuasive, and frictionless landing page designed specifically to convert visitors into valuable leads and sales.</p></div>
                    <div class="accelerator-card"><div class="icon"><i class="fas fa-hand-holding-usd"></i></div><h3>ROI-Focused Budget Management</h3><p>We treat your budget like our own, dynamically allocating spend to the campaigns, ad groups, and keywords that deliver the highest return on investment.</p></div>
                    <div class="accelerator-card"><div class="icon"><i class="fas fa-chart-pie"></i></div><h3>Transparent Performance Tracking</h3><p>We track every metric that matters—from impressions to conversions—providing clear, actionable reports that demonstrate the direct impact on your bottom line.</p></div>
                    <div class="accelerator-card"><div class="icon"><i class="fas fa-users-cog"></i></div><h3>Audience & Competitor Analysis</h3><p>We continuously analyze your target audience and monitor competitor strategies to identify new opportunities and keep you one step ahead in the market.</p></div>
                </div>
            </div>
        </section>

        <!-- =========================== -->
        <!--  FINAL CALL-TO-ACTION       -->
        <!-- =========================== -->
        <section id="service-cta" class="section">
            <div class="container">
                <h2 class="section-title">Ready to Own the <span class="highlight">Top Spot?</span></h2>
                <p class="section-subtitle">Stop letting competitors capture your customers. Let's launch a paid search campaign that delivers immediate, measurable, and profitable results.</p>
                <div class="cta-form">
                    <h3>Get a Free Campaign Proposal</h3>
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
