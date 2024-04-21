<section class="{{ $block->classes }}" style="{{ $block->inlineStyle }}" >
<div class="pt-4">
    <div id="testimonials" class="px-4 md:px-2">
      @if($testimonial_section_title)
      <h2
        class="text-2xl lg:text-3xl lg:leading-relaxed font-semibold leading-snug text-gray-900"
      >
        {{$testimonial_section_title}}
      </h2>
      @endif
      @if($testimonials)
        <div class="grid sm:grid-cols-2 md:grid-cols-3 gap-4 mt-4">
          @if($first_column)
          <div class="grid gap-4">
            @foreach($first_column as $fc )
              <article
            class="w-full mx-auto rounded bg-white border border-gray-900 p-5 text-gray-800 font-light"
          >
            <div class="w-full flex items-center">
              <div
                class="overflow-hidden rounded-full w-10 h-10 bg-gray-50 border border-gray-200"
              >
                <img src="{{get_fields($fc)['testimonial_author_image']}}" alt="" />
              </div>
              <div class="flex-grow pl-3">
                <h6 class="font-bold text-sm uppercase text-gray-600">
                  {{get_fields($fc)['testimonial_author_name']}}
                </h6>
                <div class="flex items-center gap-2">
                  <span class="text-sm text-zinc-500">{{get_fields($fc)['testimonial_author_location']}}</span>
                </div>
              </div>
            </div>
            <div class="w-full">
              <p class="text-sm leading-tight">
                <span
                  class="text-lg leading-none italic font-bold text-gray-400 mr-1"
                  >"</span
                >
                {{get_fields($fc)['testimonial_text']}}
                <span
                  class="text-lg leading-none italic font-bold text-gray-400 ml-1"
                  >"</span
                >
              </p>
            </div>
          </article>
            @endforeach
          </div>
          @endif
          @if($second_column)
          <div class="grid gap-4">
            @foreach($second_column as $sc)
              <article
            class="w-full mx-auto rounded bg-white border border-gray-900 p-5 text-gray-800 font-light"
          >
            <div class="w-full flex items-center">
              <div
                class="overflow-hidden rounded-full w-10 h-10 bg-gray-50 border border-gray-200"
              >
                <img src="{{get_fields($sc)['testimonial_author_image']}}" alt="" />
              </div>
              <div class="flex-grow pl-3">
                <h6 class="font-bold text-sm uppercase text-gray-600">
                  {{get_fields($sc)['testimonial_author_name']}}
                </h6>
                <div class="flex items-center gap-2">
                  <span class="text-sm text-zinc-500">{{get_fields($sc)['testimonial_author_location']}}</span>
                </div>
              </div>
            </div>
            <div class="w-full">
              <p class="text-sm leading-tight">
                <span
                  class="text-lg leading-none italic font-bold text-gray-400 mr-1"
                  >"</span
                >
                {{get_fields($sc)['testimonial_text']}}
                <span
                  class="text-lg leading-none italic font-bold text-gray-400 ml-1"
                  >"</span
                >
              </p>
            </div>
          </article>
            @endforeach
          </div>
          @endif
          @if($third_column)
          <div class="grid gap-4">
            @foreach($third_column as $tc)
              <article
            class="w-full mx-auto rounded bg-white border border-gray-900 p-5 text-gray-800 font-light"
          >
            <div class="w-full flex items-center">
              <div
                class="overflow-hidden rounded-full w-10 h-10 bg-gray-50 border border-gray-200"
              >
                <img src="{{get_fields($tc)['testimonial_author_image']}}" alt="" />
              </div>
              <div class="flex-grow pl-3">
                <h6 class="font-bold text-sm uppercase text-gray-600">
                  {{get_fields($tc)['testimonial_author_name']}}
                </h6>
                <div class="flex items-center gap-2">
                  <span class="text-sm text-zinc-500">{{get_fields($tc)['testimonial_author_location']}}</span>
                </div>
              </div>
            </div>
            <div class="w-full">
              <p class="text-sm leading-tight">
                <span
                  class="text-lg leading-none italic font-bold text-gray-400 mr-1"
                  >"</span
                >
                {{get_fields($tc)['testimonial_text']}}
                <span
                  class="text-lg leading-none italic font-bold text-gray-400 ml-1"
                  >"</span
                >
              </p>
            </div>
          </article>
            @endforeach
          </div>
          @endif
        </div>
        @endif
      </div>
    </div>
  </section>
