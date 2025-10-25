@php
    $title = get_field('block_section_title');
    $description = get_field('block_section_description');
    $post_type = get_field('block_post');
    $post_count = get_field('block_post_count') ?: 4;
    $post_order = get_field('block_post_order') ?: 'asc';
    $grid_cols = get_field('block_post_grid_cols') ?: 2;

    $args = [
        'post_type' => $post_type,
        'posts_per_page' => $post_count,
        'order' => strtoupper($post_order),
    ];

    $query = new WP_Query($args);
@endphp

@unless ($block->preview)
    <section {{ $attributes->merge(['class' => 'px-3 border-b border-border/50']) }}>
    @else
        <section class="px-3 border border-b">
        @endunless

        <div class="container mx-auto border-l border-r border-border/50 py-10 px-3 md:px-6">

            {{-- Section Header --}}
            <div class="max-w-2xl mb-12">
                @if ($title)
                    <h2 class="font-display text-4xl font-bold mb-4">{{ $title }}</h2>
                @endif
                @if ($description)
                    <p class="text-muted-foreground leading-relaxed">{{ $description }}</p>
                @endif
            </div>

            {{-- Posts Grid --}}
            <div class="grid md:grid-cols-{{ $grid_cols }} gap-6 mb-8">
                @if ($query->have_posts())
                    @while ($query->have_posts())
                        @php $query->the_post(); @endphp
                        <div class="animate-fade-in">
                            <a href="{{ get_permalink() }}"
                                class="khwr-no-underline group block p-8 border border-dashed-subtle-default hover:border-primary transition-all duration-300 hover:shadow-lg hover:shadow-primary/5">

                                @if ($post_type === 'project')
                                    <div class="flex items-center justify-between mb-4">
                                        <span
                                            class="px-2 py-1 text-xs bg-secondary text-foreground border-dashed-subtle-default">
                                            @php
                                                $terms = get_the_terms(get_the_ID(), $post_type . '_category');
                                                if ($terms && !is_wp_error($terms)) {
                                                    echo esc_html($terms[0]->name);
                                                }
                                            @endphp
                                        </span>
                                        <span class="text-xs text-muted-foreground">
                                            @php
                                                $project_date = get_field('project_date');
                                                if ($project_date) {
                                                    echo date('Y', strtotime($project_date));
                                                }
                                            @endphp
                                        </span>
                                    </div>
                                @endif

                                @if ($post_type === 'service')
                                    @php
                                        $service_icon = get_field('service_icon', get_the_ID());
                                        $icon_url = $service_icon['url'] ?? '';
                                        $is_svg = $icon_url && str_ends_with($icon_url, '.svg');
                                    @endphp

                                    @if ($is_svg)
                                        <span
                                            class="text-primary [&>svg]:h-8 [&>svg]:w-8 [&>svg]:text-muted-foreground [&>svg]:mb-4 ">
                                            {!! file_get_contents($icon_url) !!}
                                        </span>
                                    @else
                                        <img src="{{ $icon_url }}" class="h-5 w-5" />
                                    @endif
                                @endif


                                {{-- Title --}}
                                <h3
                                    class="font-display text-xl font-semibold mb-3 group-hover:text-primary transition-colors">
                                    {!! html_entity_decode( get_the_title() ) !!}
                                </h3>

                                {{-- Description / Excerpt --}}
                                <p class="text-muted-foreground text-sm leading-relaxed mb-4">
                                    @php
                                        if (has_excerpt()) {
                                            echo wp_trim_words(get_the_excerpt(), 25, '...');
                                        } else {
                                            echo wp_trim_words(strip_tags(get_the_content()), 25, '...');
                                        }
                                    @endphp
                                </p>

                                {{-- Learn More --}}
                                <div class="flex items-center gap-2 text-sm font-medium text-primary">
                                    Learn More
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                        viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                        stroke-linecap="round" stroke-linejoin="round"
                                        class="lucide lucide-arrow-right w-4 h-4 group-hover:translate-x-1 transition-transform">
                                        <path d="M5 12h14"></path>
                                        <path d="m12 5 7 7-7 7"></path>
                                    </svg>
                                </div>

                            </a>
                        </div>
                    @endwhile
                    @php wp_reset_postdata(); @endphp
                @else
                    <p class="text-muted-foreground col-span-{{ $grid_cols }}">No posts found.</p>
                @endif
            </div>

            {{-- View All Link --}}
            @if ($post_type)
                <a class="khwr-no-underline inline-flex items-center gap-2 text-sm font-medium text-primary hover:underline"
                    href="{{ get_post_type_archive_link($post_type) }}">
                    View All {{ ucfirst($post_type) }}s
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                        fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                        stroke-linejoin="round" class="lucide lucide-arrow-right w-4 h-4">
                        <path d="M5 12h14"></path>
                        <path d="m12 5 7 7-7 7"></path>
                    </svg>
                </a>
            @endif

        </div>

        @unless ($block->preview)
        </section>
    @endunless
