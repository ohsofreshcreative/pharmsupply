<!--- indications -->

<section
	data-gsap-anim="section"
	@if(!empty($section_id)) id="{{ $section_id }}" @endif
	@class([ 'b-indications relative -smt' ,
	$sectionClass=> filled($sectionClass),
	$section_class => filled($section_class),
	$background => filled($background) && $background !== 'none',
	])>

	<div class="__wrapper c-main relative grid grid-cols-1 lg:grid-cols-[1fr_3fr] items-start gap-6">

		<aside data-gsap-element="aside" class="__filters relative lg:sticky top-0 lg:top-20 order1">
			@if (!empty($categoriesTree))
			<ul class="space-y-3">
				@foreach ($categoriesTree as $parent)
				<li>
					<p class="font-header text-h5">
						{{ $parent['name'] }}
					</p>

					@if (!empty($parent['children']))
					<ul class="mt-2 space-y-1">
						@foreach ($parent['children'] as $child)
						<li>
							<a
								href="{{ $child['url'] }}"
								@class([ '!text-gray-500' , '__active'=> $activeCategorySlug === $child['slug'],
								'border-gray-200 hover:border-primary-light' => $activeCategorySlug !== $child['slug'],
								])>
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

		<div class="__indications order2">

			@if (!empty($products))
			<div class="space-y-6">
				@foreach ($products as $product)
				<article data-gsap-element="card" class="flex flex-col md:flex-row rounded-xl items-start md:items-center gap-8 bg-white b-shadow py-10 px-10 lg:px-8 lg:py-4">

					@if (!empty($product['thumbnail']))
					<a href="{{ $product['permalink'] }}" class="block mt-3">
						<img
							src="{{ $product['thumbnail'] }}"
							alt="{{ $product['title'] }}"
							class="h-50 w-50 min-w-50 min-h-50 rounded-lg object-contain object-center">
					</a>
					@endif

					<div class="flex-1 flex flex-col lg:flex-row items-start lg:items-center gap-6">
						<div>
							<h3 class="text-h6">
								<a href="{{ $product['permalink'] }}" class="hover:text-primary transition">
									{{ $product['title'] }}
								</a>
							</h3>
							@if (!empty($product['form']))
							<p class="mt-2">
								{{ $product['form'] }}
							</p>
							@endif
							@if (!empty($product['packaging']))
							<p class="">
								{{ $product['packaging'] }}
							</p>
							@endif
						</div>
						<x-button
							href="{{ $product['permalink'] }}"
							variant="primary"
							class="align-self-start lg:align-self-end ml-0 lg:ml-auto">
							Sprawdź produkt
						</x-button>
					</div>
				</article>
				@endforeach
			</div>
			@else
			<p class="mt-8">Brak produktów w wybranej kategorii.</p>
			@endif
		</div>

	</div>
</section>