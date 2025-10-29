@props(['post'])

@php
    $terms = get_the_terms($post->ID, 'project_category');
    $term_name = $terms && !is_wp_error($terms) ? esc_html($terms[0]->name) : '';
    $project_date = get_field('project_date', $post->ID);
    $year = $project_date ? date('Y', strtotime($project_date)) : '';
@endphp

<article class="animate-fade-in">
    <a href="{{ get_permalink($post) }}"
        class="khwr-no-underline group block p-8 border border-dashed-subtle-default hover:border-primary transition-all duration-300">

        {{-- Header --}}
        <header class="flex items-center justify-between mb-4">
            @if ($term_name)
                <span class="px-2 py-1 text-xs bg-secondary text-foreground border-dashed-subtle-default">
                    {{ $term_name }}
                </span>
            @endif
            @if ($year)
                <time datetime="{{ $project_date }}" class="text-xs text-muted-foreground">{{ $year }}</time>
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
