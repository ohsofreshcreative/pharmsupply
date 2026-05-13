<?php

namespace App\Blocks;

use Log1x\AcfComposer\Block;
use StoutLogic\AcfBuilder\FieldsBuilder;

class CurrencyRates extends Block
{
	public $name = 'Kursy walut';
	public $description = 'Tabela kursów walut z pliku wgranego w opcjach';
	public $slug = 'currency-rates';
	public $category = 'formatting';
	public $icon = 'money-alt';
	public $keywords = ['waluty', 'kursy', 'kantor'];
	public $mode = 'edit';
	public $supports = [
		'align' => false,
		'mode' => false,
		'jsx' => true,
	];

	public function fields()
	{
		$b = new FieldsBuilder('currency_rates');

		$b->setLocation('block', '==', 'acf/currency-rates')
			->addText('block-title', ['label' => 'Tytuł', 'required' => 0])

			->addAccordion('a1', ['label' => 'Kursy walut', 'open' => false])
			->addTab('Treść', ['placement' => 'top'])
			->addGroup('g_rates', ['label' => 'Treść'])
			->addText('title',    ['label' => 'Tytuł sekcji'])
			->addWysiwyg('txt', [
				'label' => 'Treść',
				'tabs' => 'all',
				'toolbar' => 'full',
				'media_upload' => true,
			])
			->addText('col_code', ['label' => 'Nagłówek: Waluta',  'default_value' => 'Waluta'])
			->addText('col_buy',  ['label' => 'Nagłówek: Kupno',   'default_value' => 'Kupno'])
			->addText('col_sell', ['label' => 'Nagłówek: Sprzedaż', 'default_value' => 'Sprzedaż'])
			->endGroup()

			->addTab('Ustawienia bloku', ['placement' => 'top'])
			->addText('section_id',    ['label' => 'ID'])
			->addText('section_class', ['label' => 'Dodatkowe klasy CSS'])
			->addTrueFalse('nomt', [
				'label' => 'Usunięcie marginesu górnego',
				'ui' => 1,
				'ui_on_text' => 'Tak',
				'ui_off_text' => 'Nie',
			]);

		return $b;
	}

	public function with()
	{
		return [
			'g_rates'       => get_field('g_rates') ?: [],
			'section_id'    => get_field('section_id'),
			'section_class' => get_field('section_class'),
			'nomt'          => get_field('nomt'),
			'locations'     => get_option('ms_currency_rates', []),
			'updated_at'    => get_option('ms_currency_rates_updated'),
		];
	}
}
