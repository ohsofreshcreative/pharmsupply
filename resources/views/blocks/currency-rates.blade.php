@php
$sectionClass = $nomt ? ' !mt-0' : '';
$g = $g_rates;
@endphp

<section
	@if(!empty($section_id)) id="{{ $section_id }}" @endif
	class="b-currency-rates relative pt-14 {{ $sectionClass }} {{ $section_class }}">

	<div class="c-main">

		@if(empty($locations))
		<p class="text-secondary-light">Brak danych — dodaj placówkę i wgraj plik w „Kursy walut → Opcje".</p>
		@else
		<div class="js-currency-rates" data-currency-rates>

			<div class="__top flex justify-between">
				<div>
					@if(!empty($g['title']))
					<h2 class="text-h2 mb-4">{{ $g['title'] }}</h2>
					@endif
					@if(!empty($g['txt']))
					<div class="__txt">{!! $g['txt'] !!}</div>
					@endif
				</div>
				@if(count($locations) > 1)
				<div class="mb-6">
					<label class="block font-bold" for="currency-location">Kursy dla</label>
					<select
						id="currency-location"
						class="js-currency-location !border-1 !border-primary-50 !rounded-full px-4 !py-2"
						data-currency-select>
						@foreach($locations as $i => $loc)
						<option value="{{ $loc['slug'] ?? $i }}">{{ $loc['name'] ?? 'Placówka '.($i+1) }}</option>
						@endforeach
					</select>
				</div>
				@endif
			</div>

			@foreach($locations as $i => $loc)
			<div
				class="js-currency-panel {{ $i === 0 ? '' : 'hidden' }}"
				data-currency-panel="{{ $loc['slug'] ?? $i }}">
				<div role="table" class="w-full text-left mt-10">
					<div role="row" class="grid grid-cols-[2fr_1fr_1fr] px-4 mb-2">
						<div role="columnheader" class="!font-bold py-3">{{ $g['col_code'] ?? 'Waluta' }}</div>
						<div role="columnheader" class="!font-bold py-3">{{ $g['col_buy']  ?? 'Kupno' }}</div>
						<div role="columnheader" class="!font-bold py-3">{{ $g['col_sell'] ?? 'Sprzedaż' }}</div>
					</div>

					<div role="rowgroup" class="flex flex-col gap-3" data-currency-rows>
						@forelse($loc['rates'] ?? [] as $idx => $r)
						@php $info = \App\ms_currency_info($r['code']); @endphp
						<div role="row"
							@class([ 'grid grid-cols-[2fr_1fr_1fr] items-center bg-white border border-secondary rounded-full px-4' , 'hidden'=> $idx >= 9,
							])
							@if($idx >= 9) data-currency-extra @endif>
							<div role="cell" class="py-3">
								<div class="flex items-center gap-3">
									@if($info['flag'])
									<img src="{{ $info['flag'] }}"
										alt="{{ $info['code'] }}"
										width="28" height="20"
										class="rounded-full aspect-square object-cover shrink-0"
										loading="lazy">
									@endif
									<span class="font-bold">{{ $info['code'] }}</span>
									<span class="text-secondary-light hidden sm:block">{{ $info['name'] }}</span>
								</div>
							</div>
							<div role="cell" class="py-3">{{ number_format($r['buy'],  4, ',', ' ') }}</div>
							<div role="cell" class="py-3">{{ number_format($r['sell'], 4, ',', ' ') }}</div>
						</div>
						@empty
						<div role="row" class="py-3 px-4">
							<div role="cell">Brak danych dla tej placówki.</div>
						</div>
						@endforelse
					</div>
				</div>


				@if($updated_at)
				<p class="mt-4 text-sm text-secondary-light">
					Aktualizacja: {{ \Carbon\Carbon::parse($updated_at)->format('d.m.Y H:i') }}
				</p>
				@endif

				@if(count($loc['rates'] ?? []) > 9)
				<div class="mt-6 flex justify-center">
					<x-button
						type="button"
						variant="secondary"
						data-currency-toggle
						data-label-more="{{ $g['btn_more'] ?? 'Zobacz wszystkie kursy' }}"
						data-label-less="{{ $g['btn_less'] ?? 'Pokaż mniej' }}">
						{{ $g['btn_more'] ?? 'Zobacz wszystkie kursy' }}
					</x-button>
				</div>
				@endif
			</div>
			@endforeach
		</div>

		@endif
	</div>
</section>