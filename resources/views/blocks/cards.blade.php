@php
$sectionClass = '';
$sectionClass .= $flip ? ' order-flip' : '';
$sectionClass .= $wide ? ' wide' : '';
$sectionClass .= $nomt ? ' !mt-0' : '';
$sectionClass .= $gap ? ' wider-gap' : '';

if (!empty($background) && $background !== 'none') {
$sectionClass .= ' ' . $background;
}
@endphp

<!--- cards --->

<section data-gsap-anim="section" @if(!empty($section_id)) id="{{ $section_id }}" @endif class="b-cards -smt {{ $sectionClass }} {{ $section_class }}">
	<div class="__wrapper c-main">
		<div class="__top w-full md:w-1/2">
			<h2 data-gsap-element="header" class="text-gradient m-header">{{ strip_tags($g_cards['header']) }}</h2>
			<p data-gsap-element="txt">{{ $g_cards['text'] }}</p>
		</div>

		@if (!empty($r_cards))
		@php
		$itemCount = count($r_cards);
		$gridCols = 1;
		if ($itemCount == 2) $gridCols = 2;
		if ($itemCount == 3) $gridCols = 3;
		if ($itemCount >= 4) $gridCols = 4; // Twój dotychczasowy warunek
		$gridClass = $gridCols > 1 ? 'grid-cols-1 lg:grid-cols-' . $gridCols : 'grid-cols-1';
		@endphp

		<div class="grid {{ $gridClass }} gap-8 mt-8">
			@foreach ($r_cards as $item)
			<a href="{{ $item['button']['url'] }}" data-gsap-element="card" class="__card relative bg-secondary radius overflow-hidden p-8">
				<div class="relative z-10">
					@if (!empty($item['image']['url']))
					<img class="mb-6" src="{{ $item['image']['url'] }}" alt="{{ $item['image']['alt'] ?? '' }}" />
					@endif
					@if (!empty($item['title']))
					<p class="text-h6">{{ $item['title'] }}</p>
					@endif
					@if (!empty($item['text']))
					<p class="mt-2">{{ $item['text'] }}</p>
					@endif
					<p class="btn-underline mt-4">Zobacz produkty</p>
				</div>
				<img class="absolute -top-10/12 -right-5/12 mix-blend-overlay" src="/wp-content/uploads/2026/06/shade_shape.svg" />
			</a>
			@endforeach
		</div>
		@endif

	</div>
</section>