<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- SEO for Digital Marketing Service Page -->
    <title>360° Digital Marketing Services | Adzquare - Integrated Strategies</title>

    <meta name="description" content="Adzquare architects comprehensive 360° digital marketing strategies, integrating SEO, PPC, SMM, and Content Marketing to drive global growth and maximize ROI.">
    <meta name="keywords" content="digital marketing services, 360 digital marketing, integrated marketing, SMM, content marketing, digital strategy, online marketing agency">
    <meta name="author" content="Adzquare">

    <!-- This should point to your single, unified stylesheet -->
    <link rel="stylesheet" href="/css/sub_style.css">

    <!-- (Include other head elements like fonts, Font Awesome, etc.) -->
    <link rel="shortcut icon" type="image/png" href="admin_new/images/favicon.png">
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
                <div class="breadcrumb"><a href="index.html">Home</a> > <a href="#">Services</a> > <span>360° Digital Marketing</span></div>
                <h1>Integrated Digital <span class="highlight">Ecosystems</span></h1>
                <p class="subtitle">We move beyond isolated tactics to build powerful, unified digital marketing engines where every channel works in concert to achieve your global business objectives.</p>
                <a href="#service-cta" class="cta-button">Build Your Strategy</a>
            </div>
        </section>

        <!-- =========================== -->
        <!--  PROBLEM/SOLUTION SECTION   -->
        <!-- =========================== -->
        <section id="service-content" class="section">
            <div class="container">
                <div class="content-layout">
                    <div class="content-block">
                        <h2>The Core Challenge: The Cost of Disconnected Marketing</h2>
                        <p>Many businesses operate their marketing in silos—social media is separate from SEO, and paid ads don't inform the content strategy. This fragmentation leads to inconsistent brand messaging, wasted ad spend, and a confusing customer journey. The result is a digital presence that is less than the sum of its parts, failing to achieve its full potential.</p>
                    </div>
                    <div class="content-block">
                        <h2>Our Strategic Solution: A Unified, 360° Approach</h2>
                        <p>Adzquare solves this by architecting a fully integrated digital ecosystem. We ensure insights from your SEO keyword research fuel your content creation. Data from your PPC campaigns informs your social media targeting. Every action is part of a cohesive strategy, creating a powerful feedback loop that drives continuous improvement and magnifies your ROI.</p>
                    </div>
                </div>
            </div>
        </section>

        <!-- =========================== -->
        <!--    CORE SERVICES SECTION    -->
        <!-- =========================== -->
        <section id="key-accelerators" class="section">
            <div class="container">
                <h2 class="section-title">Core <span>Marketing Accelerators</span></h2>
                <p class="section-subtitle">The essential components we integrate to build your comprehensive digital strategy.</p>
                <div class="accelerators-grid">
                    <div class="accelerator-card"><div class="icon"><i class="fas fa-chart-line"></i></div><h3>Search Engine Supremacy (SEO/SEM)</h3><p>We build your organic authority through technical and content SEO while running precision SEM campaigns for immediate, targeted traffic.</p></div>
                    <div class="accelerator-card"><div class="icon"><i class="fas fa-users"></i></div><h3>Global Social Engagement (SMM)</h3><p>We build and manage vibrant communities on platforms like Instagram, Facebook, and LinkedIn with culturally-resonant content that engages global audiences.</p></div>
                    <div class="accelerator-card"><div class="icon"><i class="fas fa-pen-nib"></i></div><h3>Authority Content Marketing</h3><p>From insightful blogs to compelling videos, we create high-value content that establishes you as a thought leader and fuels every other marketing channel.</p></div>
                    <div class="accelerator-card"><i class="fa-brands fa-searchengin"></i><div class="icon"><i class="fas fa-search-dollar"></i></div><h3>Precision Paid Advertising</h3><p>We maximize your ROI with meticulously managed Google, Meta, and LinkedIn Ad campaigns designed to capture high-intent leads and sales.</p></div>
                    <div class="accelerator-card"><div class="icon"><i class="fas fa-envelope-open-text"></i></div><h3>Direct Engagement & Nurturing</h3><p>We implement sophisticated Email and WhatsApp marketing automation to convert prospects into loyal customers and brand advocates.</p></div>
                    <div class="accelerator-card"><div class="icon"><i class="fas fa-project-diagram"></i></div><h3>Data & Analytics Integration</h3><p>We connect data points from all channels to provide a clear, holistic view of your marketing performance and its direct impact on your bottom line.</p></div>
                </div>
            </div>
        </section>

        <!-- =========================== -->
        <!--  FINAL CALL-TO-ACTION       -->
        <!-- =========================== -->
        <section id="service-cta" class="section">
            <div class="container">
                <h2 class="section-title">Ready to Unify Your <span>Marketing?</span></h2>
                <p class="section-subtitle">Let's build a powerful, integrated digital ecosystem that drives real business results. Connect with our strategy experts today.</p>
                <div class="cta-form">
                    <h3>Start Your Strategy Inquiry</h3>
                    <form action="#" method="POST">
                        <input type="text" name="name" placeholder="Your Full Name" required>
                        <input type="email" name="email" placeholder="Your Business Email Address" required>
                        <input type="tel" name="phone" placeholder="Your Phone Number">
                        <textarea name="message" rows="4" placeholder="Briefly describe your business and your digital marketing goals..."></textarea>
                        <button type="submit" class="cta-button">Get My Free Consultation</button>
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
