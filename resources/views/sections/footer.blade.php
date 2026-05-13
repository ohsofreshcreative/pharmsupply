<footer class="footer bg-primary overflow-hidden relative z-10 -smt">
	<div class="__wrapper c-main relative z-10">
		<div class="__top flex flex-col md:flex-row items-center justify-between gap-6 mt-20">
			<img src="{{ $logo_footer['url'] }}" alt="{{ $logo_footer['alt'] ?? 'Logo' }}" class="relative w-auto max-w-46">

			@if (is_active_sidebar('sidebar-footer-1'))
			<div class="__footer-widget text-white flex">
				@php(dynamic_sidebar('sidebar-footer-1'))
			</div>
			@endif

			<x-button
				href="tel:692580241"
				variant="secondary"
				class="!flex gap-2"
				data-gsap-element="btn">
				<img src="/wp-content/uploads/2026/05/phone-white.svg" />+48 692 580 241
			</x-button>

		</div>

		@php($locations = get_field('locat', 'option'))
		@if ($locations)
		@php($count = count($locations))
		<div class="__widgets border-t border-secondary grid grid-cols-1 md:grid-cols-2 lg:[grid-template-columns:repeat(var(--lg-cols),minmax(0,1fr))] gap-10 md:gap-6 py-26 mt-12" style="--lg-cols: {{ $count }};">
			@foreach ($locations as $loc)
			<div class="__location text-white">
				@if (!empty($loc['name']))
				<b class="font-bold">{{ $loc['name'] }}</b>
				@endif
				@if (!empty($loc['txt']))
				<div class="flex items-center gap-2 mt-3">
					<img src="/wp-content/uploads/2026/05/place.svg" alt="Ikona miejsca" class="">
					<p class="mb-3">{!! $loc['txt'] !!}</p>
				</div>
				@endif
				@if (!empty($loc['phone']))
				<div class="flex items-center gap-2 mt-2">
					<img src="/wp-content/uploads/2026/05/phone.svg" alt="Ikona telefonu" class="">
					<p><a href="tel:{{ preg_replace('/\s+/', '', $loc['phone']) }}">{{ $loc['phone'] }}</a></p>
				</div>
				@endif
			</div>
			@endforeach
		</div>
		@endif

	</div>

	<div class="c-main flex flex-col md:flex-row justify-between gap-6 py-10 footer-bottom border-t border-secondary">
		<p class="text-white">Copyright &copy;{{ date('Y') }} <?php echo get_bloginfo('name'); ?>. All Rights Reserved</p>
		<p class="flex text-white gap-2">Designed &amp; Developed by
			<a target="_blank" rel="nofollow" href="https://www.ohsofresh.pl" title="OhSoFresh"><img class="oh" src="/wp-content/themes/multiserwis/resources/images/ohsofresh.svg"></a>
		</p>
	</div>

	<img class="__bg absolute top-0 left-0 opacity-5 pointer-events-none" src="/wp-content/uploads/2026/01/shape-footer.svg" />
	</div>
</footer>