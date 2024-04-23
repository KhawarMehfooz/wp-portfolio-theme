@extends('layouts.app')

@section('content')
    <div class="container p-2">
        <h1
        class="text-3xl lg:text-4xl lg:leading-relaxed font-semibold leading-snug text-gray-900"
      >
        Testimonials
      </h1>
      @if(have_posts())
      <div class="grid gap-4 sm:grid-cols-2 lg:grid-cols-3">
        @while(have_posts()) @php(the_post())
          <article
            class="w-full mx-auto rounded bg-white border border-gray-900 p-5 text-gray-800 font-light"
          >
            <div class="w-full flex items-center">
              <div
                class="overflow-hidden rounded-full w-10 h-10 bg-gray-50 border border-gray-200"
              >
                <img src="{{get_field('testimonial_author_image',get_the_ID())}}" alt="" />
              </div>
              <div class="flex-grow pl-3">
                <h6 class="font-bold text-sm uppercase text-gray-600">
                  {{get_field('testimonial_author_name',get_the_ID())}}
                </h6>
                <div class="flex items-center gap-2">
                  <span class="text-sm text-zinc-500">
                    {{get_field('testimonial_author_location',get_the_ID())}}
                  </span>
                </div>
              </div>
            </div>
            <div class="w-full mt-2">
              <p class="text-sm leading-tight">
                <span
                  class="text-lg leading-none italic font-bold text-gray-400 mr-1"
                  >"</span
                >
                  {{get_field('testimonial_text',get_the_ID())}}
                <span
                  class="text-lg leading-none italic font-bold text-gray-400 ml-1"
                  >"</span
                >
              </p>
            </div>
          </article>
        @endwhile

      </div>
      @else
        <p>No testimonials found...</p>
      @endif

    </div>
@endsection
