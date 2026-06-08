<!--- about -->

<section
	data-gsap-anim="section"
	@if(!empty($section_id)) id="{{ $section_id }}" @endif
	@class([ 'b-about relative -smt' ,
	$sectionClass=> filled($sectionClass),
	$section_class => filled($section_class),
	$background => filled($background) && $background !== 'none',
	])>

	<div class="__wrapper c-main relative z-10 grid grid-cols-1 md:grid-cols-[2fr_1fr] items-center gap-8 lg:gap-20">

		<div class="__content flex flex-col lg:flex-row gap-8 order2 lg:py-10">
			<div>
				<p data-gsap-element="eyebrow" class="w-max text-lg text-secondary">{{ $g_about['eyebrow'] }}</p>
			</div>
			<div>
				<h3 data-gsap-element="header" class="text-h4 text-gradient">{{ $g_about['header'] }}</h3>
				<div data-gsap-element="txt" class="__txt mt-4">
					{!! $g_about['txt'] !!}
				</div>
				@if (!empty($g_about['button']))
				<x-button
					:href="$g_about['button']['url']"
					variant="secondary"
					class="mt-6"
					data-gsap-element="btn">
					{{ $g_about['button']['title'] }}
				</x-button>
				@endif
			</div>
		</div>

		@if (!empty($g_about['image']))
		<div data-gsap-element="img" class="__img h-full order1">
			<img class="mask-img object-contain object-top-left w-full h-full aspect-[3/2] __img radius-img relative z-10" src="{{ $g_about['image']['url'] }}" alt="{{ $g_about['image']['alt'] ?? '' }}">
			<img class="absolute top-0 -right-20 z-10" src="/wp-content/uploads/2026/05/shape-stroke.svg" />
			<img class="absolute top-0 blur-[350px] opacity-60 w-full h-full z-0" src="/wp-content/uploads/2026/05/hero-shape.svg" />
		</div>
		@endif

	</div>
</section>