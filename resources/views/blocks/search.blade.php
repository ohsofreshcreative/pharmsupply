<!--- search -->

<section
	data-gsap-anim="section"
	@if(!empty($section_id)) id="{{ $section_id }}" @endif
	@class([ 'b-search relative -smt' ,
	$sectionClass=> filled($sectionClass),
	$section_class => filled($section_class),
	$background => filled($background) && $background !== 'none',
	])>

	<div data-gsap-element="search" class="__wrapper c-main relative">


		<div class="__search bg-gradient radius p-10 md:px-20 md:pt-12 md:pb-14">
			<h3 class="text-center text-white">Wyszukiwarka produktów</h3>

			<div class="mt-8">
				@include('partials.product-filters')
			</div>
		</div>
	</div>
</section>