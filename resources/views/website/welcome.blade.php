<!DOCTYPE html>
<html lang="en">

@extends('website.layouts.app')

<body>
    <!-- Animated Backgrounds: Bubbles and Particles -->
    <div class="bg-animation-container"> <!-- For particle effects --> </div>
    <div class="bubbles"> <!-- For bubble effects --> </div>

    @include('website.layouts.header')

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
                            <form action="{{ route('inquiry.store') }}" method="POST"> <!-- Replace # with your form processing endpoint -->
                                @csrf
                                <input type="text" name="name" placeholder="Your Full Name" required>
                                <input type="email" name="email" placeholder="Your Business Email">
                                <input type="tel" name="phone" placeholder="Phone Number" required>
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
                    <!-- Card 1: Digital Marketing -->
                    <div class="overview-item animate-on-scroll fade-in-up" style="animation-delay: 0.2s;">
                        <div class="icon-placeholder">🌌</div> <!-- Icon: Galaxy/Strategy -->
                        <h3>Digital Marketing</h3>
                        <p>Crafting comprehensive, data-driven strategies to navigate the digital landscape and achieve your core business objectives.</p>
                    </div>
                    <!-- Card 2: SEO -->
                    <div class="overview-item animate-on-scroll fade-in-up" style="animation-delay: 0.3s;">
                        <div class="icon-placeholder">📈</div> <!-- Icon: Growth Chart -->
                        <h3>Search Engine Optimization</h3>
                        <p>Enhancing your website's visibility on search engines to drive sustained organic traffic and achieve top rankings.</p>
                    </div>
                    <!-- Card 3: SEM -->
                    <div class="overview-item animate-on-scroll fade-in-up" style="animation-delay: 0.4s;">
                        <div class="icon-placeholder">🎯</div> <!-- Icon: Target -->
                        <h3>Search Engine Marketing</h3>
                        <p>Utilizing paid search strategies to place your brand in front of motivated customers and maximize return on investment.</p>
                    </div>
                    <!-- Card 4: Web & Mobile App Development -->
                    <div class="overview-item animate-on-scroll fade-in-up" style="animation-delay: 0.5s;">
                        <div class="icon-placeholder">💻</div> <!-- Icon: Laptop/Code -->
                        <h3>Web & Mobile App Development</h3>
                        <p>Building responsive websites and intuitive mobile applications that provide a seamless, high-performance user experience.</p>
                    </div>
                    <!-- Card 5: Content Creation -->
                    <div class="overview-item animate-on-scroll fade-in-up" style="animation-delay: 0.6s;">
                        <div class="icon-placeholder">✍️</div> <!-- Icon: Writing Hand -->
                        <h3>Content Creation</h3>
                        <p>Developing engaging and valuable content that resonates with your target audience and builds lasting brand authority.</p>
                    </div>
                    <!-- Card 6: Meta & Google Ads -->
                    <div class="overview-item animate-on-scroll fade-in-up" style="animation-delay: 0.7s;">
                        <div class="icon-placeholder">📢</div> <!-- Icon: Megaphone/Ads -->
                        <h3>Meta & Google Ads</h3>
                        <p>Running hyper-targeted ad campaigns on the world's largest platforms to reach specific demographics and drive conversions.</p>
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

</body>
</html>
