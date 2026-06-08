<?php

namespace App\Options;

use Log1x\AcfComposer\Options;

class Connects extends Options
{
	public $name = 'Wezwanie do działania';
	public $slug = 'connects';
	public $title = 'Wezwanie do działania';
	public $capability = 'edit_posts';
	public $redirect = false;
	public function fields(): array
	{
		return [];
	}
}
