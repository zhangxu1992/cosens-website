@extends('layouts.app')

@section('title', 'News - Cosens Industrial Water Treatment')
@section('meta_description', 'Latest news and updates from Cosens about water treatment technology, products, and industry trends.')

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

    .news-section {
        padding: 4rem 0;
        background: var(--bg-light);
    }

    .news-grid {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 2rem;
    }

    .news-card {
        background: white;
        border-radius: 12px;
        overflow: hidden;
        box-shadow: var(--shadow-sm);
        transition: all 0.3s;
    }

    .news-card:hover {
        transform: translateY(-4px);
        box-shadow: var(--shadow-lg);
    }

    .news-image {
        aspect-ratio: 16/9;
        background: var(--bg-light);
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .news-image svg {
        width: 48px;
        height: 48px;
        color: var(--text-light);
        opacity: 0.5;
    }

    .news-content {
        padding: 1.5rem;
    }

    .news-date {
        color: var(--accent);
        font-size: 0.875rem;
        font-weight: 500;
        margin-bottom: 0.5rem;
    }

    .news-content h3 {
        font-size: 1.125rem;
        font-weight: 600;
        margin-bottom: 0.75rem;
        line-height: 1.4;
    }

    .news-content p {
        color: var(--text-light);
        font-size: 0.875rem;
        line-height: 1.6;
    }

    @media (max-width: 1024px) {
        .news-grid {
            grid-template-columns: repeat(2, 1fr);
        }
    }

    @media (max-width: 640px) {
        .news-grid {
            grid-template-columns: 1fr;
        }
    }
</style>

<section class="page-header">
    <div class="container">
        <h1>{{ __('News') }}</h1>
        <p>{{ __('Latest updates from Cosens') }}</p>
    </div>
</section>

<section class="news-section">
    <div class="container">
        <div class="news-grid">
            <article class="news-card">
                <div class="news-image">
                    <svg fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m0 12.75h7.5m-7.5 3H12M10.5 2.25H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 00-9-9z"/></svg>
                </div>
                <div class="news-content">
                    <div class="news-date">May 10, 2026</div>
                    <h3>Cosens Launches New Line of Stainless Steel Filter Tanks</h3>
                    <p>We are excited to announce the launch of our new series of high-efficiency stainless steel filter tanks designed for industrial water purification.</p>
                </div>
            </article>

            <article class="news-card">
                <div class="news-image">
                    <svg fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path d="M2.25 21h19.5m-18-18v18m10.5-18v18m6-13.5V21M6.75 6.75h.75m-.75 3h.75m-.75 3h.75m3-6h.75m-.75 3h.75m-.75 3h.75M6.75 21v-3.375c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21M3 3h12m-.75 4.5H21m-3.75 3.75h.008v.008h-.008v-.008zm0 3h.008v.008h-.008v-.008zm0 3h.008v.008h-.008v-.008z"/></svg>
                </div>
                <div class="news-content">
                    <div class="news-date">April 28, 2026</div>
                    <h3>Expansion of Manufacturing Facility Completed</h3>
                    <p>Our new 5,000 square meter production facility is now fully operational, increasing our production capacity by 40%.</p>
                </div>
            </article>

            <article class="news-card">
                <div class="news-image">
                    <svg fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path d="M12 21a9.004 9.004 0 008.716-6.747M12 21a9.004 9.004 0 01-8.716-6.747M12 21c2.485 0 4.5-4.03 4.5-9S14.485 3 12 3m0 18c-2.485 0-4.5-4.03-4.5-9S9.515 3 12 3m0 0a8.997 8.997 0 017.843 4.582M12 3a8.997 8.997 0 00-7.843 4.582m15.686 0A11.953 11.953 0 0112 10.5c-2.998 0-5.74-1.1-7.843-2.918m15.686 0A8.959 8.959 0 0121 12c0 .778-.099 1.533-.284 2.253m0 0A17.919 17.919 0 0112 16.5c-3.162 0-6.133-.815-8.716-2.247m0 0A9.015 9.015 0 013 12c0-1.605.42-3.113 1.157-4.418"/></svg>
                </div>
                <div class="news-content">
                    <div class="news-date">April 15, 2026</div>
                    <h3>Cosens Receives ISO 9001:2015 Certification Renewal</h3>
                    <p>We are proud to announce the successful renewal of our ISO 9001:2015 quality management certification.</p>
                </div>
            </article>
        </div>
    </div>
</section>
@endsection
