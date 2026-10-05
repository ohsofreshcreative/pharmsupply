<!--- connect preview --->

<div class="acf-preview" @if(!empty($nomt)) data-acf-nomt @endif>
	<div class="acf-preview__meta">
		<div class="acf-preview__heading">
			<div class="acf-preview__title">Kontakt - stopka</div>
			<span class="acf-preview__slug">acf/connect</span>
		</div>
		@include('partials.block-preview-settings')
	</div>
	<div class="acf-preview__content">
		@if (!empty($connects['header']))
		<p class="text-h5">{{ $connects['header'] }}</p>
		@endif
		@if (!empty($connects['txt']))
		<div>{!! $connects['txt'] !!}</div>
		@endif
		@if (!empty($connects['button']['title']))
		<div class="acf-preview-actions"><span class="acf-preview-button">{{ $connects['button']['title'] }}</span></div>
		@endif
		@if (!empty($connects['image']['ID']))
		<figure class="acf-preview__media m-0">{!! wp_get_attachment_image($connects['image']['ID'], 'thumbnail', false, ['class' => 'h-16 w-24 object-cover']) !!}</figure>
		@endif
	</div>
</div>
