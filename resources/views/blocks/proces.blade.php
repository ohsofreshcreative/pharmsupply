<!--- proces --->

<section
	data-gsap-anim="section"
	@if(!empty($section_id)) id="{{ $section_id }}" @endif
	@class([ 'b-proces relative -smt' ,
	$sectionClass=> filled($sectionClass),
	$section_class => filled($section_class),
	$background => filled($background) && $background !== 'none',
	])>

	<div class="__wrapper c-main">
		<div class="">
			<div class="__top grid grid-cols-1 lg:grid-cols-2 items-center gap-10 relative z-10">
				@if (!empty($g_proces['header']))
				<h3 data-gsap-element="header" class="text-gradient m-header">{{ strip_tags($g_proces['header']) }}</h3>
				@endif
				@if (!empty($g_proces['txt']))
				<div data-gsap-element="txt" class="w-full md:w-2/3 ml-auto">{{ strip_tags($g_proces['txt']) }}</div>
				@endif
			</div>
			@if (!empty($g_proces['image']))
			<img class="absolute left-1/2 -translate-x-1/2 top-10" src="{{ $g_proces['image']['url'] }}" alt="{{ $g_proces['image']['alt'] ?? '' }}" />
			@endif
		</div>

		@if (!empty($r_proces))
		@php
		$repeater_count = count($r_proces);
		$grid_class = 'lg:grid-cols-4'; // Domyślna klasa
		if ($repeater_count === 3) {
		$grid_class = 'lg:grid-cols-3';
		}
		@endphp
		<div class="__repeater section-gap grid grid-cols-1 md:grid-cols-2 {{ $grid_class }} mt-8">

			@foreach ($r_proces as $item)
			<div data-gsap-element="stagger" class="__card relative flex flex-col radius border border-primary-light bg-primary-lighter overflow-hidden px-6 py-8">
				<div class="relative z-20">
					@if (!empty($item['number']))
					<div class="bg-primary rounded-full text-h6 font-header text-white flex items-center justify-center w-12 h-12">{{ $item['number'] }}</div>
					@endif
					@if (!empty($item['image']))
					<img class="absolute -bottom-6 -right-6 z-10" src="{{ $item['image']['url'] }}" alt="{{ $item['image']['alt'] ?? '' }}" />\
					@endif
					<p class="font-header text-h7 text-secondary-dark mt-4">{{ $item['title'] }}</p>
					<div class="!text-[16px] mt-2">{!! $item['txt'] !!}</div>
				</div>
				<img class="absolute opacity-10 -top-45 -right-30 z-0" src="http://pharmsupply.local/wp-content/uploads/2026/05/card_shape.svg" alt="shape" />
			</div>
			@endforeach
		</div>
		@endif
	</div>

</section>