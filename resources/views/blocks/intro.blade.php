<!-- intro --->

<section
	data-gsap-anim="section"
	@if(!empty($section_id)) id="{{ $section_id }}" @endif
	@class([ 'b-intro relative -smt overflow-visible' ,
	$sectionClass=> filled($sectionClass),
	$section_class => filled($section_class),
	$background => filled($background) && $background !== 'none',
	])>

	@if (!empty($breadcrumbs))
	<div class="absolute inset-x-0 z-40 w-full pt-2 mt-0 sm:-mt-6">
		<div class="c-main">
			{!! $breadcrumbs !!}
		</div>
	</div>
	@endif

	<div class=" __wrapper c-main grid grid-cols-1 md:grid-cols-2 items-center gap-10 overflow-visible">

		<div class="__content relative flex flex-col justify-center z-20 pt-10 pb-10 md:py-30">
			<h1 data-gsap-element="header" class="text-gradient m-header">
				{{ $g_intro['title'] }}
			</h1>
			<div data-gsap-element="txt" class="">
				{!! $g_intro['txt'] !!}
			</div>

			<div class="inline-buttons m-btn">
				@if (!empty($g_intro['button1']))
				<x-button
					:href="$g_intro['button1']['url']"
					variant="primary"
					class=""
					data-gsap-element="btn">
					{{ $g_intro['button1']['title'] }}
				</x-button>
				@endif

				@if (!empty($g_intro['button2']))
				<x-button
					:href="$g_intro['button2']['url']"
					variant="secondary"
					class=""
					data-gsap-element="btn">
					{{ $g_intro['button2']['title'] }}
				</x-button>
				@endif
			</div>
		</div>

		<div data-gsap-element="image" class="__img relative z-20 overflow-visible">
			<img src="{{ $g_intro['image']['url'] }}" alt="{{ $g_intro['image']['alt'] }}"
				class="mask-img h-[680px] w-full object-cover" />
			<img src="/wp-content/uploads/2026/05/intro-bg.svg" class="absolute top-8 -left-6 h-[504px] w-[504px] object-cover overflow-visible -z-10" />
		</div>
	</div>

	<img src="/wp-content/uploads/2026/05/top-bg.svg" class="absolute -top-1/4 md:-bottom-1/3 left-1/2 -translate-x-1/2 object-cover overflow-visible" />

</section>