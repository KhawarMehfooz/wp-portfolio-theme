@unless ($block->preview)
  <section {{ $attributes->merge(['class' => 'relative px-6 overflow-hidden border-b border-border/50']) }}>
  @else
    <section class="relative px-6 overflow-hidden border-b">
@endunless

    <div class="container mx-auto py-30 relative z-10 border-l border-r border-border/50 grid-background-7 ">
      <div class="max-w-3xl mx-auto animate-fade-in-up text-center">
        <h1 class="font-display text-3xl md:text-4xl lg:text-6xl text-center font-bold mb-6 tracking-tight">
          {{ $items['hero_heading'] }}
        </h1>

        <p class="text-md lg:text-xl text-muted-foreground mb-8 leading-relaxed text-center">
          {{ $items['hero_detail'] }}
        </p>

        <div class="flex gap-4 items-center justify-center">
          @if (!empty($items['primary_button']['url']))
        <a href="{{ esc_url($items['primary_button']['url']) }}"
        class="inline-flex items-center px-6 py-2 bg-primary text-white  font-medium hover:bg-background hover:text-primary border-1 border-transparent hover-border-dashed-subtle transition-all duration-300">
        {{ esc_html($items['primary_button']['title']) }}
        <svg xmlns="http://www.w3.org/2000/svg" class="ml-2 w-4 h-4" fill="none" viewBox="0 0 24 24"
          stroke="currentColor">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3" />
        </svg>
        </a>
      @endif

          @if (!empty($items['secondary_button']['url']))
        <a href="{{ esc_url($items['secondary_button']['url']) }}"
        class="inline-flex items-center px-6 py-2 border bg-background border-dashed border-primary text-primary  font-medium hover:bg-primary/10 transition-all duration-300">
        {{ esc_html($items['secondary_button']['title']) }}
        </a>
      @endif
        </div>
      </div>
    </div>
  </section>