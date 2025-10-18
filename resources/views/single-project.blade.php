@extends('layouts.app')
@section('content')
    <main class="border-b border-border/50">
        <div class=" mx-auto max-w-4xl pt-20 px-6">
            <a class="inline-flex items-center gap-2 text-sm text-muted-foreground hover:text-primary transition-colors mb-8"
                href="/projects"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                    fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                    class="lucide lucide-arrow-left w-4 h-4">
                    <path d="m12 19-7-7 7-7"></path>
                    <path d="M19 12H5"></path>
                </svg>Back to Projects</a>
            <div class="flex items-center gap-4 mb-6">
                @php
                    $p_cat = get_the_terms(get_the_ID(), 'project_category');
                @endphp
                @if ($p_cat && !is_wp_error($p_cat))
                    <span class="text-sm font-semibold  text-primary">
                        {{ $p_cat[0]->name }}
                    </span>
                @endif

                <span class="text-sm text-muted-foreground"> {{ date('Y', strtotime(get_field('project_date'))) }}</span>
            </div>
            <h1 class="font-display text-4xl md:text-5xl font-bold mb-6">{{ the_title() }}</h1>
            <div class="">{{ the_content() }}</div>
            <section class="mb-12">
                <h2 class="font-display text-2xl font-semibold mb-6">Technologies Used</h2>
                @php
                    $technologies = get_the_terms(get_the_ID(), 'technology');
                @endphp

                @if ($technologies && !is_wp_error($technologies))
                    <div class="flex flex-wrap gap-2">
                        @foreach ($technologies as $tech)
                            <span
                                class="px-3 py-1.5 font-sans font-medium bg-secondary text-foreground text-sm rounded-sm border border-dashed-subtle-default">
                                {{ $tech->name }}
                            </span>
                        @endforeach
                    </div>
                @else
                    <p class="text-muted-foreground text-sm">No technologies listed.</p>
                @endif
            </section>

        </div>
    </main>
@endsection
