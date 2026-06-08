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

$hasImage = !empty($cta_bg['image']['ID']);
@endphp

<!--- cta-bg -->

<section data-gsap-anim="section" @if(!empty($section_id)) id="{{ $section_id }}" @endif class="b-cta-bg c-main relative bg-gradient radius -smt overflow-hidden {{ $sectionClass }} {{ $section_class }}">

	<div class="__wrapper py-12 radius relative z-10">

		<div class="__inside flex flex-col {{ $hasImage ? 'md:flex-row md:items-center md:justify-between md:gap-10' : 'items-center' }} w-full {{ $hasImage ? 'max-w-6xl' : 'md:w-2/3' }} mx-auto gap-2 px-12">
			<div class="flex flex-col {{ $hasImage ? 'items-start text-left md:w-1/2' : 'items-center' }} gap-2">
				@if ($cta_bg['header'])
				<p data-gsap-element="header" class="text-h5 text-white {{ $hasImage ? 'text-left' : 'text-center' }}">{{ $cta_bg['header'] }}</p>
				@endif
				
				@if ($cta_bg['txt'])
				<div data-gsap-element="text" class="text-body text-white {{ $hasImage ? 'text-left' : 'text-center' }}">{!! $cta_bg['txt'] !!}</div>
				@endif

				@if (!empty($cta_bg['button']))
				<x-button
					:href="$cta_bg['button']['url']"
					variant="white"
					class="mt-6 {{ $hasImage ? 'text-left' : 'text-center' }}"
					data-gsap-element="btn">
					{{ $cta_bg['button']['title'] }}
				</x-button>
				@endif
			</div>

			@if ($hasImage)
			<div class="__img h-full absolute -right-6 bottom-0 pt-20">
				<img
					class="mask-img w-full h-full object-cover relative z-10"
					src="{{ $cta_bg['image']['url'] }}"
					alt="{{ $cta_bg['image']['alt'] ?: $cta_bg['image']['title'] }}" />
			</div>
			@endif
		</div>

	</div>
	<img class="absolute opacity-15 -top-1/2 left-30" src="/wp-content/uploads/2026/05/white-shape.svg" />
</section>