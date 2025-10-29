@props(['post'])

@php
    $service_icon = get_field('service_icon', $post->ID);
    $icon_url = $service_icon['url'] ?? '';
    $is_svg = $icon_url && str_ends_with($icon_url, '.svg');
@endphp

<article class="animate-fade-in">
    <a href="{{ get_permalink($post) }}"
        class="khwr-no-underline group block p-8 border border-dashed-subtle-default hover:border-primary transition-all duration-300 ">

        {{-- header --}}
        <header class="mb-4">
            @if ($is_svg)
                <span class="text-primary [&>svg]:h-8 [&>svg]:w-8 [&>svg]:text-muted-foreground [&>svg]:mb-4">
                    {!! file_get_contents($icon_url) !!}
                </span>
            @elseif ($icon_url)
                <img src="{{ $icon_url }}" alt="{{ get_the_title($post) }}" class="h-5 w-5 mb-4" />
            @endif
        </header>

        {{-- content --}}
        <div>
            <h3 class="font-display text-xl font-semibold mb-3 group-hover:text-primary transition-colors">
                {!! html_entity_decode(get_the_title($post)) !!}
            </h3>

            <p class="text-muted-foreground text-sm leading-relaxed mb-4">
                {!! wp_trim_words(has_excerpt($post) ? get_the_excerpt($post) : strip_tags(get_the_content($post)), 25, '...') !!}
            </p>
        </div>

        {{-- footer --}}
        <footer class="flex items-center gap-2 text-sm font-medium text-primary">
            Learn More
            <x-icons.arrow-right class="w-4 h-4 group-hover:translate-x-1 transition-transform" />
        </footer>
    </a>
</article>
