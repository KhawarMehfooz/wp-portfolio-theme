@extends('layouts.app')

@section('content')
    <main class="container mx-auto pt-20 md:pt-30 pb-10 px-3 border-l border-r border-border/50">
        <x-back-link href="/feedbacks" label="Back to Feedbacks" />

        <div class="max-w-2xl mx-auto">
            <x-feedback-card :feedback="get_post()" />
        </div>

    </main>
@endsection