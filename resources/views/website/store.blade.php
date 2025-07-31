<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Digital Store - Adzquare</title>
    <meta name="description" content="Welcome to the Adzquare Digital Store. Browse our collection of premium digital assets, tools, and solutions.">
    <meta name="keywords" content="digital products, digital store, templates, software, plugins, Adzquare">
    <meta name="author" content="Adzquare">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&family=Orbitron:wght@400;500;700&display=swap" rel="stylesheet">

    <style>
        /* CSS Variables for Theming */
        :root {
            --bg-color: #0D0D0D;
            --surface-color: #1A1A1A;
            --card-bg: #1F1F1F;
            --primary-accent: #FF7A00;
            --secondary-accent: #E66A00;
            --text-color: #EAEAEA;
            --text-muted-color: #A0A0A0;
            --border-color: #383838;
            --glow-color: rgba(255, 122, 0, 0.3);
            --gradient-primary: linear-gradient(135deg, var(--primary-accent), var(--secondary-accent));
            --gradient-text: linear-gradient(90deg, var(--primary-accent), #FFB800);
            --font-heading: 'Orbitron', sans-serif;
            --font-body: 'Poppins', sans-serif;
        }

        /* Basic Reset & Defaults */
        * { margin: 0; padding: 0; box-sizing: border-box; }
        html { scroll-behavior: smooth; font-size: 16px; }
        body {
            font-family: var(--font-body);
            line-height: 1.7;
            color: var(--text-color);
            background-color: var(--bg-color);
            overflow-x: hidden;
            position: relative;
        }

        .container { width: 90%; max-width: 1400px; margin: auto; padding: 0 20px; }

        /* Header & Navigation */
        header {
            background: rgba(13, 13, 13, 0.6); backdrop-filter: blur(15px);
            padding: 1rem 0; border-bottom: 1px solid var(--border-color);
            position: sticky; top: 0; z-index: 1000;
        }
        header .container { display: flex; justify-content: space-between; align-items: center; }
        .logo {
            font-family: var(--font-heading); font-size: 1.9rem; font-weight: 700;
            text-decoration: none; letter-spacing: 1px;
            background-image: var(--gradient-text);
            -webkit-background-clip: text; background-clip: text; color: transparent;
        }
        .header-right-controls { display: flex; align-items: center; gap: 25px; }
        .menu-toggle { display: flex; flex-direction: column; justify-content: space-around; width: 30px; height: 25px; background: transparent; border: none; cursor: pointer; padding: 0; z-index: 2001; }
        .menu-toggle .bar { width: 100%; height: 3px; background-color: var(--text-color); border-radius: 10px; transition: all 0.3s ease-in-out; }
        .menu-toggle.open .bar:nth-child(1) { transform: rotate(45deg) translate(6px, 6px); }
        .menu-toggle.open .bar:nth-child(2) { opacity: 0; }
        .menu-toggle.open .bar:nth-child(3) { transform: rotate(-45deg) translate(7px, -7px); }

        /* General Section Styling */
        .section { padding: 80px 0; position: relative; overflow: hidden; }
        .section-title {
            font-family: var(--font-heading); font-size: 2.6rem; font-weight: 700;
            text-align: center; margin-bottom: 25px; position: relative;
            color: var(--text-color);
        }
        .section-title span { background-image: var(--gradient-text); -webkit-background-clip: text; background-clip: text; color: transparent; }
        .section-title::after { content: ''; display: block; width: 80px; height: 4px; background-image: var(--gradient-primary); margin: 15px auto 0; border-radius: 3px; box-shadow: 0 0 15px var(--glow-color); }
        .section-subtitle { text-align: center; font-size: 1.15rem; color: var(--text-muted-color); max-width: 800px; margin: 0 auto 50px auto; line-height: 1.8; }

        /* CTA Button */
        .cta-button {
            display: inline-block; background-image: var(--gradient-primary);
            color: #fff; padding: 15px 35px; text-decoration: none;
            border-radius: 50px; font-weight: 600; font-family: var(--font-heading); font-size: 1rem;
            transition: transform 0.3s ease, box-shadow 0.3s ease; border: none; box-shadow: 0 6px 20px var(--glow-color);
        }
         .cta-button:hover { transform: translateY(-3px) scale(1.03); box-shadow: 0 10px 30px rgba(255, 122, 0, 0.5); }

        /* Store Header */
        .store-header { display: flex; flex-direction: column; align-items: center; gap: 30px; margin-bottom: 50px; }
        .search-bar { width: 100%; max-width: 600px; display: flex; }
        .search-bar input { flex-grow: 1; border: 1px solid var(--border-color); background-color: var(--surface-color); color: var(--text-color); padding: 14px 20px; border-radius: 50px 0 0 50px; font-family: var(--font-body); font-size: 1rem; }
        .search-bar input:focus { outline: none; border-color: var(--primary-accent); box-shadow: 0 0 0 3px var(--glow-color); }
        .search-bar button { border: 1px solid var(--primary-accent); background-image: var(--gradient-primary); color: white; padding: 0 25px; border-radius: 0 50px 50px 0; cursor: pointer; font-family: var(--font-heading); font-size: 1rem; transition: box-shadow 0.3s ease; }
        .search-bar button:hover { box-shadow: 0 0 15px var(--glow-color); }

        /* Cart Icon */
        .cart-icon-wrapper { position: relative; cursor: pointer; font-size: 2rem; color: var(--text-color); }
        .cart-icon-wrapper .cart-count { position: absolute; top: -5px; right: -12px; background-color: var(--primary-accent); color: white; width: 24px; height: 24px; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-size: 0.8rem; font-weight: bold; font-family: var(--font-body); border: 2px solid var(--bg-color); }

        /* Product Grid Responsive Layout */
        .product-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr); /* Mobile view: 2 columns */
            gap: 30px;
            margin-bottom: 50px;
        }
        @media (min-width: 992px) {
            .product-grid {
                grid-template-columns: repeat(4, 1fr); /* Web view: 4 columns */
            }
        }

        .product-card { background: var(--card-bg); border-radius: 12px; border: 1px solid var(--border-color); overflow: hidden; transition: transform 0.3s ease, box-shadow 0.3s ease, border-color 0.3s ease; display: flex; flex-direction: column; }
        .product-card:hover { transform: translateY(-8px) scale(1.02); box-shadow: 0 12px 30px rgba(0,0,0,0.25), 0 0 25px var(--glow-color); border-color: var(--primary-accent); }
        .product-image { width: 100%; aspect-ratio: 16 / 10; object-fit: cover; display: block; }
        .product-info { padding: 25px; display: flex; flex-direction: column; flex-grow: 1; }
        .product-title { font-family: var(--font-heading); font-size: 1.2rem; color: var(--text-color); margin-bottom: 10px; min-height: 40px; }
        .product-title:hover { color: var(--primary-accent); }
        .product-description { font-size: 0.9rem; color: var(--text-muted-color); margin-bottom: 20px; flex-grow: 1; }
        .product-footer { display: flex; justify-content: space-between; align-items: center; margin-top: auto; flex-wrap: wrap; gap: 10px; }
        .product-price { font-family: var(--font-heading); font-size: 1.1rem; font-weight: 700; background-image: var(--gradient-text); -webkit-background-clip: text; background-clip: text; color: transparent; }
        .product-actions { display: flex; align-items: center; flex-wrap: wrap; gap: 15px; }
        .view-details-btn { background: none; border: none; color: var(--text-muted-color); cursor: pointer; font-family: var(--font-body); font-size: 0.8rem; text-decoration: underline; transition: color 0.3s ease; }
        .view-details-btn:hover { color: var(--primary-accent); }
        .add-to-cart-btn { background: transparent; border: 1px solid var(--primary-accent); color: var(--primary-accent); padding: 8px 15px; border-radius: 50px; cursor: pointer; font-weight: 600; font-family: var(--font-body); font-size: 0.9rem; transition: background-color 0.3s ease, color 0.3s ease, transform 0.3s ease; }
        .add-to-cart-btn:hover { background-color: var(--primary-accent); box-shadow: 0 0 10px var(--glow-color); color: white; transform: scale(1.05); }
        .view-more-container { text-align: center; }

        /* Overlay */
        .overlay { position: fixed; top: 0; left: 0; width: 100%; height: 100%; background-color: rgba(0,0,0,0.7); z-index: 1999; opacity: 0; visibility: hidden; transition: opacity 0.5s ease, visibility 0.5s ease; }
        .overlay.active { opacity: 1; visibility: visible; }

        /* Side Menu (Navigation from original code) */
        .side-menu {
            position: fixed; top: 0; left: -100%; width: 100%; max-width: 320px; height: 100vh;
            background: rgba(19, 19, 19, 0.98); backdrop-filter: blur(10px);
            z-index: 2000; border-right: 1px solid var(--border-color);
            transition: left 0.5s cubic-bezier(0.77, 0, 0.175, 1);
            display: flex; flex-direction: column; box-shadow: 10px 0 30px rgba(0,0,0,0.5);
            padding-top: 100px;
        }
        .side-menu.open { left: 0; }
        .side-menu .nav-links { list-style: none; width: 100%; }
        .side-menu .nav-links li { text-align: center; margin: 10px 0; }
        .side-menu .nav-links a { text-decoration: none; color: var(--text-color); font-family: var(--font-heading); font-size: 1rem; padding: 10px 20px; display: block; transition: color 0.3s ease; position: relative; }
        .side-menu .nav-links a:hover { color: var(--primary-accent); }
        .side-menu .nav-links a::after {
            content: ''; position: absolute; width: 0; height: 2px;
            bottom: 5px; left: 50%; transform: translateX(-50%);
            background-image: var(--gradient-primary); transition: width 0.4s ease; border-radius: 2px;
        }
        .side-menu .nav-links a:hover::after { width: 50%; }

        /* Side Cart Styling */
        .side-cart {
            position: fixed; top: 0; right: -100%; width: 100%; max-width: 400px; height: 100vh;
            background-color: var(--bg-color); z-index: 2000; border-left: 1px solid var(--border-color);
            transition: right 0.5s cubic-bezier(0.77, 0, 0.175, 1);
            display: flex; flex-direction: column; box-shadow: -10px 0 30px rgba(0,0,0,0.5);
        }
        .side-cart.open { right: 0; }
        .cart-header { padding: 20px; border-bottom: 1px solid var(--border-color); display: flex; justify-content: space-between; align-items: center; }
        .cart-header h3 { font-family: var(--font-heading); color: var(--primary-accent); font-size: 1.5rem; }
        .close-sidebar-btn { background: none; border: none; color: var(--text-muted-color); font-size: 2rem; cursor: pointer; line-height: 1; transition: color 0.3s ease, transform 0.3s ease; }
        .close-sidebar-btn:hover { color: var(--primary-accent); transform: rotate(90deg); }
        .cart-body { flex-grow: 1; overflow-y: auto; padding: 20px; }
        .cart-empty-message { text-align: center; padding-top: 50px; color: var(--text-muted-color); }
        .cart-footer { padding: 20px; border-top: 1px solid var(--border-color); background-color: var(--surface-color); }
        .cart-subtotal { display: flex; justify-content: space-between; margin-bottom: 20px; font-size: 1.2rem; }
        .cart-subtotal .label { color: var(--text-muted-color); }
        .cart-subtotal .amount { font-weight: 700; font-family: var(--font-heading); color: var(--primary-accent); }
        .checkout-btn { width: 100%; padding: 16px; }

        /* Product Detail Modal */
        .product-modal {
            position: fixed; top: 50%; left: 50%; transform: translate(-50%, -50%) scale(0.95);
            width: 90%; max-width: 800px; background: var(--card-bg); border: 1px solid var(--border-color);
            border-radius: 12px; z-index: 3000; opacity: 0; visibility: hidden;
            transition: opacity 0.4s ease, visibility 0.4s ease, transform 0.4s ease;
        }
        .product-modal.active { opacity: 1; visibility: visible; transform: translate(-50%, -50%) scale(1); }
        .modal-content { display: flex; flex-direction: column; max-height: 90vh; }
        @media (min-width: 768px) { .modal-content { flex-direction: row; } }
        .modal-image { width: 100%; object-fit: cover; border-radius: 12px 12px 0 0; }
        @media (min-width: 768px) { .modal-image { width: 45%; border-radius: 12px 0 0 12px; } }
        .modal-info { padding: 30px; overflow-y: auto; }
        .modal-title { font-family: var(--font-heading); font-size: 2rem; color: var(--primary-accent); margin-bottom: 15px; }
        .modal-price { font-family: var(--font-heading); font-size: 1.5rem; color: var(--text-color); margin-bottom: 20px; }
        .modal-description { font-size: 1rem; line-height: 1.8; color: var(--text-muted-color); margin-bottom: 30px; }
        .close-modal-btn { position: absolute; top: 15px; right: 20px; background: none; border: none; color: var(--text-muted-color); font-size: 2.5rem; cursor: pointer; line-height: 1; transition: color 0.3s ease, transform 0.3s ease; }
        .close-modal-btn:hover { color: var(--primary-accent); transform: rotate(90deg); }

        /* Footer */
        footer {
            background: linear-gradient(to top, #0A0A0A, var(--bg-color) 90%);
            color: var(--text-muted-color); text-align: center; padding: 60px 0 30px;
            margin-top: 50px; border-top: 1px solid var(--border-color);
            position: relative;
        }
        .footer-content {
            display: grid; grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
            gap: 30px; text-align: left; margin-bottom: 40px; position: relative; z-index: 1;
        }
        .footer-column h4 {
            font-family: var(--font-heading); font-size: 1.3rem; color: var(--primary-accent);
            margin-bottom: 15px;
        }
        .footer-column p, .footer-column ul li { font-size: 0.95rem; margin-bottom: 10px; }
        .footer-column ul { list-style: none; }
        .footer-column ul li a { color: var(--text-muted-color); text-decoration: none; transition: color 0.3s ease; }
        .footer-column ul li a:hover { color: var(--primary-accent); }
        .footer-social-icons a {
            color: var(--text-muted-color); margin-right: 15px; font-size: 1.6rem;
            transition: color 0.3s ease, transform 0.3s ease; display: inline-block;
        }
        .footer-social-icons a:hover { color: var(--primary-accent); transform: scale(1.1) translateY(-2px); }
        .footer-bottom-text {
            border-top: 1px solid var(--border-color); padding-top: 30px;
            font-size: 0.9rem; text-align: center; position: relative; z-index: 1;
        }

        /* --- Mobile Responsiveness --- */
        @media (max-width: 768px) {
            .container {
                width: 100%;
                padding: 0 15px; /* *** REDUCED side padding for mobile *** */
            }
            html {
                font-size: 15px;
            }
            .section {
                padding: 60px 0;
            }
            .section-title {
                font-size: 2.1rem;
            }
            .product-grid {
                gap: 15px;
            }
            .product-info {
                padding: 20px;
            }
            .product-title {
                font-size: 1.1rem;
                min-height: auto;
            }
            .product-description {
                 font-size: 0.85rem;
            }
            .product-price {
                font-size: 1.05rem;
            }
            .add-to-cart-btn {
                padding: 6px 14px;
                font-size: 0.8rem;
            }
            .product-actions {
                gap: 10px;
            }
            .modal-info {
                padding: 20px;
            }
            .modal-title {
                font-size: 1.5rem;
            }
            .modal-price {
                font-size: 1.2rem;
            }
        }

    </style>
</head>
<body>
    <div class="overlay" id="main-overlay"></div>

    <header>
        <div class="container">
            <a href="#hero" class="logo">
                <img src="{{ asset('web/images/logo-main.png') }}" alt="Adzquare Logo" style="height: 26px;">
            </a>
            <div class="header-right-controls">
                <div class="cart-icon-wrapper" id="cart-icon">
                    <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="currentColor" viewBox="0 0 16 16">
                      <path d="M0 1.5A.5.5 0 0 1 .5 1H2a.5.5 0 0 1 .485.379L2.89 3H14.5a.5.5 0 0 1 .49.598l-1 5a.5.5 0 0 1-.49.402H3.31l-.485 2.42A.5.5 0 0 0 3 11.5h8.5a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.491-.408L2.01 3.607 1.61 2H.5a.5.5 0 0 1-.5-.5zM3.102 4l.84 4.473L12.717 9l.7-3.5H3.102zM5 12a2 2 0 1 0 0 4 2 2 0 0 0 0-4zm7 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4zm-7 1a1 1 0 1 1 0 2 1 1 0 0 1 0-2zm7 0a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>
                    </svg>
                    <span class="cart-count">0</span>
                </div>
                <button class="menu-toggle" id="menu-toggle-button" aria-label="Toggle navigation">
                    <span class="bar"></span><span class="bar"></span><span class="bar"></span>
                </button>
            </div>
        </div>
    </header>

    <!-- Side Menu (Navigation) -->
    <aside class="side-menu" id="side-menu">
        <ul class="nav-links">
             <li><a href="#">Home</a></li>
             <li><a href="#">360° Solutions</a></li>
             <li><a href="#">Services</a></li>
             <li><a href="#">Partners</a></li>
             <li><a href="#">Global Reach</a></li>
             <li><a href="#">Testimonials</a></li>
             <li><a href="#">FAQs</a></li>
             <li><a href="#">Contact</a></li>
        </ul>
    </aside>

    <main>
        <section id="digital-store" class="section">
            <div class="container">
                <h2 class="section-title">Our <span>Digital Marketplace</span></h2>
                <p class="section-subtitle">
                   Discover powerful tools, stunning templates, and innovative solutions crafted by our experts to accelerate your digital growth.
                </p>
                <div class="store-header">
                     <div class="search-bar">
                        <input type="text" placeholder="Search for plugins, themes, assets...">
                        <button>Search</button>
                    </div>
                </div>
                <div class="product-grid" id="product-grid">
                    <!-- Product Items will be dynamically generated here -->
                </div>
                <div class="view-more-container">
                    <a href="#" class="cta-button">Load More</a>
                </div>
            </div>
        </section>
    </main>

    <footer>
        <div class="container">
            <div class="footer-content">
                <div class="footer-column animate-on-scroll fade-in-right" style="animation-delay:0.1s;">
                    <h4>About Adzquare Global</h4>
                    <p>Adzquare is a premier international IT and 360° Digital Marketing powerhouse. We are dedicated to architecting innovative, data-driven solutions that propel businesses across India, the USA, UK, Australia, and beyond to new heights of success and leadership in the dynamic digital age.</p>
                </div>
                <div class="footer-column animate-on-scroll fade-in-up" style="animation-delay:0.2s;">
                    <h4>Explore Adzquare</h4>
                    <ul>
                        <li><a href="#hero" title="Adzquare Home">Home</a></li>
                        <li><a href="#specific-services" title="Our IT & Digital Marketing Services">Our Services</a></li>
                        <li><a href="#partners" title="Adzquare Technology Partners">Partners</a></li>
                        <li><a href="#testimonials" title="Client Testimonials">Client Success</a></li>
                        <li><a href="#faqs" title="Frequently Asked Questions">FAQs</a></li>
                        <li><a href="#contact" title="Contact Adzquare">Contact Us</a></li>
                        <li><a href="#" title="Adzquare Privacy Policy">Privacy Policy</a></li> <!-- Add link -->
                        <li><a href="#" title="Adzquare Terms of Service">Terms of Service</a></li> <!-- Add link -->
                        <li><a href="/team-member/login" title="Adzquare's Global Reach">Team Login</a> | <a href="/admin/login" title="Adzquare's Global Reach">Admin Login</a></li>
                    </ul>
                </div>
                <div class="footer-column animate-on-scroll fade-in-left" style="animation-delay:0.3s;">
                    <h4>Connect With Our Global Team</h4>
                    <p><strong>Global Headquarters (Example):</strong><br>123 Innovation Drive, Tech City, Silicon Valley, Global</p>
                    <p><strong>International Phone:</strong> <a href="tel:+10000000000" title="Call Adzquare International">+1 (000) 000-0000</a></p>
                    <p><strong>General Inquiries:</strong> <a href="mailto:global.inquiries@adzquare.com" title="Email Adzquare Global Inquiries">global.inquiries@adzquare.com</a></p>
                    <p><em>(Regional offices in India, US, UK, Australia - Contact us for local details)</em></p>
                    <div class="footer-social-icons">
                        <a href="#" aria-label="Adzquare on Facebook" title="Adzquare on Facebook">FB</a> <!-- Replace with SVG icon -->
                        <a href="#" aria-label="Adzquare on Twitter" title="Adzquare on Twitter">TW</a> <!-- Replace with SVG icon -->
                        <a href="#" aria-label="Adzquare on LinkedIn" title="Adzquare on LinkedIn">IN</a> <!-- Replace with SVG icon -->
                        <a href="#" aria-label="Adzquare on Instagram" title="Adzquare on Instagram">IG</a> <!-- Replace with SVG icon -->
                        <a href="#" aria-label="Adzquare on YouTube" title="Adzquare on YouTube">YT</a> <!-- Replace with SVG icon -->
                    </div>
                </div>
            </div>
            <div class="footer-bottom-text animate-on-scroll fade-in" style="animation-delay:0.4s;">
                <p>&copy; <span id="currentYear"></span> Adzquare. All Rights Reserved. | Architecting Your Global Digital Future.</p>
            </div>
        </div>
    </footer>

    <!-- Side Cart HTML -->
    <aside class="side-cart" id="side-cart">
        <div class="cart-header">
            <h3>Your Cart</h3>
            <button class="close-sidebar-btn" id="close-cart">&times;</button>
        </div>
        <div class="cart-body" id="cart-items-container">
            <p class="cart-empty-message">Your cart is currently empty.</p>
        </div>
        <div class="cart-footer">
            <div class="cart-subtotal">
                <span class="label">Subtotal</span>
                <span class="amount">$0.00</span>
            </div>
            <a href="#" class="cta-button checkout-btn">Proceed to Checkout</a>
        </div>
    </aside>

    <!-- Product Modal HTML -->
    <div class="product-modal" id="product-modal">
        <button class="close-modal-btn" id="close-modal">&times;</button>
        <div class="modal-content" id="modal-content-host"></div>
    </div>


    <script>
    document.addEventListener('DOMContentLoaded', function() {
        // --- Copyright Year ---
        const currentYearSpan = document.getElementById('currentYear');
        if (currentYearSpan) {
            currentYearSpan.textContent = new Date().getFullYear();
        }

        // --- Sample Product Data (16 products for 4x4 grid) ---
        const products = [
            { id: 1, name: "Futuristic UI Kit", price: 79.00, image: "https://via.placeholder.com/400x250/FF7A00/0D0D0D?text=UI+Kit", description: "A comprehensive UI kit with over 200 futuristic components, perfect for building modern web and mobile applications. Includes dark and light themes, fully customizable and scalable vector graphics." },
            { id: 2, name: "SEO Optimizer Pro", price: 129.00, image: "https://via.placeholder.com/400x250/E66A00/0D0D0D?text=SEO+Plugin", description: "The ultimate WordPress plugin to boost your search engine rankings. Features automated on-page SEO, schema markup generation, sitemap tools, and performance analytics." },
            { id: 3, name: "Orbitron Theme", price: 59.00, image: "https://via.placeholder.com/400x250/FF7A00/0D0D0D?text=WP+Theme", description: "A sleek and modern WordPress theme designed for tech startups and digital agencies. Fully responsive, lightweight, and built with the block editor in mind for easy customization." },
            { id: 4, name: "Social Media Template Pack", price: 49.00, image: "https://via.placeholder.com/400x250/E66A00/0D0D0D?text=Templates", description: "A pack of 50+ professionally designed and fully editable social media templates for Instagram, Facebook, and Twitter. Compatible with Photoshop, Figma, and Canva." },
            { id: 5, name: "Data Visualizer", price: 99.00, image: "https://via.placeholder.com/400x250/FF7A00/0D0D0D?text=Data+Tool", description: "A standalone JavaScript library to create stunning and interactive data visualizations. Includes charts, graphs, and maps with a simple and powerful API." },
            { id: 6, name: "E-Commerce Icon Set", price: 25.00, image: "https://via.placeholder.com/400x250/E66A00/0D0D0D?text=Icons", description: "Over 200 high-quality, pixel-perfect vector icons for e-commerce websites and apps. Provided in SVG, and icon font formats for easy integration." },
            { id: 7, name: "Project Management Dashboard", price: 65.00, image: "https://via.placeholder.com/400x250/FF7A00/0D0D0D?text=Dashboard", description: "A responsive HTML/CSS/JS dashboard template for managing projects effectively. Includes widgets for tasks, timelines, team collaboration, and reporting." },
            { id: 8, name: "AI Chatbot Script", price: 199.00, image: "https://via.placeholder.com/400x250/E66A00/0D0D0D?text=AI+Script", description: "An advanced, self-hosted chatbot script with natural language processing capabilities. Easy to integrate into any website for customer support and lead generation." },
            { id: 9, name: "Cyber Security Guide", price: 39.00, image: "https://via.placeholder.com/400x250/FF7A00/0D0D0D?text=eBook", description: "An in-depth 150-page eBook covering the fundamentals of modern cybersecurity practices for small and medium businesses. Written by industry experts." },
            { id: 10, name: "Animated Background Pack", price: 30.00, image: "https://via.placeholder.com/400x250/E66A00/0D0D0D?text=Animations", description: "A collection of 20 seamless looping animated backgrounds in MP4 and WebM formats. Perfect for adding a dynamic and professional touch to your website." },
            { id: 11, name: "Cloud Backup Solution", price: 150.00, image: "https://via.placeholder.com/400x250/FF7A00/0D0D0D?text=Cloud+Backup", description: "A secure and reliable cloud backup solution for your business data. Automated backups, easy restoration, and end-to-end encryption." },
            { id: 12, name: "Mobile App Template", price: 89.00, image: "https://via.placeholder.com/400x250/E66A00/0D0D0D?text=App+Template", description: "A React Native template for building a sleek and modern mobile app. Includes dozens of pre-built screens and components." },
            { id: 13, name: "Marketing Analytics Tool", price: 250.00, image: "https://via.placeholder.com/400x250/FF7A00/0D0D0D?text=Analytics", description: "A comprehensive marketing analytics platform to track your campaign performance, user behavior, and ROI across all channels." },
            { id: 14, name: "VR Experience Kit", price: 300.00, image: "https://via.placeholder.com/400x250/E66A00/0D0D0D?text=VR+Kit", description: "An starter kit for Unity developers to create immersive VR experiences. Includes scripts, 3D models, and environments." },
            { id: 15, name: "Lead Generation Form Pack", price: 19.00, image: "https://via.placeholder.com/400x250/FF7A00/0D0D0D?text=Forms", description: "A pack of 10 high-converting, professionally designed lead generation forms in HTML and CSS. Easy to customize and integrate." },
            { id: 16, name: "Podcast Starter Kit", price: 45.00, image: "https://via.placeholder.com/400x250/E66A00/0D0D0D?text=Podcast+Kit", description: "Everything you need to start a professional podcast. Includes intro/outro music, sound effects, and cover art templates." }
        ];

        const productGrid = document.getElementById('product-grid');
        products.forEach(product => {
            const productCardHTML = `
                <div class="product-card">
                    <img src="${product.image}" alt="${product.name}" class="product-image">
                    <div class="product-info">
                        <h3 class="product-title">${product.name}</h3>
                        <p class="product-description">${product.description.substring(0, 80)}...</p>
                        <div class="product-footer">
                            <span class="product-price">$${product.price.toFixed(2)}</span>
                            <div class="product-actions">
                                <button class="view-details-btn" data-id="${product.id}">Details</button>
                                <button class="add-to-cart-btn" data-id="${product.id}">Add to Cart</button>
                            </div>
                        </div>
                    </div>
                </div>`;
            productGrid.innerHTML += productCardHTML;
        });

        const mainOverlay = document.getElementById('main-overlay');
        const body = document.body;

        const checkAndToggleBodyScroll = () => {
            if (sideMenu.classList.contains('open') || sideCart.classList.contains('open') || productModal.classList.contains('active')) {
                body.style.overflow = 'hidden';
            } else {
                body.style.overflow = '';
            }
        };

        // --- Side Menu (Navigation) Logic ---
        const menuToggleButton = document.getElementById('menu-toggle-button');
        const sideMenu = document.getElementById('side-menu');
        const navLinks = document.querySelectorAll('.side-menu .nav-links a');

        const openMenu = () => {
            sideMenu.classList.add('open');
            menuToggleButton.classList.add('open');
            mainOverlay.classList.add('active');
            checkAndToggleBodyScroll();
        };
        const closeMenu = () => {
            sideMenu.classList.remove('open');
            menuToggleButton.classList.remove('open');
            if(!sideCart.classList.contains('open') && !productModal.classList.contains('active')) {
                mainOverlay.classList.remove('active');
            }
            checkAndToggleBodyScroll();
        };

        menuToggleButton.addEventListener('click', () => {
            sideMenu.classList.contains('open') ? closeMenu() : openMenu();
        });
        navLinks.forEach(link => link.addEventListener('click', closeMenu));

        // --- Cart Logic ---
        const cartIcon = document.getElementById('cart-icon');
        const sideCart = document.getElementById('side-cart');
        const closeCartBtn = document.getElementById('close-cart');
        const cartCount = document.querySelector('.cart-count');
        let cart = [];

        const openCart = () => {
            sideCart.classList.add('open');
            mainOverlay.classList.add('active');
            checkAndToggleBodyScroll();
        };
        const closeCart = () => {
            sideCart.classList.remove('open');
            if(!sideMenu.classList.contains('open') && !productModal.classList.contains('active')) {
                 mainOverlay.classList.remove('active');
            }
            checkAndToggleBodyScroll();
        };

        cartIcon.addEventListener('click', openCart);
        closeCartBtn.addEventListener('click', closeCart);

        const updateCartUI = () => {
            cartCount.textContent = cart.length;
            const cartItemsContainer = document.getElementById('cart-items-container');
            if (cart.length === 0) {
                 cartItemsContainer.innerHTML = '<p class="cart-empty-message">Your cart is currently empty.</p>';
            } else {
                cartItemsContainer.innerHTML = '';
                cart.forEach(item => {
                    cartItemsContainer.innerHTML += `<p style="display:flex; justify-content:space-between; align-items:center; padding-bottom: 5px; border-bottom: 1px solid var(--border-color); margin-bottom: 5px;"><span>${item.name}</span> <span>$${item.price.toFixed(2)}</span></p>`;
                });
            }
            const subtotal = cart.reduce((total, item) => total + item.price, 0);
            document.querySelector('.cart-subtotal .amount').textContent = `$${subtotal.toFixed(2)}`;
        };
        const addToCart = (productId) => {
            const productToAdd = products.find(p => p.id === productId);
            if (productToAdd) {
                cart.push(productToAdd);
                updateCartUI();
            }
        };

        // --- Product Modal Logic ---
        const productModal = document.getElementById('product-modal');
        const closeModalBtn = document.getElementById('close-modal');
        const modalContentHost = document.getElementById('modal-content-host');

        const openModal = (productId) => {
            const product = products.find(p => p.id === productId);
            if (!product) return;

            const modalHTML = `
                <img src="${product.image.replace('400x250', '500x500')}" alt="${product.name}" class="modal-image">
                <div class="modal-info">
                    <h2 class="modal-title">${product.name}</h2>
                    <p class="modal-price">$${product.price.toFixed(2)}</p>
                    <p class="modal-description">${product.description}</p>
                    <button class="cta-button add-to-cart-btn" data-id="${product.id}">Add to Cart</button>
                </div>`;
            modalContentHost.innerHTML = modalHTML;
            productModal.classList.add('active');
            mainOverlay.classList.add('active');
            checkAndToggleBodyScroll();
        };
        const closeModal = () => {
            productModal.classList.remove('active');
            if(!sideMenu.classList.contains('open') && !sideCart.classList.contains('open')) {
                 mainOverlay.classList.remove('active');
            }
            checkAndToggleBodyScroll();
        };

        closeModalBtn.addEventListener('click', closeModal);

        // --- Global Event Listeners ---
        mainOverlay.addEventListener('click', () => {
            if (sideMenu.classList.contains('open')) closeMenu();
            if (sideCart.classList.contains('open')) closeCart();
            if (productModal.classList.contains('active')) closeModal();
        });

        document.body.addEventListener('click', function(e) {
            if (e.target.classList.contains('add-to-cart-btn')) {
                const productId = parseInt(e.target.getAttribute('data-id'));
                addToCart(productId);
                if (!sideCart.classList.contains('open')) {
                    openCart();
                }
            }
            if (e.target.classList.contains('view-details-btn')) {
                const productId = parseInt(e.target.getAttribute('data-id'));
                openModal(productId);
            }
        });
    });
    </script>
</body>
</html>
