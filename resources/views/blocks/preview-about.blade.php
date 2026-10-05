<!--- about preview --->

<div class="acf-preview" @if(!empty($nomt)) data-acf-nomt @endif>
	<div class="acf-preview__meta">
		<div class="acf-preview__heading">
			<div class="acf-preview__title">O nas</div>
			<span class="acf-preview__slug">acf/about</span>
		</div>
		@include('partials.block-preview-settings')
	</div>
	<div class="acf-preview__content">
		@if (!empty($g_about['eyebrow']))
		<p>{{ $g_about['eyebrow'] }}</p>
		@endif
		@if (!empty($g_about['header']))
		<p class="text-h5">{{ $g_about['header'] }}</p>
		@endif
		@if (!empty($g_about['txt']))
		<div>{!! $g_about['txt'] !!}</div>
		@endif
		@if (!empty($g_about['button']['title']))
		<div class="acf-preview-actions"><span class="acf-preview-button">{{ $g_about['button']['title'] }}</span></div>
		@endif
		@if (!empty($g_about['image']['ID']))
		<figure class="acf-preview__media m-0">{!! wp_get_attachment_image($g_about['image']['ID'], 'thumbnail', false, ['class' => 'h-16 w-24 object-cover']) !!}</figure>
		@endif
	</div>
</div>
