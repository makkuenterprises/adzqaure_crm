



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


