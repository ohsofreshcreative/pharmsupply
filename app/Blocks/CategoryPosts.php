<?php

namespace App\Blocks;

use Log1x\AcfComposer\Block;
use StoutLogic\AcfBuilder\FieldsBuilder;
use App\Support\SectionClasses;

class CategoryPosts extends Block
{
	public $name = 'Baza wiedzy - Ostatnie wpisy';
	public $description = 'category-posts';
	public $slug = 'category-posts';
	public $category = 'formatting';
	public $icon = 'admin-post';
	public $keywords = ['posts', 'category', 'wpisy', 'kategoria'];
	public $mode = 'edit';
	public $supports = [
		'align' => false,
		'mode' => true,
		'jsx' => true,
	];

	public function fields()
	{
		$categoryPosts = new FieldsBuilder('category-posts');

		$categoryPosts
			->setLocation('block', '==', 'acf/category-posts')
			->addTab('Treści', ['placement' => 'top'])
			->addGroup('posts_settings', ['label' => ''])
			->addText('title', ['label' => 'Tytuł'])
			->addTextarea('text', [
				'label' => 'Opis',
				'rows' => 2,
				'new_lines' => 'br',
			])
			->addLink('button', [
				'label' => 'Przycisk',
				'return_format' => 'array',
			])
			->addTrueFalse('show_image', [
				'label' => 'Pokaż obrazek',
				'default_value' => 1,
				'ui' => 1,
				'ui_on_text' => 'Tak',
				'ui_off_text' => 'Nie',
			])
			->addTrueFalse('show_excerpt', [
				'label' => 'Pokaż fragment treści',
				'default_value' => 0,
				'ui' => 1,
				'ui_on_text' => 'Tak',
				'ui_off_text' => 'Nie',
			])
			->endGroup()

			->addTab('Ustawienia bloku', ['placement' => 'top'])
			->addText('section_id', ['label' => 'ID'])
			->addText('section_class', ['label' => 'Dodatkowe klasy CSS'])
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

		return $categoryPosts;
	}

	public function with()
	{
		$posts_settings = get_field('posts_settings');
		$show_image     = $posts_settings['show_image'] ?? true;
		$show_excerpt   = $posts_settings['show_excerpt'] ?? false;

		$query = new \WP_Query([
			'post_type'      => 'post',
			'posts_per_page' => 6,
			'post_status'    => 'publish',
			'orderby'        => 'date',
			'order'          => 'DESC',
		]);

		$fields = [
			'posts_settings' => $posts_settings,
			'posts'          => $query->posts,
			'show_image'     => $show_image,
			'show_excerpt'   => $show_excerpt,

			'section_id'    => get_field('section_id'),
			'section_class' => get_field('section_class'),

			'flip' => (bool) get_field('flip'),
			'wide' => (bool) get_field('wide'),
			'nomt' => (bool) get_field('nomt'),
			'gap'  => (bool) get_field('gap'),

			'background' => get_field('background') ?: 'none',
		];

		$fields['sectionClass'] = SectionClasses::fromMap($fields, [
			'flip' => 'order-flip',
			'wide' => 'wide',
			'nomt' => '!mt-0',
			'gap'  => 'wider-gap',
		]);

		return $fields;
	}
}
