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

<!--- reactions --->


@if (!empty($breadcrumbs))
<div class="absolute inset-x-0 z-40 w-full pt-2 mt-0 sm:-mt-6">
	<div class="c-main">
		{!! $breadcrumbs !!}
	</div>
</div>
@endif

<section data-gsap-anim="section" @if(!empty($section_id)) id="{{ $section_id }}" @endif class="b-reactions -smt {{ $sectionClass }} {{ $section_class }}">

	<div class="__wrapper c-main">
		<div class="__top w-full md:w-1/2">
			<h2 data-gsap-element="header" class="text-gradient m-header">{{ strip_tags($g_reactions['header']) }}</h2>
			<div data-gsap-element="txt">{!! $g_reactions['text'] !!}</div>
		</div>

		@if (!empty($r_reactions))
		@php
		$itemCount = count($r_reactions);
		$gridCols = 1;
		if ($itemCount == 2) $gridCols = 2;
		if ($itemCount == 3) $gridCols = 3;
		if ($itemCount >= 4) $gridCols = 4; // Twój dotychczasowy warunek
		$gridClass = $gridCols > 1 ? 'grid-cols-1 lg:grid-cols-' . $gridCols : 'grid-cols-1';
		@endphp
		<b data-gsap-element="txt" class="block mt-8">{!! $g_reactions['title'] !!}</b>
		<div class="grid {{ $gridClass }} gap-8 mt-2">
			@foreach ($r_reactions as $item)
			<div data-gsap-element="card" class="__card relative bg-white b-shadow radius p-6">
				@if (!empty($item['image']['url']))
				<div class="bg-primary rounded-full flex w-14 h-14 p-4">
					<img class="" src="{{ $item['image']['url'] }}" alt="{{ $item['image']['alt'] ?? '' }}" />
				</div>
				@endif
				@if (!empty($item['title']))
				<p class="text-h6 mt-4">{!! $item['title'] !!}</p>
				@endif
				@if (!empty($item['text']))
				<div class="__txt mt-2">{!! $item['text'] !!}</div>
				@endif


				@if (!empty($item['button']))
				<x-button
					:href="$item['button']['url']"
					:target="$item['button']['target'] ?? '_self'"
					:rel="($item['button']['target'] ?? '') === '_blank' ? 'noopener noreferrer' : null"
					variant="primary"
					class="mt-6"
					data-gsap-element="btn">
					{{ $item['button']['title'] }}
				</x-button>
				@endif
			</div>
			@endforeach
		</div>
		@endif

	</div>
</section>
