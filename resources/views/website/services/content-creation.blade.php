<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- SEO for Content Creation Service Page -->
    <title>Content Creation Services | Adzquare - Content That Converts</title>
    <meta name="description" content="Fuel your digital growth with strategic content creation from Adzquare. We craft high-value articles, web copy, and social content that builds authority and converts readers into customers.">
    <meta name="keywords" content="content creation services, content marketing, copywriting, blog writing services, website content, content strategy, SEO content">
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
                <div class="breadcrumb"><a href="index.html">Home</a> > <a href="#">Services</a> > <span>Content Creation</span></div>
                <h1>Content That Connects. <span class="highlight">Copy That Converts.</span></h1>
                <p class="subtitle">We move beyond mere words to architect content strategies that build trust, establish authority, and fuel every channel of your digital marketing ecosystem.</p>
                <a href="#service-cta" class="cta-button">Tell Your Story</a>
            </div>
        </section>

        <!-- =========================== -->
        <!--  PROBLEM/SOLUTION SECTION   -->
        <!-- =========================== -->
        <section id="service-content" class="section">
            <div class="container">
                <div class="content-layout">
                    <div class="content-block">
                        <h2>The Core Challenge: The Content Void</h2>
                        <p>Many businesses fall into the content trap: producing generic, uninspired articles and posts just to "be active." This content fails to resonate with audiences, doesn't rank on search engines, and does nothing to build brand equity. It's not an asset; it's just noise. This void allows more strategic competitors to capture your audience's attention and trust.</p>
                    </div>
                    <div class="content-block">
                        <h2>Our Strategic Solution: Content as a Core Business Asset</h2>
                        <p>At Adzquare, content is the fuel for your entire marketing engine. We develop a deep understanding of your audience's questions, challenges, and motivations. Then, we craft high-value content that answers those needs, positioning you as the definitive authority in your space. This approach turns your blog, website, and social profiles into powerful assets that attract, engage, and convert.</p>
                    </div>
                </div>
            </div>
        </section>

        <!-- =========================== -->
        <!--    CORE SERVICES SECTION    -->
        <!-- =========================== -->
        <section id="key-accelerators" class="section">
            <div class="container">
                <h2 class="section-title">Core <span>Content Accelerators</span></h2>
                <p class="section-subtitle">The essential components of our content creation engine, designed for maximum impact.</p>
                <div class="accelerators-grid">
                    <div class="accelerator-card"><div class="icon"><i class="fas fa-map-signs"></i></div><h3>Strategic Content Roadmaps</h3><p>We begin by creating a data-driven content plan that aligns with your business goals, targets valuable keywords, and maps out a full-funnel content journey.</p></div>
                    <div class="accelerator-card"><div class="icon"><i class="fas fa-feather-alt"></i></div><h3>SEO & Authority Content</h3><p>Our team produces expertly written, long-form articles and blog posts designed to rank on search engines and establish your brand as a thought leader.</p></div>
                    <div class="accelerator-card"><div class="icon"><i class="fas fa-bullseye-pointer"></i></div><h3>High-Conversion Copywriting</h3><p>We write persuasive, action-oriented copy for your website pages, landing pages, and advertisements, crafted to turn visitors into customers.</p></div>
                    <div class="accelerator-card"><div class="icon"><i class="fas fa-camera-retro"></i></div><h3>Engaging Social Media Content</h3><p>We create and manage a calendar of compelling visuals, captions, and stories for platforms like Instagram and LinkedIn that build community and drive engagement.</p></div>
                    <div class="accelerator-card"><div class="icon"><i class="fas fa-video"></i></div><h3>Video Scripting & Storyboarding</h3><p>We help you harness the power of video by developing clear scripts and concepts for promotional videos, tutorials, and social media clips.</p></div>
                    <div class="accelerator-card"><div class="icon"><i class="fas fa-bullhorn"></i></div><h3>Content Distribution & Promotion</h3><p>Creating great content is only half the battle. We ensure your content reaches the right audience through strategic outreach and multi-channel promotion.</p></div>
                </div>
            </div>
        </section>

        <!-- =========================== -->
        <!--  FINAL CALL-TO-ACTION       -->
        <!-- =========================== -->
        <section id="service-cta" class="section">
            <div class="container">
                <h2 class="section-title">Ready to Tell Your <span class="highlight">Brand's Story?</span></h2>
                <p class="section-subtitle">Let's build a content strategy that captivates your audience and drives measurable growth. Connect with our content strategists today.</p>
                <div class="cta-form">
                    <h3>Start Your Content Inquiry</h3>
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
