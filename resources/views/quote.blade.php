@extends('layouts.app')

@section('title', 'Get a Quote - Cosens Industrial Water Treatment')
@section('meta_description', 'Request a free quote for water treatment equipment. Stainless steel tanks, FRP vessels, filter systems, and custom solutions.')

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

    .quote-section {
        padding: 4rem 0;
        background: var(--bg-light);
    }

    .quote-grid {
        display: grid;
        grid-template-columns: 2fr 1fr;
        gap: 3rem;
    }

    .quote-form {
        background: white;
        padding: 2rem;
        border-radius: 12px;
        box-shadow: var(--shadow-sm);
    }

    .quote-form h2 {
        font-size: 1.5rem;
        font-weight: 700;
        margin-bottom: 1.5rem;
    }

    .form-row {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 1rem;
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
    .form-group select,
    .form-group textarea {
        width: 100%;
        padding: 0.75rem 1rem;
        border: 1px solid var(--border);
        border-radius: 8px;
        font-size: 1rem;
        transition: border-color 0.2s;
    }

    .form-group input:focus,
    .form-group select:focus,
    .form-group textarea:focus {
        outline: none;
        border-color: var(--primary);
    }

    .form-group textarea {
        resize: vertical;
        min-height: 100px;
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

    .quote-sidebar {
        display: flex;
        flex-direction: column;
        gap: 1.5rem;
    }

    .sidebar-card {
        background: white;
        padding: 1.5rem;
        border-radius: 12px;
        box-shadow: var(--shadow-sm);
    }

    .sidebar-card h3 {
        font-size: 1.125rem;
        font-weight: 600;
        margin-bottom: 1rem;
    }

    .sidebar-card ul {
        list-style: none;
    }

    .sidebar-card li {
        display: flex;
        align-items: center;
        gap: 0.5rem;
        margin-bottom: 0.75rem;
        font-size: 0.875rem;
    }

    .sidebar-card li svg {
        width: 20px;
        height: 20px;
        color: var(--success);
    }

    .price-estimate {
        background: linear-gradient(135deg, var(--primary) 0%, var(--primary-light) 100%);
        color: white;
        padding: 1.5rem;
        border-radius: 12px;
        text-align: center;
    }

    .price-estimate h3 {
        font-size: 1.125rem;
        margin-bottom: 0.5rem;
    }

    .price-value {
        font-size: 2rem;
        font-weight: 800;
        margin: 1rem 0;
    }

    .price-note {
        font-size: 0.75rem;
        opacity: 0.8;
    }

    @media (max-width: 1024px) {
        .quote-grid {
            grid-template-columns: 1fr;
        }

        .form-row {
            grid-template-columns: 1fr;
        }
    }
</style>

<section class="page-header">
    <div class="container">
        <h1>{{ __('Online Quote') }}</h1>
        <p>{{ __('Get an instant price estimate for your water treatment equipment') }}</p>
    </div>
</section>

<section class="quote-section">
    <div class="container">
        <div class="quote-grid">
            <div class="quote-form">
                <h2>{{ __('Request a Quote') }}</h2>
                <form action="/quote" method="POST">
                    @csrf

                    <div class="form-row">
                        <div class="form-group">
                            <label>{{ __('Your Name') }} *</label>
                            <input type="text" name="name" required placeholder="John Smith">
                        </div>
                        <div class="form-group">
                            <label>{{ __('Your Email') }} *</label>
                            <input type="email" name="email" required placeholder="john@example.com">
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group">
                            <label>{{ __('Your Phone') }}</label>
                            <input type="tel" name="phone" placeholder="+1 234 567 890">
                        </div>
                        <div class="form-group">
                            <label>{{ __('Your Company') }}</label>
                            <input type="text" name="company" placeholder="Company Name">
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group">
                            <label>{{ __('Select Product Type') }} *</label>
                            <select name="product_type" required id="productType">
                                <option value="">-- Select Product --</option>
                                <option value="stainless-tank">Stainless Steel Water Tank</option>
                                <option value="filter-tank">Stainless Steel Filter Tank</option>
                                <option value="frp-vessel">FRP Pressure Vessel</option>
                                <option value="mixing-tank">Mixing Tank</option>
                                <option value="insulated-tank">Insulated Water Tank</option>
                                <option value="custom">Custom Solution</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>{{ __('Select Material') }}</label>
                            <select name="material" id="material">
                                <option value="">-- Select Material --</option>
                                <option value="ss304">SS304</option>
                                <option value="ss316">SS316</option>
                                <option value="frp">FRP/Fiberglass</option>
                                <option value="pe">PE/Plastic</option>
                                <option value="custom">Custom</option>
                            </select>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group">
                            <label>{{ __('Enter Dimensions') }} (mm)</label>
                            <input type="text" name="dimensions" placeholder="e.g., Diameter 2000 x Height 3000">
                        </div>
                        <div class="form-group">
                            <label>{{ __('Quantity') }}</label>
                            <input type="number" name="quantity" min="1" value="1" id="quantity">
                        </div>
                    </div>

                    <div class="form-group">
                        <label>{{ __('Your Message') }}</label>
                        <textarea name="message" placeholder="Describe your specific requirements..."></textarea>
                    </div>

                    <button type="submit" class="btn-submit">{{ __('Get Price Estimate') }}</button>
                </form>
            </div>

            <div class="quote-sidebar">
                <div class="price-estimate">
                    <h3>{{ __('Estimated Price') }}</h3>
                    <div class="price-value" id="priceEstimate">$0 - $0</div>
                    <p class="price-note">{{ __('Price varies based on specifications') }}</p>
                </div>

                <div class="sidebar-card">
                    <h3>{{ __('Why Choose Cosens') }}</h3>
                    <ul>
                        <li>
                            <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M5 13l4 4L19 7"/></svg>
                            Factory direct pricing
                        </li>
                        <li>
                            <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M5 13l4 4L19 7"/></svg>
                            Custom design available
                        </li>
                        <li>
                            <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M5 13l4 4L19 7"/></svg>
                            ISO 9001 certified
                        </li>
                        <li>
                            <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M5 13l4 4L19 7"/></svg>
                            Global shipping
                        </li>
                        <li>
                            <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M5 13l4 4L19 7"/></svg>
                            2-year warranty
                        </li>
                    </ul>
                </div>

                <div class="sidebar-card">
                    <h3>{{ __('Need Help?') }}</h3>
                    <p style="font-size: 0.875rem; color: var(--text-light); margin-bottom: 1rem;">
                        Contact our sales team for assistance with your quote.
                    </p>
                    <a href="https://wa.me/8618520151000" target="_blank" style="display: inline-flex; align-items: center; gap: 0.5rem; color: #25d366; font-weight: 600;">
                        <svg width="20" height="20" fill="currentColor" viewBox="0 0 24 24"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/></svg>
                        Chat on WhatsApp
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>

<script>
    const priceRanges = {
        'stainless-tank': { min: 500, max: 5000 },
        'filter-tank': { min: 300, max: 3000 },
        'frp-vessel': { min: 200, max: 2500 },
        'mixing-tank': { min: 800, max: 8000 },
        'insulated-tank': { min: 600, max: 6000 },
        'custom': { min: 1000, max: 10000 }
    };

    function updatePrice() {
        const productType = document.getElementById('productType').value;
        const quantity = parseInt(document.getElementById('quantity').value) || 1;
        const priceEl = document.getElementById('priceEstimate');

        if (productType && priceRanges[productType]) {
            const range = priceRanges[productType];
            const min = range.min * quantity;
            const max = range.max * quantity;
            priceEl.textContent = `$${min.toLocaleString()} - $${max.toLocaleString()}`;
        } else {
            priceEl.textContent = '$0 - $0';
        }
    }

    document.getElementById('productType').addEventListener('change', updatePrice);
    document.getElementById('quantity').addEventListener('input', updatePrice);
</script>
@endsection
