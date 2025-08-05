<head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <!-- SEO Basics -->
        <title>Adzquare - Global IT & 360° Digital Marketing Solutions | USA, UK, India, Australia</title>
        <meta name="description" content="Adzquare: Your international partner for cutting-edge IT solutions and results-driven 360° digital marketing services. We empower businesses in the USA, UK, India, Australia, and beyond.">
        <meta name="keywords" content="digital marketing, IT solutions, SEO, SEM, SMM, web development, app development, Adzquare, international digital marketing, USA, UK, India, Australia, global IT services">
        <meta name="author" content="Adzquare">

        <meta name="csrf-token" content="{{ csrf_token() }}">
        <!-- Open Graph / Facebook -->
        <meta property="og:type" content="website">
        <meta property="og:url" content="https://www.adzquare.com/"> <!-- Replace with your actual URL -->
        <meta property="og:title" content="Adzquare - Global IT & 360° Digital Marketing Solutions">
        <meta property="og:description" content="Drive global growth with Adzquare's innovative IT and digital marketing strategies.">
        <meta property="og:image" content="https://www.adzquare.com/og-image.jpg"> <!-- Replace with an actual Open Graph image URL -->
        <!-- Twitter -->
        <meta property="twitter:card" content="summary_large_image">
        <meta property="twitter:url" content="https://www.adzquare.com/"> <!-- Replace with your actual URL -->
        <meta property="twitter:title" content="Adzquare - Global IT & 360° Digital Marketing Solutions">
        <meta property="twitter:description" content="Drive global growth with Adzquare's innovative IT and digital marketing strategies.">
        <meta property="twitter:image" content="https://www.adzquare.com/twitter-card-image.jpg"> <!-- Replace with an actual Twitter card image URL -->


        <link rel="stylesheet" href="/css/main_style.css">

        <!-- FAVICONS ICON -->
        <link rel="shortcut icon" type="image/png" href="{{ asset('admin_new/images/favicon.png') }}">

        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/toastify-js/src/toastify.min.css">
        <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&family=Orbitron:wght@400;500;700&display=swap" rel="stylesheet">
        <!-- TOASTIFY CSS (for notifications) -->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/toastify-js/src/toastify.min.css">

    @include('components.gemini')

</head>

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


