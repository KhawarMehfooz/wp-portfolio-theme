@extends('layouts.app')

@section('content')
    <main>
        <div class="container mx-auto pt-20 md:pt-30 pb-10 px-3 border-l border-r border-border/50">

            {{-- Archive Header --}}
            {{-- Archive Header with Fiverr Link --}}
            <header class="w-full animate-fade-in-up mb-6 flex  items-center justify-between gap-3">

                {{-- Archive Title --}}
                <h1 class="font-display text-2xl sm:text-3xl md:text-4xl font-bold m-0">
                    {{ post_type_archive_title('', false) }}
                </h1>

                {{-- Fiverr CTA --}}
                <a href="https://www.fiverr.com/beingkhawar" rel="noopener noreferrer" referrerpolicy="no-referrer"
                    target="_blank"
                    class="block bg-muted px-4 py-2 text-xs md:text-base text-primary font-display font-semibold border border-dashed-subtle-default">
                    View on Fiverr
                </a>

            </header>

            {{-- Archive Description --}}
            @if (get_field('feedback_archive_description', 'options'))
                <p class="text-sm sm:text-base md:text-lg text-muted-foreground leading-relaxed m-0 mb-6">
                    {{ get_field('feedback_archive_description', 'options') }}
                </p>
            @endif


            {{-- Feedback Grid --}}
            @php
                $feedbacks = get_posts([
                    'post_type' => 'feedback',
                    'posts_per_page' => -1,
                    'post_status' => 'publish',
                    'orderby' => 'date',
                    'order' => 'DESC',
                ]);
            @endphp

            @if ($feedbacks)
                <div class="mb-6 columns-1 sm:columns-2 lg:columns-3 gap-6">
                    @foreach ($feedbacks as $feedback)
                        <div class="mb-6 break-inside-avoid">
                            <x-feedback-card :feedback="$feedback" />
                        </div>
                    @endforeach
                </div>
            @else
                <p class="text-muted-foreground">No feedback found.</p>
            @endif

        </div>
    </main>
@endsection