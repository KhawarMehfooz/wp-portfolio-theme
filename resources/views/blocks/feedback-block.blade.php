@php
  $title = get_field('feedback_section_title');
  $description = get_field('feedback_section_description');
  $feedbacks = get_field('feedbacks');

  $post_type = 'feedback';

@endphp

@unless ($block->preview)
  <section {{ $attributes->merge(['id' => 'posts-block', 'class' => 'px-3 border-b border-border/50']) }}>
@else
    <section class="px-3 border border-b">
  @endunless

    <div class="container mx-auto border-l border-r border-border/50 py-10 px-3 md:px-6">

      {{-- Section Header --}}
      @if ($title || $description)
        <header class="max-w-2xl mb-6">
          @if ($title)
            <h2 class="font-display text-2xl sm:text-3xl lg:text-4xl font-bold mb-4">{{ $title }}</h2>
          @endif
          @if ($description)
            <p class="text-muted-foreground text-base md:text-lg leading-relaxed">{{ $description }}</p>
          @endif
        </header>
      @endif

      <!-- Feedbacks -->

      @if ($feedbacks)
        <div class="columns-1 sm:columns-2 lg:columns-3 gap-6">
          @foreach ($feedbacks as $feedback)
            <div class="mb-6 break-inside-avoid">
              <x-feedback-card :feedback="$feedback" />
            </div>
          @endforeach
        </div>
      @endif

      {{-- View All Link --}}
      @if ($post_type)
        <footer>
          <a href="{{ get_post_type_archive_link($post_type) }}"
            class="khwr-no-underline inline-flex items-center gap-2 text-sm font-medium text-primary hover:underline">
            View All {{ ucfirst($post_type) }}s
            <x-icons.arrow-right class="w-4 h-4 group-hover:translate-x-1 transition-transform" />
          </a>
        </footer>
      @endif


    </div>

    @unless ($block->preview)
      </section>
    @endunless