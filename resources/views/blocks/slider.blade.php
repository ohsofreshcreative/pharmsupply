<!--- slider --->

<section
	data-gsap-anim="section"
	@if(!empty($section_id)) id="{{ $section_id }}" @endif
	@class([ 'b-slider relative overflow-visible -smt' ,
	$sectionClass=> filled($sectionClass),
	$section_class => filled($section_class),
	$background => filled($background) && $background !== 'none',
	])>

	<div class="__wrapper c-main flex flex-col md:flex-row justify-between items-start md:items-center gap-10 relative">
		<div class="flex items-center gap-4">
			<h2 data-gsap-element="header" class="text-gradient">
				{{ strip_tags($g_slider['header']) }}
			</h2>
		</div>

		<div class="flex flex-col gap-6">

			<div data-gsap-element="arrows" class="flex gap-3 justify-end">
				<div class="__prev rounded-full bg-secondary h-14 w-14 flex items-center justify-center cursor-pointer transition-all duration-400">
					<svg xmlns="http://www.w3.org/2000/svg" width="13" height="12" viewBox="0 0 13 12" fill="none">
						<path d="M0.270429 5.31498C0.270706 5.31469 0.270937 5.31435 0.27126 5.31406L5.08882 0.281803C5.44973 -0.0951806 6.03348 -0.0937777 6.39273 0.285093C6.75194 0.663916 6.75055 1.27664 6.38964 1.65367L3.15514 5.03226L12.078 5.03226C12.5872 5.03226 13 5.46552 13 6C13 6.53448 12.5872 6.96774 12.078 6.96774L3.15518 6.96774L6.3896 10.3463C6.75051 10.7234 6.75189 11.3361 6.39269 11.7149C6.03344 12.0938 5.44963 12.0951 5.08877 11.7182L0.271213 6.68594C0.270936 6.68565 0.270706 6.68531 0.270383 6.68502C-0.0907122 6.30673 -0.08956 5.69202 0.270429 5.31498Z" fill="#FFF" />
					</svg>
				</div>
				<div class="__next rounded-full bg-secondary h-14 w-14 flex items-center justify-center cursor-pointer transition-all duration-300">
					<svg xmlns="http://www.w3.org/2000/svg" width="13" height="12" viewBox="0 0 13 12" fill="none">
						<path d="M12.7296 5.31498C12.7293 5.31469 12.7291 5.31435 12.7287 5.31406L7.91118 0.281803C7.55027 -0.0951806 6.96652 -0.0937777 6.60727 0.285093C6.24806 0.663916 6.24945 1.27664 6.61036 1.65367L9.84486 5.03226L0.921985 5.03226C0.412773 5.03226 0 5.46552 0 6C0 6.53448 0.412773 6.96774 0.921985 6.96774L9.84482 6.96774L6.6104 10.3463C6.24949 10.7234 6.24811 11.3361 6.60731 11.7149C6.96657 12.0938 7.55037 12.0951 7.91123 11.7182L12.7288 6.68594C12.7291 6.68565 12.7293 6.68531 12.7296 6.68502C13.0907 6.30673 13.0896 5.69202 12.7296 5.31498Z" fill="#FFF" />
					</svg>
				</div>
			</div>
		</div>
	</div>

	@if (!empty($slider_posts))
	<div class="c-main pt-8">
		<div class="swiper slider-swiper !overflow-visible">
			<div class="swiper-wrapper">
				@foreach ($slider_posts as $post)
				@php
				setup_postdata($GLOBALS['post'] =& $post);
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

				<div class="swiper-slide !h-auto">
					<a data-gsap-element="card" href="{{ get_permalink() }}" class="block h-full">
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
										{{ pll__('Sprawdź') }}
									</p>
						</div>
					</a>
				</div>
				@endforeach
				@php(wp_reset_postdata())
			</div>
		</div>
	</div>
	@endif
</section>