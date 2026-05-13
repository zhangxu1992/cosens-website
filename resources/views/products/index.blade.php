@extends('layouts.app')

@section('title', 'Products - Cosens Industrial Water Treatment')
@section('meta_description', 'Browse Cosens water treatment products: stainless steel tanks, FRP vessels, filter systems, mixing tanks, and custom solutions.')

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

    .page-header p {
        opacity: 0.9;
        font-size: 1.125rem;
    }

    .products-page {
        padding: 4rem 0;
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
    }

    .product-image svg {
        width: 64px;
        height: 64px;
        color: var(--text-light);
        opacity: 0.5;
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

    .product-meta {
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .product-price {
        font-weight: 700;
        color: var(--accent);
        font-size: 1.125rem;
    }

    .product-link {
        color: var(--primary);
        font-weight: 600;
        font-size: 0.875rem;
    }

    .product-link:hover {
        color: var(--accent);
    }

    @media (max-width: 1024px) {
        .products-grid {
            grid-template-columns: repeat(2, 1fr);
        }
    }

    @media (max-width: 640px) {
        .products-grid {
            grid-template-columns: 1fr;
        }
    }
</style>

<section class="page-header">
    <div class="container">
        <h1>{{ __('Products') }}</h1>
        <p>{{ __('Discover our range of high-quality water treatment equipment') }}</p>
    </div>
</section>

<section class="products-page">
    <div class="container">
        <div class="products-grid">
            <div class="product-card">
                <div class="product-image">
                    <svg fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/></svg>
                </div>
                <div class="product-info">
                    <h3>{{ __('Stainless Steel Water Tank') }}</h3>
                    <p>{{ __('High-quality SS304/SS316 water storage tanks for industrial and commercial use.') }}</p>
                    <div class="product-meta">
                        <span class="product-price">$500 - $5,000</span>
                        <a href="/products/stainless-steel-tank" class="product-link">{{ __('View Details') }} →</a>
                    </div>
                </div>
            </div>

            <div class="product-card">
                <div class="product-image">
                    <svg fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m0 12.75h7.5m-7.5 3H12M10.5 2.25H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 00-9-9z"/></svg>
                </div>
                <div class="product-info">
                    <h3>{{ __('Stainless Steel Filter Tank') }}</h3>
                    <p>{{ __('Mechanical and activated carbon filter tanks for water purification systems.') }}</p>
                    <div class="product-meta">
                        <span class="product-price">$300 - $3,000</span>
                        <a href="/products/filter-tank" class="product-link">{{ __('View Details') }} →</a>
                    </div>
                </div>
            </div>

            <div class="product-card">
                <div class="product-image">
                    <svg fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path d="M9.75 3.104v5.714a2.25 2.25 0 01-.659 1.591L5 14.5M9.75 3.104c-.251.023-.501.05-.75.082m.75-.082a24.301 24.301 0 014.5 0m0 0v5.714c0 .597.237 1.17.659 1.591L19.8 15.3M14.25 3.104c.251.023.501.05.75.082M19.8 15.3l-1.57.393A9.065 9.065 0 0112 15a9.065 9.065 0 00-6.23.693L5 14.5m14.8.8l1.402 1.402c1.232 1.232.65 3.318-1.067 3.611A48.309 48.309 0 0112 21c-2.773 0-5.491-.235-8.135-.687-1.718-.293-2.3-2.379-1.067-3.61L5 14.5"/></svg>
                </div>
                <div class="product-info">
                    <h3>{{ __('FRP Pressure Vessel') }}</h3>
                    <p>{{ __('Fiberglass reinforced plastic tanks for corrosion-resistant water treatment.') }}</p>
                    <div class="product-meta">
                        <span class="product-price">$200 - $2,500</span>
                        <a href="/products/frp-vessel" class="product-link">{{ __('View Details') }} →</a>
                    </div>
                </div>
            </div>

            <div class="product-card">
                <div class="product-image">
                    <svg fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path d="M4.5 12a7.5 7.5 0 0015 0m-15 0a7.5 7.5 0 1115 0m-15 0H3m16.5 0H21m-1.5 0H12m-8.457 3.077l1.41-.513m14.095-5.13l1.41-.513M5.106 17.785l1.15-.964m11.49-9.642l1.149-.964M7.501 19.795l.75-1.3m7.5-12.99l.75-1.3m-6.063 16.658l.26-1.477m2.605-14.772l.26-1.477m0 17.726l-.26-1.477M10.698 4.614l-.26-1.477M16.5 19.795l-1.15-.964m-7.125-12.99l-1.15-.964m-1.378 14.826l-.26-1.477M3 21h18M12.75 3.375v17.25"/></svg>
                </div>
                <div class="product-info">
                    <h3>{{ __('Mixing Tank') }}</h3>
                    <p>{{ __('Industrial mixing and stirring tanks for chemical processing applications.') }}</p>
                    <div class="product-meta">
                        <span class="product-price">$800 - $8,000</span>
                        <a href="/products/mixing-tank" class="product-link">{{ __('View Details') }} →</a>
                    </div>
                </div>
            </div>

            <div class="product-card">
                <div class="product-image">
                    <svg fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path d="M15 11.25l-3-3m0 0l-3 3m3-3v7.5M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                </div>
                <div class="product-info">
                    <h3>{{ __('Insulated Water Tank') }}</h3>
                    <p>{{ __('Thermal insulated storage tanks for temperature-sensitive applications.') }}</p>
                    <div class="product-meta">
                        <span class="product-price">$600 - $6,000</span>
                        <a href="/products/insulated-tank" class="product-link">{{ __('View Details') }} →</a>
                    </div>
                </div>
            </div>

            <div class="product-card">
                <div class="product-image">
                    <svg fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path d="M21 7.5l-9-5.25L3 7.5m18 0l-9 5.25m9-5.25v9l-9 5.25M3 7.5l9 5.25M3 7.5v9l9 5.25m0-9v9"/></svg>
                </div>
                <div class="product-info">
                    <h3>{{ __('Custom Solutions') }}</h3>
                    <p>{{ __('Tailored water treatment systems designed to meet your specific requirements.') }}</p>
                    <div class="product-meta">
                        <span class="product-price">{{ __('Custom') }}</span>
                        <a href="/quote" class="product-link">{{ __('Get Quote') }} →</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
