@extends('layouts.app')

@section('content')
    <main>
        <section class="container mx-auto pt-20 md:pt-30 pb-3 md:pb-6 px-3 border-l border-r border-border/50">

            {{-- Archive Header --}}
            <header class="animate-fade-in-up mb-6 md:mb-8">
                <h1 class="font-display text-2xl md:text-4xl font-bold">
                    {!! get_the_archive_title() !!}
                </h1>
            </header>

            {{-- Archive Grid --}}
            <div class="grid md:grid-cols-2 gap-6 animate-fade-in">
                @if (have_posts())
                    @while (have_posts())
                        @php the_post(); @endphp
                        <x-default-card :title="get_the_title()" :permalink="get_permalink()" :excerpt="has_excerpt()
                            ? wp_trim_words(get_the_excerpt(), 30, '...')
                            : wp_trim_words(strip_tags(get_the_content()), 30, '...')" />
                    @endwhile
                @else
                    <p class="col-span-2 text-center text-muted-foreground">No posts found.</p>
                @endif
            </div>

            {{-- Pagination --}}
            <nav class="pagination mt-8 flex justify-center gap-4" aria-label="Archive Pagination">
                {!! paginate_links([
                    'prev_text' => '&laquo;',
                    'next_text' => '&raquo;',
                ]) !!}
            </nav>

        </section>
    </main>
@endsection
