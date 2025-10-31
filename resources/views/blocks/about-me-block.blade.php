@unless ($block->preview)
    <section {{ $attributes->merge(['class' => 'px-3 border-b border-border/50', 'id' => 'about-me-block']) }}>
    @else
        <section class="px-3 border border-b">
        @endunless
        <div class="container py-10 mx-auto border-l border-r border-border/50">
            <div class="max-w-3xl mx-auto text-center px-3">
                <h2 class="font-display text-4xl font-bold mb-6">{{ $items['about_section_title'] }}</h2>
                <p class="text-lg text-muted-foreground leading-relaxed mb-8">
                    {{ $items['about_section_description'] }}
                </p>
                <div class="flex flex-wrap justify-center gap-3">
                    @foreach ($items['skills'] as $skill)
                        <span key={skill}
                            class="px-4 py-2 bg-secondary text-sm font-medium border-dashed-subtle-default">
                            {{ $skill }}
                        </span>
                    @endforeach
                </div>
            </div>
        </div>


        @unless ($block->preview)
        </section>
    @endunless
