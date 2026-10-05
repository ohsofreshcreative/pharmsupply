<!--- reachus preview --->

<div class="acf-preview" @if(!empty($nomt)) data-acf-nomt @endif>
	<div class="acf-preview__meta">
		<div class="acf-preview__heading">
			<div class="acf-preview__title">Skontaktuj się</div>
			<span class="acf-preview__slug">acf/reachus</span>
		</div>
		@include('partials.block-preview-settings')
	</div>
	<div class="acf-preview__content">
		@if (!empty($g_reachus_1['header']))
		<p class="text-h5">{{ $g_reachus_1['header'] }}</p>
		@endif
		@if (!empty($g_reachus_1['txt']))
		<div>{!! $g_reachus_1['txt'] !!}</div>
		@endif
		@if (!empty($g_reachus_1['phone']))
		<p>{{ $g_reachus_1['phone'] }}</p>
		@endif
		@if (!empty($g_reachus_1['mail']))
		<p>{{ $g_reachus_1['mail'] }}</p>
		@endif
		@if (!empty($g_reachus_2['title']))
		<p class="text-h6">{{ $g_reachus_2['title'] }}</p>
		@endif
		@if (!empty($g_reachus_2['shortcode']))
		<p>{{ $g_reachus_2['shortcode'] }}</p>
		@endif
	</div>
</div>
