@unless ($block->preview)
  <section {{ $attributes->merge(['class' => 'px-6 border-b border-border/50']) }}>
  @else
    <section class="px-6 border border-b border-border/50">
@endunless

    @if (!empty($stats))
      <div class="container mx-auto py-16 border-l border-r border-border/50 ">
        @php
        $cols = min(count($stats), 4);
        $gridClass = match ($cols) {
        1 => 'md:grid-cols-1',
        2 => 'md:grid-cols-2',
        3 => 'md:grid-cols-3',
        default => 'md:grid-cols-4',
        };
    @endphp
        <div class="grid mx-auto grid-cols-2 {{ $gridClass }} gap-8">
        @foreach($stats as $index => $stat)
      <div class="text-center animate-fade-in" style="animation-delay: {{ $index * 100 }}ms;">
        <img class="w-8 h-8 mx-auto mb-3" src="{{ esc_url($stat['stat_icon']['url']) }}" alt="">
        <div class="font-display text-3xl font-bold mb-1">{{ $stat['stat_value'] }}</div>
        <div class="text-sm text-muted-foreground">{{ $stat['stat_name'] }}</div>
      </div>
    @endforeach
        </div>
      </div>
  @else
  <p>{{ $block->preview ? 'Add an item…' : 'No items found!' }}</p>
@endif

    @unless ($block->preview)
      </section>
    @endunless