<!--- category-posts preview --->

<div class="acf-preview" @if(!empty($nomt)) data-acf-nomt @endif>
	<div class="acf-preview__meta">
		<div class="acf-preview__heading">
			<div class="acf-preview__title">Wpisy z kategorii</div>
			<span class="acf-preview__slug">acf/category-posts</span>
		</div>
		@include('partials.block-preview-settings')
	</div>
	<div class="acf-preview__content">
		@if (!empty($posts_settings['title']))
		<p class="text-h5">{{ $posts_settings['title'] }}</p>
		@endif
		@if (!empty($posts_settings['text']))
		<p>{{ $posts_settings['text'] }}</p>
		@endif
		@if (!empty($posts_settings['button']['title']))
		<div class="acf-preview-actions"><span class="acf-preview-button">{{ $posts_settings['button']['title'] }}</span></div>
		@endif
		<div class="acf-preview__grid grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3">
			@foreach (array_slice((array) ($posts ?? []), 0, 3) as $post)
			<div class="acf-preview__card flex flex-col gap-2">
				<p class="text-h6">{{ $post->post_title }}</p>
			</div>
			@endforeach
		</div>
	</div>
</div>
