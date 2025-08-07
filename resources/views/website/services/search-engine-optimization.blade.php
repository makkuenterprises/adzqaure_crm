<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- SEO for SEO Service Page -->
    <title>SEO Services | Adzquare - Search Engine Supremacy</title>
    <meta name="description" content="Achieve top global search rankings with Adzquare's expert SEO strategies. We drive organic traffic and build lasting authority for businesses in the USA, UK, India, and Australia.">
    <meta name="keywords" content="SEO services, search engine optimization, technical SEO, on-page SEO, link building, keyword research, organic traffic, local SEO agency">
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
                <div class="breadcrumb"><a href="index.html">Home</a> > <a href="#">Services</a> > <span>Search Engine Optimization</span></div>
                <h1>Search Engine <span class="highlight">Supremacy</span></h1>
                <p class="subtitle">We engineer long-term organic growth, moving your brand from invisible to invincible in global search rankings and driving a sustainable flow of high-intent customers.</p>
                <a href="#service-cta" class="cta-button">Start Your Ascent</a>
            </div>
        </section>

        <!-- =========================== -->
        <!--  PROBLEM/SOLUTION SECTION   -->
        <!-- =========================== -->
        <section id="service-content" class="section">
            <div class="container">
                <div class="content-layout">
                    <div class="content-block">
                        <h2>The Core Challenge: The Invisibility Problem</h2>
                        <p>In today's digital economy, if you're not on the first page of Google, you are virtually invisible to 95% of your potential customers. Many businesses struggle with low rankings, unable to outmaneuver competitors or understand the complex, ever-changing algorithms. This digital invisibility directly translates to lost traffic, leads, and revenue.</p>
                    </div>
                    <div class="content-block">
                        <h2>Our Strategic Solution: Building Lasting Digital Authority</h2>
                        <p>Unlike quick-fix tactics that fade away, Adzquare's SEO strategy is about building a powerful, lasting digital asset. We focus on three core pillars: flawless technical performance, high-value content that users and search engines love, and building a credible backlink profile. This creates sustainable authority that withstands algorithm updates and delivers compounding returns over time.</p>
                    </div>
                </div>
            </div>
        </section>

        <!-- =========================== -->
        <!--    CORE SERVICES SECTION    -->
        <!-- =========================== -->
        <section id="key-accelerators" class="section">
            <div class="container">
                <h2 class="section-title">Core <span>SEO Accelerators</span></h2>
                <p class="section-subtitle">The essential components we deploy to dominate search engine results pages.</p>
                <div class="accelerators-grid">
                    <div class="accelerator-card"><div class="icon"><i class="fas fa-sitemap"></i></div><h3>Technical SEO Foundation</h3><p>We conduct deep audits to optimize your site's speed, mobile-friendliness, crawlability, and overall health, ensuring search engines can index you perfectly.</p></div>
                    <div class="accelerator-card"><div class="icon"><i class="fas fa-key"></i></div><h3>Multilingual Keyword Intelligence</h3><p>We uncover the high-intent keywords and phrases your target customers are using in each specific region, from the USA to India.</p></div>
                    <div class="accelerator-card"><div class="icon"><i class="fas fa-file-alt"></i></div><h3>On-Page & Content Optimization</h3><p>We meticulously align your website's content, titles, meta descriptions, and structure with your target keywords to signal relevance to search engines.</p></div>
                    <div class="accelerator-card"><div class="icon"><i class="fas fa-project-diagram"></i></div><h3>Authority Building & Link Ecosystems</h3><p>We build your site's authority by acquiring high-quality, relevant backlinks from reputable sources through outreach and digital PR in your target countries.</p></div>
                    <div class="accelerator-card"><div class="icon"><i class="fas fa-map-marked-alt"></i></div><h3>Local & International SEO</h3><p>We optimize your presence for both "near me" searches in local markets and broad queries across international territories to capture all relevant traffic.</p></div>
                    <div class="accelerator-card"><div class="icon"><i class="fas fa-chart-bar"></i></div><h3>Transparent Performance Analytics</h3><p>You receive clear, concise reports tracking your keyword rankings, organic traffic growth, and conversions, proving the direct ROI of our SEO efforts.</p></div>
                </div>
            </div>
        </section>

        <!-- =========================== -->
        <!--  FINAL CALL-TO-ACTION       -->
        <!-- =========================== -->
        <section id="service-cta" class="section">
            <div class="container">
                <h2 class="section-title">Ready to Be <span class="highlight">Discovered?</span></h2>
                <p class="section-subtitle">Let's craft your roadmap to the top of the search results. Connect with our analysts for a free, no-obligation website audit and strategy session.</p>
                <div class="cta-form">
                    <h3>Request Your Free SEO Audit</h3>
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
