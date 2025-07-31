<!DOCTYPE html>
<html lang="en">

@extends('website.layouts.app')

<body>
    <!-- Animated Backgrounds: Bubbles and Particles -->
    <div class="bg-animation-container"> <!-- For particle effects --> </div>
    <div class="bubbles"> <!-- For bubble effects --> </div>

    @include('website.layouts.header')

     <main>
        <section id="terms-content" class="section">
            <div class="container">
                <h1 class="section-title">Terms of <span>Service</span></h1>
                <p class="section-subtitle">Last updated: <span id="last-updated"></span></p>

                <div class="static-content">
                    <h2>1. Agreement to Terms</h2>
                    <p>By using our website and the services offered by Adzquare ("Service"), you agree to be bound by these Terms of Service ("Terms"). If you do not agree to these Terms, do not use the Service.</p>

                    <h2>2. Purchases and Payment</h2>
                    <p>If you wish to purchase any product or service made available through the Service ("Purchase"), you may be asked to supply certain information relevant to your Purchase including, without limitation, your credit card number, the expiration date of your credit card, and your billing address. You represent and warrant that you have the legal right to use any credit card(s) or other payment method(s) utilized in connection with any Purchase.</p>

                    <h2>3. Intellectual Property</h2>
                    <p>The Service and its original content (excluding content provided by users), features, and functionality are and will remain the exclusive property of Adzquare and its licensors. Our digital products are licensed to you, not sold. You may not copy, modify, distribute, sell, or lease any part of our Service or included software, nor may you reverse engineer or attempt to extract the source code of that software.</p>

                    <h2>4. User Accounts</h2>
                    <p>When you create an account with us, you must provide us with information that is accurate, complete, and current at all times. Failure to do so constitutes a breach of the Terms, which may result in immediate termination of your account on our Service. You are responsible for safeguarding the password that you use to access the Service and for any activities or actions under your password.</p>

                    <h2>5. Termination</h2>
                    <p>We may terminate or suspend your account immediately, without prior notice or liability, for any reason whatsoever, including without limitation if you breach the Terms. Upon termination, your right to use the Service will immediately cease.</p>

                    <h2>6. Limitation of Liability</h2>
                    <p>In no event shall Adzquare, nor its directors, employees, partners, agents, suppliers, or affiliates, be liable for any indirect, incidental, special, consequential or punitive damages, including without limitation, loss of profits, data, use, goodwill, or other intangible losses, resulting from your access to or use of or inability to access or use the Service.</p>

                    <h2>7. Changes to These Terms</h2>
                    <p>We reserve the right, at our sole discretion, to modify or replace these Terms at any time. We will provide at least 30 days' notice prior to any new terms taking effect. By continuing to access or use our Service after those revisions become effective, you agree to be bound by the revised terms.</p>

                    <h2>8. Contact Us</h2>
                    <p>If you have any questions about these Terms, please contact us at:</p>
                    <p>Email: <a href="mailto:support@adzquare.com">support@adzquare.com</a></p>
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
