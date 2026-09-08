<!--- indications -->

@php
$resultsId = sanitize_html_class(($section_id ?: ($block->data['id'] ?? 'indications')) . '-results');
$translate = static fn(string $text): string => function_exists('pll__') ? pll__($text) : $text;
@endphp

<section
	data-gsap-anim="section"
	@if(!empty($section_id)) id="{{ $section_id }}" @endif
	@class([ 'b-indications relative -smt' ,
	$sectionClass=> filled($sectionClass),
	$section_class => filled($section_class),
	$background => filled($background) && $background !== 'none',
	])>

	<div class="__wrapper c-main relative grid grid-cols-1 lg:grid-cols-[1fr_3fr] items-start gap-6">

		<aside data-gsap-element="aside" class="__filters relative order1">
			@if (!empty($categoriesTree))
			<ul class="__category-list">
				<li>
					<a href="{{ $filterBaseUrl }}#{{ $resultsId }}"
						@class(['__category-link __category-parent', '__active' => $activeCategorySlug === ''])
						@if ($activeCategorySlug === '') aria-current="true" @endif>
						{{ $translate('Wszystkie produkty') }}
					</a>
				</li>
				@foreach ($categoriesTree as $parent)
				@php
					$hasChildren = !empty($parent['children']);
					$isExpanded = $activeCategorySlug === $parent['slug']
						|| in_array($activeCategorySlug, array_column($parent['children'], 'slug'), true);
					$childrenId = $resultsId . '-category-' . $loop->index;
				@endphp
				<li>
					<div class="__category-heading">
						<a href="{{ $parent['url'] }}#{{ $resultsId }}"
							@class(['__category-link __category-parent', '__active' => $activeCategorySlug === $parent['slug']])
							@if ($activeCategorySlug === $parent['slug']) aria-current="true" @endif>
							{{ $parent['name'] }}
						</a>
						@if ($hasChildren)
						<button type="button" class="__category-toggle"
							aria-label="{{ $parent['name'] }}"
							aria-expanded="{{ $isExpanded ? 'true' : 'false' }}" aria-controls="{{ $childrenId }}">
							<svg class="__category-arrow" width="18" height="18" viewBox="0 0 24 24" fill="none" aria-hidden="true">
								<path d="m6 9 6 6 6-6" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
							</svg>
						</button>
						@endif
					</div>

					@if ($hasChildren)
					<ul id="{{ $childrenId }}" class="__category-children" @if (!$isExpanded) hidden @endif>
						@foreach ($parent['children'] as $child)
						<li>
							<a
								href="{{ $child['url'] }}#{{ $resultsId }}"
								@class(['__category-link', '__active' => $activeCategorySlug === $child['slug']])
								@if ($activeCategorySlug === $child['slug']) aria-current="true" @endif>
								{{ $child['name'] }}
							</a>
						</li>
						@endforeach
					</ul>
					@endif
				</li>
				@endforeach
			</ul>
			@endif
		</aside>

		<div id="{{ $resultsId }}" class="__indications order2">

			@if (!empty($products))
			<div class="space-y-3">
				@foreach ($products as $product)
				<article data-gsap-element="stagger" class="flex flex-col md:flex-row rounded-xl items-start md:items-center gap-4 bg-white b-shadow p-4 lg:px-5 lg:py-3">

					@if (!empty($product['thumbnail']))
					<a href="{{ $product['permalink'] }}" class="block shrink-0">
						<img
							src="{{ $product['thumbnail'] }}"
							alt="{{ $product['title'] }}"
							class="h-28 w-28 md:h-32 md:w-32 rounded-lg object-contain object-center">
					</a>
					@endif

					<div class="flex-1 flex flex-col lg:flex-row items-start lg:items-center gap-3">
						<div>
							<h3 class="!text-lg !leading-snug">
								<a href="{{ $product['permalink'] }}" class="hover:text-primary transition">
									{{ $product['title'] }}
								</a>
							</h3>
							@if (!empty($product['form']))
							<p class="mt-1 text-sm">
								{{ $product['form'] }}
							</p>
							@endif
							@if (!empty($product['packaging']))
							<p class="text-sm">
								{{ $product['packaging'] }}
							</p>
							@endif
						</div>
						<x-button
							href="{{ $product['permalink'] }}"
							variant="primary"
							class="align-self-start lg:align-self-end ml-0 lg:ml-auto !px-4 !py-2 !text-sm">
							{{ $translate('Sprawdź produkt') }}
						</x-button>
					</div>
				</article>
				@endforeach
			</div>
			@else
			<p class="mt-8">{{ $translate('Brak produktów w wybranej kategorii.') }}</p>
			@endif
		</div>

	</div>
</section>
