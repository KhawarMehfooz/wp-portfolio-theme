@props([
  'type' => null,
  'message' => null,
])

@php($class = match ($type) {
  'success' => 'text-green-50 bg-green-400',
  'caution' => 'text-yellow-50 bg-yellow-400',
  'warning' => 'text-red-50 bg-red-400',
  default => 'text-indigo-50 bg-indigo-400',
})

<div {{ $attributes->merge(['class' => "px-6 py-3 text-xl md:text-2xl font-display font-medium {$class} w-fit mx-auto"]) }}>
  {!! $message ?? $slot !!}
</div>
