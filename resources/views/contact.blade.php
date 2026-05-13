@extends('layouts.app')

@section('title', 'Contact Us - Cosens Industrial Water Treatment')
@section('meta_description', 'Contact Cosens for water treatment equipment inquiries. WhatsApp, email, or fill out our contact form.')

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

    .contact-section {
        padding: 4rem 0;
        background: var(--bg-light);
    }

    .contact-grid {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 3rem;
    }

    .contact-info {
        background: white;
        padding: 2rem;
        border-radius: 12px;
        box-shadow: var(--shadow-sm);
    }

    .contact-info h2 {
        font-size: 1.5rem;
        font-weight: 700;
        margin-bottom: 1.5rem;
    }

    .contact-item {
        display: flex;
        align-items: flex-start;
        gap: 1rem;
        margin-bottom: 1.5rem;
    }

    .contact-item svg {
        width: 24px;
        height: 24px;
        color: var(--primary);
        flex-shrink: 0;
    }

    .contact-item h4 {
        font-weight: 600;
        margin-bottom: 0.25rem;
    }

    .contact-item p {
        color: var(--text-light);
        font-size: 0.875rem;
    }

    .contact-form {
        background: white;
        padding: 2rem;
        border-radius: 12px;
        box-shadow: var(--shadow-sm);
    }

    .contact-form h2 {
        font-size: 1.5rem;
        font-weight: 700;
        margin-bottom: 1.5rem;
    }

    .form-group {
        margin-bottom: 1.25rem;
    }

    .form-group label {
        display: block;
        font-weight: 500;
        margin-bottom: 0.5rem;
        font-size: 0.875rem;
    }

    .form-group input,
    .form-group textarea {
        width: 100%;
        padding: 0.75rem 1rem;
        border: 1px solid var(--border);
        border-radius: 8px;
        font-size: 1rem;
        transition: border-color 0.2s;
    }

    .form-group input:focus,
    .form-group textarea:focus {
        outline: none;
        border-color: var(--primary);
    }

    .form-group textarea {
        resize: vertical;
        min-height: 120px;
    }

    .btn-submit {
        width: 100%;
        padding: 0.875rem;
        background: var(--accent);
        color: white;
        border: none;
        border-radius: 8px;
        font-weight: 600;
        font-size: 1rem;
        cursor: pointer;
        transition: background 0.2s;
    }

    .btn-submit:hover {
        background: var(--accent-hover);
    }

    .whatsapp-section {
        background: linear-gradient(135deg, #25d366 0%, #128c7e 100%);
        color: white;
        padding: 3rem 0;
        text-align: center;
    }

    .whatsapp-section h2 {
        font-size: 2rem;
        font-weight: 700;
        margin-bottom: 1rem;
    }

    .whatsapp-section p {
        opacity: 0.9;
        margin-bottom: 1.5rem;
    }

    .whatsapp-btn {
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        background: white;
        color: #25d366;
        padding: 0.875rem 2rem;
        border-radius: 8px;
        font-weight: 600;
        transition: transform 0.2s;
    }

    .whatsapp-btn:hover {
        transform: translateY(-2px);
    }

    @media (max-width: 768px) {
        .contact-grid {
            grid-template-columns: 1fr;
        }
    }
</style>

<section class="page-header">
    <div class="container">
        <h1>{{ __('Contact Us') }}</h1>
        <p>{{ __('Get in touch with us for inquiries and quotes') }}</p>
    </div>
</section>

<section class="contact-section">
    <div class="container">
        <div class="contact-grid">
            <div class="contact-info">
                <h2>{{ __('Contact Information') }}</h2>

                <div class="contact-item">
                    <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                    <div>
                        <h4>{{ __('Address') }}</h4>
                        <p>{{ __('Guangzhou, China') }}</p>
                    </div>
                </div>

                <div class="contact-item">
                    <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                    <div>
                        <h4>{{ __('Email') }}</h4>
                        <p>info@cosens.cn</p>
                    </div>
                </div>

                <div class="contact-item">
                    <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/></svg>
                    <div>
                        <h4>{{ __('Phone') }}</h4>
                        <p>+86 185-2015-1000</p>
                    </div>
                </div>

                <div class="contact-item">
                    <svg fill="currentColor" viewBox="0 0 24 24"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/></svg>
                    <div>
                        <h4>WhatsApp</h4>
                        <p>+86 185-2015-1000</p>
                    </div>
                </div>
            </div>

            <div class="contact-form">
                <h2>{{ __('Send Inquiry') }}</h2>
                <form action="/contact" method="POST">
                    @csrf
                    <div class="form-group">
                        <label>{{ __('Your Name') }}</label>
                        <input type="text" name="name" required placeholder="Enter your name">
                    </div>
                    <div class="form-group">
                        <label>{{ __('Your Email') }}</label>
                        <input type="email" name="email" required placeholder="Enter your email">
                    </div>
                    <div class="form-group">
                        <label>{{ __('Your Phone') }}</label>
                        <input type="tel" name="phone" placeholder="Enter your phone number">
                    </div>
                    <div class="form-group">
                        <label>{{ __('Your Company') }}</label>
                        <input type="text" name="company" placeholder="Enter your company name">
                    </div>
                    <div class="form-group">
                        <label>{{ __('Your Message') }}</label>
                        <textarea name="message" required placeholder="Tell us about your requirements"></textarea>
                    </div>
                    <button type="submit" class="btn-submit">{{ __('Submit Inquiry') }}</button>
                </form>
            </div>
        </div>
    </div>
</section>

<section class="whatsapp-section">
    <div class="container">
        <h2>{{ __('Chat on WhatsApp') }}</h2>
        <p>{{ __('Get instant responses to your inquiries') }}</p>
        <a href="https://wa.me/8618520151000" target="_blank" class="whatsapp-btn">
            <svg width="24" height="24" fill="currentColor" viewBox="0 0 24 24"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/></svg>
            {{ __('Chat Now') }}
        </a>
    </div>
</section>
@endsection
