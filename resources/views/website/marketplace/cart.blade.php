<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your Shopping Cart - Adzquare</title>

    <!-- Google Fonts & Font Awesome -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&family=Orbitron:wght@400;500;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

    <!-- This should point to your single, unified stylesheet -->
    <link rel="stylesheet" href="/css/sub_style.css">

    <style>
        /* ================================================= */
        /*  2. CSS FOR CART PAGE & COUPONS (WITH FIX)        */
        /* ================================================= */

        /* --- Compact Offers Banner --- */
        .offers-notification-banner { background: var(--surface-color); border: 1px solid var(--border-color); border-radius: 12px; padding: 20px; margin-bottom: 30px; position: relative; display: none; }
        .offers-notification-banner.visible { display: block; }
        .offers-title { font-family: var(--font-heading); font-size: 1.2rem; color: var(--primary-accent); margin: 0 0 15px 0; display: flex; align-items: center; gap: 10px; }
        .offer-card { display: flex; flex-wrap: wrap; justify-content: space-between; align-items: center; gap: 10px 20px; padding: 10px 0; border-top: 1px solid var(--border-color); }
        .offer-details .offer-code { font-weight: 600; color: var(--text-color); background-color: #2a2a2a; padding: 2px 8px; border-radius: 5px; border: 1px dashed var(--primary-accent); margin-right: 10px; }
        .offer-details .offer-description { font-size: 0.9rem; color: var(--text-muted-color); display: inline; }
        .apply-offer-btn { background: transparent; border: 1px solid var(--primary-accent); color: var(--primary-accent); padding: 6px 16px; border-radius: 50px; cursor: pointer; font-weight: 600; transition: all 0.3s; white-space: nowrap; }
        .apply-offer-btn:hover { background-color: var(--primary-accent); color: white; }
        .close-banner-btn { position: absolute; top: 10px; right: 10px; background: none; border: none; color: var(--text-muted-color); font-size: 1.5rem; cursor: pointer; transition: color 0.3s; }
        .close-banner-btn:hover { color: var(--primary-accent); }

        /* --- Mobile-First Cart Layout --- */
        .cart-layout { display: flex; flex-direction: column; gap: 40px; }
        .order-summary { background-color: var(--surface-color); border: 1px solid var(--border-color); border-radius: 12px; padding: 25px; width: 100%; }

        .cart-items-list .cart-item { display: grid; grid-template-columns: 80px 1fr auto; gap: 15px; align-items: center; padding: 20px 0; border-bottom: 1px solid var(--border-color); }
        .cart-item-image img { width: 100%; height: 80px; object-fit: cover; border-radius: 8px; }
        .cart-item-details .item-name { font-family: var(--font-heading); font-size: 1.1rem; }
        .cart-item-details .item-category { font-size: 0.8rem; color: var(--text-muted-color); }
        .cart-item-actions { text-align: right; }
        .cart-item-actions .item-price { font-size: 1.2rem; font-weight: 600; display: block; margin-bottom: 10px; }
        .remove-item-btn { background: none; border: none; color: var(--text-muted-color); cursor: pointer; font-size: 0.8rem; transition: color 0.3s; }
        .remove-item-btn:hover { color: #ff4d4d; }

        .summary-title { font-family: var(--font-heading); font-size: 1.5rem; margin-bottom: 20px; border-bottom: 1px solid var(--border-color); padding-bottom: 15px; }
        .summary-row { display: flex; justify-content: space-between; margin-bottom: 15px; font-size: 1rem; }
        .summary-row .label { color: var(--text-muted-color); }
        .summary-total { margin-top: 15px; padding-top: 15px; border-top: 1px solid var(--border-color); font-size: 1.3rem; font-weight: 600; }
        .summary-total .amount { font-family: var(--font-heading); color: var(--primary-accent); }

        /* --- *** NEW: MOBILE-FRIENDLY COUPON SECTION *** --- */
        .coupon-section { margin-top: 25px; padding-top: 15px; border-top: 1px solid var(--border-color); }
        .coupon-input-group {
            display: flex;
            flex-direction: column; /* MOBILE: Stack input and button */
            gap: 10px;
            margin-bottom: 10px;
        }
        .coupon-input-group input {
            width: 100%;
            border: 1px solid var(--border-color);
            background-color: var(--card-bg);
            color: var(--text-color);
            padding: 12px 15px;
            border-radius: 50px; /* MOBILE: Fully rounded */
            font-size: 1rem;
            text-align: center;
        }
        .coupon-input-group button {
            width: 100%;
            border: 1px solid var(--primary-accent);
            background-color: var(--primary-accent);
            color: white;
            padding: 12px;
            border-radius: 50px; /* MOBILE: Fully rounded */
            cursor: pointer;
            font-family: var(--font-heading);
            font-size: 1rem;
        }
        .coupon-input-group input:focus { outline: none; border-color: var(--primary-accent); box-shadow: 0 0 0 3px var(--glow-color); }

        /* DESKTOP OVERRIDE: On screens wider than 500px, make it side-by-side */
        @media (min-width: 500px) {
            .coupon-input-group {
                flex-direction: row; /* DESKTOP: Side-by-side */
                gap: 0;
            }
            .coupon-input-group input {
                border-radius: 50px 0 0 50px; /* DESKTOP: Pill shape left */
                text-align: left;
            }
            .coupon-input-group button {
                width: auto; /* DESKTOP: Auto width */
                border-radius: 0 50px 50px 0; /* DESKTOP: Pill shape right */
                padding: 0 25px;
            }
        }

        .coupon-message { font-size: 0.9rem; height: 20px; text-align: center; }
        .coupon-message.success { color: var(--success-color); }
        .coupon-message.error { color: var(--error-color); }
        .checkout-btn { width: 100%; margin-top: 20px; text-align: center; }

        /* --- Desktop Layout --- */
        @media (min-width: 992px) {
            .cart-layout { flex-direction: row; align-items: flex-start; }
            .cart-items-section { flex: 2; }
            .order-summary { flex: 1; position: sticky; top: 120px; }
        }
        @media (max-width: 768px) {
            .section-title { font-size: 1.8rem; }
        }
    </style>
</head>
<body>

    @include('website.layouts.header')

    <main>
        <section class="section">
            <div class="container">
                <h1 class="section-title">Shopping<span> Cart</span></h1>

                <div class="offers-notification-banner" id="offers-banner">
                    <button class="close-banner-btn" id="close-offers-banner" aria-label="Dismiss offers">&times;</button>
                    <h2 class="offers-title"><i class="fas fa-tags"></i> Available Offers</h2>
                    <div class="offers-list" id="offers-list-container">
                        <!-- Dynamic Content -->
                    </div>
                </div>

                <div class="cart-layout" id="cart-container">
                    <div class="cart-items-section" id="cart-items-section">
                        <!-- Dynamic Content -->
                    </div>
                    <div class="order-summary" id="order-summary">
                        <h2 class="summary-title">Order Summary</h2>
                        <div class="summary-row">
                            <span class="label">Subtotal</span>
                            <span class="amount" id="summary-subtotal">$0.00</span>
                        </div>
                        <div class="summary-row" id="discount-row" style="display: none;">
                            <span class="label">Discount</span>
                            <span class="amount" id="summary-discount">-$0.00</span>
                        </div>
                        <div class="summary-row summary-total">
                            <span class="label">Total</span>
                            <span class="amount" id="summary-total">$0.00</span>
                        </div>
                        <div class="coupon-section">
                             <div class="coupon-input-group">
                                <input type="text" id="coupon-input" placeholder="Enter Coupon Code">
                                <button id="apply-coupon-btn">Apply</button>
                            </div>
                            <p class="coupon-message" id="coupon-message"></p>
                        </div>
                        <a href="/checkout" class="cta-button checkout-btn">
                            Proceed to Checkout
                        </a>
                    </div>
                </div>
            </div>
        </section>
    </main>

    @extends('website.layouts.footer')

    <!-- JAVASCRIPT (No changes needed here from previous version) -->
    <script>
    document.addEventListener('DOMContentLoaded', function() {
        const cartItems = [
            { id: 1, name: "Futuristic UI Kit", category: "UI Kits", price: 79.00, image: "https://images.unsplash.com/photo-1555774698-0b77e0ab232e?q=80&w=200&auto=format&fit=crop" },
            { id: 8, name: "AI Chatbot Script", category: "Scripts", price: 199.00, image: "https://images.unsplash.com/photo-1526628953301-3e589a6a8b74?q=80&w=200&auto=format&fit=crop" },
        ];
        const availableCoupons = {
            'SAVE20': { percent: 0.20, description: "Get 20% off your entire order." },
            'ADZQUARE50': { percent: 0.50, description: "Limited time: Get 50% OFF!" }
        };
        let appliedCoupon = null;
        const cartItemsSection = document.getElementById('cart-items-section');
        const orderSummary = document.getElementById('order-summary');
        const summarySubtotal = document.getElementById('summary-subtotal');
        const discountRow = document.getElementById('discount-row');
        const summaryDiscount = document.getElementById('summary-discount');
        const summaryTotal = document.getElementById('summary-total');
        const couponInput = document.getElementById('coupon-input');
        const applyCouponBtn = document.getElementById('apply-coupon-btn');
        const couponMessage = document.getElementById('coupon-message');
        const offersBanner = document.getElementById('offers-banner');
        const offersListContainer = document.getElementById('offers-list-container');
        const closeOffersBannerBtn = document.getElementById('close-offers-banner');

        const calculateTotals = () => {
            const subtotal = cartItems.reduce((total, item) => total + item.price, 0);
            let discountAmount = 0;
            if (appliedCoupon && availableCoupons[appliedCoupon]) {
                discountAmount = subtotal * availableCoupons[appliedCoupon].percent;
                discountRow.style.display = 'flex';
            } else {
                discountRow.style.display = 'none';
            }
            const total = subtotal - discountAmount;
            summarySubtotal.textContent = `$${subtotal.toFixed(2)}`;
            summaryDiscount.textContent = `-$${discountAmount.toFixed(2)}`;
            summaryTotal.textContent = `$${total.toFixed(2)}`;
        };

        const renderCart = () => {
            if (cartItems.length === 0) {
                cartItemsSection.innerHTML = `<div style="text-align:center; padding: 50px 0;"><i class="fas fa-shopping-cart" style="font-size:3rem; color: var(--primary-accent);"></i><p style="margin:20px 0;">Your cart is empty!</p><a href="/store" class="cta-button">Continue Shopping</a></div>`;
                orderSummary.style.display = 'none';
                offersBanner.style.display = 'none';
                return;
            }
            orderSummary.style.display = 'block';
            const itemsHTML = cartItems.map(item => `
                <div class="cart-item">
                    <div class="cart-item-image"><img src="${item.image}" alt="${item.name}"></div>
                    <div class="cart-item-details"><p class="item-name">${item.name}</p><p class="item-category">${item.category}</p></div>
                    <div class="cart-item-actions"><p class="item-price">$${item.price.toFixed(2)}</p><button class="remove-item-btn" data-id="${item.id}">Remove</button></div>
                </div>`).join('');
            cartItemsSection.innerHTML = `<div class="cart-items-list">${itemsHTML}</div>`;
            calculateTotals();
        };

        const renderOffers = () => {
            if (Object.keys(availableCoupons).length > 0) {
                offersBanner.classList.add('visible');
                offersListContainer.innerHTML = Object.entries(availableCoupons).map(([code, details]) => `
                    <div class="offer-card">
                        <div class="offer-details">
                            <span class="offer-code">${code}</span>
                            <p class="offer-description">${details.description}</p>
                        </div>
                        <button class="apply-offer-btn" data-code="${code}">Apply</button>
                    </div>`).join('');
            }
        };

        const applyCoupon = (code) => {
            const couponCode = code.trim().toUpperCase();
            if (availableCoupons[couponCode]) {
                appliedCoupon = couponCode;
                couponMessage.textContent = `Success! "${couponCode}" applied.`;
                couponMessage.className = 'coupon-message success';
                couponInput.value = couponCode;
                calculateTotals();
            } else {
                appliedCoupon = null;
                couponMessage.textContent = 'Invalid or expired coupon code.';
                couponMessage.className = 'coupon-message error';
                calculateTotals();
            }
        };

        applyCouponBtn.addEventListener('click', () => applyCoupon(couponInput.value));
        closeOffersBannerBtn.addEventListener('click', () => offersBanner.style.display = 'none');
        document.body.addEventListener('click', function(e) {
            if (e.target.classList.contains('remove-item-btn')) {
                const itemIdToRemove = parseInt(e.target.dataset.id);
                const itemIndex = cartItems.findIndex(item => item.id === itemIdToRemove);
                if (itemIndex > -1) {
                    cartItems.splice(itemIndex, 1);
                    renderCart();
                }
            }
            if (e.target.classList.contains('apply-offer-btn')) {
                applyCoupon(e.target.dataset.code);
            }
        });

        renderCart();
        renderOffers();
    });
    </script>
</body>
</html>
