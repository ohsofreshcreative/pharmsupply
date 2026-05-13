<!--- contact --->

<section
	data-gsap-anim="section" style="background-image:linear-gradient(rgba(5,7,54,0.48), rgba(5, 7, 54,0.48)), url('{{ $g_contact_1['image']['url'] }}'); background-size:cover; background-position:center;" 
	@if(!empty($section_id)) id="{{ $section_id }}" @endif
	@class([ 'b-contact  relative pt-10 pb-10' ,
	$sectionClass=> filled($sectionClass),
	$section_class => filled($section_class),
	$background => filled($background) && $background !== 'none',
	])>

	<div class="__wrapper c-main relative z-2 py-16">

		<div class="relative grid grid-cols-1 lg:grid-cols-2 items-center gap-10 z-10">
			<div class="__content w-full lg:w-11/12 flex flex-col justify-between">
				<h2 data-gsap-element="header" class="text-white">{!! $g_contact_1['header'] !!}</h2>
				<a data-gsap-element="txt" class="__phone flex items-center !text-white text-lg w-max mt-4" href="tel:{{ $g_contact_1['phone'] }}">{{ $g_contact_1['phone'] }}</a>
				<div class="border-t border-dashed border-secondary pt-4 mt-4">
					<a data-gsap-element="txt" class="__mail flex items-center !text-white text-lg w-max" href="mailto:{{ $g_contact_1['mail'] }}">{{ $g_contact_1['mail'] }}</a>
				</div>
				<x-button
					href="#lokalizacje"
					variant="secondary"
					class="mt-6"
					data-gsap-element="btn">
					Sprawdź lokalizacje
				</x-button>
			</div>

			<div data-gsap-element="form" class="bg-white radius p-10">
			<h4 class="!text-primary mb-4">{!! $g_contact_2['title'] !!}</h4>
				{!! do_shortcode($g_contact_2['shortcode']) !!}
			</div>
		</div>
	</div>

</section>