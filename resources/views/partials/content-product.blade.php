@php
$translate = static fn(string $text): string => function_exists('pll__') ? pll__($text) : $text;

$terms = get_the_terms(get_the_ID(), 'product_category') ?: [];

$terms = array_values(array_reduce($terms, function ($parents, $term) {
	$parentTerm = $term;

	if (!empty($term->parent)) {
		$ancestors = get_ancestors($term->term_id, 'product_category', 'taxonomy');
		$topLevelTermId = !empty($ancestors) ? end($ancestors) : $term->parent;
		$resolvedParent = get_term($topLevelTermId, 'product_category');

		if ($resolvedParent && !is_wp_error($resolvedParent)) {
			$parentTerm = $resolvedParent;
		}
	}

	$parents[$parentTerm->term_id] = $parentTerm;

	return $parents;
}, []));
@endphp

<article @php(post_class('__card'))>

	<a class="rounded-2xl" href="{{ get_permalink() }}">
		<div class="__card relative bg-white b-shadow radius p-6 h-full">
			@if (has_post_thumbnail())
			<div class="radius-img">
				<img class="h-[360px] w-full radius-img object-contain object-center mb-6"
					src="{{ get_the_post_thumbnail_url(get_the_ID(), 'large') }}"
					alt="{{ get_the_title() }}" />
			</div>
			@endif

			@if (!empty($terms))
			<p class="!text-body text-sm mt-2">
				@foreach ($terms as $i => $term){{ $term->name }}@if ($i + 1 < count($terms)), @endif
					@endforeach
					</p>
					@endif

					<p class="text-h7 !text-body font-header">{{ get_the_title() }}</p>

					<p data-gsap-element="btn" class="btn btn-primary-small mt-4">
						{{ $translate('Sprawdź') }}
					</p>
		</div>
	</a>
</article>
