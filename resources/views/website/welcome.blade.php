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
                        <a href="#" class="add-to-cart-btn">View Details</a>
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
                        <a href="#" class="add-to-cart-btn">View Details</a>
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
                        <a href="#" class="add-to-cart-btn">View Details</a>
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
                       <a href="#" class="add-to-cart-btn">View Details</a>
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
                       <a href="#" class="add-to-cart-btn">View Details</a>
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
                    <img src="{{ asset('web/images/razorpay.png') }}" alt="Razorpay Payment Solutions Logo" class="partner-logo animate-on-scroll scale-up" style="animation-delay: 0.2s;">
                    <img src="{{ asset('web/images/phonepe.png') }}" alt="PhonePe Digital Payments Logo" class="partner-logo animate-on-scroll scale-up" style="animation-delay: 0.3s;">
                    <img src="{{ asset('web/images/jio.png') }}" alt="Jio Haptik AI Chatbot Solutions Logo" class="partner-logo animate-on-scroll scale-up" style="animation-delay: 0.4s;">
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
                        <blockquote>"Partnering with Adzquare was a game-changer for our brand. Their 360° digital marketing strategy, especially their mastery of SEO and local market analytics, gave us unprecedented visibility. We saw a 200% increase in qualified leads within the first six months. Their team doesn't just deliver services; they deliver results."</blockquote>
                        <p class="client-name">Priya Sharma</p>
                        <p class="client-info">Marketing Director, SaffronStays Hospitality (Mumbai, India)</p>
                    </div>
                    <div class="testimonial-card gradient-card animate-on-scroll fade-in-up" style="animation-delay:0.3s;">
                        <div class="client-avatar" alt="Client Avatar - Ravi S.">RS</div> <!-- Use <img src="path/to/ravi-avatar.jpg" alt="Ravi Sharma"> -->
                        <blockquote>"As a fast-growing SaaS startup, we needed a robust and scalable IT infrastructure. Adzquare's team provided an impeccable cloud solution and custom software development that streamlined our operations completely. Their technical expertise and 24/7 support are truly world-class. They are not just a vendor, but a vital technology partner in our growth."</blockquote>
                        <p class="client-name">Rohan Mehta</p>
                        <p class="client-info">Founder & CEO, Tech-Verse Solutions (Bengaluru, India)</p>
                    </div>
                    <div class="testimonial-card gradient-card animate-on-scroll fade-in-right" style="animation-delay:0.4s;">
                        <div class="client-avatar" alt="Client Avatar - Sarah K.">SK</div> <!-- Use <img src="path/to/sarah-avatar.jpg" alt="Sarah K."> -->
                        <blockquote>"We always dreamed of taking our artisanal products to the global stage, but the complexity was overwhelming. Adzquare's expertise in international e-commerce and targeted PPC campaigns for the US and UK markets was phenomenal. They managed everything from lead generation to conversion optimization, effectively bridging the gap between our Indian craftsmanship and a global audience."</blockquote>
                        <p class="client-name">Arjun Reddy</p>
                        <p class="client-info">Head of E-commerce, CraftsOfIndia Retail Pvt. Ltd. (Jaipur, India)</p>
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
                        <summary class="faq-question">What makes Adzquare different from a typical marketing agency or IT firm?</summary>
                        <div class="faq-content">
                            <p>Our core difference is Integrated Expertise. A typical marketing agency can run ads but may not understand the underlying technology, leading to slow websites and lost conversions. An IT firm can build an app but may not know how to market it. <br> <br>
Adzquare bridges this gap. We build your digital infrastructure (website, apps, cloud) with marketing goals in mind from day one, and we execute marketing campaigns that leverage a deep understanding of the technology. This creates a seamless, high-performance digital ecosystem where every part works together to maximize your results.</p>
                        </div>
                    </details>
                    <details class="faq-item animate-on-scroll fade-in-up" style="animation-delay:0.3s;">
                        <summary class="faq-question">My last agency focused on clicks and likes. How do I know I'll get a real return on my investment (ROI) with you?</summary>
                        <div class="faq-content">
                            <p>We believe vanity metrics are a waste of your time and money. Our entire strategy is built around the KPIs that directly impact your bottom line: leads, customer acquisition cost, sales revenue, and overall profitability. We use advanced analytics to track every rupee and dollar spent, providing you with transparent, easy-to-understand reports that clearly connect our efforts to your business growth. We succeed when you succeed.</p>
                        </div>
                    </details>
                    <details class="faq-item animate-on-scroll fade-in-up" style="animation-delay:0.4s;">
                        <summary class="faq-question">My marketing and IT feel disconnected. Can you handle everything under one roof?</summary>
                        <div class="faq-content">
                            <p>Absolutely. This is the exact problem we solve. Managing separate vendors for SEO, web development, cloud hosting, and cybersecurity leads to miscommunication, delays, and missed opportunities. As your single, unified partner, we ensure your SEO expert is talking to your developer, and your cybersecurity lead is aligned with your e-commerce manager. The result is a faster, more secure, and more effective strategy where everyone is pulling in the same direction.</p>
                        </div>
                    </details>
                     <details class="faq-item animate-on-scroll fade-in-up" style="animation-delay:0.5s;">
                        <summary class="faq-question">We want to expand globally. How do you make a strategy work in different countries like the USA, UK, or Australia?</summary>
                        <div class="faq-content">
                            <p>This is our specialty. A successful global strategy is about localization, not just translation. We don't simply run the same ads in a different language. Our international teams conduct deep market research to understand the unique cultural nuances, consumer behaviors, and competitive landscapes of each region. We adapt your messaging, visuals, and platforms to be highly resonant and effective, turning your brand into a global player.</p>
                        </div>
                    </details>
                    <details class="faq-item animate-on-scroll fade-in-up" style="animation-delay:0.5s;">
                        <summary class="faq-question">What does the process look like from my first call to project launch?</summary>
                        <div class="faq-content">
                            <p>We follow a clear, transparent, and collaborative process to ensure we are aligned every step of the way:</p>
                            <ul>
                                <li>Discovery & Analysis: We start with a deep-dive session to understand your business, your goals, and your biggest challenges.</li>
                                <li>Strategy & Proposal: We present a custom-built, data-driven strategy and a detailed proposal with a clear scope, timeline, and deliverables. No surprises.</li>
                                <li>Onboarding & Kick-off: You meet your dedicated project manager and team. We set up all communication channels and finalize the project roadmap.</li>
                                <li>Execution & Reporting: We get to work, providing you with regular updates and comprehensive performance reports so you always know the status of your project and its impact.</li>
                            </ul>
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
