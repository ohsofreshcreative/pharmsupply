<!--- content -->

<section
    data-gsap-anim="section"
    @if(!empty($section_id)) id="{{ $section_id }}" @endif
    @class([ 'b-content relative -smt' ,
    $sectionClass=> filled($sectionClass),
    $section_class => filled($section_class),
    $background => filled($background) && $background !== 'none',
    ])>

    <div class="__wrapper c-main relative grid grid-cols-1 lg:grid-cols-2 items-center gap-8 lg:gap-20">
        @if (!empty($g_content['image']))
        <div data-gsap-element="img"
            @class(['__img relative h-full order1', 'is-flipped'=> !empty($switch)])>

            @if (!empty($g_content['bg']))
            <img class="absolute {{ $bg_class ?? '' }} z-0"
                src="{{ $g_content['bg']['url'] }}"
                alt="{{ $g_content['bg']['alt'] ?? '' }}" />
            @endif

            @if (!empty($glow))
            <img class="absolute top-0 -left-20 blur-[350px] opacity-15 w-full h-full z-0" src="/wp-content/uploads/2026/05/hero-shape.svg" />
            @endif

            <img class="mask-img object-cover w-full h-full aspect-[3/2] radius-img relative z-10"
                src="{{ $g_content['image']['url'] }}"
                alt="{{ $g_content['image']['alt'] ?? '' }}">

        </div>
        @endif

        <div class="__content order2 lg:py-10">
            <h2 data-gsap-element="header" class="text-gradient m-header">
                {{ $g_content['header'] }}
            </h2>

            <div data-gsap-element="txt" class="__txt mt-4">
                {!! $g_content['txt'] !!}
            </div>

            @if (!empty($g_content['button']))
            <x-button
                :href="$g_content['button']['url']"
                variant="primary"
                class="mt-6"
                data-gsap-element="btn">
                {{ $g_content['button']['title'] }}
            </x-button>
            @endif

        </div>

    </div>

</section>