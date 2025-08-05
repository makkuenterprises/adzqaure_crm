<!DOCTYPE html>
<html lang="en">


<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- SEO for Service Page -->
    <title>IT Solutions & Cloud Services | Adzquare | AWS, Azure, GCP</title>
    <meta name="description" content="Empower your global operations with Adzquare's robust IT solutions, including managed services, cloud computing (AWS, Azure, GCP), cybersecurity, and custom development.">
    <meta name="keywords" content="managed IT services, cloud solutions, AWS consulting, Azure management, cybersecurity, custom software development, DevOps, IT infrastructure">
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
                <div class="breadcrumb"><a href="index.html">Home</a> > <a href="#">Services</a> > <span>IT & Cloud Solutions</span></div>
                <h1>Futuristic IT & <span class="highlight">Cloud Solutions</span></h1>
                <p class="subtitle">Empower your global operations with our robust IT infrastructure, cloud solutions, and custom software development. We ensure security, scalability, and efficiency for businesses operating across borders.</p>
                <a href="#service-cta" class="cta-button">Future-Proof Your Business</a>
            </div>
        </section>

        <section id="service-content" class="section">
            <div class="container">
                <div class="content-layout">
                    <div class="content-block">
                        <h2>The Core Challenge: The Drag of Legacy Systems</h2>
                        <p>In the digital age, outdated and inflexible IT infrastructure is not just an inconvenience—it's a critical business risk. Companies are held back by high maintenance costs, constant security threats, and an inability to scale or innovate quickly. This technological drag prevents them from competing effectively in a fast-moving global market, leading to downtime and missed opportunities.</p>
                    </div>
                    <div class="content-block">
                        <h2>Our Strategic Solution: Your Technology Foundation, Reimagined</h2>
                        <p>Adzquare provides a forward-thinking alternative. We architect, implement, and manage a secure, scalable, and cost-efficient technology backbone that powers your business. By leveraging leading cloud platforms like AWS, Azure, and GCP, and applying modern DevOps principles, we handle the complexity of your IT operations. This frees you to focus on your core business objectives, confident that your technology can keep pace with your ambition.</p>
                    </div>
                </div>
            </div>
        </section>

        <section id="key-accelerators" class="section">
            <div class="container">
                <h2 class="section-title">Core <span>Service Accelerators</span></h2>
                <p class="section-subtitle">The essential components we deploy to build and manage your high-performance technology ecosystem.</p>
                <div class="accelerators-grid">
                    <div class="accelerator-card">
                        <div class="icon"><i class="fas fa-headset"></i></div>
                        <h3>Managed IT & 24/7 Global Support</h3>
                        <p>Proactive monitoring, maintenance, and helpdesk support for your entire IT infrastructure, ensuring maximum uptime and reliability.</p>
                    </div>
                    <div class="accelerator-card">
                        <div class="icon"><i class="fas fa-cloud"></i></div>
                        <h3>Cloud Migration & Optimization</h3>
                        <p>Expert guidance and execution for migrating to AWS, Azure, or GCP, followed by continuous management to optimize cost and performance.</p>
                    </div>
                    <div class="accelerator-card">
                        <div class="icon"><i class="fas fa-lock"></i></div>
                        <h3>Advanced Cybersecurity Solutions</h3>
                        <p>We implement multi-layered security protocols, threat detection, and data protection strategies to safeguard your critical business assets.</p>
                    </div>
                    <div class="accelerator-card">
                        <div class="icon"><i class="fas fa-code"></i></div>
                        <h3>Custom Application Development</h3>
                        <p>Building scalable, secure, and user-friendly web and mobile applications tailored to solve your unique business challenges.</p>
                    </div>
                    <div class="accelerator-card">
                        <div class="icon"><i class="fas fa-infinity"></i></div>
                        <h3>DevOps & IT Automation</h3>
                        <p>We implement CI/CD pipelines and automation to accelerate your development lifecycle, improving speed and reliability.</p>
                    </div>
                     <div class="accelerator-card">
                        <div class="icon"><i class="fas fa-rocket"></i></div>
                        <h3>Performance Architecture</h3>
                        <p>We design and build systems with scalability at their core, ensuring your infrastructure can handle future growth without compromise.</p>
                    </div>
                </div>
            </div>
        </section>

        <section id="service-cta" class="section">
            <div class="container">
                <h2 class="section-title">Ready for a Technology <span>Upgrade?</span></h2>
                <p class="section-subtitle">Let's discuss how we can build a secure, scalable, and efficient IT foundation for your business. Contact us for a complimentary infrastructure assessment.</p>
                <div class="cta-form">
                    <h3>Start Your Project Inquiry</h3>
                    <form action="#" method="POST">
                        <input type="text" name="name" placeholder="Your Full Name" required>
                        <input type="email" name="email" placeholder="Your Business Email Address" required>
                        <input type="tel" name="phone" placeholder="Your Phone Number">
                        <textarea name="message" rows="4" placeholder="Briefly describe your current IT infrastructure and goals..."></textarea>
                        <button type="submit" class="cta-button">Schedule My IT Assessment</button>
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
