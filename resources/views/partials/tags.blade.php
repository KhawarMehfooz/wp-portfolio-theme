@php
    $tags = get_the_terms(get_the_ID(), 'post_tag');
@endphp

@if($tags && !is_wp_error($tags))
<div class="mt-3 md:mt-6 border bg-card text-card-foreground border-dashed-subtle-default">
    <div class="flex flex-col space-y-1.5 p-6">
        <h3 class="font-semibold tracking-tight text-lg">Tags</h3>
    </div>
    <div class="p-6 pt-0">
        <div class="flex flex-wrap gap-2">
            @foreach ($tags as $tag)
                <a href="{{ get_tag_link($tag->term_id) }}"
                   class="inline-flex items-center px-2 py-1 text-xs bg-secondary text-foreground border-dashed-subtle-default">
                    {{ $tag->name }}
                </a>
            @endforeach
        </div>
    </div>
</div>
@endif
