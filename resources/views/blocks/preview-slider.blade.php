<!--- slider preview --->

<div class="acf-preview" @if(!empty($nomt)) data-acf-nomt @endif>
	<div class="acf-preview__meta">
		<div class="acf-preview__heading">
			<div class="acf-preview__title">Slider</div>
			<span class="acf-preview__slug">acf/slider</span>
		</div>
		@include('partials.block-preview-settings')
	</div>
	<div class="acf-preview__content">
		@if (!empty($g_slider['header']))
		<p class="text-h5">{{ $g_slider['header'] }}</p>
		@endif
		@if (!empty($g_slider['content']))
		<div>{!! $g_slider['content'] !!}</div>
		@endif
	</div>
</div>
