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

    <!-- FAVICONS ICON -->
    <link rel="shortcut icon" type="image/png" href="{{ asset('admin_new/images/favicon.png') }}">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/toastify-js/src/toastify.min.css">
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
            --gradient-bg-subtle: linear-gradient(180deg, rgba(26, 26, 26, 0.03) 0%, rgba(13,13,13,0.1) 100%);
            --gradient-card-border: linear-gradient(to right, var(--primary-accent), var(--bg-color));
            --gradient-text: linear-gradient(90deg, var(--primary-accent), #FFB800);

            --font-heading: 'Orbitron', sans-serif;
            --font-body: 'Poppins', sans-serif;
            --animation-duration: 0.7s;
        }

        /* Basic Reset & Defaults */
        * { margin: 0; padding: 0; box-sizing: border-box; }
        html { scroll-behavior: smooth; font-size: 10px; }
        body {
            font-family: var(--font-body);
            line-height: 1.7;
            color: var(--text-color);
            background-color: var(--bg-color);
            overflow-x: hidden;
            position: relative;
        }

         .add-to-cart-btn { background: transparent; border: 1px solid var(--primary-accent); color: var(--primary-accent); padding: 8px 15px; border-radius: 50px; cursor: pointer; font-weight: 600; font-family: var(--font-body); font-size: 0.9rem; transition: background-color 0.3s ease, color 0.3s ease, transform 0.3s ease; }
        .add-to-cart-btn:hover { background-color: var(--primary-accent); box-shadow: 0 0 10px var(--glow-color); color: white; transform: scale(1.05); }

        .add-to-cart-btn {
                padding: 6px 14px;
                font-size: 0.8rem;
            }

        /* Animated Background Elements (Particles & Bubbles) */
        .bg-animation-container, .bubbles {
            position: fixed; top: 0; left: 0;
            width: 100%; height: 100%;
            z-index: -2; overflow: hidden; pointer-events: none;
        }
        .bg-particle {
            position: absolute; border-radius: 50%;
            background-color: var(--primary-accent); opacity: 0;
            animation: particle-flow 10s linear infinite;
        }
        @keyframes particle-flow {
            0% { transform: translateY(100vh) scale(0.5); opacity: 0; }
            20%, 80% { opacity: 0.05; }
            100% { transform: translateY(-10vh) scale(1); opacity: 0; }
        }
        .bubbles span {
            position: absolute; width: 20px; height: 20px;
            background: rgba(255, 122, 0, 0.08); border-radius: 50%;
            animation: bubble-rise 30s linear infinite; opacity: 0;
        }
        @keyframes bubble-rise {
            0% { transform: translateY(100vh) scale(0); opacity: 1; }
            100% { transform: translateY(-10vh) scale(1.2); opacity: 0; }
        }


        .container { width: 90%; max-width: 1200px; margin: auto; padding: 0 20px; }

        /* Header & Navigation */
        header {
            background: rgba(13, 13, 13, 0.6); backdrop-filter: blur(15px);
            padding: 1rem 0; border-bottom: 1px solid var(--border-color);
            position: sticky; top: 0; z-index: 1000;
            transition: background-color 0.3s ease, box-shadow 0.3s ease;
        }
        header.scrolled { background: rgba(19, 19, 19, 0.8); box-shadow: 0 3px 15px rgba(0,0,0,0.4); }
        header .container { display: flex; justify-content: space-between; align-items: center; }
        header .logo {
            font-family: var(--font-heading); font-size: 1.9rem; font-weight: 700;
            text-decoration: none; letter-spacing: 1px;
            background-image: var(--gradient-text);
            -webkit-background-clip: text; background-clip: text; color: transparent;
        }
        header nav ul { list-style: none; display: flex; align-items: center; }
        header nav ul li { margin-left: 28px; }
        header nav ul li a {
            text-decoration: none; color: var(--text-muted-color);
            font-weight: 500; font-family: var(--font-heading); font-size: 0.9rem;
            padding: 8px 0; transition: color 0.3s ease; position: relative;
        }
        header nav ul li a::after {
            content: ''; position: absolute; width: 0; height: 2px;
            bottom: -3px; left: 50%; transform: translateX(-50%);
            background-image: var(--gradient-primary);
            transition: width 0.4s ease; border-radius: 2px;
        }
        header nav ul li a:hover::after, header nav ul li a.active::after { width: 100%; }
        header nav ul li a:hover, header nav ul li a.active { color: var(--primary-accent); }

        /* Mobile Menu */
        .menu-toggle { display: none; flex-direction: column; justify-content: space-around; width: 30px; height: 25px; background: transparent; border: none; cursor: pointer; padding: 0; z-index: 1001; }
        .menu-toggle .bar { width: 100%; height: 3px; background-color: var(--text-color); border-radius: 10px; transition: all 0.3s ease-in-out; }
        .menu-toggle.open .bar:nth-child(1) { transform: rotate(45deg) translate(6px, 6px); }
        .menu-toggle.open .bar:nth-child(2) { opacity: 0; }
        .menu-toggle.open .bar:nth-child(3) { transform: rotate(-45deg) translate(7px, -7px); }

        /* General Section Styling */
        .section { padding: 80px 0; position: relative; overflow: hidden; }
        .section:not(#hero) { background: var(--gradient-bg-subtle); }
        .section-title {
            font-family: var(--font-heading); font-size: 2.6rem; font-weight: 700;
            text-align: center; margin-bottom: 25px; position: relative;
            color: var(--text-color);
        }
        .section-title span {
            background-image: var(--gradient-text);
            -webkit-background-clip: text; background-clip: text; color: transparent;
        }
        .section-title::after {
            content: ''; display: block; width: 80px; height: 4px;
            background-image: var(--gradient-primary);
            margin: 15px auto 0; border-radius: 3px;
            box-shadow: 0 0 15px var(--glow-color);
        }
        .section-subtitle {
            text-align: center; font-size: 1.15rem; color: var(--text-muted-color);
            max-width: 800px; margin: 0 auto 50px auto; line-height: 1.8;
        }

        /* CTA Button */
        .cta-button {
            display: inline-block; background-image: var(--gradient-primary);
            color: #fff; padding: 15px 35px; text-decoration: none;
            border-radius: 50px; font-weight: 600; font-family: var(--font-heading); font-size: 1rem;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            border: none; box-shadow: 0 6px 20px var(--glow-color);
            position: relative; overflow: hidden;
        }
        .cta-button::before {
            content: ""; position: absolute; top: 0; left: -100%;
            width: 50%; height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255,255,255,0.3), transparent);
            transition: left 0.8s ease;
        }
        .cta-button:hover::before { left: 150%; }
        .cta-button:hover {
            transform: translateY(-3px) scale(1.03);
            box-shadow: 0 10px 30px rgba(255, 122, 0, 0.5);
        }

        /* Generic Pseudo 3D Background Elements for Sections */
        .section-3d-bg {
            position: absolute; top: 0; left: 0; width: 100%; height: 100%;
            perspective: 1500px;
            z-index: -1; overflow: hidden; pointer-events: none;
        }
        .section-3d-bg .s3d-shape {
            position: absolute;
            border: 1px solid rgba(255, 122, 0, 0.1);
            background: linear-gradient(45deg, rgba(255,122,0,0.02), rgba(255,122,0,0.05));
            animation: s3d-float 25s infinite ease-in-out alternate;
            border-radius: 5px;
        }
        @keyframes s3d-float {
            0% { transform: translateY(15px) rotateZ(var(--s-start-rotate, 0deg)) translateZ(var(--s-start-z, -200px)) scale(0.9); opacity: 0.3; }
            100% { transform: translateY(-15px) rotateZ(var(--s-end-rotate, 10deg)) translateZ(var(--s-end-z, -250px)) scale(1); opacity: 0.5;}
        }
        /* Unique positions and styles for background shapes in sections */
        .s3d-shape.s1 { width: 100px; height: 100px; top: 20%; left: 10%; --s-start-z: -180px; --s-end-z: -220px; animation-delay: -1s;}
        .s3d-shape.s2 { width: 150px; height: 80px; bottom: 15%; right: 5%; --s-start-z: -250px; --s-end-z: -280px; animation-delay: -3s; transform: rotate(30deg);}
        .s3d-shape.s3 { width: 80px; height: 120px; top: 50%; left: 5%; --s-start-z: -220px; --s-end-z: -260px; animation-delay: -5s; transform: rotate(-20deg);}
        .s3d-shape.s4 { width: 120px; height: 70px; top: 10%; right: 15%; --s-start-z: -190px; --s-end-z: -230px; animation-delay: -2s; transform: rotate(45deg);}
        .s3d-shape.s5 { width: 90px; height: 90px; bottom: 25%; left: 20%; --s-start-z: -210px; --s-end-z: -240px; animation-delay: -4s; border-radius: 50%;}


        /* Hero Section: Left Text, Right Form */
        .hero {
            min-height: 100vh; display: flex; align-items: center; position: relative;
            overflow: hidden; padding-top: 100px;
            background: radial-gradient(ellipse at bottom, var(--surface-color) 0%, var(--bg-color) 70%);
        }
        .hero-content-wrapper {
            display: flex; align-items: center; justify-content: space-between;
            gap: 40px; width: 100%; position: relative; z-index: 1;
        }
        .hero-text { flex: 1.2; text-align: left; }
        .hero-form-container { flex: 0.8; max-width: 450px; }

        /* Hero Pseudo 3D Background (AI/Data inspired) - More Prominent */
        .hero-ai-bg {
            position: absolute; top: 0; left: 0; width: 100%; height: 100%;
            perspective: 1200px; z-index: 0;
        }
        .hero-ai-bg .ai-shape {
            position: absolute;
            border: 1px solid rgba(255, 122, 0, 0.2);
            background: linear-gradient(45deg, rgba(255,122,0,0.05), rgba(255,122,0,0.15));
            box-shadow: 0 0 20px rgba(255,122,0,0.1);
            animation: ai-pulse 20s infinite ease-in-out alternate;
        }
        .hero-ai-bg .ai-shape1 { width: 250px; height: 150px; top: 15%; left: 5%; transform: rotateX(60deg) rotateZ(30deg) translateZ(-150px); border-radius: 10px; animation-delay: -2s; }
        .hero-ai-bg .ai-shape2 { width: 100px; height: 300px; top: 50%; left: 20%; transform: rotateY(70deg) rotateZ(-20deg) translateZ(-100px); border-radius: 5px; animation-delay: -6s; }
        .hero-ai-bg .ai-shape3 { width: 180px; height: 180px; top: 30%; right: 10%; transform: rotateX(-50deg) rotateZ(45deg) translateZ(-200px); border-radius: 50%; animation-delay: 0s; }
        .hero-ai-bg .ai-shape4 { width: 300px; height: 80px; bottom: 10%; right: 15%; transform: rotateY(-60deg) rotateZ(10deg) translateZ(-120px); border-radius: 8px; animation-delay: -8s; }

        @keyframes ai-pulse {
            0% { transform: var(--start-transform) scale(0.95); opacity: 0.7; box-shadow: 0 0 15px var(--glow-color); }
            100% { transform: var(--end-transform) scale(1.05); opacity: 1; box-shadow: 0 0 30px var(--glow-color); }
        }
        .hero-ai-bg .ai-shape1 { --start-transform: rotateX(60deg) rotateZ(30deg) translateZ(-150px); --end-transform: rotateX(55deg) rotateZ(35deg) translateZ(-140px); }
        .hero-ai-bg .ai-shape2 { --start-transform: rotateY(70deg) rotateZ(-20deg) translateZ(-100px); --end-transform: rotateY(65deg) rotateZ(-25deg) translateZ(-90px); }
        .hero-ai-bg .ai-shape3 { --start-transform: rotateX(-50deg) rotateZ(45deg) translateZ(-200px); --end-transform: rotateX(-45deg) rotateZ(40deg) translateZ(-190px); }
        .hero-ai-bg .ai-shape4 { --start-transform: rotateY(-60deg) rotateZ(10deg) translateZ(-120px); --end-transform: rotateY(-55deg) rotateZ(15deg) translateZ(-110px); }


        .hero-text h1 {
            font-family: var(--font-heading); font-size: 3rem; font-weight: 700;
            margin-bottom: 20px; line-height: 1.3;
            color: var(--text-color);
        }
        .hero-text h1 .highlight {
            background-image: var(--gradient-text);
            -webkit-background-clip: text; background-clip: text; color: transparent;
            display: block;
        }
        .hero-text p.subtitle {
            font-size: 1.25rem; margin-bottom: 35px; color: var(--text-muted-color);
        }
        .hero-form {
            background: rgba(30, 30, 38, 0.8); backdrop-filter: blur(10px);
            padding: 30px; border-radius: 12px;
            box-shadow: 0 8px 30px rgba(0,0,0,0.3);
            border: 1px solid var(--border-color);
        }
        .hero-form h3 {
            font-family: var(--font-heading); color: var(--primary-accent);
            margin-bottom: 20px; font-size: 1.4rem; text-align: center;
        }
        .hero-form input[type="text"],
        .hero-form input[type="email"],
        .hero-form input[type="tel"] {
            width: 100%; padding: 14px; margin-bottom: 18px; border-radius: 8px;
            border: 1px solid var(--border-color); background-color: #222;
            color: var(--text-color); font-family: var(--font-body); font-size: 0.95rem;
        }
        .hero-form input::placeholder { color: var(--text-muted-color); }
        .hero-form input:focus {
            outline: none; border-color: var(--primary-accent);
            box-shadow: 0 0 0 3px var(--glow-color);
        }
        .hero-form .cta-button { width: 100%; padding: 14px; }


        /* 360 Digital Marketing Section (Overview) */
        #digital-360 .services-overview-grid { display: grid; grid-template-columns: repeat(auto-fit, minmax(280px, 1fr)); gap: 30px; margin-top: 40px; }
        .overview-item {
            background: var(--card-bg); padding: 30px 25px; border-radius: 10px; text-align: center;
            border: 1px solid var(--border-color);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            position: relative; overflow: hidden;
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
        }
        .overview-item:hover {
            transform: translateY(-8px) scale(1.02);
            box-shadow: 0 12px 30px rgba(0,0,0,0.2), 0 0 20px var(--glow-color);
            border-color: var(--primary-accent);
        }
        .overview-item .icon-placeholder { font-size: 2.8rem; color: var(--primary-accent); margin-bottom: 15px; line-height: 1; }
        .overview-item h3 { font-family: var(--font-heading); font-size: 1.4rem; color: var(--text-color); margin-bottom: 10px; }
        .overview-item p { font-size: 0.9rem; color: var(--text-muted-color); line-height: 1.6; }

        /* Specific Services Section */
        #specific-services { background-color: var(--bg-color); }
        .specific-service-card {
            background: linear-gradient(145deg, var(--surface-color), var(--card-bg));
            padding: 35px; border-radius: 12px; margin-bottom: 30px;
            border: 1px solid var(--border-color);
            box-shadow: 0 8px 25px rgba(0,0,0,0.15);
            display: flex; gap: 30px; align-items: center;
        }
        .specific-service-card:nth-child(even) { flex-direction: row-reverse; }
        .specific-service-card .service-icon { font-size: 3.5rem; color: var(--primary-accent); flex-shrink: 0; width: 80px; text-align: center; }
        .specific-service-card .service-content h3 { font-family: var(--font-heading); font-size: 1.6rem; color: var(--primary-accent); margin-bottom: 10px; }
        .specific-service-card .service-content p { font-size: 1rem; color: var(--text-muted-color); margin-bottom: 15px; }
        .specific-service-card .service-content ul { list-style: none; padding-left: 0; }
        .specific-service-card .service-content ul li { margin-bottom: 8px; color: var(--text-color); font-size: 0.95rem; position: relative; padding-left: 25px; }
        .specific-service-card .service-content ul li::before {
            content: '›';
            font-family: var(--font-heading);
            color: var(--primary-accent); position: absolute; left: 0; font-weight: bold; font-size: 1.2em; top: -2px;
        }

        /* Gradient Card (reused for testimonials and other stand-out cards if needed) */
        .gradient-card {
            background: linear-gradient(145deg, var(--surface-color), var(--card-bg));
            padding: 30px; border-radius: 10px;
            border: 1px solid transparent;
            border-image: var(--gradient-card-border) 1;
            box-shadow: 0 8px 20px rgba(0,0,0,0.15);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }
        .gradient-card:hover {
            transform: translateY(-5px) scale(1.01);
            box-shadow: 0 12px 30px rgba(0,0,0,0.2), 0 0 15px var(--glow-color);
        }

        /* International Presence Section */
        #international-presence .countries-grid {
            display: grid; grid-template-columns: repeat(auto-fit, minmax(180px, 1fr));
            gap: 25px; margin-top: 40px; text-align: center;
        }
        .country-item {
            background: var(--card-bg);
            padding: 25px 20px; border-radius: 8px;
            border: 1px solid var(--border-color);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }
        .country-item:hover {
            transform: translateY(-5px) scale(1.03);
            box-shadow: 0 8px 20px rgba(0,0,0,0.2), 0 0 10px var(--glow-color);
            border-color: var(--primary-accent);
        }
        .country-item .flag-icon { font-size: 3rem; margin-bottom: 10px; display: block; line-height: 1; }
        .country-item span { font-family: var(--font-heading); font-weight: 500; font-size: 1.2rem; color: var(--text-color); }


        /* Partner Section */
        #partners { background: var(--surface-color); }
        .partners-grid {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            align-items: center;
            gap: 40px;
            margin-top: 40px;
        }
        .partner-logo {

            max-width: 100%;
            filter: grayscale(80%) brightness(1.5) contrast(1.2);
            transition: filter 0.3s ease, transform 0.3s ease;
            opacity: 0.7;
        }
        .partner-logo:hover {
            filter: grayscale(0%) brightness(1) contrast(1);
            transform: scale(1.1);
            opacity: 1;
        }


        /* Testimonials Section */
        #testimonials { background: linear-gradient(to bottom, var(--surface-color), var(--bg-color) 80%); }
        .testimonial-grid {
            display: grid; grid-template-columns: repeat(auto-fit, minmax(320px, 1fr));
            gap: 30px; margin-top: 40px;
        }
        .testimonial-card {
            background: var(--card-bg); padding: 30px; border-radius: 10px;
            border-left: 5px solid;
            border-image: var(--gradient-primary) 1;
            box-shadow: 0 8px 20px rgba(0,0,0,0.2);
            position: relative;
        }
        .testimonial-card .client-avatar {
            width: 60px; height: 60px; border-radius: 50%;
            background-image: var(--gradient-primary);
            margin-bottom: 15px;
            display: flex; align-items: center; justify-content: center;
            color: white; font-weight: bold;
            box-shadow: 0 0 10px var(--glow-color);
        }
        .testimonial-card blockquote {
            font-size: 1rem; color: var(--text-muted-color); margin-bottom: 20px;
            font-style: italic; line-height: 1.8; position: relative;
        }
        .testimonial-card blockquote::before {
            content: '“'; font-family: Georgia, serif; font-size: 3.5rem;
            line-height: 1;
            background-image: var(--gradient-text); -webkit-background-clip: text; background-clip: text; color: transparent;
            position: absolute; left: -15px; top: -15px; opacity: 0.8;
        }
        .testimonial-card .client-name {
            font-family: var(--font-heading); font-weight: 600; font-size: 1.1rem;
            color: var(--text-color);
        }
        .testimonial-card .client-info { font-size: 0.9rem; color: var(--primary-accent); }

        /* FAQs Section */
        #faqs { background: var(--bg-color); }
        .faq-item {
            background: var(--surface-color); margin-bottom: 15px; border-radius: 8px;
            border: 1px solid var(--border-color);
            transition: box-shadow 0.3s ease;
        }
        .faq-item:hover { box-shadow: 0 5px 15px rgba(0,0,0,0.15); }
        .faq-item summary {
            font-family: var(--font-heading); font-weight: 500; font-size: 1.1rem;
            padding: 20px; cursor: pointer; list-style: none;
            position: relative; color: var(--text-color);
        }
        .faq-item summary::-webkit-details-marker { display: none; }
        .faq-item summary::after {
            content: '+'; font-family: var(--font-heading);
            font-size: 1.5rem; color: var(--primary-accent);
            position: absolute; right: 20px; top: 50%; transform: translateY(-50%);
            transition: transform 0.3s ease;
        }
        .faq-item[open] summary::after { transform: translateY(-50%) rotate(45deg); }
        .faq-item .faq-content {
            padding: 0 20px 20px 20px;
            color: var(--text-muted-color); font-size: 0.95rem; line-height: 1.8;
        }


        /* Animations on Scroll */
        .animate-on-scroll { opacity: 0; transition: opacity var(--animation-duration) ease-out, transform var(--animation-duration) ease-out; }
        .fade-in { transform: translateY(30px); } .fade-in-up { transform: translateY(50px); }
        .fade-in-left { transform: translateX(-50px); } .fade-in-right { transform: translateX(50px); }
        .scale-up { transform: scale(0.9); }
        .animate-on-scroll.is-visible { opacity: 1; transform: translateY(0) translateX(0) scale(1); }

        /* Footer */
        footer {
            background: linear-gradient(to top, #0A0A0A, var(--bg-color) 90%);
            color: var(--text-muted-color); text-align: center; padding: 60px 0 30px;
            margin-top: 50px; border-top: 1px solid var(--border-color);
            position: relative;
        }
        footer::before {
            content: ''; position: absolute; bottom: 0; left: 50%;
            transform: translateX(-50%);
            width: 300px; height: 100px;
            background: radial-gradient(ellipse at bottom, rgba(255,122,0,0.1) 0%, transparent 70%);
            opacity: 0.5; z-index: 0; filter: blur(10px);
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


        /* Responsive Adjustments */
        @media (max-width: 992px) {
            .hero-content-wrapper { flex-direction: column; text-align: center; }
            .hero-text { text-align: center; margin-bottom: 30px; }
            .hero-form-container { max-width: 500px; width: 100%; }
            .hero-text h1 { font-size: 2.6rem; }
            .hero-text p.subtitle { font-size: 1.1rem; }
            .section-title { font-size: 2.3rem; }
            .specific-service-card, .specific-service-card:nth-child(even) {
                flex-direction: column; text-align: center;
            }
            .specific-service-card .service-icon { margin-bottom: 20px; }
        }

        @media (max-width: 768px) {
            html { font-size: 15px; }
            header nav ul { display: none; flex-direction: column; position: absolute; top: 100%; left: 0; width: 100%; background: rgba(19, 19, 19, 0.98); backdrop-filter: blur(10px); padding: 15px 0; border-top: 1px solid var(--border-color); box-shadow: 0 5px 10px rgba(0,0,0,0.2); }
            header nav ul.open { display: flex; }
            header nav ul li { margin: 10px 0; width: 100%; text-align: center; }
            header nav ul li a { padding: 10px 20px; display: block; }
            .menu-toggle { display: flex; }

            .hero { padding: 120px 0 60px; }
            .hero-text h1 { font-size: 2.2rem; }
            .section-title { font-size: 2rem; }
            .hero-ai-bg .ai-shape, .section-3d-bg .s3d-shape { display: none; } /* Simplify complex bg on mobile for performance */
            .partners-grid { gap: 20px;}
            .partner-logo { height: 45px; max-width: 120px;}
        }
         @media (max-width: 480px) {
            .hero-text h1 { font-size: 1.9rem; }
            .section-title { font-size: 1.7rem; }
            .partner-logo { height: 40px; max-width: 100px;}
         }

    </style>


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


