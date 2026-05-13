@extends('layouts.app')

@section('title', 'Case Studies - Cosens Industrial Water Treatment')
@section('meta_description', 'Explore Cosens case studies and success stories from clients worldwide.')

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

    .cases-section {
        padding: 4rem 0;
        background: var(--bg-light);
    }

    .cases-grid {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 2rem;
    }

    .case-card {
        background: white;
        border-radius: 12px;
        overflow: hidden;
        box-shadow: var(--shadow-sm);
        transition: all 0.3s;
    }

    .case-card:hover {
        transform: translateY(-4px);
        box-shadow: var(--shadow-lg);
    }

    .case-image {
        aspect-ratio: 16/9;
        background: var(--bg-light);
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .case-image svg {
        width: 64px;
        height: 64px;
        color: var(--text-light);
        opacity: 0.5;
    }

    .case-content {
        padding: 1.5rem;
    }

    .case-tag {
        display: inline-block;
        background: var(--primary);
        color: white;
        padding: 0.25rem 0.75rem;
        border-radius: 4px;
        font-size: 0.75rem;
        font-weight: 500;
        margin-bottom: 0.75rem;
    }

    .case-content h3 {
        font-size: 1.25rem;
        font-weight: 600;
        margin-bottom: 0.75rem;
    }

    .case-content p {
        color: var(--text-light);
        font-size: 0.875rem;
        line-height: 1.6;
        margin-bottom: 1rem;
    }

    .case-meta {
        display: flex;
        gap: 1rem;
        font-size: 0.875rem;
        color: var(--text-light);
    }

    @media (max-width: 768px) {
        .cases-grid {
            grid-template-columns: 1fr;
        }
    }
</style>

<section class="page-header">
    <div class="container">
        <h1>{{ __('Case Studies') }}</h1>
        <p>{{ __('Success stories from our clients worldwide') }}</p>
    </div>
</section>

<section class="cases-section">
    <div class="container">
        <div class="cases-grid">
            <div class="case-card">
                <div class="case-image">
                    <svg fill="none" stroke="currentColor" stroke-width="1" viewBox="0 0 24 24"><path d="M2.25 21h19.5m-18-18v18m10.5-18v18m6-13.5V21M6.75 6.75h.75m-.75 3h.75m-.75 3h.75m3-6h.75m-.75 3h.75m-.75 3h.75M6.75 21v-3.375c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21M3 3h12m-.75 4.5H21m-3.75 3.75h.008v.008h-.008v-.008zm0 3h.008v.008h-.008v-.008zm0 3h.008v.008h-.008v-.008z"/></svg>
                </div>
                <div class="case-content">
                    <span class="case-tag">Pharmaceutical</span>
                    <h3>Water Treatment System for Pharmaceutical Plant</h3>
                    <p>Designed and installed a complete stainless steel water treatment system for a major pharmaceutical manufacturer in Southeast Asia.</p>
                    <div class="case-meta">
                        <span>📍 Thailand</span>
                        <span>📅 2025</span>
                    </div>
                </div>
            </div>

            <div class="case-card">
                <div class="case-image">
                    <svg fill="none" stroke="currentColor" stroke-width="1" viewBox="0 0 24 24"><path d="M3.75 13.5l10.5-11.25L12 10.5h8.25L9.75 21.75 12 13.5H3.75z"/></svg>
                </div>
                <div class="case-content">
                    <span class="case-tag">Power Generation</span>
                    <h3>Cooling Water System for Power Plant</h3>
                    <p>Supplied FRP pressure vessels and filtration systems for a 500MW power plant's cooling water treatment facility.</p>
                    <div class="case-meta">
                        <span>📍 Nigeria</span>
                        <span>📅 2025</span>
                    </div>
                </div>
            </div>

            <div class="case-card">
                <div class="case-image">
                    <svg fill="none" stroke="currentColor" stroke-width="1" viewBox="0 0 24 24"><path d="M9.75 3.104v5.714a2.25 2.25 0 01-.659 1.591L5 14.5M9.75 3.104c-.251.023-.501.05-.75.082m.75-.082a24.301 24.301 0 014.5 0m0 0v5.714c0 .597.237 1.17.659 1.591L19.8 15.3M14.25 3.104c.251.023.501.05.75.082M19.8 15.3l-1.57.393A9.065 9.065 0 0112 15a9.065 9.065 0 00-6.23.693L5 14.5m14.8.8l1.402 1.402c1.232 1.232.65 3.318-1.067 3.611A48.309 48.309 0 0112 21c-2.773 0-5.491-.235-8.135-.687-1.718-.293-2.3-2.379-1.067-3.61L5 14.5"/></svg>
                </div>
                <div class="case-content">
                    <span class="case-tag">Food & Beverage</span>
                    <h3>Purified Water System for Beverage Factory</h3>
                    <p>Installed a complete RO water treatment system including stainless steel storage tanks for a leading beverage manufacturer.</p>
                    <div class="case-meta">
                        <span>📍 Mexico</span>
                        <span>📅 2024</span>
                    </div>
                </div>
            </div>

            <div class="case-card">
                <div class="case-image">
                    <svg fill="none" stroke="currentColor" stroke-width="1" viewBox="0 0 24 24"><path d="M15 11.25l-3-3m0 0l-3 3m3-3v7.5M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                </div>
                <div class="case-content">
                    <span class="case-tag">Electronics</span>
                    <h3>Ultra-Pure Water System for Semiconductor Plant</h3>
                    <p>Delivered custom-designed ultra-pure water treatment equipment for a semiconductor manufacturing facility.</p>
                    <div class="case-meta">
                        <span>📍 India</span>
                        <span>📅 2024</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
