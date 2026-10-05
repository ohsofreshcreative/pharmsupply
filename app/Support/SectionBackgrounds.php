<?php

namespace App\Support;

class SectionBackgrounds
{
	/**
	 * @return array<string, string> klasa CSS => etykieta
	 */
	public static function choices(): array
	{
		return [
			'none' => 'Brak (domyślne)',
			'section-white' => 'Białe',
			'section-light' => 'Jasne',
			'section-secondary' => 'Jasne - Alternatywne',
			'section-brand' => 'Marki',
			'section-gradient' => 'Gradient',
			'section-dark' => 'Ciemne',
		];
	}
}
