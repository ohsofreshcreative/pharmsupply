<!--- search preview --->

<div class="acf-preview" @if(!empty($nomt)) data-acf-nomt @endif>
	<div class="acf-preview__meta">
		<div class="acf-preview__heading">
			<div class="acf-preview__title">Wyszukiwarka</div>
			<span class="acf-preview__slug">acf/search</span>
		</div>
		@include('partials.block-preview-settings')
	</div>
	<div class="acf-preview__content">
		@if (!empty($g_search['header']))
		<p class="text-h5">{{ $g_search['header'] }}</p>
		@endif
	</div>
</div>
