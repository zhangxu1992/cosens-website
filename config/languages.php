<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Available Languages
    |--------------------------------------------------------------------------
    |
    | The list of available languages for the application.
    |
    */

    'available' => [
        'zh_CN' => [
            'name' => '简体中文',
            'name_en' => 'Chinese (Simplified)',
            'flag' => '🇨🇳',
            'locale' => 'zh_CN',
            'direction' => 'ltr',
        ],
        'en' => [
            'name' => 'English',
            'name_en' => 'English',
            'flag' => '🇬🇧',
            'locale' => 'en',
            'direction' => 'ltr',
        ],
        'es' => [
            'name' => 'Español',
            'name_en' => 'Spanish',
            'flag' => '🇪🇸',
            'locale' => 'es',
            'direction' => 'ltr',
        ],
        'fr' => [
            'name' => 'Français',
            'name_en' => 'French',
            'flag' => '🇫🇷',
            'locale' => 'fr',
            'direction' => 'ltr',
        ],
        'de' => [
            'name' => 'Deutsch',
            'name_en' => 'German',
            'flag' => '🇩🇪',
            'locale' => 'de',
            'direction' => 'ltr',
        ],
        'ru' => [
            'name' => 'Русский',
            'name_en' => 'Russian',
            'flag' => '🇷🇺',
            'locale' => 'ru',
            'direction' => 'ltr',
        ],
        'ja' => [
            'name' => '日本語',
            'name_en' => 'Japanese',
            'flag' => '🇯🇵',
            'locale' => 'ja',
            'direction' => 'ltr',
        ],
        'ko' => [
            'name' => '한국어',
            'name_en' => 'Korean',
            'flag' => '🇰🇷',
            'locale' => 'ko',
            'direction' => 'ltr',
        ],
        'ar' => [
            'name' => 'العربية',
            'name_en' => 'Arabic',
            'flag' => '🇸🇦',
            'locale' => 'ar',
            'direction' => 'rtl',
        ],
        'pt' => [
            'name' => 'Português',
            'name_en' => 'Portuguese',
            'flag' => '🇧🇷',
            'locale' => 'pt',
            'direction' => 'ltr',
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Default Language
    |--------------------------------------------------------------------------
    */

    'default' => env('DEFAULT_LOCALE', 'zh_CN'),

    /*
    |--------------------------------------------------------------------------
    | Fallback Language
    |--------------------------------------------------------------------------
    */

    'fallback' => 'en',

    /*
    |--------------------------------------------------------------------------
    | URL Prefix
    |--------------------------------------------------------------------------
    */

    'url_prefix' => true,

    /*
    |--------------------------------------------------------------------------
    | Cookie Name
    |--------------------------------------------------------------------------
    */

    'cookie_name' => 'cosens_locale',

    /*
    |--------------------------------------------------------------------------
    | Cookie Lifetime (minutes)
    |--------------------------------------------------------------------------
    */

    'cookie_lifetime' => 60 * 24 * 30, // 30 days
];
