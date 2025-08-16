<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product: Futuristic UI Kit - Adzquare Marketplace</title>
    <meta name="description" content="Explore the features of the Futuristic UI Kit, a comprehensive asset for building modern web and mobile applications.">

    <!-- This should point to your single, unified stylesheet -->
    <link rel="stylesheet" href="/css/sub_style.css">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <!-- Google Fonts & Font Awesome -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&family=Orbitron:wght@400;500;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

    <style>

         .cart-icon {
            color: white; /* Change to your desired color */
            font-size: 1.2rem; /* Adjust the size as needed */
            margin-left: 15px; /* Add some space between the navigation and the icon */
            text-decoration: none;
        }

        .cart-icon:hover {
            color: var(--primary-accent); /* Change to your desired hover color */
        }
        /* ================================================= */
        /*  2. NEW CSS FOR PRODUCT DETAIL PAGE (MINIMAL)     */
        /* ================================================= */
        .breadcrumb { font-family: var(--font-body); font-size: 1rem; color: var(--text-muted-color); margin-bottom: 40px; }
        .breadcrumb a:hover { color: var(--primary-accent); }
        .breadcrumb span { color: var(--text-color); }

        .product-detail-layout { display: grid; grid-template-columns: 1fr; gap: 40px; }
        @media (min-width: 768px) {
            .product-detail-layout { grid-template-columns: 1fr 1fr; gap: 50px; }
        }

        .product-gallery .main-image { width: 100%; aspect-ratio: 1 / 1; object-fit: cover; border-radius: 12px; border: 1px solid var(--border-color); background-color: var(--card-bg); }
        .product-gallery .thumbnails { display: grid; grid-template-columns: repeat(4, 1fr); gap: 10px; margin-top: 15px; }
        .product-gallery .thumb { width: 100%; aspect-ratio: 1/1; object-fit: cover; border-radius: 8px; border: 2px solid var(--border-color); cursor: pointer; transition: border-color 0.3s; }
        .product-gallery .thumb:hover, .product-gallery .thumb.active { border-color: var(--primary-accent); }

        .product-info .product-category { font-family: var(--font-heading); text-transform: uppercase; letter-spacing: 1px; color: var(--primary-accent); font-size: 0.9rem; margin-bottom: 10px; }
        .product-info .product-title-detail { font-family: var(--font-heading); font-size: 2.8rem; line-height: 1.2; margin-bottom: 15px; }
        .product-info .product-price-detail { font-family: var(--font-heading); font-size: 2rem; color: var(--primary-accent); margin-bottom: 20px; }
        .product-info .short-description { color: var(--text-muted-color); font-size: 1.1rem; margin-bottom: 30px; }
        .product-info .add-to-cart-btn { width: 100%; text-align: center; padding: 18px; font-size: 1.1rem; }

        .product-meta { margin-top: 30px; border-top: 1px solid var(--border-color); padding-top: 20px; font-size: 0.9rem; color: var(--text-muted-color); }
        .product-meta .meta-item { margin-bottom: 8px; }
        .product-meta .meta-item span { color: var(--text-color); }
        .product-meta .social-share a { margin-right: 15px; font-size: 1.2rem; transition: color 0.3s; }
        .product-meta .social-share a:hover { color: var(--primary-accent); }

        .product-details-tabs { margin-top: 80px; }
        .tabs-nav { display: flex; border-bottom: 1px solid var(--border-color); gap: 30px; }
        .tabs-nav .tab-link { font-family: var(--font-heading); font-size: 1.1rem; padding-bottom: 15px; border-bottom: 3px solid transparent; cursor: pointer; color: var(--text-muted-color); transition: color 0.3s, border-color 0.3s; }
        .tabs-nav .tab-link.active { color: var(--primary-accent); border-bottom-color: var(--primary-accent); }

        .tabs-content .tab-pane { padding: 40px 0; display: none; line-height: 1.8; font-size: 1.05rem; }
        .tabs-content .tab-pane.active { display: block; }
        .tabs-content .tab-pane h3 { font-family: var(--font-heading); font-size: 1.5rem; margin-bottom: 15px; color: var(--primary-accent); }
        .tabs-content .tab-pane ul { list-style-position: inside; padding-left: 10px; }

        .review-card { border-bottom: 1px solid var(--border-color); padding: 25px 0; }
        .review-header { display: flex; justify-content: space-between; align-items: center; margin-bottom: 10px; }
        .reviewer-name { font-weight: 600; font-size: 1.1rem; }
        .review-date { font-size: 0.8rem; color: var(--text-muted-color); }
        .star-rating .fas.fa-star { color: #FFB800; }
        .review-body { color: var(--text-muted-color); }

        /* --- Re-using existing product card for related products --- */
        .related-products .product-grid { display: grid; grid-template-columns: repeat(2, 1fr); gap: 30px; }
        @media (min-width: 992px) { .related-products .product-grid { grid-template-columns: repeat(4, 1fr); } }
        .related-products .product-card { background: var(--card-bg); border-radius: 12px; border: 1px solid var(--border-color); overflow: hidden; transition: all 0.3s; }
        .related-products .product-card:hover { transform: translateY(-8px); box-shadow: 0 12px 30px rgba(0,0,0,0.25), 0 0 25px var(--glow-color); border-color: var(--primary-accent); }
        .related-products .product-image { width: 100%; aspect-ratio: 16 / 10; object-fit: cover; }
        .related-products .product-info { padding: 25px; }
        .related-products .product-title { font-family: var(--font-heading); font-size: 1.2rem; margin-bottom: 10px; }
        .related-products .product-price { font-family: var(--font-heading); font-weight: 700; background-image: var(--gradient-text); -webkit-background-clip: text; color: transparent; }

    </style>
</head>
<body>

    @include('website.layouts.header')

    <main>
        <section class="section">
            <div class="container">
                <!-- BREADCRUMB NAVIGATION -->
                <div class="breadcrumb">
                    <a href="/">Home</a> &gt; <a href="/store">Marketplace</a> &gt; <span>Futuristic UI Kit</span>
                </div>

                <!-- MAIN PRODUCT LAYOUT (2-COLUMN) -->
                <div class="product-detail-layout">
                    <!-- LEFT COLUMN: IMAGE GALLERY -->
                    <div class="product-gallery">
                        <img src="https://images.unsplash.com/photo-1555774698-0b77e0ab232e?q=80&w=871&auto=format&fit=crop" alt="Main product image of the Futuristic UI Kit" class="main-image" id="main-product-image">
                        <div class="thumbnails">
                            <img src="https://images.unsplash.com/photo-1555774698-0b77e0ab232e?q=80&w=200&auto=format&fit=crop" alt="Thumbnail 1" class="thumb active" data-src="https://images.unsplash.com/photo-1555774698-0b77e0ab232e?q=80&w=871&auto=format&fit=crop">
                            <img src="https://images.unsplash.com/photo-1551288049-bebda4e38f71?q=80&w=200&auto=format&fit=crop" alt="Thumbnail 2" class="thumb" data-src="https://images.unsplash.com/photo-1551288049-bebda4e38f71?q=80&w=870&auto=format&fit=crop">
                            <img src="https://images.unsplash.com/photo-1581291518857-4e27b48ff24e?q=80&w=200&auto=format&fit=crop" alt="Thumbnail 3" class="thumb" data-src="https://images.unsplash.com/photo-1581291518857-4e27b48ff24e?q=80&w=870&auto=format&fit=crop">
                            <img src="https://images.unsplash.com/photo-1526628953301-3e589a6a8b74?q=80&w=200&auto=format&fit=crop" alt="Thumbnail 4" class="thumb" data-src="https://images.unsplash.com/photo-1526628953301-3e589a6a8b74?q=80&w=774&auto=format&fit=crop">
                        </div>
                    </div>

                    <!-- RIGHT COLUMN: PRODUCT INFO & ACTIONS -->
                    <div class="product-info">
                        <p class="product-category">UI Kits & Templates</p>
                        <h1 class="product-title-detail">Futuristic UI Kit</h1>
                        <p class="product-price-detail">$79.00</p>
                        <p class="short-description">
                            A comprehensive UI kit with over 200 components, perfect for building modern web and mobile applications with a high-tech aesthetic.
                        </p>
                        <button class="cta-button add-to-cart-btn">
                            <i class="fas fa-shopping-cart" style="margin-right: 10px;"></i> Add to Cart
                        </button>

                        <div class="product-meta">
                            <p class="meta-item">Category: <span>UI Kits, Figma, Web Assets</span></p>
                            <p class="meta-item">Tags: <span>dark theme, futuristic, tech, dashboard, components</span></p>
                            <div class="meta-item social-share">
                                Share:
                                <a href="#" aria-label="Share on Facebook"><i class="fab fa-facebook-f"></i></a>
                                <a href="#" aria-label="Share on Twitter"><i class="fab fa-twitter"></i></a>
                                <a href="#" aria-label="Share on Pinterest"><i class="fab fa-pinterest"></i></a>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- DETAILS TABS SECTION -->
                <div class="product-details-tabs">
                    <div class="tabs-nav">
                        <div class="tab-link active" data-tab="description">Description</div>
                        <div class="tab-link" data-tab="features">Features</div>
                        <div class="tab-link" data-tab="reviews">Reviews (3)</div>
                    </div>
                    <div class="tabs-content">
                        <!-- Description Pane -->
                        <div class="tab-pane active" id="description">
                            <h3>Product Overview</h3>
                            <p>Accelerate your design workflow with the Futuristic UI Kit, the ultimate toolkit for creating stunning, high-tech interfaces. Designed with precision and a deep understanding of modern UI/UX trends, this kit provides everything you need to bring your next-gen projects to life. Whether you're designing a complex data dashboard, a sleek mobile app, or a cutting-edge website, our components are fully customizable and scalable to fit your needs.</p>
                            <p>Built for Figma and compatible with other major design tools, each component is meticulously organized and named for easy integration. Save hundreds of hours of design work and deliver professional, polished products faster than ever before.</p>
                        </div>
                        <!-- Features Pane -->
                        <div class="tab-pane" id="features">
                            <h3>What's Included?</h3>
                            <ul>
                                <li>200+ Fully Customizable Components</li>
                                <li>45+ Pre-designed Application Screens</li>
                                <li>Dark & Light Theme Variants</li>
                                <li>Scalable Vector Graphics & Icons</li>
                                <li>Organized Layer & Component Structure</li>
                                <li>Typography & Color Style Guide</li>
                                <li>Free Lifetime Updates</li>
                                <li>Compatible with Figma, Sketch, and Adobe XD</li>
                            </ul>
                        </div>
                        <!-- Reviews Pane -->
                        <div class="tab-pane" id="reviews">
                            <h3>Customer Feedback</h3>
                            <div class="review-list">
                                <div class="review-card">
                                    <div class="review-header">
                                        <span class="reviewer-name">Jane D. - Lead Designer</span>
                                        <span class="review-date">Oct 24, 2024</span>
                                    </div>
                                    <div class="star-rating">
                                        <i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i>
                                    </div>
                                    <p class="review-body">This kit is an absolute game-changer. Saved my team weeks of work. The components are beautiful and incredibly easy to customize. Highly recommended!</p>
                                </div>
                                <div class="review-card">
                                    <div class="review-header">
                                        <span class="reviewer-name">Mark S. - Startup Founder</span>
                                        <span class="review-date">Oct 22, 2024</span>
                                    </div>
                                    <div class="star-rating">
                                        <i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i>
                                    </div>
                                    <p class="review-body">Allowed us to build a professional-looking MVP on a tight budget. The dark theme is exactly the aesthetic we were going for. Fantastic value.</p>
                                </div>
                                <div class="review-card">
                                    <div class="review-header">
                                        <span class="reviewer-name">Carlos R. - Freelance Developer</span>
                                        <span class="review-date">Sep 15, 2024</span>
                                    </div>
                                    <div class="star-rating">
                                        <i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="far fa-star"></i>
                                    </div>
                                    <p class="review-body">Great set of components. My only wish is for more chart and graph variations, but the developer mentioned they are coming in a free update, so I'm happy!</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- RELATED PRODUCTS SECTION -->
        <section class="section related-products" style="background-color: var(--surface-color);">
            <div class="container">
                <h2 class="section-title"><span>You Might</span> Also Like</h2>
                <div class="product-grid" id="related-products-grid">
                    <!-- Related products will be dynamically loaded here -->
                </div>
            </div>
        </section>
    </main>

   @extends('website.layouts.footer')

    <!-- JAVASCRIPT -->
    <script>
    document.addEventListener('DOMContentLoaded', function() {
        // --- Tab Functionality ---
        const tabLinks = document.querySelectorAll('.tabs-nav .tab-link');
        const tabPanes = document.querySelectorAll('.tabs-content .tab-pane');

        tabLinks.forEach(link => {
            link.addEventListener('click', function() {
                const tabId = this.getAttribute('data-tab');

                // Update active state for links
                tabLinks.forEach(item => item.classList.remove('active'));
                this.classList.add('active');

                // Update active state for panes
                tabPanes.forEach(pane => {
                    if (pane.id === tabId) {
                        pane.classList.add('active');
                    } else {
                        pane.classList.remove('active');
                    }
                });
            });
        });

        // --- Gallery Thumbnail Functionality ---
        const mainImage = document.getElementById('main-product-image');
        const thumbnails = document.querySelectorAll('.product-gallery .thumb');

        thumbnails.forEach(thumb => {
            thumb.addEventListener('click', function() {
                const newSrc = this.getAttribute('data-src');
                mainImage.src = newSrc;

                thumbnails.forEach(item => item.classList.remove('active'));
                this.classList.add('active');
            });
        });

        // --- Mock Data for Related Products ---
        const relatedProducts = [
            { id: 5, name: "Data Visualizer", price: 99.00, image: "https://images.unsplash.com/photo-1551288049-bebda4e38f71?q=80&w=870&auto=format&fit=crop"},
            { id: 7, name: "Project Management Dashboard", price: 65.00, image: "https://images.unsplash.com/photo-1587620962725-abab7fe55159?q=80&w=1031&auto=format&fit=crop"},
            { id: 6, name: "E-Commerce Icon Set", price: 25.00, image: "https://images.unsplash.com/photo-1581291518857-4e27b48ff24e?q=80&w=870&auto=format&fit=crop"},
            { id: 8, name: "AI Chatbot Script", price: 199.00, image: "https://images.unsplash.com/photo-1526628953301-3e589a6a8b74?q=80&w=774&auto=format&fit=crop"},
        ];

        const relatedGrid = document.getElementById('related-products-grid');
        if(relatedGrid) {
             relatedGrid.innerHTML = relatedProducts.map(p => `
                <div class="product-card">
                    <img src="${p.image}" alt="${p.name}" class="product-image">
                    <div class="product-info">
                        <h3 class="product-title">${p.name}</h3>
                        <p class="product-price">$${p.price.toFixed(2)}</p>
                    </div>
                </div>
            `).join('');
        }
    });
    </script>

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
