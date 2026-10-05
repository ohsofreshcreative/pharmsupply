<!--- reactions preview --->

<div class="acf-preview" @if(!empty($nomt)) data-acf-nomt @endif>
	<div class="acf-preview__meta">
		<div class="acf-preview__heading">
			<div class="acf-preview__title">Działania niepożądane</div>
			<span class="acf-preview__slug">acf/reactions</span>
		</div>
		@include('partials.block-preview-settings')
	</div>
	<div class="acf-preview__content">
		@if (!empty($g_reactions['header']))
		<p class="text-h5">{{ $g_reactions['header'] }}</p>
		@endif
		@if (!empty($g_reactions['title']))
		<p class="text-h6">{{ $g_reactions['title'] }}</p>
		@endif
		@if (!empty($g_reactions['text']))
		<p>{{ $g_reactions['text'] }}</p>
		@endif
		<div class="acf-preview__grid grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3">
			@foreach (array_slice((array) ($r_reactions ?? []), 0, 3) as $item)
			<div class="acf-preview__card flex flex-col gap-2">
				@if (!empty($item['image']['ID']))
				<figure class="acf-preview__media m-0">{!! wp_get_attachment_image($item['image']['ID'], 'thumbnail', false, ['class' => 'h-16 w-24 object-cover']) !!}</figure>
				@endif
				@if (!empty($item['title']))
				<p class="text-h6">{{ $item['title'] }}</p>
				@endif
				@if (!empty($item['text']))
				<p>{{ $item['text'] }}</p>
				@endif
				@if (!empty($item['button']['title']))
				<div class="acf-preview-actions"><span class="acf-preview-button">{{ $item['button']['title'] }}</span></div>
				@endif
			</div>
			@endforeach
		</div>
	</div>
</div>
