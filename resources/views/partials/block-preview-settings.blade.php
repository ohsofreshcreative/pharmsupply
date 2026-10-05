@php
$previewSettings = [];
$toggleSettings = [
	'Brak marginesu górnego' => $nomt ?? false,
	'Szeroka kolumna' => $wide ?? false,
	'Odwrotna kolejność' => $flip ?? false,
	'Większy odstęp' => $gap ?? false,
	'Bez punktatorów' => $nolist ?? false,
	'Punktatory' => $bullets ?? false,
	'Kształt w tle' => $bgshape ?? false,
	'Formularz' => $form ?? false,
];

foreach ($toggleSettings as $label => $enabled) {
	if ($enabled) {
		$previewSettings[] = $label;
	}
}

$backgroundChoices = \App\Support\SectionBackgrounds::choices();
$backgroundValue = $background ?? 'none';

if ($backgroundValue !== 'none' && isset($backgroundChoices[$backgroundValue])) {
	$previewSettings[] = 'Tło: ' . $backgroundChoices[$backgroundValue];
}
@endphp

@if (!empty($previewSettings))
<div class="acf-preview__settings" aria-label="Wybrane ustawienia bloku">
	@foreach ($previewSettings as $setting)
	<span @class([
		'acf-preview__setting',
		'acf-preview__setting--background' => str_starts_with($setting, 'Tło:'),
		'acf-preview__setting--nomt' => $setting === 'Brak marginesu górnego',
	])>{{ $setting }}</span>
	@endforeach
</div>
@endif
