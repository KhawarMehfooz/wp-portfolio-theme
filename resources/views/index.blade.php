@extends('layouts.app')

@section('content')
    <main>
        <div class="container mx-auto pt-20 md:pt-30 pb-3 md:pb-6 px-3 border-l border-r border-border/50">

            <div class=" animate-fade-in-up">
                <h1 class="font-display text-2xl md:text-4xl font-bold mb-3 md:mb-6">
                    Blog
                </h1>
            </div>

            @php
                $blog = new WP_Query([
                    'post_type' => 'post',
                    'posts_per_page' => 10,
                    'status' => 'published',
                    'paged' => get_query_var('paged') ?: 1,
                ]);
            @endphp

            {{-- Archive Grid --}}
            <div class="grid md:grid-cols-2 gap-6 mt-6 animate-fade-in">
                @if ($blog->have_posts())
                    @while ($blog->have_posts())
                        @php $blog->the_post(); @endphp

                        <article
                            class="border border-dashed-subtle-default p-6 hover:border-primary hover:shadow-lg hover:shadow-primary/5 transition-all duration-300 group">
                            {{-- Title --}}
                            <a href="{{ get_permalink() }}" class="khwr-no-underline group block">
                                <h2
                                    class="font-display text-xl font-semibold mb-3 group-hover:text-primary transition-colors">
                                    {!! html_entity_decode(get_the_title()) !!}
                                </h2>


                                {{-- Excerpt or Content --}}
                                <div class="text-muted-foreground text-sm leading-relaxed mb-4">
                                    @if (has_excerpt())
                                        {{ wp_trim_words(get_the_excerpt(), 30, '...') }}
                                    @else
                                        {{ wp_trim_words(strip_tags(get_the_content()), 30, '...') }}
                                    @endif
                                </div>

                                <div class="flex items-center gap-2 text-sm font-medium text-primary">
                                    Read More
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                        viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                        stroke-linecap="round" stroke-linejoin="round"
                                        class="lucide lucide-arrow-right w-4 h-4 group-hover:translate-x-1 transition-transform">
                                        <path d="M5 12h14"></path>
                                        <path d="m12 5 7 7-7 7"></path>
                                    </svg>
                                </div>
                            </a>
                        </article>
                    @endwhile
                @else
                    <p class="col-span-2 text-center text-muted-foreground">No posts found.</p>
                @endif
            </div>

            {{-- Pagination --}}
            <div class="pagination mt-8 flex justify-center gap-4">
                {!! paginate_links([
                    'prev_text' => '&laquo;',
                    'next_text' => '&raquo;',
                ]) !!}
            </div>

        </div>
    </main>
@endsection
