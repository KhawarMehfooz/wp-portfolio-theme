@php
    $title = get_field('block_section_title');
    $description = get_field('block_section_description');
    $post_type = get_field('block_post');
    $post_count = get_field('block_post_count') ?: 4;
    $post_order = get_field('block_post_order') ?: 'asc';
    $grid_cols = get_field('block_post_grid_cols') ?: 2;

    $query = new WP_Query([
        'post_type' => $post_type,
        'posts_per_page' => $post_count,
        'order' => strtoupper($post_order),
    ]);
@endphp

@unless ($block->preview)
    <section {{ $attributes->merge([ 'id' => 'posts-block', 'class' => 'px-3 border-b border-border/50']) }}>
    @else
        <section class="px-3 border border-b">
        @endunless

        <div class="container mx-auto border-l border-r border-border/50 py-10 px-3 md:px-6">

            {{-- Section Header --}}
            @if ($title || $description)
                <header class="max-w-2xl mb-12">
                    @if ($title)
                        <h2 class="font-display text-4xl font-bold mb-4">{{ $title }}</h2>
                    @endif
                    @if ($description)
                        <p class="text-muted-foreground leading-relaxed">{{ $description }}</p>
                    @endif
                </header>
            @endif

            {{-- Posts Grid --}}
            <div class="grid md:grid-cols-{{ $grid_cols }} gap-6 mb-8">
                @if ($query->have_posts())
                    @while ($query->have_posts())
                        @php $query->the_post(); @endphp

                        @if ($post_type === 'project')
                            <x-project-card :post="get_post()" />
                        @elseif ($post_type === 'service')
                            <x-service-card :post="get_post()" />
                        @else
                            <x-default-card :post="get_post()" />
                        @endif
                    @endwhile
                    @php wp_reset_postdata(); @endphp
                @else
                    <p class="text-muted-foreground col-span-{{ $grid_cols }}">No posts found.</p>
                @endif
            </div>

            {{-- View All Link --}}
            @if ($post_type)
                <footer>
                    <a href="{{ get_post_type_archive_link($post_type) }}"
                        class="khwr-no-underline inline-flex items-center gap-2 text-sm font-medium text-primary hover:underline">
                        View All {{ ucfirst($post_type) }}s
                        <x-icons.arrow-right class="w-4 h-4 group-hover:translate-x-1 transition-transform" />
                    </a>
                </footer>
            @endif

        </div>

        @unless ($block->preview)
        </section>
    @endunless
