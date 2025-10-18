@extends('layouts.app')

@section('content')
    <main class="border-b border-border/50">
        <div class="container mx-auto pt-10 md:pt-20 pb-3 md:pb-6 px-6 border-l border-r border-border/50">

            {{-- Archive Header --}}
            <div class="max-w-2xl animate-fade-in-up">
                <h1 class="font-display text-3xl md:text-5xl font-bold mb-3 md:mb-6">
                    {{ post_type_archive_title('', false) }}
                </h1>
                @if (get_field('archive_description', 'options'))
                    <p class="text-lg text-muted-foreground leading-relaxed m-0">
                        {{ get_field('archive_description', 'options') }}
                    </p>
                @endif
            </div>

            {{-- Projects Grid --}}
            <div class="grid md:grid-cols-2 gap-6 mt-3 md:mt-6">
                @php
                    // Pagination setup
                    $paged = get_query_var('paged') ? get_query_var('paged') : 1;
                    $args = [
                        'post_type' => 'project',
                        'posts_per_page' => 6,
                        'paged' => $paged,
                    ];
                    $projects = new WP_Query($args);
                @endphp

                @if ($projects->have_posts())
                    @while ($projects->have_posts())
                        @php $projects->the_post(); @endphp
                        <div class="animate-fade-in">
                            <a href="{{ get_permalink() }}"
                                class="group block p-8 border border-dashed-subtle-default hover:border-primary transition-all duration-300 hover:shadow-lg hover:shadow-primary/5">

                                <div class="flex items-center justify-between mb-4">
                                    <span class="text-xs font-medium text-primary">
                                        @php
                                            $terms = get_the_terms(get_the_ID(), 'project_category');
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

                                {{-- Title --}}
                                <h3
                                    class="font-display text-xl font-semibold mb-3 group-hover:text-primary transition-colors">
                                    {{ get_the_title() }}
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
                    <p class="col-span-2 text-center text-muted-foreground">No projects found.</p>
                @endif
            </div>

            {{-- Pagination --}}
            <div class="pagination mt-8 flex justify-center gap-4">
                {!! paginate_links([
                    'total' => $projects->max_num_pages,
                    'current' => max(1, get_query_var('paged')),
                    'prev_text' => '&laquo;',
                    'next_text' => '&raquo;',
                ]) !!}
            </div>

        </div>
    </main>
@endsection
