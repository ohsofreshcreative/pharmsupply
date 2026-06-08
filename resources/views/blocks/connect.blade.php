@php
$sectionClass = '';
$sectionClass .= $nomt ? ' !mt-0' : '';
@endphp

<!-- connects -->

<section data-gsap-anim="section" @if(!empty($section_id)) id="{{ $section_id }}" @endif class="b-connects relative bg-gradient overflow-hidden -smt {{ $sectionClass }} {{ $section_class }}">
	<div class="c-main grid grid-cols-1 md:grid-cols-2 items-center">

		<div class="__content relative py-60 z-10">
			<p data-gsap-element="header" class="text-h2 text-white">{{ $connects['header'] }}</p>
			<div data-gsap-element="txt" class="text-white text-xl mt-4">
				{!! $connects['txt'] !!}
			</div>

			<div class="inline-buttons m-btn">
				@if (!empty($connects['button']))
				<x-button
					:href="$connects['button']['url']"
					variant="white"
					class=""
					data-gsap-element="btn">
					{{ $connects['button']['title'] }}
				</x-button>
				@endif

				@if (!empty($connects['button2']))
				<x-button
					:href="$connects['button2']['url']"
					variant="secondary"
					class=""
					data-gsap-element="btn">
					{{ $connects['button2']['title'] }}
				</x-button>
				@endif
			</div>

		</div>

		<div data-gsap-element="img" class="__img h-full w-1/2 absolute right-0 bottom-0 pt-20">
			<img src="{{ $connects['image']['url'] }}" alt="{{ $connects['image']['alt'] }}" class="mask-img w-full h-full object-cover relative z-10" />
			<img class="absolute top-22 right-5 z-0" src="/wp-content/uploads/2026/05/shape.svg" />
		</div>

	</div>
</section>