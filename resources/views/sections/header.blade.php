<header x-data="{ open: false }"
    class="fixed top-0 left-0 right-0 z-50 bg-background/80 backdrop-blur-sm border-b border-border/50 px-3">
    <div class="container mx-auto border-l border-r border-border/50 px-3 py-2">
        <div class="flex items-center justify-between">
            {{-- Brand / Site Name --}}
            <a href="{{ home_url('/') }}"
                class="font-display text-xl khwr-no-underline  font-bold tracking-tight hover:text-primary transition-colors">
                {{ $siteName }}
            </a>
            {{-- Mobile Navigation --}}
            <button @click="open = !open"
                class="md:hidden flex items-center justify-center w-10 h-10  border border-border hover:border-primary hover:text-primary transition-colors"
                aria-label="Toggle navigation">
                <svg x-show="!open" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                    stroke-width="2" stroke="currentColor" class="w-6 h-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h16M4 18h16" />
                </svg>
                <svg x-show="open" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                    stroke-width="2" stroke="currentColor" class="w-6 h-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
            {{-- Primary Navigation --}}
            @if (has_nav_menu('primary_navigation'))
                <nav class="hidden md:flex items-center gap-8"
                    aria-label="{{ wp_get_nav_menu_name('primary_navigation') }}">
                    {!! wp_nav_menu([
                        'theme_location' => 'primary_navigation',
                        'menu_class' => 'nav flex items-center gap-8',
                        'container' => false,
                        'echo' => false,
                        'walker' => new class extends \Walker_Nav_Menu {
                            function start_el(&$output, $item, $depth = 0, $args = null, $id = 0)
                            {
                                $is_current =
                                    in_array('current-menu-item', $item->classes) || in_array('current_page_item', $item->classes);
                                $classes = $is_current
                                    ? 'text-primary relative khwr-no-underline after:absolute after:bottom-[-4px] after:left-0 after:right-0 after:h-[2px] after:bg-primary'
                                    : 'text-muted-foreground';
                                $output .= sprintf(
                                    '<a href="%s" class="text-sm khwr-no-underline font-medium transition-colors hover:text-primary %s">%s</a>',
                                    esc_url($item->url),
                                    esc_attr($classes),
                                    esc_html($item->title),
                                );
                            }
                        },
                    ]) !!}
                </nav>
            @endif
        </div>
        {{-- Mobile Dropdown --}}
        <div x-show="open" x-transition
            class="md:hidden mt-4 flex flex-col gap-3 border-t border-border/50 py-4 border-b"
            aria-label="Mobile Navigation">
            {!! wp_nav_menu([
                'theme_location' => 'primary_navigation',
                'menu_class' => 'flex flex-col gap-3',
                'container' => false,
                'echo' => false,
                'walker' => new class extends \Walker_Nav_Menu {
                    function start_el(&$output, $item, $depth = 0, $args = null, $id = 0)
                    {
                        $is_current =
                            in_array('current-menu-item', $item->classes) || in_array('current_page_item', $item->classes);
                        $classes = $is_current ? 'text-primary font-medium' : 'text-muted-foreground';
                        $output .= sprintf(
                            '<a href="%s" class="block khwr-no-underline text-base transition-colors hover:text-primary %s">%s</a>',
                            esc_url($item->url),
                            esc_attr($classes),
                            esc_html($item->title),
                        );
                    }
                },
            ]) !!}
        </div>
    </div>

</header>
