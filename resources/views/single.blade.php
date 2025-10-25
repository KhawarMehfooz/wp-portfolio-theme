@extends('layouts.app')

@php
    $author_id   = get_post_field('post_author', get_the_ID());
@endphp

@section('content')
    <main>
        <div class="container mx-auto pt-20 px-3">

            {{-- Back Link --}}
            <a href="/blog"
                class="khwr-no-underline inline-flex items-center gap-2 text-sm text-muted-foreground hover:text-primary transition-colors mb-8">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                    stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                    class="lucide lucide-arrow-left w-4 h-4">
                    <path d="m12 19-7-7 7-7"></path>
                    <path d="M19 12H5"></path>
                </svg>
                Back to Blog
            </a>

            <div class="flex flex-col md:flex-row gap-6 items-start">
                <div class="w-full md:max-w-[70%]">
                    {{-- Service Title & Content --}}
                    <h1 class="font-display text-3xl md:text-4xl font-bold mb-6">{{ the_title() }}</h1>
                    <p class="text-xl text-muted-foreground leading-relaxed mb-12">{{ get_the_excerpt() }}</p>
                    <div class="mb-12 prose max-w-none">{{ the_content() }}</div>
                </div>

                <aside class="w-full md:max-w-[30%] pb-3 md:sticky top-30">
                    @include('components.author', ['author_id' => $author_id])
                    @include('forms.contact')
                    @include('partials.tags')
                </aside>
            </div>

        </div>
    </main>
@endsection
