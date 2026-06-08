<!--- product -->

@php
$product_attributes = [
'product_application' => 'Zastosowanie',
'product_regulatory_status' => 'Status regulacyjny produktu',
'product_form' => 'Postać',
'product_packaging' => 'Opakowanie',
];

$product_terms = [];

foreach ($product_attributes as $taxonomy => $label) {
$terms = get_the_terms(get_the_ID(), $taxonomy);

if (!empty($terms) && !is_wp_error($terms)) {
$product_terms[$taxonomy] = [
'label' => $label,
'terms' => $terms,
];
}
}
@endphp

<section
	data-gsap-anim="section"
	@if(!empty($section_id)) id="{{ $section_id }}" @endif
	@class([ 'b-product relative -smt' ,
	$sectionClass=> filled($sectionClass),
	$section_class => filled($section_class),
	$background => filled($background) && $background !== 'none',
	])>

	<div class="__wrapper c-main relative">
		<div class="__col grid grid-cols-1 lg:grid-cols-2 gap-8 lg:gap-20">
			@if (!empty($g_product['image']))
			<div data-gsap-element="img" class="__img h-full order1">
				<img class="object-cover w-full h-full aspect-[3/2] __img radius-img border border-primary-light" src="{{ $g_product['image']['url'] }}" alt="{{ $g_product['image']['alt'] ?? '' }}">
			</div>
			@endif

			<div class="__product order2">
				<p data-gsap-element="category" class="w-max text-primary bg-primary-lighter border border-primary-light rounded-lg px-4 py-2">{{ get_the_terms(get_the_ID(), 'product_category')[0]->name ?? '' }}</p>
				<h2 data-gsap-element="header" class="text-h4 mt-4">{{ $g_product['header'] }}</h2>

				<div data-gsap-element="txt" class="__txt mt-4">
					{!! $g_product['txt'] !!}
				</div>

				@if (!empty($product_terms))
				<div data-gsap-element="attributes" class="__attributes flex flex-col gap-4 mt-6">
					@foreach ($product_terms as $attribute)
					@foreach ($attribute['terms'] as $term)
					@php
					$image = get_field('image', $term->taxonomy . '_' . $term->term_id);
					@endphp

					<div class="__attribute flex items-center gap-4">
						<div class="w-14 h-14 bg-primary-lighter border border-primary-light rounded-full p-3">
							@if (!empty($image))
							<img
								src="{{ $image['url'] }}"
								alt="{{ $image['alt'] ?? $term->name }}"
								class="w-full h-full object-contain">
							@endif
						</div>

						<div>
							<div class="text-sm opacity-70">
								{{ $attribute['label'] }}
							</div>

							<div class="font-medium">
								{{ $term->name }}
							</div>
						</div>
					</div>
					@endforeach
					@endforeach
				</div>
				@endif

				@if (!empty($g_product['button']))
				<x-button
					:href="$g_product['button']['url']"
					variant="primary"
					class="mt-6"
					data-gsap-element="btn">
					{{ $g_product['button']['title'] }}
				</x-button>
				@endif

			</div>

		</div>
	</div>

</section>