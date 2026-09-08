<!--- category-posts -->

<section
	data-gsap-anim="section"
	@if(!empty($section_id)) id="{{ $section_id }}" @endif
	@class([ 'b-category-posts relative -smt' ,
	$sectionClass=> filled($sectionClass),
	$section_class => filled($section_class),
	$background => filled($background) && $background !== 'none',
	])>

	<div class="c-main">
		<div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-6 mb-10">
			<h2 data-gsap-element="title" class="text-gradient">{{ $posts_settings['title'] }}</h2>
			<a href="/category/blog/" class="btn-arrow">
				Zobacz wszystkie
			</a>
		</div>

		@if(!empty($posts))
		<div class="posts-container grid grid-cols-1 md:grid-cols-3 gap-8">
			@foreach($posts as $post)
			<div data-gsap-element="card" class="__card group/card overflow-hidden radius b-shadow">
				<div class="bg-white h-full p-6 flex flex-col">
					<div class="relative z-10">
						@if($show_image && has_post_thumbnail($post->ID))
						<div class="__img">
							<a class="" href="{{ get_permalink($post->ID) }}">
								{!! get_the_post_thumbnail($post->ID, 'large', ['class' => 'img-s radius object-cover']) !!}
							</a>
						</div>
						@endif
						<div class="__content flex flex-col justify-between w-full mt-8 flex-grow text-center">
							@php
							$categories = get_the_category($post->ID);
							$defaultCategoryId = (int) get_option('default_category');
							$displayCategory = null;
							foreach ($categories as $cat) {
							if ((int) $cat->term_id !== $defaultCategoryId) {
							$displayCategory = $cat;
							break;
							}
							}
							if (!$displayCategory && !empty($categories)) {
							$displayCategory = $categories[0];
							}
							@endphp
							@if($displayCategory)
							<p data-gsap-element="category" class="w-max text-secondary bg-secondary-lighter border border-secondary-light rounded-lg px-4 py-2 mx-auto">{{ $displayCategory->name }}</p>
							@endif
							<h6 class="mt-2">
								<a href="{{ get_permalink($post->ID) }}">
									{!! get_the_title($post->ID) !!}
								</a>
							</h6>
							<a href="{{ get_permalink($post->ID) }}" class="bg-secondary group-hover/card:bg-secondary-hover rounded-full flex items-center justify-center w-14 h-14 p-5 mt-6 mx-auto">
								<img src="/wp-content/uploads/2026/05/arrow.svg" />
							</a>
						</div>
					</div>
				</div>
				<img class="absolute -top-7/12 -left-1/4" src="/wp-content/uploads/2026/05/logo-shape.svg" />
			</div>
			@endforeach
		</div>
		@else
		<div class="no-posts">
			Brak postów w wybranej kategorii.
		</div>
		@endif
	</div>
</section>