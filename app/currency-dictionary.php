<?php

namespace App;

/**
 * Słownik walut: kod => [nazwa PL, kod kraju ISO dla flagi].
 * Kod kraju używamy do flagcdn.com (np. 'us' => https://flagcdn.com/us.svg).
 */
function ms_currency_dictionary(): array
{
    return [
        'USD' => ['Dolar amerykański',     'us'],
        'EUR' => ['Euro',                  'eu'],
        'GBP' => ['Funt brytyjski',        'gb'],
        'CAD' => ['Dolar kanadyjski',      'ca'],
        'BGN' => ['Lew bułgarski',         'bg'],
        'DKK' => ['Korona duńska',         'dk'],
        'CHF' => ['Frank szwajcarski',     'ch'],
        'HRK' => ['Kuna chorwacka',        'hr'],
        'SEK' => ['Korona szwedzka',       'se'],
        'VND' => ['Dong wietnamski',       'vn'],
        'HUF' => ['Forint węgierski',      'hu'],
        'RUB' => ['Rubel rosyjski',        'ru'],
        'UAH' => ['Hrywna ukraińska',      'ua'],
        'NOK' => ['Korona norweska',       'no'],
        'AUD' => ['Dolar australijski',    'au'],
        'JPY' => ['Jen japoński',          'jp'],
        'CZK' => ['Korona czeska',         'cz'],
        'ILS' => ['Szekel izraelski',      'il'],
        'TRY' => ['Lira turecka',          'tr'],
        'RON' => ['Lej rumuński',          'ro'],
        'CNY' => ['Juan chiński',          'cn'],
        'AED' => ['Dirham ZEA',            'ae'],
        'KRW' => ['Won południowokoreański','kr'],
        'THB' => ['Baht tajlandzki',       'th'],
        'ALL' => ['Lek albański',          'al'],
        'PLN' => ['Złoty polski',          'pl'],
    ];
}

function ms_currency_info(string $code): array
{
    $code = strtoupper($code);
    $dict = ms_currency_dictionary();

    return [
        'code'    => $code,
        'name'    => $dict[$code][0] ?? $code,
        'country' => $dict[$code][1] ?? null,
        'flag'    => isset($dict[$code][1])
            ? 'https://flagcdn.com/w40/' . $dict[$code][1] . '.png'
            : null,
    ];
}