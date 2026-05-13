@php
$sectionClass = '';
$sectionClass .= $nomt ? ' !mt-0' : '';

// Najnowszy wyróżniony (sticky) wpis – fallback do najnowszego zwykłego
$sticky_ids = get_option('sticky_posts') ?: [];
$featured_post = null;
if (!empty($sticky_ids)) {
$q = new \WP_Query([
'post__in' => $sticky_ids,
'posts_per_page' => 1,
'ignore_sticky_posts' => 1,
'orderby' => 'date',
'order' => 'DESC',
'no_found_rows' => true,
]);
if ($q->have_posts()) { $q->the_post(); $featured_post = get_post(); wp_reset_postdata(); }
}
@endphp

<!-- hero --->

<section
	data-gsap-anim="section"
	@if(!empty($section_id)) id="{{ $section_id }}" @endif
	class="b-hero relative {{ $sectionClass }} {{ $section_class }}">

	<div class=" __wrapper c-wide relative radius z-20 py-20" style="background-image:linear-gradient(rgba(5,7,54,0.5), rgba(5,7,54,0.5)), url('{{ $g_hero['image']['url'] }}'); background-size:cover; background-position:center;">
		<div class="__inside c-main grid grid-cols-1 md:grid-cols-2 gap-10">
			<div class="__content relative flex flex-col justify-center z-20 pt-10 pb-10 md:py-30">
				<h1 data-gsap-element="header" class="text-white bg-bg-brand">
					{{ $g_hero['title'] }}
				</h1>
				<div data-gsap-element="txt" class="text-h4 text-secondary-light">
					{!! $g_hero['txt'] !!}
				</div>
				@if (!empty($g_hero['button1']))
				<div class="inline-buttons m-btn">
					<a data-gsap-element="button" class="second-btn left-btn"
						href="{{ $g_hero['button1']['url'] }}"
						target="{{ $g_hero['button1']['target'] }}">
						{{ $g_hero['button1']['title'] }}
					</a>
					@if (!empty($g_hero['button2']))
					<a data-gsap-element="button" class="white-btn"
						href="{{ $g_hero['button2']['url'] }}"
						target="{{ $g_hero['button2']['target'] }}">
						{{ $g_hero['button2']['title'] }}
					</a>
					@endif
				</div>
				@endif
				<p data-gsap-element="txt" class="!font-bold text-lg text-white mt-20">
					Nasze kantory są nadzorowane przez Narodowy Bank Polski
				</p>
			</div>
			<div class="__calc relative z-20 self-center w-full max-w-md ml-auto bg-background backdrop-blur p-6 md:p-8 rounded-2xl shadow-xl"
				x-data='msCurrencyCalc(@json($locations))'>
				<h5 class="mb-2">Kalkulator wymiany</h5>
				@if(empty($locations))
				<p class="text-secondary-light">Brak danych walutowych. Uzupełnij „Kursy walut → Opcje".</p>
				@else
				{{-- Tryb: kupić / sprzedać --}}
				<div class="border border-primary-50 rounded-full grid grid-cols-2 gap-2 p-2 mb-5">
					<button type="button"
						class="py-2 px-3 rounded-full border font-bold transition"
						:class="mode === 'buy'  ? 'bg-secondary text-white border-secondary' : 'bg-white text-primary border-primary/30'"
						@click="mode = 'buy'">Chcę kupić</button>
					<button type="button"
						class="py-2 px-3 rounded-full border font-bold transition"
						:class="mode === 'sell' ? 'bg-secondary text-white border-secondary' : 'bg-white text-primary border-primary/30'"
						@click="mode = 'sell'">Chcę sprzedać</button>
				</div>

				{{-- Placówka --}}
				<label class="block mb-1 text-sm font-bold">Placówka</label>
				<select x-model="locationSlug"
					class="w-full mb-4 !border-1 !rounded-full !px-6 py-2 appearance-none bg-no-repeat"
					style="background-image: url(&quot;data:image/svg+xml;utf8,<svg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 20 20' fill='%23000'><path fill-rule='evenodd' d='M5.23 7.21a.75.75 0 011.06.02L10 11.06l3.71-3.83a.75.75 0 111.08 1.04l-4.25 4.39a.75.75 0 01-1.08 0L5.21 8.27a.75.75 0 01.02-1.06z' clip-rule='evenodd'/></svg>&quot;); background-position: right 1.55rem center; background-size: 1rem;">
					<template x-for="loc in locations" :key="loc.slug">
						<option :value="loc.slug" x-text="loc.name"></option>
					</template>
				</select>

				{{-- Waluta --}}
				<label class="block mb-1 text-sm font-bold">Waluta</label>
				<div class="relative mb-4" x-data="{ open: false }" @click.outside="open = false">
					<button type="button"
						@click="open = !open"
						class="w-full !border-1 !rounded-full !px-6 py-2 bg-white flex items-center justify-between gap-3 text-left">
						<span class="flex items-center gap-3">
							<template x-if="currentRow?.flag">
								<img :src="currentRow.flag" :alt="currencyCode"
									width="24" height="24"
									class="rounded-full aspect-square object-cover shrink-0">
							</template>
							<span class="font-bold" x-text="currencyCode"></span>
						</span>
						<svg class="w-4 h-4 transition" :class="open && 'rotate-180'" viewBox="0 0 20 20" fill="currentColor">
							<path fill-rule="evenodd" d="M5.23 7.21a.75.75 0 011.06.02L10 11.06l3.71-3.83a.75.75 0 111.08 1.04l-4.25 4.39a.75.75 0 01-1.08 0L5.21 8.27a.75.75 0 01.02-1.06z" clip-rule="evenodd" />
						</svg>
					</button>

					<ul x-show="open" x-transition
						class="absolute z-30 mt-2 w-full bg-white border rounded-2xl shadow-lg max-h-64 overflow-auto py-1"
						style="display:none">
						<template x-for="r in currentRates" :key="r.code">
							<li>
								<button type="button"
									@click="currencyCode = r.code; open = false"
									class="w-full flex items-center gap-3 px-4 py-2 hover:bg-background text-left"
									:class="r.code === currencyCode && 'bg-background'">
									<template x-if="r.flag">
										<img :src="r.flag" :alt="r.code"
											width="24" height="24"
											class="rounded-full aspect-square object-cover shrink-0">
									</template>
									<span class="font-bold" x-text="r.code"></span>
									<span class="text-secondary-light text-sm" x-text="r.name"></span>
								</button>
							</li>
						</template>
					</ul>
				</div>

				{{-- Kwota waluty --}}
				<label class="block mb-1">
					<span class="!text-sm !font-bold" x-text="mode === 'buy' ? 'Chcę kupić (kwota waluty)' : 'Chcę sprzedać (kwota waluty)'"></span>
				</label>
				<div class="relative mb-4">
					<input type="number" min="0" step="0.01" inputmode="decimal"
						x-model.number="amount"
						class="w-full border !rounded-full bg-white px-6 py-2 pr-16"
						placeholder="0,00">
					<span class="absolute right-3 top-1/2 -translate-y-1/2 font-bold text-secondary-light"
						x-text="currencyCode"></span>
				</div>

				{{-- Wynik --}}
				<div class="bg-white border rounded-xl p-4">
					<div class="text-sm text-secondary-light mb-1">
						<span x-text="mode === 'buy' ? 'Zapłacisz' : 'Otrzymasz'"></span>
					</div>
					<div class="text-2xl font-bold">
						<span x-text="formattedResult"></span> PLN
					</div>
				</div>

				<div class="bg-primary !font-bold text-center text-sm text-white rounded-2xl border-2 border-dotted border-secondary px-10 py-6 mt-4">
				Możliwość negocjacji cen powyżej równowartości 3000 PLN
				</div>
				@endif
			</div>
		</div>

	</div>

	@if($featured_post)
	<div class="c-main !-mt-10 relative z-20 overflow-hidden">
		<a href="{{ get_permalink($featured_post) }}"
			class="flex flex-col md:flex-row gap-10 bg-primary border-2 border-secondary border-dotted rounded-2xl p-6 md:p-8">
			<img class="w-16 h-16 relative z-20" src="/wp-content/uploads/2026/05/info.svg" />
			<div class="w-full md:w-1/2 relative z-20">
				<p class="text-h6 text-white mb-2">{{ get_the_title($featured_post) }}</p>
				<p class="text-white">
					{{ get_the_excerpt($featured_post) ?: wp_trim_words(strip_shortcodes($featured_post->post_content), 30) }}
				</p>
			</div>
			<img class="absolute mix-blend-soft-light right-20 top-1/2 -translate-y-1/2 z-10 pointer-events-none" src="/wp-content/uploads/2026/05/info_bg.svg" />
		</a>
	</div>
	@endif

</section>