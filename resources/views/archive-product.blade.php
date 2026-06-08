@extends('layouts.app')

@section('content')
@include('partials.page-header')

<div class="c-main -smt -smb">

	<h2 data-gsap-element="header" class="text-gradient m-header">Produkty</h2>
	<div class="bg-gradient radius px-20 pt-12 pb-14">
		<h3 class="text-center text-white">Wyszukiwarka produktów</h3>
		<div class="mt-4">@include('partials.product-filters')</div>
	</div>

	@if (! have_posts())
	<x-alert type="warning">
		{!! __('Sorry, no results were found.', 'sage') !!}
	</x-alert>
	@else
	<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mt-20">
		@while (have_posts()) @php(the_post())
		@include('partials.content-product')
		@endwhile
	</div>

	{!! get_the_posts_navigation() !!}
	@endif
</div>
@endsection