@extends('layouts.app')

@section('content')
  <div class="">
    <img class="block h-96 w-full object-cover aspect-video mb-4" src="{{get_the_post_thumbnail_url(get_the_ID())}}" alt="">
  </div>
  <h1 class="text-3xl lg:text-4xl lg:leading-relaxed font-semibold leading-snug text-gray-900">{{get_the_title(get_the_ID())}}</h1>
  <hr class="mb-4">
  {{the_content()}}
@endsection