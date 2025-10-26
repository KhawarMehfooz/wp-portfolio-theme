@extends('layouts.app')

@section('content')
    <main>
        <div class="container mx-auto pt-20 md:pt-30 pb-3 px-3 border-l border-r border-border/50">

            {{-- Archive Header --}}
            <header class="w-full md:max-w-2xl mb-8 animate-fade-in-up">
                <h1 class="font-display text-2xl md:text-4xl font-bold mb-3 md:mb-6">
                    {{ post_type_archive_title('', false) }}
                </h1>

                @if (get_field('service_archive_description', 'options'))
                    <p class="text-lg text-muted-foreground leading-relaxed m-0">
                        {{ get_field('service_archive_description', 'options') }}
                    </p>
                @endif
            </header>

            {{-- Services Grid --}}
            @php
                $paged = get_query_var('paged') ? get_query_var('paged') : 1;
                $args = [
                    'post_type' => 'service',
                    'posts_per_page' => 6,
                    'paged' => $paged,
                ];
                $services = new WP_Query($args);
            @endphp

            <section aria-labelledby="services-heading" class="mt-6">
                <h2 id="services-heading" class="sr-only">Available Services</h2>

                @if ($services->have_posts())
                    <div class="grid md:grid-cols-2 gap-6">
                        @while ($services->have_posts())
                            @php $services->the_post(); @endphp
                            <x-service-card :post="get_post()" />
                        @endwhile
                    </div>

                    {{-- Pagination --}}
                    <nav class="pagination mt-12 flex justify-center gap-4" aria-label="Pagination">
                        {!! paginate_links([
                            'total' => $services->max_num_pages,
                            'current' => max(1, get_query_var('paged')),
                            'prev_text' => '&laquo;',
                            'next_text' => '&raquo;',
                        ]) !!}
                    </nav>

                    @php wp_reset_postdata(); @endphp
                @else
                    <p class="col-span-2 text-center text-muted-foreground">No services found.</p>
                @endif
            </section>
        </div>
    </main>
@endsection
