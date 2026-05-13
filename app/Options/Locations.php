<?php

namespace App\Options;

use Log1x\AcfComposer\Options as Field;
use StoutLogic\AcfBuilder\FieldsBuilder;

class Locations extends Field
{
	/**
	 * The option page menu name.
	 *
	 * @var string
	 */
	public $name = 'Lokacje';

	/**
	 * The option page document title.
	 *
	 * @var string
	 */
	public $title = 'Lokacje | Opcje';

	/**
	 * The option page field group.
	 *
	 * @return array
	 */
	public function fields()
	{
		$locations = new FieldsBuilder('locations_settings');

		$locations
			->addRepeater('locat', [
				'label' => 'Placówki',
				'button_label' => 'Dodaj placówkę',
				'layout' => 'block',
			])
			->addImage('image', [
				'label' => 'Obraz',
				'return_format' => 'array', // lub 'url', lub 'id'
				'preview_size' => 'thumbnail',
			])
			->addText('name', [
				'label' => 'Nazwa placówki',
				'required' => 1,
			])
			->addTextarea('txt', [
				'label' => 'Adres',
				'rows' => 2,
				'new_lines' => 'br',
			])
			->addText('phone', [
				'label' => 'Telefon',
				'required' => 1,
			])
			->addTextarea('navi', [
				'label' => 'Nawigacja',
			])
			->endRepeater();

		return $locations->build();
	}
}
