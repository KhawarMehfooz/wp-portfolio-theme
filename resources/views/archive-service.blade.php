@extends('layouts.app')

@section('content')
<main class="">
    <div class="container mx-auto pt-10 md:pt-20 pb-3 md:pb-6 px-6 border-l border-r border-border/50">

        {{-- Archive Header --}}
        <div class="max-w-2xl animate-fade-in-up">
            <h1 class="font-display text-3xl md:text-5xl font-bold mb-3 md:mb-6">
                {{ post_type_archive_title('', false) }}
            </h1>
            @if (get_field('archive_description', 'options'))
            <p class="text-lg text-muted-foreground leading-relaxed m-0">
                {{ get_field('service_archive_description', 'options') }}
            </p>
            @endif
        </div>

        {{-- Servics Grid --}}
        <div class="grid md:grid-cols-2 gap-6 mt-3 md:mt-6">
            @php
            // Pagination setup
            $paged = get_query_var('paged') ? get_query_var('paged') : 1;
            $args = [
            'post_type' => 'service',
            'posts_per_page' => 6,
            'paged' => $paged,
            ];
            $services = new WP_Query($args);
            @endphp

            @if ($services->have_posts())
            @while ($services->have_posts())
            @php $services->the_post(); @endphp
            <div class="animate-fade-in">
                <a href="{{ get_permalink() }}" class="group block p-8 border border-dashed-subtle-default hover:border-primary transition-all duration-300 hover:shadow-lg hover:shadow-primary/5">

                    @php
                    $service_icon = get_field('service_icon', get_the_ID());
                    $icon_url = $service_icon['url'] ?? '';
                    $is_svg = $icon_url && str_ends_with($icon_url, '.svg');
                    @endphp

                    @if ($is_svg)
                    <span class="text-primary [&>svg]:h-8 [&>svg]:w-8 [&>svg]:text-muted-foreground [&>svg]:mb-4 ">
                        {!! file_get_contents($icon_url) !!}
                    </span>
                    @else
                    <img src="{{ $icon_url }}" class="h-5 w-5" />
                    @endif

                    {{-- Title --}}
                    <h3 class="font-display text-xl font-semibold mb-3 group-hover:text-primary transition-colors">
                        {!! html_entity_decode( get_the_title() ) !!}
                    </h3>

                    {{-- Excerpt / Description --}}
                    <p class="text-muted-foreground text-sm leading-relaxed mb-4">
                        @php
                        if (has_excerpt()) {
                        echo wp_trim_words(get_the_excerpt(), 25, '...');
                        } else {
                        echo wp_trim_words(strip_tags(get_the_content()), 25, '...');
                        }
                        @endphp
                    </p>


                    <div class="flex items-center gap-2 text-sm font-medium text-primary">
                        Learn More
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-arrow-right w-4 h-4 group-hover:translate-x-1 transition-transform">
                            <path d="M5 12h14"></path>
                            <path d="m12 5 7 7-7 7"></path>
                        </svg>
                    </div>
                </a>
            </div>
            @endwhile

            @php wp_reset_postdata(); @endphp
            @else
            <p class="col-span-2 text-center text-muted-foreground">No services found.</p>
            @endif
        </div>

        {{-- Pagination --}}
        <div class="pagination mt-8 flex justify-center gap-4">
            {!! paginate_links([
            'total' => $services->max_num_pages,
            'current' => max(1, get_query_var('paged')),
            'prev_text' => '&laquo;',
            'next_text' => '&raquo;',
            ]) !!}
        </div>

    </div>
</main>
@endsection
