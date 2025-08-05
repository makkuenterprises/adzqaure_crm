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
                <div class="breadcrumb"><a href="index.html">Home</a> > <a href="#">Services</a> > <span>Global Social Engagement</span></div>
                <h1>Global Social <span class="highlight">Engagement</span></h1>
                <p class="subtitle">Develop culturally-resonant social media campaigns. We connect your brand with diverse audiences worldwide on platforms like Facebook, Instagram, LinkedIn, and Twitter.</p>
                <a href="#service-cta" class="cta-button">Build Your Community</a>
            </div>
        </section>

        <section id="service-content" class="section">
            <div class="container">
                <div class="content-layout">
                    <div class="content-block">
                        <h2>The Core Challenge: Speaking the Global Language</h2>
                        <p>In a world connected by social media, a one-size-fits-all approach fails. What resonates in the UK may be ignored in India or misunderstood in the US. The challenge isn't just to be present on social platforms, but to be relevant, requiring a deep understanding of cultural context and local trends to build authentic connections.</p>
                    </div>
                    <div class="content-block">
                        <h2>Our Strategic Solution: From Broadcast to Conversation</h2>
                        <p>Adzquare transforms your social media from a broadcast channel into a dynamic hub for global conversation. We don't just post; we engage. Our strategies are built on cultural intelligence, creating content that speaks to each region, fostering active communities, and managing your brand's reputation across borders to turn passive followers into loyal advocates.</p>
                    </div>
                </div>
            </div>
        </section>

        <section id="key-accelerators" class="section">
            <div class="container">
                <h2 class="section-title">Core <span>Service Accelerators</span></h2>
                <p class="section-subtitle">The essential components we deploy to build and nurture your global brand presence.</p>
                <div class="accelerators-grid">
                    <div class="accelerator-card"><div class="icon"><i class="fas fa-palette"></i></div><h3>Cross-Cultural Content Strategy</h3><p>We craft content pillars, messaging, and visuals to align with the unique cultural values of each international audience.</p></div>
                    <div class="accelerator-card"><div class="icon"><i class="fas fa-comments"></i></div><h3>International Community Building</h3><p>Proactive engagement and moderation across time zones to foster a positive and loyal global community.</p></div>
                    <div class="accelerator-card"><div class="icon"><i class="fas fa-bullhorn"></i></div><h3>Targeted Global Social Advertising</h3><p>Precision ad campaigns on Facebook, Instagram, & LinkedIn, using advanced data to maximize ROI.</p></div>
                    <div class="accelerator-card"><div class="icon"><i class="fas fa-users"></i></div><h3>Worldwide Influencer Marketing</h3><p>We identify and collaborate with authentic local influencers in your target countries to build trust and amplify your message.</p></div>
                    <div class="accelerator-card"><div class="icon"><i class="fas fa-search-location"></i></div><h3>Social Listening & Reputation Mgt.</h3><p>Monitoring global conversations to gather insights, manage sentiment, and protect your online reputation.</p></div>
                    <div class="accelerator-card"><div class="icon"><i class="fas fa-chart-pie"></i></div><h3>Actionable Analytics & Reporting</h3><p>We provide comprehensive reports that measure what truly matters: engagement, lead generation, and ROI.</p></div>
                </div>
            </div>
        </section>

        <section id="service-cta" class="section">
            <div class="container">
                <h2 class="section-title">Ready to Connect with the <span>World?</span></h2>
                <p class="section-subtitle">Let's craft a social media strategy that transcends borders. Fill out the form to speak with our global SMM experts.</p>
                <div class="cta-form">
                    <h3>Start Your Project Inquiry</h3>
                    <form action="#" method="POST">
                        <input type="text" name="name" placeholder="Your Full Name" required>
                        <input type="email" name="email" placeholder="Your Business Email Address" required>
                        <input type="tel" name="phone" placeholder="Your Phone Number">
                        <textarea name="message" rows="4" placeholder="Briefly describe your business and social media goals..."></textarea>
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
