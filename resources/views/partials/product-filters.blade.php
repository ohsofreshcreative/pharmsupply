@php
$categories = get_terms(['taxonomy' => 'product_category', 'hide_empty' => false]);
$applications = get_terms(['taxonomy' => 'product_application', 'hide_empty' => false]);

$action = get_post_type_archive_link('product');
$qName = $_GET['product_s'] ?? '';
$qCat = $_GET['product_cat'] ?? '';
$qApp = $_GET['product_app'] ?? '';
@endphp

<form method="get" action="{{ $action }}"
	class="b-product-filters bg-white rounded-full b-shadow flex flex-col md:flex-row items-center overflow-hidden w-max pl-6 pr-4 mx-auto">

	{{-- Nazwa produktu --}}
	<div class="flex-1 px-6 py-3 md:border-r border-gray-200">
		<label for="product_s" class="block font-semibold text-xl">
			Nazwa produktu
		</label>
		<input type="text" id="product_s" name="product_s"
			value="{{ esc_attr($qName) }}"
			placeholder="Wpisz nazwę produktu"
			class="w-full bg-transparent border-0 outline-none p-0 text-gray-600 !placeholder-gray-500 focus:ring-0">
	</div>

	{{-- Rodzaj produktu --}}
	<div class="flex-1 px-6 py-3 md:border-r border-gray-200">
		<label for="product_cat" class="block font-semibold text-xl">
			Rodzaj produktu
		</label>
		<select id="product_cat" name="product_cat"
			class="w-full bg-transparent border-0 outline-none p-0 text-gray-600 focus:ring-0 appearance-none">
			<option value="">Wpisz rodzaj produktu</option>
			@foreach ($categories as $term)
			<option value="{{ $term->slug }}" @selected($qCat===$term->slug)>{{ $term->name }}</option>
			@endforeach
		</select>
	</div>

	{{-- Zastosowanie --}}
	<div class="flex-1 px-6 py-3">
		<label for="product_app" class="block font-semibold text-xl">
			Zastosowanie
		</label>
		<select id="product_app" name="product_app"
			class="w-full bg-transparent border-0 outline-none p-0 text-gray-600 focus:ring-0 appearance-none">
			<option value="">Wybierz zastosowanie</option>
			@foreach ($applications as $term)
			<option value="{{ $term->slug }}" @selected($qApp===$term->slug)>{{ $term->name }}</option>
			@endforeach
		</select>
	</div>

	{{-- Submit --}}
	<button type="submit"
		class="bg-secondary hover:bg-secondary-hover cursor-pointer text-white rounded-full flex items-center justify-center w-11 h-11">
		<img src="http://pharmsupply.local/wp-content/uploads/2026/05/magnifier.svg" alt="Szukaj" class="w-5 h-5">
	</button>
</form>