<article @php(post_class('h-entry'))>
  <header class="mb-6">
    <h1 class="p-name font-display text-3xl md:text-4xl font-bold mb-4">{!! $title !!}</h1>
  </header>

  @if (has_excerpt())
    <p class="text-xl text-muted-foreground leading-relaxed mb-12">
      {{ get_the_excerpt() }}
    </p>
  @endif

  <div class="e-content prose max-w-none mb-12">
    @php(the_content())
  </div>

  @if ($pagination())
    <footer>
      <nav class="page-nav" aria-label="Page">
        {!! $pagination !!}
      </nav>
    </footer>
  @endif
</article>
