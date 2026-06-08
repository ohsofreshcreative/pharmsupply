<article class="{{ $postClasses }}">

	<div class="group">
		<div class="__content relative bg-white rounded-2xl p-6 overflow-hidden">
			@if (has_post_thumbnail())
			<a class="block rounded-2xl overflow-hidden relative z-10" href="{{ get_permalink() }}">
				<img src="{{ get_the_post_thumbnail_url(null, 'large') }}" alt="{{ get_the_title() }}" class="w-full img-s object-cover">
			</a>
			@endif

			@php
			$categories = get_the_category();
			$defaultCategoryId = (int) get_option('default_category');
			$displayCategory = null;

			foreach ($categories as $cat) {
			if ((int) $cat->term_id !== $defaultCategoryId) {
			$displayCategory = $cat;
			break;
			}
			}

			if (!$displayCategory) {
			$displayCategory = get_category($defaultCategoryId);
			}
			@endphp

			<div class="flex flex-col items-center mt-8">
				@if ($displayCategory && !is_wp_error($displayCategory))
				<a href="{{ get_category_link($displayCategory->term_id) }}" class="__cat bg-secondary-lighter border border-secondary-light !text-secondary w-max rounded-lg px-3 py-1">
					{{ $displayCategory->name }}
				</a>
				@endif
				<a href="{{ get_permalink() }}" class="text-h6 text-center mt-4">
					{!! get_the_title() !!}
				</a>

				<a href="{{ get_permalink() }}" class="flex items-center justify-center bg-secondary group-hover:bg-secondary-hover rounded-full w-14 h-14 p-5 mt-6">
					<img src="/wp-content/uploads/2026/05/arrow.svg" />
				</a>
			</div>

			<img class="absolute -top-7/12 -left-1/4" src="/wp-content/uploads/2026/05/logo-shape.svg" />
		</div>
	</div>
</article>