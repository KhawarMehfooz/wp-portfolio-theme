<x-default-card :title="get_the_title()" :permalink="get_permalink()" :excerpt="has_excerpt()
  ? wp_trim_words(get_the_excerpt(), 30, '...')
  : wp_trim_words(strip_tags(get_the_content()), 30, '...')" />



