@extends('layouts.app')

@section('title', 'About Us - Cosens Industrial Water Treatment')
@section('meta_description', 'Learn about Cosens - 15+ years of experience in manufacturing industrial water treatment equipment. Serving 100+ countries worldwide.')

@section('content')
<style>
    .page-header {
        background: linear-gradient(135deg, var(--primary) 0%, var(--primary-light) 100%);
        color: white;
        padding: 4rem 0;
        text-align: center;
    }

    .page-header h1 {
        font-size: 2.5rem;
        font-weight: 700;
        margin-bottom: 0.5rem;
    }

    .about-section {
        padding: 4rem 0;
        background: var(--bg-white);
    }

    .about-content {
        max-width: 800px;
        margin: 0 auto;
    }

    .about-content h2 {
        font-size: 2rem;
        font-weight: 700;
        margin-bottom: 1.5rem;
        text-align: center;
    }

    .about-content p {
        color: var(--text-medium);
        line-height: 1.8;
        margin-bottom: 1rem;
        font-size: 1.125rem;
    }

    .stats-section {
        padding: 4rem 0;
        background: var(--bg-light);
    }

    .stats-grid {
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        gap: 2rem;
    }

    .stat-card {
        background: white;
        padding: 2rem;
        border-radius: 12px;
        text-align: center;
        box-shadow: var(--shadow-sm);
    }

    .stat-number {
        font-size: 2.5rem;
        font-weight: 800;
        color: var(--primary);
    }

    .stat-label {
        color: var(--text-light);
        margin-top: 0.5rem;
    }

    .values-section {
        padding: 4rem 0;
        background: var(--bg-white);
    }

    .values-grid {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 2rem;
    }

    .value-card {
        text-align: center;
        padding: 2rem;
    }

    .value-icon {
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

    .value-icon svg {
        width: 32px;
        height: 32px;
    }

    .value-card h3 {
        font-size: 1.25rem;
        font-weight: 600;
        margin-bottom: 0.75rem;
    }

    .value-card p {
        color: var(--text-light);
    }

    @media (max-width: 768px) {
        .stats-grid {
            grid-template-columns: repeat(2, 1fr);
        }

        .values-grid {
            grid-template-columns: 1fr;
        }
    }
</style>

<section class="page-header">
    <div class="container">
        <h1>{{ __('About Cosens') }}</h1>
        <p>{{ __('Leading manufacturer of industrial water treatment equipment') }}</p>
    </div>
</section>

<section class="about-section">
    <div class="container">
        <div class="about-content">
            <h2>{{ __('Our Story') }}</h2>
            <p>
                Cosens is a professional manufacturer specializing in industrial water treatment equipment.
                With over 15 years of experience, we have established ourselves as a trusted partner for
                businesses across the globe.
            </p>
            <p>
                Our product range includes stainless steel water tanks, FRP pressure vessels, filtration systems,
                mixing tanks, and custom water treatment solutions. We serve diverse industries including electronics,
                power generation, pharmaceuticals, chemicals, and food & beverage.
            </p>
            <p>
                At Cosens, we are committed to quality, innovation, and customer satisfaction. Our state-of-the-art
                manufacturing facility, combined with our experienced engineering team, allows us to deliver
                products that meet the highest international standards.
            </p>
        </div>
    </div>
</section>

<section class="stats-section">
    <div class="container">
        <div class="stats-grid">
            <div class="stat-card">
                <div class="stat-number">15+</div>
                <div class="stat-label">{{ __('Years Experience') }}</div>
            </div>
            <div class="stat-card">
                <div class="stat-number">100+</div>
                <div class="stat-label">{{ __('Countries Served') }}</div>
            </div>
            <div class="stat-card">
                <div class="stat-number">28000+</div>
                <div class="stat-label">{{ __('Happy Clients') }}</div>
            </div>
            <div class="stat-card">
                <div class="stat-number">50+</div>
                <div class="stat-label">{{ __('Certifications') }}</div>
            </div>
        </div>
    </div>
</section>

<section class="values-section">
    <div class="container">
        <div class="section-header">
            <h2>{{ __('Our Values') }}</h2>
            <p>{{ __('The principles that guide everything we do') }}</p>
        </div>
        <div class="values-grid">
            <div class="value-card">
                <div class="value-icon">
                    <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/></svg>
                </div>
                <h3>{{ __('Quality First') }}</h3>
                <p>{{ __('We never compromise on quality. Every product undergoes rigorous testing and inspection.') }}</p>
            </div>
            <div class="value-card">
                <div class="value-icon">
                    <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M13 10V3L4 14h7v7l9-11h-7z"/></svg>
                </div>
                <h3>{{ __('Innovation') }}</h3>
                <p>{{ __('We continuously invest in R&D to bring the latest technology to our products.') }}</p>
            </div>
            <div class="value-card">
                <div class="value-icon">
                    <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/></svg>
                </div>
                <h3>{{ __('Customer Focus') }}</h3>
                <p>{{ __('Our customers are at the heart of everything we do. We listen, adapt, and deliver.') }}</p>
            </div>
        </div>
    </div>
</section>
@endsection
