@php
$sectionClass = '';
$sectionClass .= $flip ? ' order-flip' : '';
$sectionClass .= $wide ? ' wide' : '';
$sectionClass .= $nomt ? ' !mt-0' : '';
$sectionClass .= $gap ? ' wider-gap' : '';
$sectionClass .= $lightbg ? ' section-light' : '';
$sectionClass .= $graybg ? ' section-gray' : '';
$sectionClass .= $whitebg ? ' section-white' : '';
$sectionClass .= $brandbg ? ' section-brand' : '';

@endphp

<!--- category-posts -->

<div data-gsap-anim="section" @if(!empty($section_id)) id="{{ $section_id }}" @endif class="b-category-posts -smt {{ $sectionClass }} {{ $section_class }}">
	<div class="c-main">
		<div class="grid">

			<div class="flex flex-col md:flex-row justify-between gap-6">
				@if($posts_settings['title'])
				<h2 data-gsap-element="title" class="">{{ $posts_settings['title'] }}</h2>
				@endif
				@if (!empty($posts_settings['button']))
				<a data-gsap-element="btn" class="second-btn" href="{{ $posts_settings['button']['url'] }}">{{ $posts_settings['button']['title'] }}</a>
				@endif
			</div>

			<div class="mt-10">
				@if(!empty($posts))
				@foreach($posts as $post)
				@php
				$thumbnail_url = $show_image && has_post_thumbnail($post->ID) ? get_the_post_thumbnail_url($post->ID, 'large') : '';
				@endphp

				<div data-gsap-element="card" class="__content relative bg-white border-l-2 border-secondary border-dotted flex flex-col md:flex-row items-start md:items-center gap-2 md:gap-10 p-10">
					<span class="post-date leading-none text-h4 text-secondary flex flex-row md:flex-col gap-2">
						<span class="block">{{ get_the_date('d/m', $post->ID) }}</span>
						<span class="block">{{ get_the_date('Y', $post->ID) }}</span>
					</span>
					<div>
						<h6 class="mt-4">{{ get_the_title($post->ID) }}</h6>
						<div class="mt-2">
							{!! apply_filters('the_content', $post->post_excerpt ?: $post->post_content) !!}
						</div>
					</div>
				</div>

				@endforeach
			</div>


			@else
			<div class="no-posts">
				Brak postów do wyświetlenia.
			</div>
			@endif
		</div>
	</div>
</div>
</div>