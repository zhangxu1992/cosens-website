@extends('layouts.app')

@section('title', 'News Article - Cosens Industrial Water Treatment')

@section('content')
<style>
    .page-header {
        background: linear-gradient(135deg, var(--primary) 0%, var(--primary-light) 100%);
        color: white;
        padding: 4rem 0;
        text-align: center;
    }

    .article-section {
        padding: 4rem 0;
        background: var(--bg-light);
    }

    .article-content {
        max-width: 800px;
        margin: 0 auto;
        background: white;
        padding: 3rem;
        border-radius: 12px;
        box-shadow: var(--shadow-sm);
    }

    .article-date {
        color: var(--accent);
        font-weight: 500;
        margin-bottom: 1rem;
    }

    .article-content h1 {
        font-size: 2rem;
        font-weight: 700;
        margin-bottom: 1.5rem;
    }

    .article-content p {
        color: var(--text-medium);
        line-height: 1.8;
        margin-bottom: 1rem;
    }
</style>

<section class="page-header">
    <div class="container">
        <h1>{{ __('News') }}</h1>
    </div>
</section>

<section class="article-section">
    <div class="container">
        <article class="article-content">
            <div class="article-date">May 10, 2026</div>
            <h1>News Article</h1>
            <p>Full article content will be displayed here.</p>
        </article>
    </div>
</section>
@endsection
