<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- SEO Basics -->
    <title>Adzquare - Global IT & 360° Digital Marketing Solutions | USA, UK, India, Australia</title>
    <meta name="description" content="Adzquare: Your international partner for cutting-edge IT solutions and results-driven 360° digital marketing services. We empower businesses in the USA, UK, India, Australia, and beyond.">
    <meta name="keywords" content="digital marketing, IT solutions, SEO, SEM, SMM, web development, app development, Adzquare, international digital marketing, USA, UK, India, Australia, global IT services">
    <meta name="author" content="Adzquare">
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
        html { scroll-behavior: smooth; font-size: 16px; }
        body {
            font-family: var(--font-body);
            line-height: 1.7;
            color: var(--text-color);
            background-color: var(--bg-color);
            overflow-x: hidden;
            position: relative;
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
            height: 60px;
            max-width: 150px;
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
<body>
    <!-- Animated Backgrounds: Bubbles and Particles -->
    <div class="bg-animation-container"> <!-- For particle effects --> </div>
    <div class="bubbles"> <!-- For bubble effects --> </div>

    <header id="main-header">
        <div class="container">
            <a href="#hero" class="logo">Adzquare</a>
            <nav>
                <ul id="nav-menu">
                    <li><a href="#hero" class="active">Home</a></li>
                    <li><a href="#digital-360">360° Solutions</a></li>
                    <li><a href="#specific-services">Services</a></li>
                    <li><a href="#partners">Partners</a></li>
                    <li><a href="#international-presence">Global Reach</a></li>
                    <li><a href="#testimonials">Testimonials</a></li>
                    <li><a href="#faqs">FAQs</a></li>
                    <li><a href="#contact">Contact</a></li>
                </ul>
            </nav>
            <button class="menu-toggle" id="menu-toggle-button" aria-label="Toggle navigation" aria-expanded="false">
                <span class="bar"></span><span class="bar"></span><span class="bar"></span>
            </button>
        </div>
    </header>

    <main>
        <!-- Hero Section -->
        <section id="hero" class="hero">
            <div class="hero-ai-bg">
                <div class="ai-shape ai-shape1"></div>
                <div class="ai-shape ai-shape2"></div>
                <div class="ai-shape ai-shape3"></div>
                <div class="ai-shape ai-shape4"></div>
            </div>
            <div class="container">
                <div class="hero-content-wrapper">
                    <div class="hero-text animate-on-scroll fade-in-right">
                        <h1>Your <span class="highlight">Global Partner</span> for Digital Transformation</h1>
                        <p class="subtitle">
                            Adzquare architects cutting-edge IT solutions and spearheads pioneering 360° digital marketing strategies, empowering businesses in India, USA, UK, Australia, and across the globe to achieve unprecedented growth and market dominance.
                        </p>
                        <a href="#digital-360" class="cta-button">Explore Our Universe of Solutions</a>
                    </div>
                    <div class="hero-form-container animate-on-scroll fade-in-left">
                        <div class="hero-form">
                            <h3>Ignite Your Growth - Quick Inquiry</h3>
                            <form action="#" method="POST"> <!-- Replace # with your form processing endpoint -->
                                <input type="text" name="name" placeholder="Your Full Name" required>
                                <input type="email" name="email" placeholder="Your Business Email" required>
                                <input type="tel" name="phone" placeholder="Phone Number (Optional)">
                                <button type="submit" class="cta-button">Connect With Our Experts</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- 360 Digital Marketing Overview Section -->
        <section id="digital-360" class="section">
            <div class="section-3d-bg">
                <div class="s3d-shape s1"></div>
                <div class="s3d-shape s2"></div>
            </div>
            <div class="container">
                <h2 class="section-title animate-on-scroll fade-in">Our <span>360° Digital Galaxy</span> Approach</h2>
                <p class="section-subtitle animate-on-scroll fade-in" style="animation-delay: 0.1s;">
                    We navigate the complexities of the digital cosmos to chart a course for your brand's global success. Our integrated strategies ensure every touchpoint contributes to your growth, whether you're targeting audiences in India, the USA, UK, or Australia.
                </p>
                <div class="services-overview-grid">
                    <div class="overview-item animate-on-scroll fade-in-up" style="animation-delay: 0.2s;">
                        <div class="icon-placeholder">🌌</div> <!-- Icon: Galaxy/Strategy -->
                        <h3>Strategic Constellations</h3>
                        <p>Mapping data-driven, bespoke strategies for stellar digital performance across diverse international markets.</p>
                    </div>
                    <div class="overview-item animate-on-scroll fade-in-up" style="animation-delay: 0.3s;">
                        <div class="icon-placeholder">💡</div> <!-- Icon: Idea/Creativity -->
                        <h3>Creative Nebulas</h3>
                        <p>Forging compelling, culturally-resonant content and captivating designs that engage global audiences and build brand loyalty.</p>
                    </div>
                    <div class="overview-item animate-on-scroll fade-in-up" style="animation-delay: 0.4s;">
                        <div class="icon-placeholder">🛰️</div> <!-- Icon: Satellite/Reach -->
                        <h3>Targeted Trajectories</h3>
                        <p>Precision outreach using advanced analytics to connect with your ideal customers on the right platforms, at the optimal time, worldwide.</p>
                    </div>
                    <div class="overview-item animate-on-scroll fade-in-up" style="animation-delay: 0.5s;">
                        <div class="icon-placeholder">🔬</div> <!-- Icon: Microscope/Analysis -->
                        <h3>Analytical Orbits</h3>
                        <p>Continuously refining strategies through meticulous tracking, A/B testing, and data analysis for peak performance and maximum ROI.</p>
                    </div>
                </div>
            </div>
        </section>

        <!-- Specific Services Section -->
        <section id="specific-services" class="section">
             <div class="section-3d-bg">
                <div class="s3d-shape s3" style="top:10%; right: 10%; transform: rotate(-45deg);"></div>
                <div class="s3d-shape s4" style="bottom:5%; left: 15%;"></div>
            </div>
            <div class="container">
                <h2 class="section-title animate-on-scroll fade-in">Core <span>Digital Accelerators</span> & IT Solutions</h2>
                <p class="section-subtitle animate-on-scroll fade-in" style="animation-delay: 0.1s;">
                    Powering your international growth with specialized digital marketing services and robust IT expertise.
                </p>
                 <div class="specific-service-card animate-on-scroll fade-in-left">
                    <div class="service-icon">📈</div> <!-- Icon: Growth Chart for SEO/SEM -->
                    <div class="service-content">
                        <h3>Search Engine Supremacy (SEO & SEM)</h3>
                        <p>Achieve top global search rankings. We craft advanced SEO & SEM strategies, fine-tuned for diverse international markets including the US, UK, India, and Australia, driving organic traffic and maximizing ad spend.</p>
                        <ul>
                            <li>Comprehensive Multilingual Keyword Intelligence</li>
                            <li>Advanced International Technical SEO Audits</li>
                            <li>Global & Localized PPC Campaign Management (Google Ads, Bing Ads)</li>
                            <li>Building Cross-Border Link Ecosystems & Digital PR</li>
                            <li>Conversion Rate Optimization (CRO) for Search Traffic</li>
                        </ul>
                    </div>
                </div>
                 <div class="specific-service-card animate-on-scroll fade-in-right">
                    <div class="service-icon">🌐</div> <!-- Icon: Globe/Network for SMM -->
                    <div class="service-content">
                        <h3>Global Social Engagement (SMM)</h3>
                        <p>Develop culturally-resonant social media campaigns. We connect your brand with diverse audiences worldwide on platforms like Facebook, Instagram, LinkedIn, Twitter, and emerging channels relevant to your target regions.</p>
                        <ul>
                            <li>Cross-Cultural Social Media Content Strategy</li>
                            <li>International Community Building & Management</li>
                            <li>Targeted Global Social Advertising (Facebook, Instagram, LinkedIn Ads)</li>
                            <li>Worldwide Influencer Marketing & Collaboration</li>
                            <li>Social Listening & Brand Reputation Management</li>
                        </ul>
                    </div>
                </div>
                 <div class="specific-service-card animate-on-scroll fade-in-left">
                    <div class="service-icon">🎯</div> <!-- Icon: Target for Paid Ads -->
                    <div class="service-content">
                        <h3>Precision Paid Advertising (PPC)</h3>
                        <p>Maximize your ROI with hyper-targeted Google Ads & Facebook Ads, and other PPC campaigns. Our experts meticulously manage campaigns for global audiences, focusing on conversions and optimal cost-efficiency.</p>
                        <ul>
                            <li>Strategic International Ad Campaign Structuring</li>
                            <li>Compelling Localized Ad Copy & Creative Design</li>
                            <li>Multi-Region Budget Allocation & Optimization</li>
                            <li>Advanced Audience Segmentation & Retargeting Strategies</li>
                            <li>Programmatic Advertising & Display Network Management</li>
                        </ul>
                    </div>
                </div>
                <div class="specific-service-card animate-on-scroll fade-in-right">
                   <div class="service-icon">💬</div> <!-- Icon: Chat Bubble for Direct Engagement -->
                   <div class="service-content">
                       <h3>Direct Engagement & Lead Generation</h3>
                       <p>Nurture prospects and convert high-value leads. We implement sophisticated WhatsApp Marketing, Email Automation, and custom Lead Generation funnels, designed for engagement and conversion in global markets.</p>
                       <ul>
                           <li>WhatsApp Business API Integration for Global Customer Service & Marketing</li>
                           <li>Development of Automated Multi-Lingual Chatbots</li>
                           <li>GDPR/CCPA Compliant International Email Marketing Campaigns</li>
                           <li>High-Converting Global Landing Page Design & Optimization</li>
                           <li>CRM Integration & Automated Lead Nurturing Sequences</li>
                       </ul>
                   </div>
               </div>
               <div class="specific-service-card animate-on-scroll fade-in-left">
                   <div class="service-icon">💻</div> <!-- Icon: Laptop/Code for IT Solutions -->
                   <div class="service-content">
                       <h3>Futuristic IT Solutions & Cloud Services</h3>
                       <p>Empower your global operations with our robust IT infrastructure, cloud solutions, and custom software development. We ensure security, scalability, and efficiency for businesses operating across borders.</p>
                       <ul>
                           <li>Managed IT Services & 24/7 Global Support</li>
                           <li>Cloud Migration, Management & Optimization (AWS, Azure, GCP)</li>
                           <li>Advanced Cybersecurity Solutions & Data Protection Strategies</li>
                           <li>Custom Web & Mobile Application Development</li>
                           <li>DevOps & IT Automation Consulting</li>
                       </ul>
                   </div>
               </div>
            </div>
        </section>

        <!-- Partner Section -->
        <section id="partners" class="section">
            <div class="section-3d-bg">
                <div class="s3d-shape s5" style="top: 15%; right: 5%; width: 70px; height: 130px; transform: rotate(20deg);"></div>
                <div class="s3d-shape s1" style="bottom: 10%; left: 5%; transform: rotate(-30deg);"></div>
            </div>
            <div class="container">
                <h2 class="section-title animate-on-scroll fade-in">Our Valued <span>Technology Partners</span></h2>
                <p class="section-subtitle animate-on-scroll fade-in" style="animation-delay: 0.1s;">
                    Collaborating with industry leaders to integrate and deliver best-in-class, cutting-edge solutions for our global clientele.
                </p>
                <div class="partners-grid">
                    <img src="https://via.placeholder.com/200x80/FFFFFF/000000?text=Razorpay+Logo" alt="Razorpay Payment Solutions Logo" class="partner-logo animate-on-scroll scale-up" style="animation-delay: 0.2s;">
                    <img src="https://via.placeholder.com/200x80/FFFFFF/000000?text=PhonePe+Logo" alt="PhonePe Digital Payments Logo" class="partner-logo animate-on-scroll scale-up" style="animation-delay: 0.3s;">
                    <img src="https://via.placeholder.com/200x80/FFFFFF/000000?text=Jio+Haptik+Logo" alt="Jio Haptik AI Chatbot Solutions Logo" class="partner-logo animate-on-scroll scale-up" style="animation-delay: 0.4s;">
                    <!-- Add more partner logos as needed. Use their official logos. -->
                </div>
            </div>
        </section>


        <!-- International Presence Section -->
        <section id="international-presence" class="section">
            <div class="section-3d-bg">
                <div class="s3d-shape s2" style="top: 50%; left: 80%; transform: rotate(50deg) scale(0.8);"></div>
                <div class="s3d-shape s4" style="bottom: 60%; right: 70%; transform: rotate(-10deg) scale(1.1);"></div>
            </div>
            <div class="container">
                <h2 class="section-title animate-on-scroll fade-in">Our <span>Global Footprint</span>: Local Expertise, Worldwide Reach</h2>
                <p class="section-subtitle animate-on-scroll fade-in" style="animation-delay:0.1s;">
                    Adzquare proudly serves a diverse clientele, driving digital innovation and IT excellence across key international markets. We understand global trends and local nuances.
                </p>
                <div class="countries-grid">
                    <div class="country-item animate-on-scroll scale-up" style="animation-delay:0.2s;">
                        <div class="flag-icon">🇮🇳</div> <!-- Unicode Flag for India -->
                        <span>India</span>
                    </div>
                    <div class="country-item animate-on-scroll scale-up" style="animation-delay:0.3s;">
                        <div class="flag-icon">🇺🇸</div> <!-- Unicode Flag for USA -->
                        <span>USA</span>
                    </div>
                    <div class="country-item animate-on-scroll scale-up" style="animation-delay:0.4s;">
                        <div class="flag-icon">🇬🇧</div> <!-- Unicode Flag for UK -->
                        <span>UK</span>
                    </div>
                    <div class="country-item animate-on-scroll scale-up" style="animation-delay:0.5s;">
                        <div class="flag-icon">🇦🇺</div> <!-- Unicode Flag for Australia -->
                        <span>Australia</span>
                    </div>
                    <div class="country-item animate-on-scroll scale-up" style="animation-delay:0.6s;">
                        <div class="flag-icon">🌍</div> <!-- Unicode Globe Icon for More -->
                        <span>And More...</span>
                    </div>
                </div>
            </div>
        </section>

        <!-- Testimonials Section -->
        <section id="testimonials" class="section">
             <div class="section-3d-bg">
                <div class="s3d-shape s1" style="top: 80%; left: 70%; transform: rotate(15deg);"></div>
                <div class="s3d-shape s3" style="top: 10%; right: 20%; transform: rotate(60deg);"></div>
            </div>
            <div class="container">
                <h2 class="section-title animate-on-scroll fade-in">Echoes of Success: Voices of Our <span>Global Partners</span></h2>
                <p class="section-subtitle animate-on-scroll fade-in" style="animation-delay:0.1s;">Hear what our international clients from various industries say about their transformative journey with Adzquare.</p>
                <div class="testimonial-grid">
                    <div class="testimonial-card gradient-card animate-on-scroll fade-in-left" style="animation-delay:0.2s;">
                        <div class="client-avatar" alt="Client Avatar - Jane D.">JD</div> <!-- Use <img src="path/to/jane-avatar.jpg" alt="Jane Doe"> -->
                        <blockquote>"Adzquare didn't just meet expectations; they shattered them. Their innovative digital strategies propelled our market reach in the USA to new heights. Truly a world-class, visionary partner!"</blockquote>
                        <p class="client-name">Jane Doe</p>
                        <p class="client-info">CEO, TechForward Solutions Inc. (USA)</p>
                    </div>
                    <div class="testimonial-card gradient-card animate-on-scroll fade-in-up" style="animation-delay:0.3s;">
                        <div class="client-avatar" alt="Client Avatar - Ravi S.">RS</div> <!-- Use <img src="path/to/ravi-avatar.jpg" alt="Ravi Sharma"> -->
                        <blockquote>"The bespoke IT infrastructure support and cloud solutions for our UK operations have been impeccable. Adzquare's team is highly responsive, deeply knowledgeable, and an absolute pleasure to work with."</blockquote>
                        <p class="client-name">Ravi Sharma</p>
                        <p class="client-info">Operations Director, Innovate Global Ltd. (UK)</p>
                    </div>
                    <div class="testimonial-card gradient-card animate-on-scroll fade-in-right" style="animation-delay:0.4s;">
                        <div class="client-avatar" alt="Client Avatar - Sarah K.">SK</div> <!-- Use <img src="path/to/sarah-avatar.jpg" alt="Sarah K."> -->
                        <blockquote>"Our lead generation in the competitive Australian market saw a staggering 150% increase thanks to Adzquare's data-driven and precisely targeted campaigns. Exceptional results and outstanding communication!"</blockquote>
                        <p class="client-name">Sarah Kensington</p>
                        <p class="client-info">Head of Marketing, AusBiz Dynamics Co. (Australia)</p>
                    </div>
                </div>
            </div>
        </section>

        <!-- FAQs Section -->
        <section id="faqs" class="section">
            <div class="section-3d-bg">
                <div class="s3d-shape s4" style="top: 25%; left: 85%; transform: rotate(-25deg) scale(0.9);"></div>
                <div class="s3d-shape s5" style="bottom: 15%; right: 80%; transform: rotate(35deg) scale(1.05); border-radius: 10px;"></div>
            </div>
            <div class="container" style="max-width: 850px;">
                <h2 class="section-title animate-on-scroll fade-in">Illuminating Your Queries: <span>Adzquare FAQs</span></h2>
                <p class="section-subtitle animate-on-scroll fade-in" style="animation-delay:0.1s;">Your questions, answered. Get clear insights into our global services, processes, and how we drive success for businesses like yours.</p>
                <div class="faq-list">
                    <details class="faq-item animate-on-scroll fade-in-up" style="animation-delay:0.2s;">
                        <summary class="faq-question">What specific international markets does Adzquare primarily serve and have expertise in?</summary>
                        <div class="faq-content">
                            <p>Adzquare has a robust presence and extensive experience catering to clients in major global markets including India, the USA, the UK, and Australia. Our teams possess deep understanding of these regions, and we are fully equipped to manage and deliver successful projects in various other international territories.</p>
                        </div>
                    </details>
                    <details class="faq-item animate-on-scroll fade-in-up" style="animation-delay:0.3s;">
                        <summary class="faq-question">How does Adzquare effectively manage projects and communication across different time zones for international clients?</summary>
                        <div class="faq-content">
                            <p>Our project management framework is inherently designed for seamless global collaboration. We establish crystal-clear communication channels, leverage advanced collaborative software, and structure our teams to ensure significant overlapping work hours. This guarantees responsive interaction and continuous progress for our international clients, regardless of their location.</p>
                        </div>
                    </details>
                    <details class="faq-item animate-on-scroll fade-in-up" style="animation-delay:0.4s;">
                        <summary class="faq-question">Can Adzquare tailor digital marketing strategies to be effective in specific countries and cultural contexts?</summary>
                        <div class="faq-content">
                            <p>Absolutely. Localization is key to our international success. We conduct in-depth market research for each target country, analyzing cultural nuances, local search engine algorithms, competitor strategies, and specific consumer behaviors. This data allows us to craft highly localized and impactful SEO, SMM, SEM, and content marketing strategies that resonate powerfully with the target audience in each unique region.</p>
                        </div>
                    </details>
                     <details class="faq-item animate-on-scroll fade-in-up" style="animation-delay:0.5s;">
                        <summary class="faq-question">What types of AI-powered solutions and innovations does Adzquare offer to businesses?</summary>
                        <div class="faq-content">
                            <p>Adzquare is at the forefront of leveraging Artificial Intelligence. We offer AI solutions for advanced predictive analytics, sophisticated marketing automation, hyper-personalized customer experiences, the development of intelligent and conversational AI chatbots, and the optimization of complex IT operations. Our primary objective is to harness AI to drive tangible efficiency, foster innovation, and create a competitive edge for your business in the global marketplace.</p>
                        </div>
                    </details>
                </div>
            </div>
        </section>

        <!-- Contact Section -->
        <section id="contact" class="section">
            <div class="container">
                <h2 class="section-title animate-on-scroll fade-in">Let's Architect Your Global Success: <span>Connect With Adzquare</span></h2>
                <p class="section-subtitle animate-on-scroll fade-in" style="animation-delay:0.1s;">
                    Ready to elevate your business on the world stage and achieve unparalleled digital growth? Reach out to our international team of experts today.
                </p>
                <div class="hero-form animate-on-scroll scale-up" style="animation-delay:0.2s; max-width:750px; margin:auto; background: linear-gradient(145deg, var(--surface-color), var(--card-bg));">
                     <h3>Send Us Your Project Brief or Inquiry</h3>
                     <form action="#" method="POST"> <!-- Remember to set up form backend -->
                        <input type="text" name="name" placeholder="Your Full Name" required>
                        <input type="email" name="email" placeholder="Your Business Email Address" required>
                        <input type="tel" name="phone" placeholder="Your Phone Number (with country code)">
                        <input type="text" name="company" placeholder="Your Company Name & Country of Operation" required>
                        <textarea name="message" rows="5" placeholder="Briefly describe your project, requirements, or inquiry..." required style="width:100%; padding:14px; margin-bottom:18px; border-radius:8px; border:1px solid var(--border-color); background-color:rgba(10,10,15,0.5); color:var(--text-color); font-family:var(--font-body); font-size:0.95rem;"></textarea>
                        <button type="submit" class="cta-button">Submit Global Inquiry Now</button>
                    </form>
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

</body>
</html>
