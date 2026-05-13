@php
$sectionClass = '';
$sectionClass .= $flip ? ' order-flip' : '';
$sectionClass .= $nolist ? ' no-list' : '';
$sectionClass .= $wide ? ' wide' : '';
$sectionClass .= $nomt ? ' !mt-0' : '';
$sectionClass .= $gap ? ' wider-gap' : '';

if (!empty($background) && $background !== 'none') {
$sectionClass .= ' ' . $background;
}
@endphp

<!--- about -->

<section data-gsap-anim="section" @if(!empty($section_id)) id="{{ $section_id }}" @endif class="b-about relative -smt {{ $sectionClass }} {{ $section_class }}">
	<div class="__wrapper c-wide bg-primary radius overflow-hidden">

		<div class="__inside c-main relative section-py z-10">
			<div class="__col grid grid-cols-1 lg:grid-cols-2 items-center gap-10">

				<div class="__about order2">
					<h2 data-gsap-element="header" class="text-h4 text-white">{{ $g_about['header'] }}</h2>

					<div data-gsap-element="txt" class="__txt text-white mt-2">
						{!! $g_about['txt'] !!}
					</div>

					@if (!empty($g_about['button']))
					<a data-gsap-element="btn" class="main-btn m-btn align-self-bottom" href="{{ $g_about['button']['url'] }}">{{ $g_about['button']['title'] }}</a>
					@endif

				</div>

				@if (!empty($g_about['image']))

				<div data-gsap-element="img" class="__img relative h-full order1">
					<img class="__img object-cover w-full img-md radius-img" src="{{ $g_about['image']['url'] }}" alt="{{ $g_about['image']['alt'] ?? '' }}">
				</div>
				@endif

			</div>
			@if (!empty($r_about))

			<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8 mt-10">
				@foreach ($r_about as $item)
				<div data-gsap-element="card" class="__card relative bg-secondary radius p-10">
					@if (!empty($item['image']['url']))
					<img class="mb-6" src="{{ $item['image']['url'] }}" alt="{{ $item['image']['alt'] ?? '' }}" />
					@endif
					@if (!empty($item['title']))
					<b class="!text-white mb-4">{{ $item['title'] }}</b>
					@endif
					@if (!empty($item['text']))
					<p class="text-white mt-4">{{ $item['text'] }}</p>
					@endif
				</div>
				@endforeach
			</div>
			@endif
			<img class="absolute bottom-0 -left-30 opacity-20" src="/wp-content/uploads/2026/05/shape.svg" />
		</div>
	</div>
</section>