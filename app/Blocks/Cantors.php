<?php

namespace App\Blocks;

use Log1x\AcfComposer\Block;
use StoutLogic\AcfBuilder\FieldsBuilder;

class Cantors extends Block
{
	public $name = 'Nasze kantory';
	public $description = 'cantors';
	public $slug = 'cantors';
	public $category = 'formatting';
	public $icon = 'location';
	public $keywords = ['kantory', 'kafelki'];
	public $mode = 'edit';
	public $supports = [
		'align' => false,
		'mode' => false,
		'jsx' => true,
	];

	public function fields()
	{
		$cantors = new FieldsBuilder('cantors');

		$cantors
			->setLocation('block', '==', 'acf/cantors') // ważne!
			->addText('block-title', [
				'label' => 'Tytuł',
				'required' => 0,
			])
			->addAccordion('accordion1', [
				'label' => 'Kantory',
				'open' => false,
				'multi_expand' => true,
			])
			/*--- TAB #1 ---*/
			->addTab('Treści', ['placement' => 'top'])
			->addGroup('g_cantors', ['label' => ''])
			->addImage('bg', [
				'label' => 'Tło',
				'return_format' => 'array', 
				'preview_size' => 'thumbnail',
			])
			->addText('header', ['label' => 'Nagłówek'])
			->addTextarea('text', [
				'label' => 'Opis',
				'rows' => 4,
				'new_lines' => 'br',
			])
			->addRepeater('buttons', [
				'label' => 'Przyciski',
				'layout' => 'table',
				'button_label' => 'Dodaj przycisk',
			])
				->addText('label', [
					'label' => 'Etykieta',
					'required' => 1,
				])
			->endRepeater()
			->endGroup()

			/*--- TAB #2 ---*/
			->addTab('Kantory', ['placement' => 'top'])
			->addRepeater('r_cantors', [
				'label' => 'Kantory',
				'layout' => 'row', // 'row', 'block', albo 'table'
				'min' => 1,
				'button_label' => 'Dodaj kantor'
			])
			->addImage('image', [
				'label' => 'Obraz',
				'return_format' => 'array', // lub 'url', lub 'id'
				'preview_size' => 'thumbnail',
			])
			->addText('title', [
				'label' => 'Nagłówek',
			])
			->addTextarea('address', [
				'label' => 'Adres',
				'rows' => 2,
				'new_lines' => 'br',
			])
			->addText('phone', [
				'label' => 'Telefon',
			])
			->addTextarea('hours', [
				'label' => 'Godziny otwarcia',
				'rows' => 2,
				'new_lines' => 'br',
			])
			->addTextarea('navi', [
				'label' => 'Nawigacja',
			])
			->addNumber('lat', [
				'label' => 'Lat (szerokość geograficzna)',
				'step' => 'any',
			])
			->addNumber('lng', [
				'label' => 'Lng (długość geograficzna)',
				'step' => 'any',
			])
			->endRepeater()

			/*--- USTAWIENIA BLOKU ---*/

			->addTab('Ustawienia bloku', ['placement' => 'top'])
			->addText('section_id', [
				'label' => 'ID',
			])
			->addText('section_class', [
				'label' => 'Dodatkowe klasy CSS',
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
                    'section-gray' => 'Szare',
                    'section-brand' => 'Marki',
                    'section-gradient' => 'Gradient',
                    'section-dark' => 'Ciemne',
                ],
                'default_value' => 'none',
                'ui' => 0, // Ulepszony interfejs
                'allow_null' => 0,
            ]);

		return $cantors;
	}

	public function with()
	{
		return [
			'g_cantors' => get_field('g_cantors'),
			'r_cantors' => get_field('r_cantors'),
			'section_id' => get_field('section_id'),
			'section_class' => get_field('section_class'),
			'flip' => get_field('flip'),
			'wide' => get_field('wide'),
			'nomt' => get_field('nomt'),
			'gap' => get_field('gap'),
			'background' => get_field('background'),
		];
	}
}
