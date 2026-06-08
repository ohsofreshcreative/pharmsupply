@php
$categories = get_the_category();
$defaultCategoryId = (int) get_option('default_category');
$category = null;

foreach ($categories as $cat) {
if ((int) $cat->term_id !== $defaultCategoryId) {
$category = $cat;
break;
}
}

if (!$category && !empty($categories)) {
$category = $categories[0];
}

$hero_image = get_the_post_thumbnail_url(get_the_ID(), 'full');
@endphp

<section data-gsap-anim="section" class="hero-blog relative overflow-visible">
	<div class="absolute inset-0 z-0">
		<div class="absolute inset-0 bg-gradient"></div>

		@if($hero_image)
		<div
			class="absolute inset-y-0 right-0 w-full md:w-[58%] bg-cover bg-center"
			style="
          background-image: url('{{ esc_url($hero_image) }}');
          -webkit-mask-image: linear-gradient(to right, transparent 0%, rgba(0,0,0,0.35) 22%, #000 42%);
          mask-image: linear-gradient(to right, transparent 0%, rgba(0,0,0,0.35) 22%, #000 42%);
          -webkit-mask-repeat: no-repeat;
          mask-repeat: no-repeat;
          -webkit-mask-size: 100% 100%;
          mask-size: 100% 100%;
        ">
		</div>

		<div
			class="absolute inset-y-0 right-0 w-full md:w-[58%] bg-gradient opacity-45 pointer-events-none"
			style="
          -webkit-mask-image: linear-gradient(to right, transparent 0%, #000 35%, #000 100%);
          mask-image: linear-gradient(to right, transparent 0%, #000 35%, #000 100%);
          -webkit-mask-repeat: no-repeat;
          mask-repeat: no-repeat;
          -webkit-mask-size: 100% 100%;
          mask-size: 100% 100%;
        ">
		</div>
		@endif
	</div>

	<div class="__wrapper c-main relative z-10 -spt">
		<div class="__content w-full sm:w-1/2 pb-30">
			<div data-gsap-element="bread" class="__breadcrumb">
				@if (function_exists('woocommerce_breadcrumb'))
				{!! woocommerce_breadcrumb() !!}
				@endif
			</div>

			<div class="__top mt-20">
				@if ($category)
				<a data-gsap-element="header" href="{{ get_category_link($category->term_id) }}" class="bg-primary-lighter hover:bg-primary-light border border-primary-light rounded-full text-sm px-4 py-3">{{ $category->name }}</a>
				@endif

				<h1 data-gsap-element="header" class="text-h2 text-white mt-6">{{ get_the_title() }}</h1>

				@if(has_excerpt())
				<div data-gsap-element="content" class="text-white mt-4">
					{!! get_the_excerpt() !!}
				</div>
				@endif
			</div>
		</div>
	</div>

	<a href="#czytaj" class="flex items-center justify-center absolute -bottom-7 left-1/2 -translate-x-1/2 bg-secondary hover:bg-secondary-hover rounded-full w-14 h-14 p-5 mt-6">
		<img src="/wp-content/uploads/2026/05/downarrow.svg" alt="Czytaj dalej" />
	</a>
</section>

@php
$content = apply_filters('the_content', get_the_content());

preg_match_all('/<h([1-4])[^>]*>(.*?)<\/h[1-4]>/', $content, $matches, PREG_SET_ORDER);

		$toc = '<nav class="toc">
			<ul>';
				$used_ids = [];

				foreach ($matches as $match) {
				$level = $match[1];
				$title = strip_tags($match[2]);
				$id = sanitize_title($title);
				$base_id = $id;
				$i = 2;

				while (in_array($id, $used_ids)) {
				$id = $base_id . '-' . $i;
				$i++;
				}

				$used_ids[] = $id;

				$content = preg_replace(
				'/<h' . $level . '[^>]*>' . preg_quote($match[2], '/' ) . '<\/h' . $level . '>/' , '<h' . $level . ' id="' . $id . '">' . $match[2] . '</h' . $level . '>' ,
					$content,
					1
					);

					$toc .='<li class="toc-h' . $level . '"><a href="#' . $id . '">' . $title . '</a></li>' ;
					}

					$toc .='</ul></nav>' ;
					@endphp

					<div id="czytaj" class="__content c-main __entry -smt grid grid-cols-1 md:grid-cols-[3fr_1fr] gap-10">
					<div id="tresc" class="__entry">
						{!! $content !!}
					</div>

					<div class="relative md:sticky top-0 md:top-30 h-max">
						<p class="text-h5 text-primary m-title">Co znajdziesz w artykule:</p>
						@if(count($matches))
						{!! $toc !!}
						@endif
					</div>
					</div>

					@php
					$current_id = get_the_ID();
					$related_categories = wp_get_post_categories($current_id);

					$related_args = [
					'category__in' => $related_categories,
					'post__not_in' => [$current_id],
					'posts_per_page' => 3,
					'ignore_sticky_posts' => 1,
					];

					$related_query = new WP_Query($related_args);
					@endphp

					@if($related_query->have_posts())
					<section class="related-posts bg-primary-lighter -smt pt-20 pb-26">
						<div class="c-main">
							<div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-6 mb-10">
								<h3 class="text-gradient">Pozostałe wpisy</h3>
								<div>
									@php
									$category_link = get_category_link($category->term_id);
									@endphp
									<a href="{{ $category_link }}" class="btn-arrow">
										Zobacz wszystkie
									</a>
								</div>
							</div>
							<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
								@while($related_query->have_posts())
								@php
								$related_query->the_post();
								$postClasses = 'h-full';
								@endphp
								<article <?php post_class($postClasses); ?>>
									<div class="group h-full">
										<div class="__content relative bg-white rounded-2xl p-6 overflow-hidden h-full flex flex-col">
											@if (has_post_thumbnail())
											<a class="block rounded-2xl overflow-hidden relative z-10" href="{{ get_permalink() }}">
												<img src="{{ get_the_post_thumbnail_url(null, 'large') }}" alt="{{ get_the_title() }}" class="w-full img-s object-cover">
											</a>
											@endif
											@php
											$post_categories = get_the_category();
											$defaultCategoryId = (int) get_option('default_category');
											$displayCategory = null;
											foreach ($post_categories as $cat) {
											if ((int) $cat->term_id !== $defaultCategoryId) {
											$displayCategory = $cat;
											break;
											}
											}
											if (!$displayCategory) {
											$displayCategory = get_category($defaultCategoryId);
											}
											@endphp
											<div class="flex flex-col items-center mt-8 relative z-10">
												@if ($displayCategory && !is_wp_error($displayCategory))
												<a href="{{ get_category_link($displayCategory->term_id) }}" class="__cat bg-secondary-lighter border border-secondary-light text-secondary! w-max rounded-lg px-3 py-1">
													{{ $displayCategory->name }}
												</a>
												@endif
												<a href="{{ get_permalink() }}" class="text-h6 text-center mt-4">
													{!! get_the_title() !!}
												</a>
												<a href="{{ get_permalink() }}" class="flex items-center justify-center bg-secondary group-hover:bg-secondary-hover rounded-full w-14 h-14 p-5 mt-6">
													<img src="/wp-content/uploads/2026/05/arrow.svg" alt="Arrow">
												</a>
											</div>
											<img class="absolute -top-7/12 -left-1/4 pointer-events-none" src="/wp-content/uploads/2026/05/logo-shape.svg" alt="">
										</div>
									</div>
								</article>
								@endwhile
								@php(wp_reset_postdata())
							</div>
						</div>
					</section>
					@endif

					

					<script>
						document.addEventListener('DOMContentLoaded', function() {
							const headings = document.querySelectorAll('h1[id], h2[id], h3[id], h4[id]');
							const tocLinks = document.querySelectorAll('.toc ul li a');

							function updateActiveLink() {
								headings.forEach((heading) => {
									const headingTop = heading.getBoundingClientRect().top;
									const windowHeight = window.innerHeight;

									if (headingTop < windowHeight - 300) {
										tocLinks.forEach((link) => {
											link.parentNode.classList.remove('active');
										});

										const id = heading.id;
										const activeLink = document.querySelector(`.toc ul li a[href="#${id}"]`);
										if (activeLink) {
											activeLink.parentNode.classList.add('active');
										}
									}
								});
							}

							updateActiveLink();
							window.addEventListener('scroll', updateActiveLink);
						});
					</script>