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

<!--- relief --->

<section data-gsap-anim="section" @if(!empty($section_id)) id="{{ $section_id }}" @endif class="b-relief mt-16 {{ $sectionClass }} {{ $section_class }}">
	<div class="__wrapper c-main">
		@if(!empty($g_relief['header']))
		<h2 data-gsap-element="header" class="text-gradient m-header">{{ strip_tags($g_relief['header']) }}</h2>
		@endif

		@if (!empty($r_relief))
		@php
		$itemCount = count($r_relief);
		$gridCols = 1;
		if ($itemCount == 2) $gridCols = 2;
		if ($itemCount == 3) $gridCols = 3;
		if ($itemCount >= 4) $gridCols = 4; // Twój dotychczasowy warunek
		$gridClass = $gridCols > 1 ? 'grid-cols-1 lg:grid-cols-' . $gridCols : 'grid-cols-1';
		@endphp

		<div class="grid {{ $gridClass }} gap-8 mt-10">
			@foreach ($r_relief as $item)
			<div data-gsap-element="card" class="__card flex items-center relative bg-primary-lighter border border-primary-light radius gap-4 p-8">
				@if (!empty($item['image']['url']))
				<img class="bg-primary rounded-full w-12 h-12 p-2" src="{{ $item['image']['url'] }}" alt="{{ $item['image']['alt'] ?? '' }}" />
				@endif
				@if (!empty($item['title']))
				<p class="text-h7">{{ $item['title'] }}</p>
				@endif
				@if (!empty($item['text']))
				<p class="">{{ $item['text'] }}</p>
				@endif
			</div>
			@endforeach
		</div>
		@endif

	</div>
</section>