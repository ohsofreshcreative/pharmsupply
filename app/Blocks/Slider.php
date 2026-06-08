<?php

namespace App\Blocks;

use Log1x\AcfComposer\Block;
use StoutLogic\AcfBuilder\FieldsBuilder;
use App\Support\SectionClasses;

class Slider extends Block
{
	public $name = 'Slider';
	public $description = 'slider - slider z produktami';
	public $slug = 'slider';
	public $category = 'formatting';
	public $icon = 'admin-users';
	public $keywords = ['slider', 'kafelki', 'produkty'];
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
		$slider = new FieldsBuilder('slider');

		$slider
			->setLocation('block', '==', 'acf/slider')
			->addText('block-title', [
				'label' => 'Tytuł',
				'required' => 0,
			])
			->addAccordion('accordion1', [
				'label' => 'Produkty - Slider',
				'open' => false,
				'multi_expand' => true,
			])
			/*--- FIELDS ---*/
			->addTab('Treści', ['placement' => 'top'])
			->addGroup('g_slider', ['label' => ''])
			->addText('header', ['label' => 'Nagłówek'])
			->addWysiwyg('content', [
				'label' => 'Treść',
				'tabs' => 'all',
				'toolbar' => 'full',
				'media_upload' => true,
			])
			->endGroup()

			->addTaxonomy('slider_categories', [
				'label'        => 'Filtruj produkty po kategoriach',
				'taxonomy'     => 'product_category',
				'field_type'   => 'checkbox',
				'return_format' => 'id',
				'multiple'     => 1,
				'add_term'     => 0,
				'load_terms'   => 0,
				'save_terms'   => 0,
				'allow_null'   => 1,
			])

			/*--- USTAWIENIA BLOKU ---*/

			->addTab('Ustawienia bloku', ['placement' => 'top'])
			->addText('section_id', [
				'label' => 'ID',
			])
			->addText('section_class', [
				'label' => 'Dodatkowe klasy CSS',
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
				'ui' => 0, // Ulepszony interfejs
				'allow_null' => 0,
			]);

		return $slider;
	}

	public function with(): array
	{
		$fields = [
			'slider_posts' => $this->slider_posts(),

			'g_slider' => get_field('g_slider'),
			'slider_categories'   => get_field('slider_categories'),
			'section_id' => get_field('section_id'),
			'section_class' => get_field('section_class'),
			'nolist' => (bool) get_field('nolist'),
			'flip' => (bool) get_field('flip'),
			'wide' => (bool) get_field('wide'),
			'nomt' => (bool) get_field('nomt'),
			'gap' => (bool) get_field('gap'),
			'background' => get_field('background') ?: 'none',
		];

		$fields['sectionClass'] = SectionClasses::fromMap($fields, [
			'nolist' => 'nolist',
			'flip' => 'order-flip',
			'wide' => 'wide',
			'nomt' => '!mt-0',
			'gap' => 'wider-gap',
		]);

		return $fields;
	}

	public function slider_posts()
	{
		$selected_categories = get_field('slider_categories');

		$args = [
			'post_type'      => 'product',
			'posts_per_page' => -1,
			'orderby'        => 'menu_order date',
			'order'          => 'ASC',
			'post_status'    => 'publish',
		];

		if (!empty($selected_categories)) {
			$args['tax_query'] = [[
				'taxonomy' => 'product_category',
				'field'    => 'term_id',
				'terms'    => (array) $selected_categories,
			]];
		}

		return get_posts($args);
	}
}
