@php
    $name   = get_the_author_meta('display_name', $author_id);
    $bio    = get_the_author_meta('description', $author_id);
    $avatar = get_avatar_url($author_id, ['size' => 200]);
@endphp

@if($name) {{-- render only if found --}}
<div class="border-dashed-subtle-default bg-card text-card-foreground mb-3 md:mb-6">
    <div class="flex flex-col space-y-1.5 p-6">
        <h3 class="font-semibold tracking-tight text-lg">About the Author</h3>
    </div>
    <div class="p-6 pt-0">
        <div class="flex flex-col items-center text-center space-y-4">

            @if($avatar)
                <img src="{{ $avatar }}" alt="{{ $name }}" class="w-20 h-20 rounded-full object-cover">
            @endif

            <div>
                <h3 class="font-semibold text-lg">{{ $name }}</h3>
            </div>

            @if($bio)
                <p class="text-sm text-muted-foreground">{{ $bio }}</p>
            @endif
        </div>
    </div>
</div>
@endif
