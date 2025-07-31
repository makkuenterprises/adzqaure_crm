<!DOCTYPE html>
<html lang="en">

@extends('website.layouts.app')

<body>
    <!-- Animated Backgrounds: Bubbles and Particles -->
    <div class="bg-animation-container"> <!-- For particle effects --> </div>
    <div class="bubbles"> <!-- For bubble effects --> </div>

    @include('website.layouts.header')

    <main>
        <section id="policy-content" class="section">
            <div class="container">
                <h1 class="section-title"><span>Privacy</span> Policy</h1>
                <p class="section-subtitle">Last updated: <span id="last-updated"></span></p>

                <div class="static-content">
                    <h2>Introduction</h2>
                    <p>Welcome to Adzquare. We respect your privacy and are committed to protecting your personal data. This privacy policy will inform you as to how we look after your personal data when you visit our website (regardless of where you visit it from) and tell you about your privacy rights and how the law protects you.</p>

                    <h2>Information We Collect</h2>
                    <p>We may collect, use, store, and transfer different kinds of personal data about you which we have grouped together as follows:</p>
                    <ul>
                        <li><strong>Identity Data</strong> includes first name, last name, username or similar identifier.</li>
                        <li><strong>Contact Data</strong> includes billing address, delivery address, email address, and telephone numbers.</li>
                        <li><strong>Financial Data</strong> includes payment card details.</li>
                        <li><strong>Transaction Data</strong> includes details about payments to and from you and other details of products and services you have purchased from us.</li>
                        <li><strong>Technical Data</strong> includes internet protocol (IP) address, your login data, browser type and version, time zone setting and location, browser plug-in types and versions, operating system and platform, and other technology on the devices you use to access this website.</li>
                        <li><strong>Usage Data</strong> includes information about how you use our website, products, and services.</li>
                    </ul>

                    <h2>How We Use Your Information</h2>
                    <p>We will only use your personal data when the law allows us to. Most commonly, we will use your personal data in the following circumstances:</p>
                    <ul>
                        <li>To process and deliver your order including managing payments, fees, and charges.</li>
                        <li>To manage our relationship with you which will include notifying you about changes to our terms or privacy policy.</li>
                        <li>To administer and protect our business and this website (including troubleshooting, data analysis, testing, system maintenance, support, reporting and hosting of data).</li>
                        <li>To use data analytics to improve our website, products/services, marketing, customer relationships and experiences.</li>
                    </ul>

                    <h2>Data Security</h2>
                    <p>We have put in place appropriate security measures to prevent your personal data from being accidentally lost, used, or accessed in an unauthorized way, altered, or disclosed. In addition, we limit access to your personal data to those employees, agents, contractors and other third parties who have a business need to know.</p>

                    <h2>Your Legal Rights</h2>
                    <p>Under certain circumstances, you have rights under data protection laws in relation to your personal data. These include the right to request access, correction, erasure, or transfer of your personal data. You also have the right to withdraw consent.</p>

                    <h2>Contact Us</h2>
                    <p>If you have any questions about this privacy policy or our privacy practices, please contact us at:</p>
                    <p>Email: <a href="mailto:privacy@adzquare.com">privacy@adzquare.com</a></p>
                    <p>Address: 123 Innovation Drive, Tech City, Silicon Valley, Global</p>
                </div>
            </div>
        </section>
    </main>

    @extends('website.layouts.footer')

    <script>
    document.addEventListener('DOMContentLoaded', function() {
        // --- Copyright Year ---
        const currentYearSpan = document.getElementById('currentYear');
        if (currentYearSpan) {
            currentYearSpan.textContent = new Date().getFullYear();
        }

        // --- Last Updated Date ---
        const lastUpdatedSpan = document.getElementById('last-updated');
        if(lastUpdatedSpan) {
            lastUpdatedSpan.textContent = new Date().toLocaleDateString('en-US', { year: 'numeric', month: 'long', day: 'numeric' });
        }

        // --- Side Menu (Navigation) Logic ---
        const menuToggleButton = document.getElementById('menu-toggle-button');
        const sideMenu = document.getElementById('side-menu');
        const mainOverlay = document.getElementById('main-overlay');
        const body = document.body;

        const openMenu = () => {
            sideMenu.classList.add('open');
            menuToggleButton.classList.add('open');
            mainOverlay.classList.add('active');
            body.style.overflow = 'hidden';
        };

        const closeMenu = () => {
            sideMenu.classList.remove('open');
            menuToggleButton.classList.remove('open');
            mainOverlay.classList.remove('active');
            body.style.overflow = '';
        };

        menuToggleButton.addEventListener('click', () => {
            sideMenu.classList.contains('open') ? closeMenu() : openMenu();
        });

        mainOverlay.addEventListener('click', closeMenu);
        document.querySelectorAll('.side-menu .nav-links a').forEach(link => {
            link.addEventListener('click', closeMenu);
        });
    });
    </script>

</body>
</html>
