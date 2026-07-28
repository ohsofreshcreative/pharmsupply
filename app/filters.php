<?php

/**
 * Theme filters.
 */

namespace App;

/**
 * Add "… Continued" to the excerpt.
 *
 * @return string
 */
add_filter('excerpt_more', function () {
    return sprintf(' &hellip; <a href="%s">%s</a>', get_permalink(), __('Continued', 'sage'));
});

/**
 * Zapobiega łamaniu nazwy marki "Pharm Supply" na dwie linie.
 * Zwykła spacja jest zamieniana na twardą spację (&nbsp;).
 */
function nbsp_brand($text)
{
    if (!is_string($text) || $text === '' || stripos($text, 'Pharm') === false) {
        return $text;
    }

    // Dowolny biały znak (w tym już wstawione &nbsp;) między "Pharm" a "Supply".
    // Callback zachowuje oryginalną wielkość liter (np. PHARM SUPPLY).
    return preg_replace_callback(
        '/\b(Pharm)(?:\s|&nbsp;|\x{00A0})+(Supply)\b/iu',
        fn($m) => $m[1] . "\u{00A0}" . $m[2],
        $text
    );
}

foreach ([
    'the_content',
    'the_title',
    'the_excerpt',
    'get_the_excerpt',
    'widget_text',
    'wp_nav_menu_items',
    'render_block',
    'acf_the_content',
] as $hook) {
    add_filter($hook, __NAMESPACE__ . '\\nbsp_brand', 20);
}

// Pola ACF (text, textarea, wysiwyg) – działa też w blokach Sage.
add_filter('acf/format_value/type=text', __NAMESPACE__ . '\\nbsp_brand', 20);
add_filter('acf/format_value/type=textarea', __NAMESPACE__ . '\\nbsp_brand', 20);
add_filter('acf/format_value/type=wysiwyg', __NAMESPACE__ . '\\nbsp_brand', 20);


add_action('pre_get_posts', function ($q) {
  if (is_admin() || !$q->is_main_query()) {
    return;
  }
  if ($q->is_search()) {
    if (!empty($_GET['post_type']) && $_GET['post_type'] === 'produkty') {
      $q->set('post_type', 'produkty');
    }
  }
});


/*--- BREACRUMB SEPARATOR ---*/
add_filter( 'woocommerce_breadcrumb_defaults', function ( $defaults ) {
    // Opakowujemy separator w element <span> z własną klasą CSS.
    $defaults['delimiter'] = '<span class="__separator">•</span>';
    return $defaults;
} );



/**
 * Override WooCommerce Coming Soon template
 */
add_filter('woocommerce_coming_soon_template', function ($template) {
    $custom_template = get_theme_file_path('resources/views/patterns/coming-soon.php');
    
    if (file_exists($custom_template)) {
        return $custom_template;
    }
    
    return $template;
});


add_action('pre_get_posts', function ($q) {
    if (is_admin() || ! $q->is_main_query()) {
        return;
    }
    if (! $q->is_post_type_archive('product')) {
        return;
    }

    // Nazwa produktu (LIKE po tytule)
    if (! empty($_GET['product_s'])) {
        $q->set('s', sanitize_text_field(wp_unslash($_GET['product_s'])));
    }

    // Taksonomie
    $tax_query = [];

    if (! empty($_GET['product_cat'])) {
        $tax_query[] = [
            'taxonomy' => 'product_category',
            'field'    => 'slug',
            'terms'    => sanitize_title(wp_unslash($_GET['product_cat'])),
        ];
    }

    if (! empty($_GET['product_app'])) {
        $tax_query[] = [
            'taxonomy' => 'product_application',
            'field'    => 'slug',
            'terms'    => sanitize_title(wp_unslash($_GET['product_app'])),
        ];
    }

    if (count($tax_query) > 1) {
        $tax_query['relation'] = 'AND';
    }

    if (! empty($tax_query)) {
        $q->set('tax_query', $tax_query);
    }
});