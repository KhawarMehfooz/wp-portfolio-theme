@extends('layouts.app')

@section('content')
<main>
    <article class="mx-auto max-w-4xl pt-20 px-6">

        {{-- Back Link --}}
        <x-back-link href="/projects" label="Back to Projects" />

        {{-- Meta Information --}}
        <header class="mb-6">
            <div class="flex items-center gap-4 mb-3">
                @php
                    $p_cat = get_the_terms(get_the_ID(), 'project_category');
                @endphp
                @if ($p_cat && !is_wp_error($p_cat))
                    <span class="px-2 py-1 text-xs bg-secondary text-foreground border-dashed-subtle-default">
                        {{ $p_cat[0]->name }}
                    </span>
                @endif

                <time datetime="{{ get_field('project_date') }}" class="text-sm text-muted-foreground">
                    {{ DateTime::createFromFormat('d/m/Y', get_field('project_date'))->format('Y') }}
                </time>
            </div>

            <h1 class="font-display text-4xl md:text-5xl font-bold mb-6">
                {{ the_title() }}
            </h1>
        </header>

        {{-- Project Content --}}
        <div class="prose prose-neutral max-w-none mb-12">
            {{ the_content() }}
        </div>

        {{-- Technologies Section --}}
        <section aria-labelledby="technologies-title" class="mb-12">
            <h2 id="technologies-title" class="font-display text-2xl font-semibold mb-6">
                Technologies Used
            </h2>

            @php
                $technologies = get_the_terms(get_the_ID(), 'technology');
            @endphp

            @if ($technologies && !is_wp_error($technologies))
                <ul class="khwr-ul flex flex-wrap gap-2">
                    @foreach ($technologies as $tech)
                        <li>
                            <span class="px-3 py-1.5 font-sans font-medium bg-secondary text-foreground text-sm border border-dashed-subtle-default">
                                {{ $tech->name }}
                            </span>
                        </li>
                    @endforeach
                </ul>
            @else
                <p class="text-muted-foreground text-sm">No technologies listed.</p>
            @endif
        </section>

    </article>
</main>
@endsection
