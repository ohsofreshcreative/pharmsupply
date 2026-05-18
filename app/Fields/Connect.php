<?php

namespace App\Fields;

use Log1x\AcfComposer\Field;
use StoutLogic\AcfBuilder\FieldsBuilder;

class Connect extends Field
{
	public $name = 'Wezwanie do działania';
	public $description = 'Connect';
	public $slug = 'connect';
	public $category = 'formatting';
	public $icon = 'email';
	public $keywords = ['formularz', 'zdjecie'];
	public $mode = 'edit';
	public $supports = [
		'align' => false,
		'mode' => false,
		'jsx' => true,
	];

	public function fields(): array
	{
		$connect = new FieldsBuilder('connect');

		$connect
			->setLocation('options_page', '==', 'connect')
			/*--- FIELDS ---*/
			->addTab('Treść', ['placement' => 'top'])
			->addGroup('connect', ['label' => ''])
			->addImage('image', [
				'label' => 'Obraz',
				'return_format' => 'array', // lub 'url', lub 'id'
				'preview_size' => 'thumbnail',
			])
			->addText('txt', ['label' => 'Tekst'])
			->addText('header', ['label' => 'Nagłówek'])
			->addText('phone', ['label' => 'Telefon'])
			->addLink('button', [
				'label' => 'Przycisk #1',
				'return_format' => 'array',
			])
			->addLink('button2', [
				'label' => 'Przycisk #2',
				'return_format' => 'array',
			])
			->addText('shortcode', [
				'label' => 'Kod formularza',
				'instructions' => 'Wklej kod formularza:  [contact-form-7 id="f12c470" title="Contact form 1"]',
				'default_value' => '[contact-form-7 id="f12c470" title="Contact form 1"]',
			])
			->endGroup()

			/*--- USTAWIENIA BLOKU ---*/

			->addTab('Ustawienia bloku', ['placement' => 'top'])
			->addTrueFalse('flip', [
				'label' => 'Odwrotna kolejność',
				'ui' => 1,
				'ui_on_text' => 'Tak',
				'ui_off_text' => 'Nie',
			])
			->addText('section_id', [
				'label' => 'ID',
			])
			->addText('section_class', [
				'label' => 'Dodatkowe klasy CSS',
			]);


		return [$connect];
	}
}
