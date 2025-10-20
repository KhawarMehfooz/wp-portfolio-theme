@unless ($block->preview)
    <section {{ $attributes->merge(['class' => 'relative px-3 overflow-hidden border-b border-border/50']) }}>
    @else
        <section class="relative px-3 overflow-hidden border-b">
        @endunless

        <div class="container mx-auto pt-30 pb-20 relative z-10 border-l border-r border-border/50 grid-background-7 ">
            <div class="max-w-3xl mx-auto animate-fade-in-up text-center px-3">
                <h1 class="font-display text-3xl md:text-4xl lg:text-6xl text-center font-bold mb-6 tracking-tight">
                    {{ $items['hero_heading'] }}
                </h1>

                <p class="text-md lg:text-xl text-muted-foreground mb-8 leading-relaxed text-center">
                    {{ $items['hero_detail'] }}
                </p>

                <div class="flex flex-col sm:flex-row gap-4 items-center justify-center">
                    @if (!empty($items['primary_button']['url']))
                        @php
                            $icon_url = $items['primary_button_icon']['url'] ?? '';
                            $is_svg = $icon_url && str_ends_with($icon_url, '.svg');
                        @endphp
                        <a href="{{ esc_url($items['primary_button']['url']) }}"
                            class="[&>svg]:h-5 [&>svg]:w-5 inline-flex gap-2 items-center px-6 py-2 bg-primary text-white  font-medium hover:bg-background hover:text-primary border-1 border-transparent hover-border-dashed-subtle transition-all duration-300">
                            @if ($is_svg)
                                {{-- Inline SVG so Tailwind text colors apply --}}
                                <span class="">
                                    {!! file_get_contents($icon_url) !!}
                                </span>
                            @else
                                {{-- Fallback for PNG/JPG icons --}}
                                <img src="{{ $icon_url }}" class="h-5 w-5" />
                            @endif
                            {{ esc_html($items['primary_button']['title']) }}

                        </a>
                    @endif

                    @if (!empty($items['secondary_button']['url']))
                        @php
                            $icon_url = $items['secondary_button_icon']['url'] ?? '';
                            $is_svg = $icon_url && str_ends_with($icon_url, '.svg');
                        @endphp
                        <a href="{{ esc_url($items['secondary_button']['url']) }}"
                            class="[&>svg]:h-5 [&>svg]:w-5 inline-flex gap-2 items-center px-6 py-2 border bg-background border-dashed border-primary text-primary  font-medium hover:bg-primary/10 transition-all duration-300">
                            @if ($is_svg)
                                {{-- Inline SVG so Tailwind text colors apply --}}
                                <span class="">
                                    {!! file_get_contents($icon_url) !!}
                                </span>
                            @else
                                {{-- Fallback for PNG/JPG icons --}}
                                <img src="{{ $icon_url }}" class="h-5 w-5" />
                            @endif
                            {{ esc_html($items['secondary_button']['title']) }}
                        </a>
                    @endif
                </div>
            </div>
        </div>
    </section>
