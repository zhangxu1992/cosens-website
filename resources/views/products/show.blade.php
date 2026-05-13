@extends('layouts.app')

@section('title', 'Product Details - Cosens Industrial Water Treatment')
@section('meta_description', 'Product details for Cosens water treatment equipment.')

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

    .product-detail {
        padding: 4rem 0;
        background: var(--bg-light);
    }

    .product-grid {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 3rem;
        align-items: start;
    }

    .product-gallery {
        background: white;
        border-radius: 12px;
        padding: 2rem;
        box-shadow: var(--shadow-sm);
    }

    .main-image {
        aspect-ratio: 4/3;
        background: var(--bg-light);
        border-radius: 8px;
        display: flex;
        align-items: center;
        justify-content: center;
        margin-bottom: 1rem;
    }

    .main-image svg {
        width: 80px;
        height: 80px;
        color: var(--text-light);
        opacity: 0.5;
    }

    .product-info {
        background: white;
        border-radius: 12px;
        padding: 2rem;
        box-shadow: var(--shadow-sm);
    }

    .product-info h1 {
        font-size: 1.875rem;
        font-weight: 700;
        margin-bottom: 1rem;
    }

    .product-price {
        font-size: 1.5rem;
        font-weight: 700;
        color: var(--accent);
        margin-bottom: 1rem;
    }

    .product-description {
        color: var(--text-medium);
        line-height: 1.8;
        margin-bottom: 1.5rem;
    }

    .product-features {
        list-style: none;
        margin-bottom: 1.5rem;
    }

    .product-features li {
        display: flex;
        align-items: center;
        gap: 0.5rem;
        margin-bottom: 0.5rem;
        color: var(--text-medium);
    }

    .product-features li svg {
        width: 20px;
        height: 20px;
        color: var(--success);
    }

    .btn-quote {
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        background: var(--accent);
        color: white;
        padding: 0.875rem 2rem;
        border-radius: 8px;
        font-weight: 600;
        transition: background 0.2s;
    }

    .btn-quote:hover {
        background: var(--accent-hover);
    }

    @media (max-width: 1024px) {
        .product-grid {
            grid-template-columns: 1fr;
        }
    }
</style>

<section class="page-header">
    <div class="container">
        <h1>{{ __('Product Details') }}</h1>
        <p>{{ __('High-quality water treatment equipment') }}</p>
    </div>
</section>

<section class="product-detail">
    <div class="container">
        <div class="product-grid">
            <div class="product-gallery">
                <div class="main-image">
                    <svg fill="none" stroke="currentColor" stroke-width="1" viewBox="0 0 24 24"><path d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/></svg>
                </div>
            </div>

            <div class="product-info">
                <h1>{{ ucwords(str_replace('-', ' ', $slug)) }}</h1>
                <div class="product-price">{{ __('Contact for Price') }}</div>
                <p class="product-description">
                    {{ __('Professional-grade water treatment equipment designed for industrial applications. Built with high-quality materials and precision engineering.') }}
                </p>
                <ul class="product-features">
                    <li>
                        <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M5 13l4 4L19 7"/></svg>
                        {{ __('High-quality materials') }}
                    </li>
                    <li>
                        <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M5 13l4 4L19 7"/></svg>
                        {{ __('Custom dimensions available') }}
                    </li>
                    <li>
                        <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M5 13l4 4L19 7"/></svg>
                        {{ __('ISO 9001 certified') }}
                    </li>
                    <li>
                        <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M5 13l4 4L19 7"/></svg>
                        {{ __('2-year warranty') }}
                    </li>
                </ul>
                <a href="/quote" class="btn-quote">
                    <svg width="20" height="20" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"/></svg>
                    {{ __('Get a Quote') }}
                </a>
            </div>
        </div>
    </div>
</section>
@endsection
