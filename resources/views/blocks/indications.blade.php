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

		<aside class="__filters sticky top-20 order1">
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
				<article class="flex rounded-xl items-center gap-8 bg-white b-shadow px-8 py-4">

					@if (!empty($product['thumbnail']))
					<a href="{{ $product['permalink'] }}" class="block mt-3">
						<img
							src="{{ $product['thumbnail'] }}"
							alt="{{ $product['title'] }}"
							class="h-50 w-50 min-w-50 min-h-50 rounded-lg object-contain object-center">
					</a>
					@endif

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
						class="align-self-end ml-auto"
						data-gsap-element="btn">
						Sprawdź produkt
					</x-button>
				</article>
				@endforeach
			</div>
			@else
			<p class="mt-8">Brak produktów w wybranej kategorii.</p>
			@endif
		</div>

	</div>
</section>