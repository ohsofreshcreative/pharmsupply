<?php

namespace App\Blocks;

use App\Support\SectionClasses;
use Log1x\AcfComposer\Block;
use StoutLogic\AcfBuilder\FieldsBuilder;

class indications extends Block
{
    public $name = 'Wskazania';
    public $description = 'indications';
    public $slug = 'indications';
    public $category = 'formatting';
    public $icon = 'align-pull-left';
    public $keywords = ['tresc', 'zdjecie'];
    public $mode = 'edit';
    public $supports = [
        'align' => false,
        'mode' => true,
        'jsx' => true,
        'anchor' => true,
        'customClassName' => true,
    ];

    public function fields()
    {
        $indications = new FieldsBuilder('indications');

        $indications
            ->setLocation('block', '==', 'acf/indications')
            ->addText('block-title', [
                'label' => 'Tytuł',
                'required' => 0,
            ])
            ->addAccordion('accordion1', [
                'label' => 'Wskazania',
                'open' => false,
                'multi_expand' => true,
            ])
            ->addTab('Elementy', ['placement' => 'top'])
            ->addGroup('g_indications', ['label' => ''])
            ->addImage('image', [
                'label' => 'Obraz',
                'return_format' => 'array',
                'preview_size' => 'thumbnail',
            ])
            ->addText('header', ['label' => 'Nagłówek'])
            ->addWysiwyg('txt', [
                'label' => 'Treść',
                'tabs' => 'all',
                'toolbar' => 'full',
                'media_upload' => true,
            ])
            ->addLink('button', [
                'label' => 'Przycisk',
                'return_format' => 'array',
            ])
            ->addImage('bg', [
                'label' => 'Grafika w tle',
                'return_format' => 'array',
                'preview_size' => 'thumbnail',
            ])
            ->endGroup()

            ->addTab('Ustawienia bloku', ['placement' => 'top'])
            ->addText('section_id', [
                'label' => 'ID',
            ])
            ->addText('section_class', [
                'label' => 'Dodatkowe klasy CSS',
            ])
            ->addText('bg_class', [
                'label' => 'Dodatkowe klasy CSS dla tła',
            ])
            ->addTrueFalse('switch', [
                'label' => 'Odwrócona maska',
                'ui' => 1,
                'ui_on_text' => 'Tak',
                'ui_off_text' => 'Nie',
            ])
            ->addTrueFalse('glow', [
                'label' => 'Glow w tle',
                'ui' => 1,
                'ui_on_text' => 'Tak',
                'ui_off_text' => 'Nie',
            ])
            ->addTrueFalse('nolist', [
                'label' => 'Brak punktatorów',
                'ui' => 1,
                'ui_on_text' => 'Tak',
                'ui_off_text' => 'Nie',
            ])
            ->addTrueFalse('flip', [
                'label' => 'Odwrotna kolejność',
                'ui' => 1,
                'ui_on_text' => 'Tak',
                'ui_off_text' => 'Nie',
            ])
            ->addTrueFalse('wide', [
                'label' => 'Szeroka kolumna',
                'ui' => 1,
                'ui_on_text' => 'Tak',
                'ui_off_text' => 'Nie',
            ])
            ->addTrueFalse('nomt', [
                'label' => 'Usunięcie marginesu górnego',
                'ui' => 1,
                'ui_on_text' => 'Tak',
                'ui_off_text' => 'Nie',
            ])
            ->addTrueFalse('gap', [
                'label' => 'Większy odstęp',
                'ui' => 1,
                'ui_on_text' => 'Tak',
                'ui_off_text' => 'Nie',
            ])
            ->addSelect('background', [
                'label' => 'Kolor tła',
                'choices' => [
                    'none' => 'Brak (domyślne)',
                    'section-white' => 'Białe',
                    'section-light' => 'Jasne',
                    'section-secondary' => 'Jasne - Alternatywne',
                    'section-brand' => 'Marki',
                    'section-gradient' => 'Gradient',
                    'section-dark' => 'Ciemne',
                ],
                'default_value' => 'none',
                'ui' => 0,
                'allow_null' => 0,
            ]);

        return $indications;
    }

    public function with(): array
    {
        $fields = [
            'g_indications' => get_field('g_indications'),

            'section_id' => get_field('section_id'),
            'section_class' => get_field('section_class'),
            'bg_class' => get_field('bg_class'),

            'switch' => (bool) get_field('switch'),
            'glow' => (bool) get_field('glow'),
            'flip' => (bool) get_field('flip'),
            'wide' => (bool) get_field('wide'),
            'nomt' => (bool) get_field('nomt'),
            'gap' => (bool) get_field('gap'),

            'background' => get_field('background') ?: 'none',
        ];

        $fields['sectionClass'] = SectionClasses::fromMap($fields, [
            'flip' => 'order-flip',
            'wide' => 'wide',
            'nomt' => '!mt-0',
            'gap' => 'wider-gap',
        ]);

        $activeCategorySlug = isset($_GET['product_cat'])
            ? sanitize_title(wp_unslash($_GET['product_cat']))
            : '';

        $requestUri = isset($_SERVER['REQUEST_URI']) ? wp_unslash($_SERVER['REQUEST_URI']) : '/';
        $currentPageUrl = home_url(strtok($requestUri, '?'));
        $filterBaseUrl = remove_query_arg(['product_cat'], $currentPageUrl);

        $parentTerms = get_terms([
            'taxonomy' => 'product_category',
            'hide_empty' => false,
            'parent' => 0,
            'number' => 3,
            'orderby' => 'name',
            'order' => 'ASC',
        ]);

        $categoriesTree = [];

        if (!is_wp_error($parentTerms) && !empty($parentTerms)) {
            foreach ($parentTerms as $parent) {
                $childTerms = get_terms([
                    'taxonomy' => 'product_category',
                    'hide_empty' => false,
                    'parent' => (int) $parent->term_id,
                    'orderby' => 'name',
                    'order' => 'ASC',
                ]);

                if (is_wp_error($childTerms) || empty($childTerms)) {
                    $childTerms = [];
                }

                $children = [];
                foreach ($childTerms as $child) {
                    $children[] = [
                        'name' => $child->name,
                        'slug' => $child->slug,
                        'url' => add_query_arg('product_cat', $child->slug, $filterBaseUrl),
                    ];
                }

                $categoriesTree[] = [
                    'name' => $parent->name,
                    'slug' => $parent->slug,
                    'url' => add_query_arg('product_cat', $parent->slug, $filterBaseUrl),
                    'children' => $children,
                ];
            }
        }

        $productArgs = [
            'post_type' => 'product',
            'post_status' => 'publish',
            'posts_per_page' => -1,
            'orderby' => 'menu_order title',
            'order' => 'ASC',
        ];

        if (!empty($activeCategorySlug)) {
            $productArgs['tax_query'] = [[
                'taxonomy' => 'product_category',
                'field' => 'slug',
                'terms' => $activeCategorySlug,
                'include_children' => true,
            ]];
        }

        $rawProducts = get_posts($productArgs);

        $products = array_map(function ($product) {
            $productId = $product->ID;

            $formTerms = get_the_terms($productId, 'product_form');
            $packagingTerms = get_the_terms($productId, 'product_packaging');

            $form = (!empty($formTerms) && !is_wp_error($formTerms))
                ? implode(', ', wp_list_pluck($formTerms, 'name'))
                : null;

            $packaging = (!empty($packagingTerms) && !is_wp_error($packagingTerms))
                ? implode(', ', wp_list_pluck($packagingTerms, 'name'))
                : null;

            return [
                'id' => $productId,
                'title' => get_the_title($productId),
                'permalink' => get_permalink($productId),
                'thumbnail' => has_post_thumbnail($productId)
                    ? get_the_post_thumbnail_url($productId, 'medium')
                    : null,
                'form' => $form,
                'packaging' => $packaging,
            ];
        }, $rawProducts);

        $fields['filterBaseUrl'] = $filterBaseUrl;
        $fields['activeCategorySlug'] = $activeCategorySlug;
        $fields['categoriesTree'] = $categoriesTree;
        $fields['products'] = $products;

        return $fields;
    }
}