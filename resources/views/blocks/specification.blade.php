<!--- specification --->

<section
	data-gsap-anim="section"
	@if(!empty($section_id)) id="{{ $section_id }}" @endif
	@class([ 'b-specification relative mt-20' ,
	$sectionClass=> filled($sectionClass),
	$section_class => filled($section_class),
	$background => filled($background) && $background !== 'none',
	])>

	<div class="__wrapper c-main grid grid-cols-1 md:grid-cols-[2.5fr_1fr] section-gap">

		<div data-gsap-element="tabs" class="tabs-wrapper flex flex-col">
			@foreach ($r_specification as $item)
			<div class="tabs rounded-2xl bg-white b-shadow h-max">
				<input class="tab-check" type="checkbox" name="radio-a" id="check{{ $loop->index }}">
				<label class="tabs-label flex items-center justify-between" for="check{{ $loop->index }}">
					<div class="flex items-center gap-4">
						<p class="!text-lg font-header">{{ $item['title'] }}</p>
					</div>
					<span class="__icon __icon-plus text-white text-2xl leading-none bg-primary h-6 w-6 rounded-full text-center">+</span>
					<span class="__icon __icon-minus text-white !font-bold text-lg leading-none bg-primary h-6 w-6 rounded-full !text-center">−</span>
				</label>
				<div class="tabs-content">
					{!! $item['txt'] !!}
				</div>
			</div>
			@endforeach
		</div>

		<div data-gsap-element="card">
			<div class="__content bg-white radius b-shadow p-8">
				<img src="/wp-content/uploads/2026/05/info.svg" />
				<p data-gsap-element="header" class="">{!! $g_specification['text'] !!}</p>
			</div>
		</div>

	</div>

</section>