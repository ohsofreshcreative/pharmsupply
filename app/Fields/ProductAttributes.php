<?php

namespace App\Fields;

use Log1x\AcfComposer\Field;
use StoutLogic\AcfBuilder\FieldsBuilder;

class ProductAttributes extends Field
{
	public function fields(): array
	{
		$productAttributes = new FieldsBuilder('product_attributes');

		$productAttributes
			->setLocation('taxonomy', '==', 'product_application')
			->or('taxonomy', '==', 'product_regulatory_status')
			->or('taxonomy', '==', 'product_form')
			->or('taxonomy', '==', 'product_packaging');

		$productAttributes
			->addImage('image', [
				'label' => 'Ikona / obrazek',
				'return_format' => 'array',
				'preview_size' => 'thumbnail',
				'library' => 'all',
			]);

		return $productAttributes->build();
	}
}