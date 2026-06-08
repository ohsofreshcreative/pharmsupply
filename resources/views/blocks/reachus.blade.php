<!--- reachus --->

<section
	data-gsap-anim="section"
	@if(!empty($section_id)) id="{{ $section_id }}" @endif
	@class([ 'b-reachus bg-gradient relative pt-10 pb-10' ,
	$sectionClass=> filled($sectionClass),
	$section_class => filled($section_class),
	$background => filled($background) && $background !== 'none',
	])>

	<div class="__wrapper c-main relative z-2 py-16">

		<div class="relative grid grid-cols-1 lg:grid-cols-2 items-center gap-10 z-10">
			<div class="__content w-full lg:w-11/12 flex flex-col justify-between">
				<h2 data-gsap-element="header" class="text-white">{!! $g_reachus_1['header'] !!}</h2>
				<div data-gsap-element="txt" class="text-white">{!! $g_reachus_1['txt'] !!}</div>
				<a data-gsap-element="txt" class="__phone flex items-center !text-white text-lg w-max mt-4" href="tel:{{ $g_reachus_1['phone'] }}">{{ $g_reachus_1['phone'] }}</a>
				<div class="mt-4">
					<a data-gsap-element="txt" class="__mail flex items-center !text-white text-lg w-max" href="mailto:{{ $g_reachus_1['mail'] }}">{{ $g_reachus_1['mail'] }}</a>
				</div>
			</div>

			<div data-gsap-element="form" class="bg-white radius p-10">
				<h4 class="!text-primary mb-4">{!! $g_reachus_2['title'] !!}</h4>
				{!! do_shortcode($g_reachus_2['shortcode']) !!}
			</div>
		</div>
	</div>

</section>