<!--- wysiwyg preview --->

<div class="acf-preview" @if(!empty($nomt)) data-acf-nomt @endif>
	<div class="acf-preview__meta">
		<div class="acf-preview__heading">
			<div class="acf-preview__title">WYSIWYG</div>
			<span class="acf-preview__slug">acf/wysiwyg</span>
		</div>
		@include('partials.block-preview-settings')
	</div>
	<div class="acf-preview__content">
		@if (!empty($g_wysiwyg['header']))
		<p class="text-h5">{{ $g_wysiwyg['header'] }}</p>
		@endif
		@if (!empty($g_wysiwyg['txt']))
		<div>{!! $g_wysiwyg['txt'] !!}</div>
		@endif
		@if (!empty($g_wysiwyg['button']['title']))
		<div class="acf-preview-actions"><span class="acf-preview-button">{{ $g_wysiwyg['button']['title'] }}</span></div>
		@endif
	</div>
</div>
