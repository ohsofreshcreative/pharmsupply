<?php

namespace App\Blocks;

use Log1x\AcfComposer\Block;
use StoutLogic\AcfBuilder\FieldsBuilder;
use App\Support\SectionClasses;

class Places extends Block
{
	public $name = 'Lokalizacje';
	public $description = 'places';
	public $slug = 'places';
	public $category = 'formatting';
	public $icon = 'location';
	public $keywords = ['lokalizacje', 'places'];
	public $mode = 'edit';
	public $supports = [
		'align' => false,
		'mode' => false,
		'jsx' => true,
		'anchor' => true,
		'customClassName' => true,
	];

	public function fields()
{
    $places = new FieldsBuilder('places');

    $places
        ->setLocation('block', '==', 'acf/places')
        ->addText('block-title', [
            'label' => 'Tytuł',
            'required' => 0,
        ])
        ->addAccordion('accordion1', [
            'label' => 'Lokalizacje',
            'open' => false,
            'multi_expand' => true,
        ])

        /*--- TAB #1 ---*/
        ->addTab('Treści', ['placement' => 'top'])
        ->addGroup('g_places', ['label' => ''])
        ->addText('header', ['label' => 'Nagłówek'])
        ->addTextarea('text', [
            'label' => 'Opis',
            'rows' => 4,
            'new_lines' => 'br',
        ])
        ->addLink('button', [
            'label' => 'Przycisk',
            'return_format' => 'array',
        ])
        ->endGroup()

        /*--- USTAWIENIA BLOKU ---*/
        ->addTab('Ustawienia bloku', ['placement' => 'top'])
        ->addText('section_id', ['label' => 'ID'])
        ->addText('section_class', ['label' => 'Dodatkowe klasy CSS'])
        ->addTrueFalse('nolist', [
            'label' => 'Brak punktatorów',
            'ui' => 1, 'ui_on_text' => 'Tak', 'ui_off_text' => 'Nie',
        ])
        ->addTrueFalse('flip', [
            'label' => 'Odwrotna kolejność',
            'ui' => 1, 'ui_on_text' => 'Tak', 'ui_off_text' => 'Nie',
        ])
        ->addTrueFalse('wide', [
            'label' => 'Szeroka kolumna',
            'ui' => 1, 'ui_on_text' => 'Tak', 'ui_off_text' => 'Nie',
        ])
        ->addTrueFalse('nomt', [
            'label' => 'Usunięcie marginesu górnego',
            'ui' => 1, 'ui_on_text' => 'Tak', 'ui_off_text' => 'Nie',
        ])
        ->addTrueFalse('gap', [
            'label' => 'Większy odstęp',
            'ui' => 1, 'ui_on_text' => 'Tak', 'ui_off_text' => 'Nie',
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
            'ui' => 0,
            'allow_null' => 0,
        ]);

    return $places;
}

public function with(): array
{
    $fields = [
        'g_places' => get_field('g_places'),
        // dane z Options „Lokacje" -> repeater 'locat'
        'r_places' => get_field('locat', 'option') ?: [],

        'section_id' => get_field('section_id'),
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