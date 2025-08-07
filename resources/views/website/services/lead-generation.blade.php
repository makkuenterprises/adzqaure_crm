<!DOCTYPE html>
<html lang="en">


<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

     <!-- SEO for Service Page -->
    <title>Lead Generation Services | Adzquare - Direct Engagement & Conversion</title>
    <meta name="description" content="Convert high-value prospects with Adzquare's direct engagement and lead generation services, including WhatsApp & Email Marketing, chatbots, and automated funnels.">
    <meta name="keywords" content="lead generation, direct engagement, WhatsApp marketing, email automation, chatbots, conversion funnel, CRM integration, landing page optimization">
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
                <div class="breadcrumb"><a href="index.html">Home</a> > <a href="#">Services</a> > <span>Direct Engagement & Lead Generation</span></div>
                <h1>Direct Engagement & <span class="highlight">Lead Generation</span></h1>
                <p class="subtitle">Nurture prospects and convert high-value leads. We implement sophisticated WhatsApp Marketing, Email Automation, and custom funnels for global markets.</p>
                <a href="#service-cta" class="cta-button">Convert Your Leads</a>
            </div>
        </section>

        <section id="service-content" class="section">
            <div class="container">
                <div class="content-layout">
                    <div class="content-block">
                        <h2>The Core Challenge: The Leaky Funnel</h2>
                        <p>Generating traffic and initial interest is only the first step. Too many businesses suffer from a "leaky funnel," where valuable prospects lose interest and drop off before they can be converted. Without a proactive strategy to engage and nurture these leads directly, your marketing efforts and investment are wasted, and potential revenue is lost to competitors.</p>
                    </div>
                    <div class="content-block">
                        <h2>Our Strategic Solution: Building Automated Relationships</h2>
                        <p>Adzquare plugs the leaks in your funnel by creating powerful, automated systems for direct engagement. We meet your customers where they are—on personal channels like WhatsApp and email—to build relationships, provide value, and guide them toward a purchase. By automating the nurturing process, we ensure no lead is left behind and that your sales team receives a steady stream of warm, qualified prospects.</p>
                    </div>
                </div>
            </div>
        </section>

        <section id="key-accelerators" class="section">
            <div class="container">
                <h2 class="section-title">Core <span>Service Accelerators</span></h2>
                <p class="section-subtitle">The essential components we deploy to build your automated lead conversion engine.</p>
                <div class="accelerators-grid">
                    <div class="accelerator-card">
                        <div class="icon"><i class="fab fa-whatsapp"></i></div>
                        <h3>WhatsApp API Integration</h3>
                        <p>We connect you directly with customers for marketing and support on the world's most popular messaging app, driving instant engagement.</p>
                    </div>
                    <div class="accelerator-card">
                        <div class="icon"><i class="fas fa-robot"></i></div>
                        <h3>Automated Multi-Lingual Chatbots</h3>
                        <p>Deploy intelligent chatbots on your website and social channels to qualify leads and answer queries 24/7, in any language.</p>
                    </div>
                    <div class="accelerator-card">
                        <div class="icon"><i class="fas fa-envelope-open-text"></i></div>
                        <h3>Compliant Email Marketing</h3>
                        <p>We design and manage GDPR/CCPA compliant email campaigns that nurture subscribers and drive sales through strategic automation.</p>
                    </div>
                    <div class="accelerator-card">
                        <div class="icon"><i class="fas fa-file-signature"></i></div>
                        <h3>High-Converting Landing Pages</h3>
                        <p>Our team designs and optimizes landing pages with a single goal: to convert visitors into qualified leads at the highest possible rate.</p>
                    </div>
                    <div class="accelerator-card">
                        <div class="icon"><i class="fas fa-cogs"></i></div>
                        <h3>CRM Integration & Automation</h3>
                        <p>We connect your marketing tools directly to your CRM, creating seamless lead nurturing sequences that guide prospects from first touch to final sale.</p>
                    </div>
                     <div class="accelerator-card">
                        <div class="icon"><i class="fas fa-funnel-dollar"></i></div>
                        <h3>Custom Funnel Strategy</h3>
                        <p>We analyze your entire sales process to design a custom lead generation funnel that is perfectly tailored to your business model and audience.</p>
                    </div>
                </div>
            </div>
        </section>

        <section id="service-cta" class="section">
            <div class="container">
                <h2 class="section-title">Turn Your Leads into <span>Revenue</span></h2>
                <p class="section-subtitle">Let's build a powerful, automated system to nurture and convert your prospects. Contact our experts to design your custom lead generation funnel.</p>
                <div class="cta-form">
                    <h3>Start Your Project Inquiry</h3>
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
