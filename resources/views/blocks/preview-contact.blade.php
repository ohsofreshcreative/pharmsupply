<!--- contact preview --->

<div class="acf-preview" @if(!empty($nomt)) data-acf-nomt @endif>
	<div class="acf-preview__meta">
		<div class="acf-preview__heading">
			<div class="acf-preview__title">Kontakt</div>
			<span class="acf-preview__slug">acf/contact</span>
		</div>
		@include('partials.block-preview-settings')
	</div>
	<div class="acf-preview__content">
		@if (!empty($g_contact_1['header']))
		<p class="text-h5">{{ $g_contact_1['header'] }}</p>
		@endif
		@if (!empty($g_contact_1['phone']))
		<p>{{ $g_contact_1['phone'] }}</p>
		@endif
		@if (!empty($g_contact_1['mail']))
		<p>{{ $g_contact_1['mail'] }}</p>
		@endif
		@if (!empty($g_contact_1['adress1']))
		<div>{!! $g_contact_1['adress1'] !!}</div>
		@endif
		@if (!empty($g_contact_1['adress2']))
		<div>{!! $g_contact_1['adress2'] !!}</div>
		@endif
		@if (!empty($g_contact_1['button']['title']))
		<div class="acf-preview-actions"><span class="acf-preview-button">{{ $g_contact_1['button']['title'] }}</span></div>
		@endif
		@if (!empty($g_contact_2['title']))
		<p class="text-h6">{{ $g_contact_2['title'] }}</p>
		@endif
		@if (!empty($g_contact_2['shortcode']))
		<p>{{ $g_contact_2['shortcode'] }}</p>
		@endif
		@if (!empty($g_contact_1['image']['ID']))
		<figure class="acf-preview__media m-0">{!! wp_get_attachment_image($g_contact_1['image']['ID'], 'thumbnail', false, ['class' => 'h-16 w-24 object-cover']) !!}</figure>
		@endif
	</div>
</div>
