@php
$sectionClass = '';
$sectionClass .= $flip ? ' order-flip' : '';
$sectionClass .= $wide ? ' wide' : '';
$sectionClass .= $nomt ? ' !mt-0' : '';
$sectionClass .= $gap ? ' wider-gap' : '';

if (!empty($background) && $background !== 'none') {
$sectionClass .= ' ' . $background;
}

// Wspólna lista lokalizacji do wszystkich map (każdy kantor pokazuje wszystkie pinezki).
$cantor_locations = [];
if (!empty($r_cantors) && is_array($r_cantors)) {
foreach ($r_cantors as $c) {
if ($c['lat'] === '' || $c['lng'] === '' || $c['lat'] === null || $c['lng'] === null) continue;
$cantor_locations[] = [
'label' => $c['title'] ?? '',
'address' => trim(($c['address'] ?? '') . (!empty($c['phone']) ? "\n" . $c['phone'] : '')),
'lat' => $c['lat'],
'lng' => $c['lng'],
];
}
}
@endphp

<!--- cantors --->

<section class="c-wide radius " style="background-image:linear-gradient(rgba(5,7,54,0.5), rgba(5,7,54,0.5)), url('{{ $g_cantors['bg']['url'] }}'); background-size:cover; background-position:center;">
	<div class="__inside c-main">
		<div class="__content relative z-20 pt-10 pb-10 md:py-30">
			<h3 data-gsap-element="header" class="text-white m-header">{{ strip_tags($g_cantors['header']) }}</h3>
			<p data-gsap-element="txt">{{ $g_cantors['text'] }}</p>
			@if (!empty($g_cantors['buttons']))
			<div class="inline-buttons mt-6 flex-wrap">
				@foreach ($g_cantors['buttons'] as $bi => $btn)
				<x-button
					href="#kantor-{{ $bi + 1 }}"
					variant="secondary"
					class=""
					data-gsap-element="btn">
					{{ $btn['label'] }}
				</x-button>
				@endforeach
			</div>
			@endif
		</div>
	</div>
</section>

<section data-gsap-anim="section" @if(!empty($section_id)) id="{{ $section_id }}" @endif class="b-cantors -smt {{ $sectionClass }} {{ $section_class }}">
	<div class="__wrapper c-main">

		@if (!empty($r_cantors))
		<div class="grid gap-8 mt-10">
			@foreach ($r_cantors as $i => $item)
			<h2 id="kantor-{{ $i + 1 }}" data-gsap-element="header" class="scroll-mt-24">{{ $item['title'] }}</h2>
			<div data-gsap-element="card" class="__card grid grid-cols-1 md:grid-cols-2 relative bg-background radius gap-8">
				<div class="__content">
					@if (!empty($item['image']['url']))
					<img class="img-m w-full object-cover radius mb-6" src="{{ $item['image']['url'] }}" alt="{{ $item['image']['alt'] ?? '' }}" />
					@endif
					<div class="__txt bg-light radius p-10">
						<div class="grid grid-cols-1 md:grid-cols-2 gap-4">
							<div>
								<b class="text-lg block mb-2">{{ $item['title'] }}</b>
								<p class="">{!! $item['address'] !!}</p>
								<div class="flex items-center gap-2 mt-2">
									<img src="/wp-content/uploads/2026/05/phone.svg" alt="Ikona telefonu" class="">
									<span class="">{{ $item['phone'] }}</span>
								</div>
							</div>
							<div class="__hours">
								<b class="text-lg block mb-2">Godziny otwarcia</b>
								<p>{!! $item['hours'] !!}</p>
							</div>
						</div>

						<div class="__btns inline-buttons mt-6">
							@if (!empty($item['navi']))
							<x-button
								:href="$item['navi']"
								target="_blank"
								variant="secondary"
								class=""
								data-gsap-element="btn">
								Włącz nawigację
							</x-button>
							@endif

							<x-button
								href="/kursy-walut/"
								variant="outline-secondary"
								class=""
								data-gsap-element="btn">
								Aktualne kursy punktu
							</x-button>
						</div>
					</div>
				</div>

				<div>
					@if (!empty($cantor_locations))
					<div
						class="js-cantor-map radius overflow-hidden w-full h-full min-h-[400px]"
						data-zoom="15"
						@if($item['lat'] !=='' && $item['lng'] !=='' )
						data-focus-lat="{{ $item['lat'] }}"
						data-focus-lng="{{ $item['lng'] }}"
						@endif
						data-locations='@json($cantor_locations)'></div>
					@endif
				</div>
			</div>
			@endforeach
		</div>
		@endif

	</div>
</section>