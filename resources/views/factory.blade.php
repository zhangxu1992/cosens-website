@extends('layouts.app')

@section('title', 'Factory View - Cosens Industrial Water Treatment')

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

    .factory-section {
        padding: 4rem 0;
        background: var(--bg-light);
    }

    .factory-grid {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 2rem;
    }

    .factory-card {
        background: white;
        border-radius: 12px;
        overflow: hidden;
        box-shadow: var(--shadow-sm);
    }

    .factory-image {
        aspect-ratio: 16/9;
        background: var(--bg-light);
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .factory-image svg {
        width: 64px;
        height: 64px;
        color: var(--text-light);
        opacity: 0.5;
    }

    .factory-content {
        padding: 1.5rem;
    }

    .factory-content h3 {
        font-size: 1.25rem;
        font-weight: 600;
        margin-bottom: 0.5rem;
    }

    .factory-content p {
        color: var(--text-light);
        font-size: 0.875rem;
    }

    @media (max-width: 768px) {
        .factory-grid {
            grid-template-columns: 1fr;
        }
    }
</style>

<section class="page-header">
    <div class="container">
        <h1>{{ __('Factory View') }}</h1>
        <p>{{ __('Take a look at our manufacturing facility') }}</p>
    </div>
</section>

<section class="factory-section">
    <div class="container">
        <div class="factory-grid">
            <div class="factory-card">
                <div class="factory-image">
                    <svg fill="none" stroke="currentColor" stroke-width="1" viewBox="0 0 24 24"><path d="M2.25 21h19.5m-18-18v18m10.5-18v18m6-13.5V21M6.75 6.75h.75m-.75 3h.75m-.75 3h.75m3-6h.75m-.75 3h.75m-.75 3h.75M6.75 21v-3.375c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21M3 3h12m-.75 4.5H21m-3.75 3.75h.008v.008h-.008v-.008zm0 3h.008v.008h-.008v-.008zm0 3h.008v.008h-.008v-.008z"/></svg>
                </div>
                <div class="factory-content">
                    <h3>{{ __('Production Workshop') }}</h3>
                    <p>{{ __('Our main production facility with advanced manufacturing equipment.') }}</p>
                </div>
            </div>

            <div class="factory-card">
                <div class="factory-image">
                    <svg fill="none" stroke="currentColor" stroke-width="1" viewBox="0 0 24 24"><path d="M9.75 3.104v5.714a2.25 2.25 0 01-.659 1.591L5 14.5M9.75 3.104c-.251.023-.501.05-.75.082m.75-.082a24.301 24.301 0 014.5 0m0 0v5.714c0 .597.237 1.17.659 1.591L19.8 15.3M14.25 3.104c.251.023.501.05.75.082M19.8 15.3l-1.57.393A9.065 9.065 0 0112 15a9.065 9.065 0 00-6.23.693L5 14.5m14.8.8l1.402 1.402c1.232 1.232.65 3.318-1.067 3.611A48.309 48.309 0 0112 21c-2.773 0-5.491-.235-8.135-.687-1.718-.293-2.3-2.379-1.067-3.61L5 14.5"/></svg>
                </div>
                <div class="factory-content">
                    <h3>{{ __('Quality Control') }}</h3>
                    <p>{{ __('Rigorous testing and inspection processes to ensure product quality.') }}</p>
                </div>
            </div>

            <div class="factory-card">
                <div class="factory-image">
                    <svg fill="none" stroke="currentColor" stroke-width="1" viewBox="0 0 24 24"><path d="M4.5 12a7.5 7.5 0 0015 0m-15 0a7.5 7.5 0 1115 0m-15 0H3m16.5 0H21m-1.5 0H12m-8.457 3.077l1.41-.513m14.095-5.13l1.41-.513M5.106 17.785l1.15-.964m11.49-9.642l1.149-.964M7.501 19.795l.75-1.3m7.5-12.99l.75-1.3m-6.063 16.658l.26-1.477m2.605-14.772l.26-1.477m0 17.726l-.26-1.477M10.698 4.614l-.26-1.477M16.5 19.795l-1.15-.964m-7.125-12.99l-1.15-.964m-1.378 14.826l-.26-1.477M3 21h18M12.75 3.375v17.25"/></svg>
                </div>
                <div class="factory-content">
                    <h3>{{ __('Warehouse') }}</h3>
                    <p>{{ __('Spacious warehouse for raw materials and finished products.') }}</p>
                </div>
            </div>

            <div class="factory-card">
                <div class="factory-image">
                    <svg fill="none" stroke="currentColor" stroke-width="1" viewBox="0 0 24 24"><path d="M12 21a9.004 9.004 0 008.716-6.747M12 21a9.004 9.004 0 01-8.716-6.747M12 21c2.485 0 4.5-4.03 4.5-9S14.485 3 12 3m0 18c-2.485 0-4.5-4.03-4.5-9S9.515 3 12 3m0 0a8.997 8.997 0 017.843 4.582M12 3a8.997 8.997 0 00-7.843 4.582m15.686 0A11.953 11.953 0 0112 10.5c-2.998 0-5.74-1.1-7.843-2.918m15.686 0A8.959 8.959 0 0121 12c0 .778-.099 1.533-.284 2.253m0 0A17.919 17.919 0 0112 16.5c-3.162 0-6.133-.815-8.716-2.247m0 0A9.015 9.015 0 013 12c0-1.605.42-3.113 1.157-4.418"/></svg>
                </div>
                <div class="factory-content">
                    <h3>{{ __('R&D Center') }}</h3>
                    <p>{{ __('Research and development center for product innovation.') }}</p>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
