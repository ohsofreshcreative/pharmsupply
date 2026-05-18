<?php

namespace App\Options;

use Log1x\AcfComposer\Options;

class Connect extends Options
{
	public $name = 'Wezwanie do działania';
	public $slug = 'connect';
	public $title = 'Connect';
	public $capability = 'edit_posts';
	public $redirect = false;
	public function fields(): array
	{
		return [];
	}
}
