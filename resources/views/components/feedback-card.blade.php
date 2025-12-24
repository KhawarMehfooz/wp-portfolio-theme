@props(['feedback'])

@php
    $author_name = get_field('t_author_name', $feedback->ID);
    $author_country = get_field('t_author_country', $feedback->ID);
    $testimonial = get_field('t_author_testimonial', $feedback->ID);

    $initials = collect(explode(' ', trim($author_name)))
        ->filter()
        ->map(fn($word) => strtoupper(mb_substr($word, 0, 1)))
        ->take(2)
        ->implode('');

    // Country name → ISO code mapping
    $country_map = [
        'Pakistan' => 'PK',
        'United States' => 'US',
        'USA' => 'US',
        'United Kingdom' => 'GB',
        'UK' => 'GB',
        'India' => 'IN',
        'Germany' => 'DE',
        'France' => 'FR',
        'Canada' => 'CA',
        'Australia' => 'AU',
        'Netherlands' => 'NL',
        'Holland' => 'NL',
        'South Africa' => 'ZA',
        'Turks and Caicos Islands' => 'TC',
    ];

    $iso = $country_map[$author_country] ?? null;

    // ISO → Emoji flag
    $flag = $iso
        ? collect(str_split($iso))
            ->map(fn($char) => mb_chr(ord($char) + 127397))
            ->implode('')
        : null;
@endphp


<article class="animate-fade-in h-full">
    <div class="group h-full p-4 border border-dashed-subtle-default
               hover:border-primary transition-all duration-300
               flex flex-col justify-between">

        {{-- Testimonial --}}
        <div class="mb-6">
            <p class="text-muted-foreground text-sm leading-relaxed">
                “{{ $testimonial }}”
            </p>
        </div>

        {{-- Author --}}
        <footer class="flex items-center gap-4 mt-auto">
            {{-- Avatar (Initials) --}}
            <div class="flex items-center justify-center
                       h-12 w-12 rounded-full
                       bg-muted text-primary
                       font-semibold text-sm
                       border border-dashed-subtle-default
                       group-hover:border-primary transition-colors">
                {{ $initials }}
            </div>

            {{-- Meta --}}
            <div>
                <p class="font-medium text-sm leading-none">
                    {{ $author_name }}
                </p>
                <p class="flex items-center gap-1 text-sm text-muted-foreground mt-1">
                    @if ($flag)
                        <span class="leading-none">{{ $flag }}</span>
                    @endif
                    <span class="">{{ $author_country }}</span>
                </p>

            </div>
        </footer>
    </div>
</article>