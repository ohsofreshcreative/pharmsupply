<?php

namespace App\Blocks;

use Log1x\AcfComposer\Block;
use StoutLogic\AcfBuilder\FieldsBuilder;

class Hero extends Block
{
    public $name = 'Hero';
    public $description = 'Hero';
    public $slug = 'hero';
    public $category = 'formatting';
    public $icon = 'align-full-width';
    public $keywords = ['tresc', 'zdjecie'];
    public $mode = 'edit';
    public $supports = [
        'align' => false,
        'mode' => false,
        'jsx' => true,
    ];

    public function fields()
    {
        $hero = new FieldsBuilder('hero');

        $hero
            ->setLocation('block', '==', 'acf/hero') // ważne!
            ->addText('block-title', [
                'label' => 'Tytuł',
                'required' => 0,
            ])
            ->addAccordion('accordion1', [
                'label' => 'Hero',
                'open' => false,
                'multi_expand' => true,
            ])
            /*--- TAB #1 ---*/
            ->addTab('Treść', ['placement' => 'top'])
            ->addGroup('g_hero', ['label' => 'Hero'])
            ->addImage('image', [
                'label' => 'Obraz',
                'return_format' => 'array',
                'preview_size' => 'medium',
            ])
            ->addText('title', ['label' => 'Tytuł'])
            ->addTextarea('txt', [
                'label' => 'Opis',
                'rows' => 2,
                'new_lines' => 'br',
            ])
            ->addLink('button1', [
                'label' => 'Przycisk #1',
                'return_format' => 'array',
            ])
            ->addLink('button2', [
                'label' => 'Przycisk #2',
                'return_format' => 'array',
            ])
            ->endGroup()

            /*--- USTAWIENIA BLOKU ---*/

            ->addTab('Ustawienia bloku', ['placement' => 'top'])
            ->addText('section_id', [
                'label' => 'ID',
            ])
            ->addText('section_class', [
                'label' => 'Dodatkowe klasy CSS',
            ])
            ->addTrueFalse('nomt', [
                'label' => 'Usunięcie marginesu górnego',
                'ui' => 1,
                'ui_on_text' => 'Tak',
                'ui_off_text' => 'Nie',
            ]);

        return $hero;
    }

    public function with()
    {
        $rawLocations = get_option('ms_currency_rates', []) ?: [];

        $locations = array_map(function ($loc) {
            $rates = $loc['rates'] ?? [];

            $loc['rates'] = array_map(function ($r) {
                $info = \App\ms_currency_info($r['code'] ?? '');
                $r['flag'] = $info['flag'];
                $r['name'] = $info['name'];
                return $r;
            }, is_array($rates) ? $rates : []);

            return $loc;
        }, is_array($rawLocations) ? $rawLocations : []);

        return [
            'g_hero'        => get_field('g_hero'),
            'section_id'    => get_field('section_id'),
            'section_class' => get_field('section_class'),
            'nomt'          => get_field('nomt'),
            'locations'     => $locations,
        ];
    }
}