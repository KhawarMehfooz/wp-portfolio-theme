@extends('layouts.app')

@php
    $author_id = get_post_field('post_author', get_the_ID());
@endphp

@section('content')
    <main>
        <div class="container mx-auto pt-20 md:pt-30 px-3">
            <header class="">
                <x-back-link href="/blog" label="Back to Blog" />
            </header>

            <section class="flex flex-col md:flex-row gap-6 items-start">
                <div class="w-full md:max-w-[70%]">
                    @includeFirst(['partials.content-single', 'partials.content'])
                </div>

                <aside class="w-full md:max-w-[30%] pb-3 md:sticky top-30">
                    @include('components.author', ['author_id' => $author_id])
                    @include('forms.contact')
                    @include('partials.tags')
                </aside>
            </section>
        </div>
    </main>
@endsection
