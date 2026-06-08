<!--- choice -->

<section
	data-gsap-anim="section"
	@if(!empty($section_id)) id="{{ $section_id }}" @endif
	@class([ 'b-choice relative -smt' ,
	$sectionClass=> filled($sectionClass),
	$section_class => filled($section_class),
	$background => filled($background) && $background !== 'none',
	])>

	@php
	$selectedProducts = $products ?? [];
	$hasSelectedProducts = !empty($selectedProducts);
	@endphp

	<div class="__wrapper relative items-center gap-8 lg:gap-20">

		<h2 data-gsap-element="header" class="text-gradient m-header">
			{{ $g_choice['header'] }}
		</h2>
		@if (!$hasSelectedProducts && !empty($g_choice['image']))
		<div data-gsap-element="img"
			@class(['__img relative h-full order1', 'is-flipped'=> !empty($switch)])>

			@if (!empty($g_choice['bg']))
			<img class="absolute {{ $bg_class ?? '' }} z-0"
				src="{{ $g_choice['bg']['url'] }}"
				alt="{{ $g_choice['bg']['alt'] ?? '' }}" />
			@endif

			@if (!empty($glow))
			<img class="absolute top-0 -left-20 blur-[350px] opacity-15 w-full h-full z-0" src="/wp-choice/uploads/2026/05/hero-shape.svg" />
			@endif

			<img class="mask-img object-cover w-full h-full aspect-3/2 radius-img relative z-10"
				src="{{ $g_choice['image']['url'] }}"
				alt="{{ $g_choice['image']['alt'] ?? '' }}">

		</div>
		@elseif ($hasSelectedProducts)
		<div data-gsap-element="products" class="__products order1 grid grid-cols-1 {{ count($selectedProducts) > 1 ? 'md:grid-cols-2' : '' }} gap-6">
			@foreach ($selectedProducts as $product)
			@php
			setup_postdata($GLOBALS['post'] = $product);
			@endphp

			@include('partials.content-product')
			@endforeach
			@php(wp_reset_postdata())
		</div>
		@endif

	</div>

</section>