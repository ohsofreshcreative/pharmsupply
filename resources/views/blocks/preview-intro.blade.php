<!--- intro preview --->

<div class="acf-preview" @if(!empty($nomt)) data-acf-nomt @endif>
	<div class="acf-preview__meta">
		<div class="acf-preview__heading">
			<div class="acf-preview__title">Intro</div>
			<span class="acf-preview__slug">acf/intro</span>
		</div>
		@include('partials.block-preview-settings')
	</div>
	<div class="acf-preview__content">
		@if (!empty($g_intro['title']))
		<p class="text-h5">{{ $g_intro['title'] }}</p>
		@endif
		@if (!empty($g_intro['txt']))
		<div>{!! $g_intro['txt'] !!}</div>
		@endif
		@if (!empty($g_intro['button1']['title']))
		<div class="acf-preview-actions"><span class="acf-preview-button">{{ $g_intro['button1']['title'] }}</span></div>
		@endif
		@if (!empty($g_intro['button2']['title']))
		<div class="acf-preview-actions"><span class="acf-preview-button">{{ $g_intro['button2']['title'] }}</span></div>
		@endif
		@if (!empty($g_intro['image']['ID']))
		<figure class="acf-preview__media m-0">{!! wp_get_attachment_image($g_intro['image']['ID'], 'thumbnail', false, ['class' => 'h-16 w-24 object-cover']) !!}</figure>
		@endif
	</div>
</div>
