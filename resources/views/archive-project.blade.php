@extends('layouts.app')

@section('content')
    <div class="container p-2">
        <h1
        class="text-3xl lg:text-4xl lg:leading-relaxed font-semibold leading-snug text-gray-900"
      >
        Projects
      </h1>
        @if(have_posts())
            <div>
                <div class="grid gap-4 md:grid-cols-2 lg:grid-cols-3 mt-4">
                @while(have_posts()) @php(the_post())
                        <article class="border rounded border-gray-800 h-fit">
                            <a href="{{get_the_permalink()}}">
                                <div class="relative border-b border-gray-800">
                                    <div class="">
                                        <img 
                                        src="{{get_the_post_thumbnail_url(get_the_ID())}}" 
                                        alt="" 
                                        loading="lazy"
                                        class="rounded-t w-[100%] bg-cover object-cover aspect-square">
                                    </div>
                                </div>
                            </a>
                            <header class="px-4 py-2 border-b border-gray-800">
                                <h3 class="text-xl font-medium">
                                    {{get_the_title()}}
                                </h3>
                            </header>
                            <footer class="flex">
                                <div class="w-full flex items-center flex-wrap p-1 gap-1 md:p-2 md:gap-2">
                                    @foreach(get_the_terms(get_the_ID(),'project_tag') as $tag)
                                        <span id="{{$tag->slug}}" class="tag tag__{{$tag->slug}}">
                                            {{$tag->name}}
                                        </span>
                                    @endforeach
                                </div>
                            </footer>
                        </article>
                        @endwhile
                    </div>
            </div>
            {!! get_the_posts_navigation() !!}
        @else
            <p>No projects found</p>
        @endif
    </div>
@endsection
