@props([
    'href' => '/',
    'label' => 'Back',
])

<a href="{{ $href }}"
    {{ $attributes->merge(['class' => 'inline-flex items-center gap-2 text-sm text-muted-foreground hover:text-primary transition-colors mb-8 khwr-no-underline']) }}>
    <x-lucide-arrow-left class="w-4 h-4" />
    {{ $label }}
</a>
