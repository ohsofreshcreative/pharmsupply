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