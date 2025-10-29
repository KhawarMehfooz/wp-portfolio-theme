@props(['post'])

@php
    $post_id = $post->ID;
    $post_type = get_post_type($post_id);
    $post_date = get_the_date('F j, Y', $post_id);
@endphp

<article
    class="group block p-6 border border-dashed-subtle-default hover:border-primary transition-all duration-300 animate-fade-in">

    {{-- Header --}}
    <header class="mb-3 flex items-center gap-4 text-xs text-muted-foreground">
        <div class="flex items-center gap-1.5">
            <x-icons.calender-days class="w-3.5 h-3.5" />
            <time datetime="{{ get_the_date('c', $post_id) }}">{{ $post_date }}</time>
        </div>
    </header>

    {{-- Content --}}
    <div>
        <h3 class="font-display text-lg font-semibold mb-2 group-hover:text-primary transition-colors">
            <a href="{{ get_permalink($post) }}" class="khwr-no-underline text-foreground hover:text-primary">
                {!! esc_html(get_the_title($post)) !!}
            </a>
        </h3>

        <section class="text-sm text-muted-foreground leading-relaxed mb-4">
            {!! wp_trim_words(
                has_excerpt($post) ? get_the_excerpt($post) : wp_strip_all_tags(get_the_content($post)),
                25,
                '...',
            ) !!}
        </section>
    </div>

    {{-- Footer --}}
    <footer>
        <a href="{{ get_permalink($post) }}"
            class="inline-flex khwr-no-underline items-center gap-2 text-sm font-medium text-primary"
            aria-label="Read more about {{ get_the_title($post) }}">
            Read More
            <x-icons.arrow-right class="w-4 h-4 group-hover:translate-x-1 transition-transform" />
        </a>
    </footer>

</article>
