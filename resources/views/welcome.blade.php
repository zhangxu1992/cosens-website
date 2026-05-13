@extends('layouts.app')

@section('title', 'Cosens - Industrial Water Treatment Solutions')
@section('meta_description', 'Cosens provides professional industrial water treatment equipment including stainless steel tanks, FRP tanks, filtration systems, and custom solutions. Factory direct with 15+ years experience.')

@section('content')
<style>
    /* Hero Section */
    .hero {
        background: linear-gradient(135deg, var(--primary) 0%, var(--primary-light) 100%);
        color: white;
        padding: 5rem 0;
        position: relative;
        overflow: hidden;
    }

    .hero::before {
        content: '';
        position: absolute;
        top: 0;
        right: 0;
        width: 50%;
        height: 100%;
        background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100"><circle cx="80" cy="20" r="40" fill="rgba(255,255,255,0.03)"/><circle cx="90" cy="80" r="30" fill="rgba(255,255,255,0.02)"/></svg>');
        background-size: cover;
    }

    .hero .container {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 4rem;
        align-items: center;
        position: relative;
        z-index: 1;
    }

    .hero-content h1 {
        font-size: 3.5rem;
        font-weight: 800;
        line-height: 1.1;
        margin-bottom: 1.5rem;
    }

    .hero-content h1 span {
        color: var(--accent);
    }

    .hero-content p {
        font-size: 1.25rem;
        opacity: 0.9;
        margin-bottom: 2rem;
        line-height: 1.8;
    }

    .hero-buttons {
        display: flex;
        gap: 1rem;
        flex-wrap: wrap;
    }

    .btn {
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        padding: 0.875rem 2rem;
        border-radius: 8px;
        font-weight: 600;
        font-size: 1rem;
        transition: all 0.2s;
        border: none;
        cursor: pointer;
    }

    .btn-primary {
        background: var(--accent);
        color: white;
    }

    .btn-primary:hover {
        background: var(--accent-hover);
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(230, 126, 34, 0.4);
    }

    .btn-outline {
        background: transparent;
        color: white;
        border: 2px solid rgba(255,255,255,0.3);
    }

    .btn-outline:hover {
        background: rgba(255,255,255,0.1);
        border-color: white;
    }

    .hero-image {
        display: flex;
        justify-content: center;
        align-items: center;
    }

    .hero-image-placeholder {
        width: 100%;
        max-width: 500px;
        aspect-ratio: 4/3;
        background: rgba(255,255,255,0.1);
        border-radius: 16px;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        border: 2px dashed rgba(255,255,255,0.2);
    }

    .hero-image-placeholder svg {
        width: 80px;
        height: 80px;
        opacity: 0.5;
        margin-bottom: 1rem;
    }

    .hero-image-placeholder p {
        opacity: 0.6;
        font-size: 0.875rem;
    }

    /* Stats Section */
    .stats {
        background: var(--bg-white);
        padding: 3rem 0;
        border-bottom: 1px solid var(--border);
    }

    .stats-grid {
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        gap: 2rem;
    }

    .stat-item {
        text-align: center;
        padding: 1.5rem;
    }

    .stat-number {
        font-size: 2.5rem;
        font-weight: 800;
        color: var(--primary);
        display: block;
    }

    .stat-label {
        color: var(--text-light);
        font-size: 0.875rem;
        margin-top: 0.5rem;
    }

    /* Section Header */
    .section-header {
        text-align: center;
        margin-bottom: 3rem;
    }

    .section-header h2 {
        font-size: 2.25rem;
        font-weight: 700;
        color: var(--text-dark);
        margin-bottom: 0.75rem;
    }

    .section-header p {
        color: var(--text-light);
        font-size: 1.125rem;
        max-width: 600px;
        margin: 0 auto;
    }

    /* Products Section */
    .products {
        padding: 5rem 0;
        background: var(--bg-light);
    }

    .products-grid {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 2rem;
    }

    .product-card {
        background: white;
        border-radius: 12px;
        overflow: hidden;
        box-shadow: var(--shadow-sm);
        transition: all 0.3s;
    }

    .product-card:hover {
        transform: translateY(-4px);
        box-shadow: var(--shadow-lg);
    }

    .product-image {
        aspect-ratio: 4/3;
        background: var(--bg-light);
        display: flex;
        align-items: center;
        justify-content: center;
        position: relative;
    }

    .product-image svg {
        width: 64px;
        height: 64px;
        color: var(--text-light);
        opacity: 0.5;
    }

    .product-badge {
        position: absolute;
        top: 1rem;
        left: 1rem;
        background: var(--accent);
        color: white;
        padding: 0.25rem 0.75rem;
        border-radius: 4px;
        font-size: 0.75rem;
        font-weight: 600;
    }

    .product-info {
        padding: 1.5rem;
    }

    .product-info h3 {
        font-size: 1.125rem;
        font-weight: 600;
        margin-bottom: 0.5rem;
    }

    .product-info p {
        color: var(--text-light);
        font-size: 0.875rem;
        margin-bottom: 1rem;
    }

    .product-link {
        color: var(--primary);
        font-weight: 600;
        font-size: 0.875rem;
        display: inline-flex;
        align-items: center;
        gap: 0.25rem;
    }

    .product-link:hover {
        color: var(--accent);
    }

    /* About Section */
    .about {
        padding: 5rem 0;
        background: var(--bg-white);
    }

    .about .container {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 4rem;
        align-items: center;
    }

    .about-image {
        aspect-ratio: 4/3;
        background: var(--bg-light);
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .about-image svg {
        width: 80px;
        height: 80px;
        color: var(--text-light);
        opacity: 0.5;
    }

    .about-content h2 {
        font-size: 2.25rem;
        font-weight: 700;
        margin-bottom: 1rem;
    }

    .about-content p {
        color: var(--text-medium);
        margin-bottom: 1rem;
        line-height: 1.8;
    }

    .about-features {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 1rem;
        margin: 1.5rem 0;
    }

    .about-feature {
        display: flex;
        align-items: center;
        gap: 0.5rem;
        font-size: 0.875rem;
    }

    .about-feature svg {
        width: 20px;
        height: 20px;
        color: var(--success);
    }

    /* Why Choose Us */
    .why-us {
        padding: 5rem 0;
        background: var(--bg-light);
    }

    .why-grid {
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        gap: 2rem;
    }

    .why-card {
        background: white;
        padding: 2rem;
        border-radius: 12px;
        text-align: center;
        box-shadow: var(--shadow-sm);
        transition: all 0.3s;
    }

    .why-card:hover {
        transform: translateY(-4px);
        box-shadow: var(--shadow-lg);
    }

    .why-icon {
        width: 64px;
        height: 64px;
        background: var(--primary);
        border-radius: 16px;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 1.5rem;
        color: white;
    }

    .why-icon svg {
        width: 32px;
        height: 32px;
    }

    .why-card h3 {
        font-size: 1.125rem;
        font-weight: 600;
        margin-bottom: 0.75rem;
    }

    .why-card p {
        color: var(--text-light);
        font-size: 0.875rem;
        line-height: 1.6;
    }

    /* Process Section */
    .process {
        padding: 5rem 0;
        background: var(--bg-white);
    }

    .process-steps {
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        gap: 2rem;
        position: relative;
    }

    .process-step {
        text-align: center;
        position: relative;
    }

    .process-step:not(:last-child)::after {
        content: '';
        position: absolute;
        top: 40px;
        right: -1rem;
        width: 2rem;
        height: 2px;
        background: var(--border);
    }

    .step-number {
        width: 80px;
        height: 80px;
        background: var(--primary);
        color: white;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.5rem;
        font-weight: 700;
        margin: 0 auto 1.5rem;
    }

    .process-step h3 {
        font-size: 1.125rem;
        font-weight: 600;
        margin-bottom: 0.75rem;
    }

    .process-step p {
        color: var(--text-light);
        font-size: 0.875rem;
    }

    /* CTA Section */
    .cta {
        background: linear-gradient(135deg, var(--primary) 0%, var(--primary-light) 100%);
        color: white;
        padding: 4rem 0;
        text-align: center;
    }

    .cta h2 {
        font-size: 2.25rem;
        font-weight: 700;
        margin-bottom: 1rem;
    }

    .cta p {
        font-size: 1.125rem;
        opacity: 0.9;
        margin-bottom: 2rem;
        max-width: 600px;
        margin-left: auto;
        margin-right: auto;
    }

    /* Responsive */
    @media (max-width: 1024px) {
        .hero .container {
            grid-template-columns: 1fr;
            text-align: center;
        }

        .hero-content h1 {
            font-size: 2.5rem;
        }

        .hero-buttons {
            justify-content: center;
        }

        .hero-image {
            display: none;
        }

        .about .container {
            grid-template-columns: 1fr;
        }

        .about-image {
            display: none;
        }

        .products-grid {
            grid-template-columns: repeat(2, 1fr);
        }

        .why-grid {
            grid-template-columns: repeat(2, 1fr);
        }

        .process-steps {
            grid-template-columns: repeat(2, 1fr);
        }

        .process-step:not(:last-child)::after {
            display: none;
        }
    }

    @media (max-width: 640px) {
        .stats-grid {
            grid-template-columns: repeat(2, 1fr);
        }

        .products-grid {
            grid-template-columns: 1fr;
        }

        .why-grid {
            grid-template-columns: 1fr;
        }

        .process-steps {
            grid-template-columns: 1fr;
        }

        .hero-content h1 {
            font-size: 2rem;
        }
    }
</style>

<!-- Hero Section -->
<section class="hero">
    <div class="container">
        <div class="hero-content">
            <h1>{{ __('Industrial Water Treatment') }} <span>{{ __('Solutions') }}</span></h1>
            <p>{{ __('Cosens provides professional water treatment equipment including stainless steel tanks, FRP tanks, filtration systems, and custom solutions. With 15+ years of manufacturing experience, we serve clients across 100+ countries.') }}</p>
            <div class="hero-buttons">
                <a href="/products" class="btn btn-primary">
                    <svg width="20" height="20" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M4 6h16M4 12h16M4 18h16"/></svg>
                    {{ __('View All Products') }}
                </a>
                <a href="/quote" class="btn btn-outline">
                    <svg width="20" height="20" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"/></svg>
                    {{ __('Get a Quote') }}
                </a>
            </div>
        </div>
        <div class="hero-image">
            <div class="hero-image-placeholder">
                <svg fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m2.25 0H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 00-9-9z"/></svg>
                <p>{{ __('Hero Image Placeholder') }}</p>
            </div>
        </div>
    </div>
</section>

<!-- Stats Section -->
<section class="stats">
    <div class="container">
        <div class="stats-grid">
            <div class="stat-item">
                <span class="stat-number">15+</span>
                <div class="stat-label">{{ __('Years Experience') }}</div>
            </div>
            <div class="stat-item">
                <span class="stat-number">100+</span>
                <div class="stat-label">{{ __('Countries Served') }}</div>
            </div>
            <div class="stat-item">
                <span class="stat-number">28000+</span>
                <div class="stat-label">{{ __('Happy Clients') }}</div>
            </div>
            <div class="stat-item">
                <span class="stat-number">50+</span>
                <div class="stat-label">{{ __('Certifications') }}</div>
            </div>
        </div>
    </div>
</section>

<!-- Products Section -->
<section class="products">
    <div class="container">
        <div class="section-header">
            <h2>{{ __('Hot Products') }}</h2>
            <p>{{ __('Discover our range of high-quality water treatment equipment designed for industrial applications') }}</p>
        </div>
        <div class="products-grid">
            <div class="product-card">
                <div class="product-image">
                    <span class="product-badge">{{ __('Hot') }}</span>
                    <svg fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/></svg>
                </div>
                <div class="product-info">
                    <h3>{{ __('Stainless Steel Water Tank') }}</h3>
                    <p>{{ __('High-quality SS304/SS316 water storage tanks for industrial and commercial use.') }}</p>
                    <a href="/products/stainless-steel-tank" class="product-link">
                        {{ __('Learn More') }} →
                    </a>
                </div>
            </div>
            <div class="product-card">
                <div class="product-image">
                    <svg fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m0 12.75h7.5m-7.5 3H12M10.5 2.25H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 00-9-9z"/></svg>
                </div>
                <div class="product-info">
                    <h3>{{ __('Stainless Steel Filter Tank') }}</h3>
                    <p>{{ __('Mechanical and activated carbon filter tanks for water purification systems.') }}</p>
                    <a href="/products/filter-tank" class="product-link">
                        {{ __('Learn More') }} →
                    </a>
                </div>
            </div>
            <div class="product-card">
                <div class="product-image">
                    <span class="product-badge">{{ __('New') }}</span>
                    <svg fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path d="M9.75 3.104v5.714a2.25 2.25 0 01-.659 1.591L5 14.5M9.75 3.104c-.251.023-.501.05-.75.082m.75-.082a24.301 24.301 0 014.5 0m0 0v5.714c0 .597.237 1.17.659 1.591L19.8 15.3M14.25 3.104c.251.023.501.05.75.082M19.8 15.3l-1.57.393A9.065 9.065 0 0112 15a9.065 9.065 0 00-6.23.693L5 14.5m14.8.8l1.402 1.402c1.232 1.232.65 3.318-1.067 3.611A48.309 48.309 0 0112 21c-2.773 0-5.491-.235-8.135-.687-1.718-.293-2.3-2.379-1.067-3.61L5 14.5"/></svg>
                </div>
                <div class="product-info">
                    <h3>{{ __('FRP Pressure Vessel') }}</h3>
                    <p>{{ __('Fiberglass reinforced plastic tanks for corrosion-resistant water treatment.') }}</p>
                    <a href="/products/frp-vessel" class="product-link">
                        {{ __('Learn More') }} →
                    </a>
                </div>
            </div>
            <div class="product-card">
                <div class="product-image">
                    <svg fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path d="M4.5 12a7.5 7.5 0 0015 0m-15 0a7.5 7.5 0 1115 0m-15 0H3m16.5 0H21m-1.5 0H12m-8.457 3.077l1.41-.513m14.095-5.13l1.41-.513M5.106 17.785l1.15-.964m11.49-9.642l1.149-.964M7.501 19.795l.75-1.3m7.5-12.99l.75-1.3m-6.063 16.658l.26-1.477m2.605-14.772l.26-1.477m0 17.726l-.26-1.477M10.698 4.614l-.26-1.477M16.5 19.795l-1.15-.964m-7.125-12.99l-1.15-.964m-1.378 14.826l-.26-1.477M3 21h18M12.75 3.375v17.25"/></svg>
                </div>
                <div class="product-info">
                    <h3>{{ __('Mixing Tank') }}</h3>
                    <p>{{ __('Industrial mixing and stirring tanks for chemical processing applications.') }}</p>
                    <a href="/products/mixing-tank" class="product-link">
                        {{ __('Learn More') }} →
                    </a>
                </div>
            </div>
            <div class="product-card">
                <div class="product-image">
                    <svg fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path d="M15 11.25l-3-3m0 0l-3 3m3-3v7.5M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                </div>
                <div class="product-info">
                    <h3>{{ __('Insulated Water Tank') }}</h3>
                    <p>{{ __('Thermal insulated storage tanks for temperature-sensitive applications.') }}</p>
                    <a href="/products/insulated-tank" class="product-link">
                        {{ __('Learn More') }} →
                    </a>
                </div>
            </div>
            <div class="product-card">
                <div class="product-image">
                    <svg fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path d="M21 7.5l-9-5.25L3 7.5m18 0l-9 5.25m9-5.25v9l-9 5.25M3 7.5l9 5.25M3 7.5v9l9 5.25m0-9v9"/></svg>
                </div>
                <div class="product-info">
                    <h3>{{ __('Custom Solutions') }}</h3>
                    <p>{{ __('Tailored water treatment systems designed to meet your specific requirements.') }}</p>
                    <a href="/products/custom" class="product-link">
                        {{ __('Learn More') }} →
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- About Section -->
<section class="about">
    <div class="container">
        <div class="about-image">
            <svg fill="none" stroke="currentColor" stroke-width="1" viewBox="0 0 24 24"><path d="M2.25 21h19.5m-18-18v18m10.5-18v18m6-13.5V21M6.75 6.75h.75m-.75 3h.75m-.75 3h.75m3-6h.75m-.75 3h.75m-.75 3h.75M6.75 21v-3.375c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21M3 3h12m-.75 4.5H21m-3.75 3.75h.008v.008h-.008v-.008zm0 3h.008v.008h-.008v-.008zm0 3h.008v.008h-.008v-.008z"/></svg>
        </div>
        <div class="about-content">
            <h2>{{ __('About Cosens') }}</h2>
            <p>{{ __('Cosens is a leading manufacturer of industrial water treatment equipment. We specialize in stainless steel tanks, FRP vessels, filtration systems, and custom water treatment solutions.') }}</p>
            <p>{{ __('With over 15 years of experience, we serve clients in electronics, power generation, pharmaceuticals, chemicals, and food & beverage industries across 100+ countries.') }}</p>
            <div class="about-features">
                <div class="about-feature">
                    <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M5 13l4 4L19 7"/></svg>
                    {{ __('ISO 9001 Certified') }}
                </div>
                <div class="about-feature">
                    <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M5 13l4 4L19 7"/></svg>
                    {{ __('Factory Direct') }}
                </div>
                <div class="about-feature">
                    <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M5 13l4 4L19 7"/></svg>
                    {{ __('Custom Design') }}
                </div>
                <div class="about-feature">
                    <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M5 13l4 4L19 7"/></svg>
                    {{ __('Global Shipping') }}
                </div>
            </div>
            <a href="/about" class="btn btn-primary">{{ __('Read More') }}</a>
        </div>
    </div>
</section>

<!-- Why Choose Us -->
<section class="why-us">
    <div class="container">
        <div class="section-header">
            <h2>{{ __('Why Choose Us') }}</h2>
            <p>{{ __('We are committed to providing the best water treatment solutions for your business') }}</p>
        </div>
        <div class="why-grid">
            <div class="why-card">
                <div class="why-icon">
                    <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M12 6v6h4.5m4.5 0a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                </div>
                <h3>{{ __('Experience') }}</h3>
                <p>{{ __('15+ years of professional manufacturing experience in water treatment equipment industry.') }}</p>
            </div>
            <div class="why-card">
                <div class="why-icon">
                    <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M12 6v12m-3-2.818l.879.659c1.171.879 3.07.879 4.242 0 1.172-.879 1.172-2.303 0-3.182C13.536 12.219 12.768 12 12 12c-.725 0-1.45-.22-2.003-.659-1.106-.879-1.106-2.303 0-3.182s2.9-.879 4.006 0l.415.33M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                </div>
                <h3>{{ __('Competitive Price') }}</h3>
                <p>{{ __('Factory direct sales, saving middleman costs. Prices 10-15% lower than competitors.') }}</p>
            </div>
            <div class="why-card">
                <div class="why-icon">
                    <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M18 18.72a9.094 9.094 0 003.741-.479 3 3 0 00-4.682-2.72m.94 3.198l.001.031c0 .225-.012.447-.037.666A11.944 11.944 0 0112 21c-2.17 0-4.207-.576-5.963-1.584A6.062 6.062 0 016 18.719m12 0a5.971 5.971 0 00-.941-3.197m0 0A5.995 5.995 0 0012 12.75a5.995 5.995 0 00-5.058 2.772m0 0a3 3 0 00-4.681 2.72 8.986 8.986 0 003.74.477m.94-3.197a5.971 5.971 0 00-.94 3.197M15 6.75a3 3 0 11-6 0 3 3 0 016 0zm6 3a2.25 2.25 0 11-4.5 0 2.25 2.25 0 014.5 0zm-13.5 0a2.25 2.25 0 11-4.5 0 2.25 2.25 0 014.5 0z"/></svg>
                </div>
                <h3>{{ __('After-Sales Service') }}</h3>
                <p>{{ __('Complete customer files, regular equipment tracking, and prompt problem resolution.') }}</p>
            </div>
            <div class="why-card">
                <div class="why-icon">
                    <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M3.75 13.5l10.5-11.25L12 10.5h8.25L9.75 21.75 12 13.5H3.75z"/></svg>
                </div>
                <h3>{{ __('Fast Delivery') }}</h3>
                <p>{{ __('Strong production capacity ensures on-time and rapid delivery for all orders.') }}</p>
            </div>
        </div>
    </div>
</section>

<!-- Process Section -->
<section class="process">
    <div class="container">
        <div class="section-header">
            <h2>{{ __('Production Process') }}</h2>
            <p>{{ __('From raw materials to finished products, every step is carefully controlled') }}</p>
        </div>
        <div class="process-steps">
            <div class="process-step">
                <div class="step-number">1</div>
                <h3>{{ __('Plate Cutting') }}</h3>
                <p>{{ __('Raw materials are cut into appropriate shapes according to product drawings.') }}</p>
            </div>
            <div class="process-step">
                <div class="step-number">2</div>
                <h3>{{ __('Bending') }}</h3>
                <p>{{ __('Plates are bent or rolled into the required curvature for welding.') }}</p>
            </div>
            <div class="process-step">
                <div class="step-number">3</div>
                <h3>{{ __('Welding') }}</h3>
                <p>{{ __('Components are welded together according to specifications by skilled workers.') }}</p>
            </div>
            <div class="process-step">
                <div class="step-number">4</div>
                <h3>{{ __('Polishing') }}</h3>
                <p>{{ __('Surface finishing and quality inspection before packaging and delivery.') }}</p>
            </div>
        </div>
    </div>
</section>

<!-- CTA Section -->
<section class="cta">
    <div class="container">
        <h2>{{ __('Ready to Get Started?') }}</h2>
        <p>{{ __('Contact us today for a free consultation and quote. Our team is ready to help you find the perfect water treatment solution.') }}</p>
        <a href="/quote" class="btn btn-primary" style="font-size: 1.125rem; padding: 1rem 2.5rem;">
            <svg width="24" height="24" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"/></svg>
            {{ __('Request a Quote') }}
        </a>
    </div>
</section>
@endsection
