@extends('layouts.app')

@section('content')
    <main>
        <div class="container mx-auto pt-20 md:pt-30 pb-3 px-3 border-l border-r border-border/50">

            {{-- Archive Header --}}
            <header class="w-full md:max-w-2xl animate-fade-in-up">
                <h1 class="font-display text-2xl md:text-4xl font-bold mb-3 md:mb-6">
                    {{ post_type_archive_title('', false) }}
                </h1>

                @if (get_field('archive_description', 'options'))
                    <p class="text-lg text-muted-foreground leading-relaxed m-0">
                        {{ get_field('archive_description', 'options') }}
                    </p>
                @endif
            </header>

            {{-- Projects Grid --}}
            @php
                $paged = get_query_var('paged') ? get_query_var('paged') : 1;
                $args = [
                    'post_type' => 'project',
                    'posts_per_page' => 6,
                    'paged' => $paged,
                ];
                $projects = new WP_Query($args);
            @endphp

            @if ($projects->have_posts())
                <section class="grid md:grid-cols-2 gap-6 mt-3 md:mt-6" aria-label="Projects">
                    @while ($projects->have_posts())
                        @php $projects->the_post(); @endphp
                        <x-project-card :post="get_post()" />
                    @endwhile
                </section>

                {{-- Pagination --}}
                <nav class="pagination mt-8 flex justify-center gap-4" aria-label="Projects Pagination">
                    {!! paginate_links([
                        'total' => $projects->max_num_pages,
                        'current' => max(1, get_query_var('paged')),
                        'prev_text' => '&laquo;',
                        'next_text' => '&raquo;',
                    ]) !!}
                </nav>

                @php wp_reset_postdata(); @endphp
            @else
                <p class="mt-8 text-center text-muted-foreground">No projects found.</p>
            @endif

        </div>
    </main>
@endsection
