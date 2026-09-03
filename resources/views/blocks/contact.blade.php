<!--- contact --->

<section
	data-gsap-anim="section"
	@if(!empty($section_id)) id="{{ $section_id }}" @endif
	@class([ 'b-contact bg-gradient relative pt-10 pb-10' ,
	$sectionClass=> filled($sectionClass),
	$section_class => filled($section_class),
	$background => filled($background) && $background !== 'none',
	])>

	<div class="__wrapper c-main relative z-2 py-16">

		<h2 data-gsap-element="header" class="text-white">{!! $g_contact_1['header'] !!}</h2>

		<div class="relative grid grid-cols-1 lg:grid-cols-2 gap-20 z-10 mt-8">
			<div class="__content flex flex-col">
				@if (!empty($g_contact_1['image']))
				<img data-gsap-element="img" class="radius img-m w-full object-cover" src="{{ $g_contact_1['image']['url'] }}'" alt="{{ $g_contact_1['image']['alt'] ?? '' }}" />
				@endif

				<div class="flex flex-col md:flex-row justify-between items-start md:items-end gap-4 mt-10">
					@if (!empty($g_contact_1['adress1']))
					<div data-gsap-element="txt" class="text-white [&_strong]:!text-white">{!! $g_contact_1['adress1'] !!}</div>
					@endif
					@if (!empty($g_contact_1['adress2']))
					<div data-gsap-element="txt" class="text-white [&_strong]:!text-white">{!! $g_contact_1['adress2'] !!}</div>
					@endif
				</div>
				@if (!empty($g_contact_1['button']))
				<x-button
					:href="$g_contact_1['button']['url']"
					variant="outline"
					class="mt-6"
					data-gsap-element="btn">
					{{ $g_contact_1['button']['title'] }}
				</x-button>
				@endif

				<div data-gsap-element="txt" class="__data border-t border-primary-100/50 mt-6">
					<a data-gsap-element="txt" class="__phone flex items-center !text-white text-lg w-max mt-6" href="tel:{{ $g_contact_1['phone'] }}">{{ $g_contact_1['phone'] }}</a>
					<a data-gsap-element="txt" class="__mail flex items-center !text-white text-lg w-max mt-4" href="mailto:{{ $g_contact_1['mail'] }}">{{ $g_contact_1['mail'] }}</a>
				</div>

				<div data-gsap-element="social" class="__social border-t border-primary-100/50 flex items-center gap-4 pt-6 mt-6">
					<p class="text-white">{{ $g_contact_1['social'] }}</p>
					<img src="/wp-content/uploads/2026/05/fb-1.svg" />
				</div>
			</div>

			<div data-gsap-element="form" class="bg-white radius p-10">
				<h4 class="!text-primary mb-4">{!! $g_contact_2['title'] !!}</h4>
				{!! do_shortcode($g_contact_2['shortcode']) !!}
			</div>
		</div>
	</div>

</section>