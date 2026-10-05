<!--- indications preview --->

<div class="acf-preview" @if(!empty($nomt)) data-acf-nomt @endif>
	<div class="acf-preview__meta">
		<div class="acf-preview__heading">
			<div class="acf-preview__title">Wskazania</div>
			<span class="acf-preview__slug">acf/indications</span>
		</div>
		@include('partials.block-preview-settings')
	</div>
	<div class="acf-preview__content">
		@if (!empty($g_indications['image']['ID']))
		<figure class="acf-preview__media m-0">{!! wp_get_attachment_image($g_indications['image']['ID'], 'thumbnail', false, ['class' => 'h-16 w-24 object-cover']) !!}</figure>
		@endif
		@if (!empty($g_indications['header']))
		<p class="text-h5">{{ $g_indications['header'] }}</p>
		@endif
		@if (!empty($g_indications['txt']))
		<div>{!! $g_indications['txt'] !!}</div>
		@endif
		@if (!empty($g_indications['button']['title']))
		<div class="acf-preview-actions"><span class="acf-preview-button">{{ $g_indications['button']['title'] }}</span></div>
		@endif
		<div class="acf-preview__grid grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3">
			@foreach (array_slice((array) ($categoriesTree ?? []), 0, 3) as $parent)
			<div class="acf-preview__card flex flex-col gap-2">
				@if (!empty($parent['name']))
				<p class="text-h6">{{ $parent['name'] }}</p>
				@endif
			</div>
			@endforeach
		</div>
	</div>
</div>
