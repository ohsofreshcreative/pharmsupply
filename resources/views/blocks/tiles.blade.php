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

<!--- tiles --->

<section data-gsap-anim="section" @if(!empty($section_id)) id="{{ $section_id }}" @endif class="b-tiles -smt {{ $sectionClass }} {{ $section_class }}">
	<div class="__wrapper c-main grid grid-cols-1 md:grid-cols-2 gap-8">

		<div class="__top relative lg:sticky top-0 lg:top-20 h-max">
			@if (!empty($g_tiles['image']['url']))
			<img class="radius img-md w-full object-cover mb-6" src="{{ $g_tiles['image']['url'] }}" alt="{{ $g_tiles['image']['alt'] ?? '' }}" />
			@endif
			<h3 data-gsap-element="header" class="text-gradient m-header">{{ strip_tags($g_tiles['header']) }}</h3>
			<p data-gsap-element="txt">{{ $g_tiles['text'] }}</p>
		</div>

		<div class="grid gap-8">
			@foreach ($r_tiles as $item)
			<div data-gsap-element="card" class="__card relative flex items-center gap-6 bg-primary-lighter border border-primary-light radius p-8">
				@if (!empty($item['image']['url']))
				<div class="bg-primary rounded-full p-4">
					<img class="" src="{{ $item['image']['url'] }}" alt="{{ $item['image']['alt'] ?? '' }}" />
				</div>
				@endif
				@if (!empty($item['title']))
				<p class="text-h6">{{ $item['title'] }}</p>
				@endif
				@if (!empty($item['text']))
				<p class="text-[20px]">{{ $item['text'] }}</p>
				@endif
			</div>
			@endforeach
		</div>

	</div>
</section>