<?php

namespace App\Options;

use Log1x\AcfComposer\Options as Field;
use StoutLogic\AcfBuilder\FieldsBuilder;

class CurrencyRates extends Field
{
    public $name = 'Kursy walut';
    public $title = 'Kursy walut | Opcje';

    public function fields()
    {
        $fields = new FieldsBuilder('currency_rates_settings');

        $fields
            ->addRepeater('locations', [
                'label' => 'Placówki',
                'instructions' => 'Dodaj placówkę i wgraj dla niej plik z kursami (TXT lub XML).',
                'button_label' => 'Dodaj placówkę',
                'layout' => 'block',
            ])
                ->addText('name', [
                    'label' => 'Nazwa placówki',
                    'required' => 1,
                ])
                ->addText('slug', [
                    'label' => 'Slug (opcjonalnie)',
                    'instructions' => 'Pozostaw puste — zostanie wygenerowany z nazwy.',
                ])
                ->addFile('rates_file', [
                    'label' => 'Plik z kursami',
                    'return_format' => 'array',
                    'mime_types' => 'txt,xml',
                    'required' => 1,
                ])
            ->endRepeater();

        return $fields->build();
    }
}