<section class="{{ $block->classes }}" style="{{ $block->inlineStyle }}" >
<div class="flex mt-0 pb-4 lg:my-8 px-4 md:px-2">
    <div class="relative z-10 w-full md:w-2/3 mt-4 lg:mt-16">
      @if($hero_title)
      <h1
        class="text-3xl lg:text-4xl lg:leading-relaxed font-semibold leading-snug text-gray-900"
      >
        {{$hero_title}}
      </h1>
      @endif
      @if($hero_description)
      <p class="text-base mt-4 text-slate-700 leading-relaxed">
        {{ $hero_description }}
      </p>
      @endif
      @if($social_links)
      <div class="flex items-center justify-start mt-8">
        @foreach ($social_links as $social_link)
          <a
            class="block mr-8 md:mr-12 fill-current text-gray-900 hover:text-slate-500 transform hover:-translate-y-1 transition-all duration-200"
            href="{{ $social_link['social_link_url'] }}"
            target="_blank"
            rel="noreferrer"
          >
            <img
              class="w-10 h-10"
              src="{{ $social_link['social_logo'] }}"
              loading="lazy"
              alt="{{ $social_link['social_logo_alt_text'] }}"
            />
          </a>
        @endforeach

      </div>
      @endif
    </div>
    @if($skills_logo)
    <div class="skills__container hidden md:block relative ml-8 w-1/3">
    @foreach($skills_logo as $skills_logo)
    <div class="skills__container-card ">
        <div>
          <img
            class="relative z-10 w-24 h-24 animate-soft alt-1"
            src="{{$skills_logo['skill_logo']}}"
            alt="{{$skills_logo['skill_logo_alt_text']}}"
            loading="lazy"
          />
          <div
            class="absolute -z-10 left-2 -bottom-12 w-16 h-16 rounded-full bg-slate-900 opacity-10 animate-soft-shadow"
          ></div>
        </div>
      </div>
      @endforeach
    </div>
    @endif
  </div>
</section>
