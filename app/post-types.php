<?php

/*--- CPT - Produkty ---*/

add_action('init', function () {
	register_post_type('product', [
		'label'         => 'Produkty',
		'labels'        => [
			'name'               => 'Produkty',
			'singular_name'      => 'Produkt',
			'menu_name'          => 'Produkty',
			'all_items'          => 'Wszystkie produkty',
			'add_new'            => 'Dodaj nowy',
			'add_new_item'       => 'Dodaj nowy produkt',
			'edit_item'          => 'Edytuj produkt',
			'new_item'           => 'Nowy produkt',
			'view_item'          => 'Zobacz produkt',
			'view_items'         => 'Zobacz produkty',
			'search_items'       => 'Szukaj produktów',
			'not_found'          => 'Nie znaleziono produktów',
			'not_found_in_trash' => 'Brak produktów w koszu',
			'parent_item_colon'  => 'Produkt nadrzędny:',
		],
		'public'        => true,
		'has_archive'   => true,
		'menu_icon'     => 'dashicons-cart',
		'menu_position' => 20,
		'supports'      => ['title', 'editor', 'thumbnail', 'excerpt'],
		'show_in_rest'  => true,
		'rewrite'       => ['slug' => 'produkty', 'with_front' => false],
	]);
});

add_action('init', function () {
	register_taxonomy('product_category', ['product'], [
		'label'        => 'Kategorie produktów',
		'labels'       => [
			'name'              => 'Kategorie produktów',
			'singular_name'     => 'Kategoria produktu',
			'search_items'      => 'Szukaj kategorii',
			'all_items'         => 'Wszystkie kategorie',
			'parent_item'       => 'Kategoria nadrzędna',
			'parent_item_colon' => 'Kategoria nadrzędna:',
			'edit_item'         => 'Edytuj kategorię',
			'update_item'       => 'Aktualizuj kategorię',
			'add_new_item'      => 'Dodaj nową kategorię',
			'new_item_name'     => 'Nazwa nowej kategorii',
			'menu_name'         => 'Kategorie',
		],
		'hierarchical' => true,
		'public'       => true,
		'show_in_rest' => true,
		'rewrite'      => ['slug' => 'kategoria-produktu', 'with_front' => false],
	]);
});

add_filter('manage_edit-product_columns', function ($columns) {
    $newColumns = [];

    foreach ($columns as $key => $label) {
        if ($key === 'cb') {
            $newColumns[$key] = $label;
            $newColumns['product_thumb'] = 'Zdjęcie';
            continue;
        }

        $newColumns[$key] = $label;
    }

    return $newColumns;
});

add_action('manage_product_posts_custom_column', function ($column, $post_id) {
    if ($column !== 'product_thumb') {
        return;
    }

    if (has_post_thumbnail($post_id)) {
        echo get_the_post_thumbnail($post_id, [60, 60], [
            'style' => 'width:60px;height:60px;object-fit:contain;border-radius:8px;',
        ]);
        return;
    }

    echo '—';
}, 10, 2);

add_action('admin_head', function () {
    $screen = get_current_screen();

    if (!$screen || $screen->id !== 'edit-product') {
        return;
    }
    ?>
    <style>
        .wp-list-table .column-product_thumb {
            width: 72px;
        }

        .wp-list-table td.column-product_thumb,
        .wp-list-table th.column-product_thumb {
            padding-left: 8px;
            padding-right: 8px;
            text-align: center;
        }
    </style>
    <?php
});

add_action('init', function () {
	$product_attributes = [
		'product_application' => [
			'label' => 'Zastosowania',
			'singular' => 'Zastosowanie',
			'menu' => 'Zastosowanie',
			'slug' => 'zastosowanie-produktu',
		],
		'product_regulatory_status' => [
			'label' => 'Statusy regulacyjne produktu',
			'singular' => 'Status regulacyjny produktu',
			'menu' => 'Status regulacyjny',
			'slug' => 'status-regulacyjny-produktu',
		],
		'product_form' => [
			'label' => 'Postacie produktu',
			'singular' => 'Postać produktu',
			'menu' => 'Postać',
			'slug' => 'postac-produktu',
		],
		'product_packaging' => [
			'label' => 'Opakowania produktu',
			'singular' => 'Opakowanie produktu',
			'menu' => 'Opakowanie',
			'slug' => 'opakowanie-produktu',
		],
	];

	foreach ($product_attributes as $taxonomy => $attribute) {
		register_taxonomy($taxonomy, ['product'], [
			'label'             => $attribute['label'],
			'labels'            => [
				'name'                       => $attribute['label'],
				'singular_name'              => $attribute['singular'],
				'search_items'               => 'Szukaj',
				'all_items'                  => 'Wszystkie',
				'edit_item'                  => 'Edytuj',
				'update_item'                => 'Aktualizuj',
				'add_new_item'               => 'Dodaj nową pozycję',
				'new_item_name'              => 'Nazwa nowej pozycji',
				'separate_items_with_commas' => 'Oddziel przecinkami',
				'add_or_remove_items'        => 'Dodaj lub usuń pozycje',
				'choose_from_most_used'      => 'Wybierz z najczęściej używanych',
				'not_found'                  => 'Nie znaleziono',
				'menu_name'                  => $attribute['menu'],
			],
			'hierarchical'      => true,
			'public'            => true,
			'show_admin_column' => true,
			'show_in_rest'      => true,
			'rewrite'           => ['slug' => $attribute['slug'], 'with_front' => false],
		]);
	}
});

add_action('save_post_product', function ($post_id, $post, $update) {
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
        return;
    }

    if (wp_is_post_revision($post_id)) {
        return;
    }

    if (!current_user_can('edit_post', $post_id)) {
        return;
    }

    $term_ids = wp_get_post_terms($post_id, 'product_application', [
        'fields' => 'ids',
    ]);

    if (is_wp_error($term_ids) || count($term_ids) <= 1) {
        return;
    }

    wp_set_post_terms($post_id, [(int) $term_ids[0]], 'product_application', false);
}, 20, 3);