<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- SEO for Service Page -->
    <title>PPC Management Services | Adzquare - Precision Paid Advertising</title>
    <meta name="description" content="Maximize your ROI with hyper-targeted Google & Facebook Ads campaigns managed by Adzquare. We focus on conversions and optimal cost-efficiency for global audiences.">
    <meta name="keywords" content="PPC management, paid advertising services, Google Ads agency, Facebook Ads expert, retargeting, programmatic advertising, conversion optimization">
    <meta name="author" content="Adzquare">

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
                <div class="breadcrumb"><a href="index.html">Home</a> > <a href="#">Services</a> > <span>Precision Paid Advertising</span></div>
                <h1>Precision Paid <span class="highlight">Advertising</span></h1>
                <p class="subtitle">Maximize your ROI with hyper-targeted Google & Facebook Ads. Our experts manage campaigns for global audiences, focusing on conversions and optimal cost-efficiency.</p>
                <a href="#service-cta" class="cta-button">Maximize Your ROI</a>
            </div>
        </section>

        <section id="service-content" class="section">
            <div class="container">
                <div class="content-layout">
                    <div class="content-block">
                        <h2>The Core Challenge: The High Cost of Guesswork</h2>
                        <p>Paid advertising offers immense power, but without precision, it becomes an expensive gamble. Many businesses waste their budget on poorly targeted ads that reach the wrong audience, use ineffective messaging, and lead to low conversion rates. The challenge is to navigate the complexity of global ad platforms and invest every dollar where it will generate the highest possible return.</p>
                    </div>
                    <div class="content-block">
                        <h2>Our Strategic Solution: Data-Driven, ROI-Focused Campaigns</h2>
                        <p>Adzquare treats your ad spend as a strategic investment. We eliminate guesswork by deploying a rigorously data-driven approach. From initial campaign structuring to continuous budget optimization and creative testing, every decision is designed to lower your cost-per-acquisition and maximize your return on investment. We turn your ad budget into a predictable engine for growth.</p>
                    </div>
                </div>
            </div>
        </section>

        <section id="key-accelerators" class="section">
            <div class="container">
                <h2 class="section-title">Core <span>Service Accelerators</span></h2>
                <p class="section-subtitle">The essential components we deploy for profitable, high-performance ad campaigns.</p>
                <div class="accelerators-grid">
                    <div class="accelerator-card"><div class="icon"><i class="fas fa-sitemap"></i></div><h3>Strategic Campaign Structuring</h3><p>We build scalable international ad campaigns with a logical structure that allows for granular control and clear performance analysis.</p></div>
                    <div class="accelerator-card"><div class="icon"><i class="fas fa-magic"></i></div><h3>Compelling Localized Ad Copy</h3><p>Our team crafts culturally-resonant ad copy and designs creative assets that capture attention and drive action in each target market.</p></div>
                    <div class="accelerator-card"><div class="icon"><i class="fas fa-coins"></i></div><h3>Multi-Region Budget Optimization</h3><p>We use advanced analytics to dynamically allocate your budget to the best-performing regions, platforms, and campaigns in real-time.</p></div>
                    <div class="accelerator-card"><div class="icon"><i class="fas fa-filter"></i></div><h3>Advanced Audience Segmentation</h3><p>We go beyond basic demographics, using behavioral data and custom audiences to target your ideal customers with unparalleled precision.</p></div>
                    <div class="accelerator-card"><div class="icon"><i class="fas fa-sync-alt"></i></div><h3>Intelligent Retargeting Strategies</h3><p>We re-engage past website visitors and interested users with tailored messaging, nurturing them through the funnel to conversion.</p></div>
                    <div class="accelerator-card"><div class="icon"><i class="fas fa-robot"></i></div><h3>Programmatic & Display Advertising</h3><p>We expand your reach through automated ad buying across a vast network of websites, placing your brand in front of relevant audiences at scale.</p></div>
                </div>
            </div>
        </section>

        <section id="service-cta" class="section">
            <div class="container">
                <h2 class="section-title">Stop Gambling with Your <span>Ad Spend</span></h2>
                <p class="section-subtitle">Let's build a profitable paid advertising strategy together. Fill out the form to get a free analysis and consultation from our PPC experts.</p>
                <div class="cta-form">
                    <h3>Start Your Project Inquiry</h3>
                    <form action="#" method="POST">
                        <input type="text" name="name" placeholder="Your Full Name" required>
                        <input type="email" name="email" placeholder="Your Business Email Address" required>
                        <input type="tel" name="phone" placeholder="Your Phone Number">
                        <textarea name="message" rows="4" placeholder="Briefly describe your business and advertising goals..."></textarea>
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
