<div class="text-sm text-muted-foreground space-x-2 mb-6">
  <time datetime="{{ get_post_time('c', true) }}" class="dt-published">
    {{ get_the_date() }}
  </time>
  <span>•</span>
  <span>
    By
    <a href="{{ get_author_posts_url(get_the_author_meta('ID')) }}" class="p-author h-card hover:text-primary transition-colors">
      {{ get_the_author() }}
    </a>
  </span>
</div>
