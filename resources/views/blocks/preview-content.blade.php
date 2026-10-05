<!--- content preview --->

<div class="acf-preview" @if(!empty($nomt)) data-acf-nomt @endif>
	<div class="acf-preview__meta">
		<div class="acf-preview__heading">
			<div class="acf-preview__title">Treść</div>
			<span class="acf-preview__slug">acf/content</span>
		</div>
		@include('partials.block-preview-settings')
	</div>
	<div class="acf-preview__content">
		@if (!empty($g_content['header']))
		<p class="text-h5">{{ $g_content['header'] }}</p>
		@endif
		@if (!empty($g_content['txt']))
		<div>{!! $g_content['txt'] !!}</div>
		@endif
		@if (!empty($g_content['button']['title']))
		<div class="acf-preview-actions"><span class="acf-preview-button">{{ $g_content['button']['title'] }}</span></div>
		@endif
		@if (!empty($g_content['image']['ID']))
		<figure class="acf-preview__media m-0">{!! wp_get_attachment_image($g_content['image']['ID'], 'thumbnail', false, ['class' => 'h-16 w-24 object-cover']) !!}</figure>
		@endif
	</div>
</div>
