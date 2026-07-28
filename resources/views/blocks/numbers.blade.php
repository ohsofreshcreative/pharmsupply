@php
// --- Dynamic Grid Logic ---
$itemCount = count($g_numbers['r_numbers'] ?? []);
$gridClass = 'grid-cols-1'; // Default for mobile

// Set grid columns for medium screens and up based on item count
if ($itemCount > 1) {
$gridClass .= ' md:grid-cols-' . min($itemCount, 5); // Handles 2, 3, 4, 5 items
}
// --- End Dynamic Grid Logic ---
@endphp

<!--- numbers --->

<section
	data-gsap-anim="section"
	@if(!empty($section_id)) id="{{ $section_id }}" @endif
	@class([ 'b-numbers relative -smt' ,
	$sectionClass=> filled($sectionClass),
	$section_class => filled($section_class),
	$background => filled($background) && $background !== 'none',
	])>

	<div class="__wrapper c-main">
		<div class="">

			@if (!empty($g_numbers['header']))
			<p data-gsap-element="header" class="text-gradient m-header font-header text-h2">{{ strip_tags($g_numbers['header']) }}</p>
			@endif

			@if (!empty($g_numbers['r_numbers']))
			<div class="grid {{ $gridClass }} gap-8 mt-6">
				@foreach ($g_numbers['r_numbers'] as $item)
				<div data-gsap-element="card" class="__card relative bg-primary-lighter border border-primary-light overflow-hidden radius px-6 py-10">
					<img class="absolute -top-70 -right-6/12 mix-blend-overlay z-1 pointer-events-none" src="/wp-content/uploads/2026/06/shade_shape.svg" />
					@if (!empty($item['image']))
					<img class="bg-primary rounded-full p-1 mb-4 relative z-10" src="{{ $item['image']['url'] }}" alt="{{ $item['image']['alt'] ?? '' }}">
					@endif
					@if (!empty($item['title']))
					<p class="text-h4 text-primary relative z-10">{{ $item['title'] }}</p>
					@endif
					@if (!empty($item['txt']))
					<p class="relative z-10">{{ $item['txt'] }}</p>
					@endif
				</div>
				@endforeach
			</div>
			@endif

		</div>
	</div>

</section>