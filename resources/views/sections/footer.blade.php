<footer class="relative px-3 border-t border-border/50">
    <div class="container mx-auto px-6 py-10 border-l border-r border-border/50 grid-background-7">
        <div class="flex flex-col items-center text-center space-y-8">
            <div>
                <a href="{{ home_url('/') }}"
                    class="khwr-no-underline font-display text-2xl font-bold tracking-tight hover:text-primary transition-colors inline-block mb-3">
                    {{ $siteName }}
                </a>
                <p class="text-sm text-muted-foreground max-w-md mx-auto">
                    {{ the_field('footer_tagline', 'option') }}
                </p>
            </div>

            @if (has_nav_menu('primary_navigation'))
                <nav class="w-full" aria-label="{{ wp_get_nav_menu_name('primary_navigation') }}">
                    {!! wp_nav_menu([
                        'theme_location' => 'primary_navigation',
                        'container' => false,
                        'menu_class' => 'flex flex-col md:flex-row md:justify-center gap-2 md:gap-4', // flex + responsive gap
                        'echo' => false,
                        'walker' => new class extends \Walker_Nav_Menu {
                            function start_el(&$output, $item, $depth = 0, $args = null, $id = 0)
                            {
                                $is_current =
                                    in_array('current-menu-item', $item->classes) || in_array('current_page_item', $item->classes);
                    
                                $classes = $is_current
                                    ? 'text-primary font-medium underline underline-offset-4 decoration-2'
                                    : 'text-muted-foreground hover:text-primary hover:underline underline-offset-4 font-medium transition-colors';
                    
                                $output .= sprintf(
                                    '<li><a href="%s" class="khwr-no-underline text-sm %s">%s</a></li>',
                                    esc_url($item->url),
                                    esc_attr($classes),
                                    esc_html($item->title),
                                );
                            }
                        },
                    ]) !!}
                </nav>
            @endif


            @php
                $social_links = get_field('footer_social_links', 'option');
            @endphp

            <div class="flex items-center gap-6">
                @foreach ($social_links as $social)
                    @php
                        $icon_url = $social['social_icon']['url'] ?? '';
                        $is_svg = $icon_url && str_ends_with($icon_url, '.svg');
                    @endphp

                    <a href="{{ $social['social_link'] }}" target="_blank" rel="noopener noreferrer"
                        aria-label="{{ $social['social_label'] }}"
                        class="text-muted-foreground hover:text-primary transition-all hover:scale-110 h-5 w-5 flex items-center justify-center">

                        @if ($is_svg)
                            {{-- Inline SVG so Tailwind text colors apply --}}
                            <span class="">
                                {!! file_get_contents($icon_url) !!}
                            </span>
                        @else
                            {{-- Fallback for PNG/JPG icons --}}
                            <img src="{{ $icon_url }}" alt="{{ $social['social_label'] }}" class="h-5 w-5" />
                        @endif
                    </a>
                @endforeach
            </div>

        </div>


    </div>
    <div
        class="container border-l border-r border-b border-t border-border/50 py-8 px-6 flex flex-col md:flex-row justify-between items-center gap-4 md:gap-0">
        <p class="text-xs text-muted-foreground order-1 md:order-1">
            © {{ date('Y') }} All rights reserved.
        </p>

        <p class="text-xs text-muted-foreground text-center order-2 md:order-2">
            Made with ❤️ in Azad Kashmir, Pakistan
        </p>

        <button onclick="window.scrollTo({ top: 0, behavior: 'smooth' })"
            class="group flex items-center gap-2 text-xs text-muted-foreground hover:text-primary cursor-pointer transition-colors order-3 md:order-3"
            aria-label="Scroll to top">
            <span>Back to top</span>
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                class="lucide lucide-arrow-up h-4 w-4 group-hover:-translate-y-1 transition-transform">
                <path d="m5 12 7-7 7 7"></path>
                <path d="M12 19V5"></path>
            </svg>
        </button>
    </div>

</footer>
