@extends('layouts.app')

@section('content')

@php
$term = get_queried_object();
$categories = get_categories();

$category_header = get_field('category_header', $term);
$category_description = get_field('category_description', $term);
$category_image = get_field('category_image', $term);

$defaultCategoryId = (int) get_option('default_category');
if ($defaultCategoryId > 0 && $defaultCategoryId !== (int) $term->term_id) {
	$defaultCategory = 'category_' . $defaultCategoryId;
	if (trim((string) $category_description) === '') {
		$category_description = get_field('category_description', $defaultCategory);
	}
	if (empty($category_image['url'])) {
		$category_image = get_field('category_image', $defaultCategory);
	}
}

$language = function_exists('pll_current_language') ? pll_current_language('slug') : 'pl';
$connectsField = $language === 'en' ? 'connects_en' : 'connects';
$connects = get_field($connectsField, 'option');

if ($language === 'en' && !array_filter((array) $connects)) {
	$connects = get_field('connects', 'option');
}

// Pobranie pól ACF dla sekcji 'connects'
$section_id = $connects['section_id'] ?? '';
$section_class = $connects['section_class'] ?? '';
$flip = $connects['flip'] ?? false;

// Przygotowanie klas CSS
$sectionClass = '';
$sectionClass .= $flip ? ' order-flip' : '';

// Wygenerowanie unikalnego ID dla SVG
$unique_id = 'clip_'.uniqid();
@endphp

<div class="b-category-hero category-header bg-primary-lighter relative overflow-hidden min-h-120">
	@if (!empty($breadcrumbs))
	<div class="absolute inset-x-0 z-40 w-full pt-2 mt-1">
		<div class="c-main">
			{!! $breadcrumbs !!}
		</div>
	</div>
	@endif
	<div class="__wrapper c-main">
	
		<div class="__content w-full lg:w-1/2 relative z-20 pt-30 pb-20">
		
			<h2 class="text-gradient m-header">
				{!! $category_header ?: get_the_archive_title() !!}
			</h2>
			@if ($category_description)
			<div class="text-lg">
				{!! $category_description !!}
			</div>
			@endif
			<div id="category-tabs" class="mt-6">
				<div class="flex gap-2">
					<div class="">
						<a href="/category/blog" class="__tab block bg-primary border border-primary rounded-full px-4 py-2 {{ is_category('blog') ? 'active' : 'bg-primary-lighter border border-primary' }}">
							Blog
						</a>
					</div>

					@foreach($categories as $category)
					@if($category->name !== 'Blog')
					<div class="!w-auto">
						<a href="{{ get_category_link($category->term_id) }}"
							class="__tab block bg-primary border border-primary text-white rounded-full px-4 py-2 {{ $term && $term->term_id === $category->term_id ? 'active' : 'bg-primary-lighter border border-primary' }}">
							{{ $category->name }}
						</a>
					</div>
					@endif
					@endforeach
				</div>
			</div>
		</div>
		@if (!empty($category_image['url']))
		<div class="__img relative lg:absolute z-0 bottom-0 right-0 pointer-events-none">
			<img src="{{ $category_image['url'] }}" alt="{{ $category_image['alt'] ?? '' }}" class="mask-img" />
		</div>
		@endif

		<img class="absolute z-0 right-20 -bottom-6/12" src="/wp-content/uploads/2026/05/blog-shape.svg" alt="Blog kształt" />
	</div>
</div>

@if (have_posts())
<div class="__posts c-main !mt-10 posts grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
	@while (have_posts()) @php(the_post())

	@includeFirst(['partials.content-' . get_post_type(), 'partials.content'])
	@endwhile
</div>

{{-- {!! get_the_posts_navigation() !!} --}}
{!! the_posts_pagination() !!}
@else
<div class="mt-20 mb-20">
	<div class="c-main">
		<h3 class="">Brak wpisów w tej kategorii.</h3>
		<a class="main-btn m-btn" href="/wszystkie-wpisy/">Sprawdź wszystkie wpisy</a>
	</div>
</div>
@endif

<!-- b-connects -->

<section data-gsap-anim="section" @if(!empty($section_id)) id="{{ $section_id }}" @endif class="b-connects relative bg-gradient overflow-hidden -smt {{ $sectionClass }} {{ $section_class }}">
	<div class="c-main grid grid-cols-1 md:grid-cols-2 items-center">

		<div class="__content relative py-60 z-10">
			<p data-gsap-element="header" class="text-h2 text-white">{{ $connects['header'] }}</p>
			<div data-gsap-element="txt" class="text-white text-xl mt-4">
				{!! $connects['txt'] !!}
			</div>

			<div class="inline-buttons m-btn">
				@if (!empty($connects['button']))
				<x-button
					:href="$connects['button']['url']"
					variant="white"
					class=""
					data-gsap-element="btn">
					{{ $connects['button']['title'] }}
				</x-button>
				@endif

				@if (!empty($connects['button2']))
				<x-button
					:href="$connects['button2']['url']"
					variant="secondary"
					class=""
					data-gsap-element="btn">
					{{ $connects['button2']['title'] }}
				</x-button>
				@endif
			</div>

		</div>

		<div data-gsap-element="img" class="__img h-full w-1/2 absolute right-0 bottom-0 pt-20">
			<img src="{{ $connects['image']['url'] }}" alt="{{ $connects['image']['alt'] }}" class="mask-img w-full h-full object-cover relative z-10" />
			<img class="absolute top-22 right-5 z-0" src="/wp-content/uploads/2026/05/shape.svg" />
		</div>

	</div>
</section>

@endsection
