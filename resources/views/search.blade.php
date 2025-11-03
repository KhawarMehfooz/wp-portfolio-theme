@extends('layouts.app')

@section('content')
    <section class="container mx-auto pt-20 md:pt-30 pb-3 md:pb-6 px-3 border-l border-r border-border/50">
        {!! get_search_form(false) !!}
        @include('partials.page-header')

        @if (!have_posts())
            <section class="">
                <x-alert type="warning">
                    {!! __('Sorry, no results were found.', 'sage') !!}
                </x-alert>
            </section>
        @endif

        <div class="grid md:grid-cols-2 gap-6 animate-fade-in">
            @while (have_posts())
                @php(the_post())
                @include('partials.content-search')
            @endwhile
        </div>
        {!! get_the_posts_navigation() !!}
    </section>
@endsection
