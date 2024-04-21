<footer class="w-full mt-8 md:mt-16 pt-4 px-4 md:px-0 border-t-2 border-gray-800">
    <div
      class="flex flex-col md:flex-row items-center justify-between leading-relaxed"
    >
      <div class="w-full md:w-1/2 text-center md:text-left">
        @if(get_field('portfolio_copyright','option'))
          <p class="font-semibold">{{get_field('portfolio_copyright','option')}}</p>
        @endif
        <p class="text-slate-700">
          Developed with &#x2764;&#xfe0f; in Beautiful Azad Kashmir
        </p>
      </div>
      <div class="w-full md:w-1/2 text-center md:text-right mt-4 md:mt-0">
        <p class="font-semibold">{{__('Get in touch','pfc')}}</p>
        @if(get_field('portfolio_social_link','option'))
        <p class="text-slate-700">
          @foreach(get_field('portfolio_social_link','option') as $social_link)
            <a
              href="{{$social_link['portfolio_social_link_url']}}"
              target="_blank"
              rel="noopener"
              class="hover:underline text-slate-700 hover:text-gray-900"
              >
              {{$social_link['portfolio_social_link_name']}}
              </a
            >
            <span class="social-link-separater text-slate-300">&nbsp;—&nbsp;</span>
          @endforeach
        </p>
        @endif
      </div>
    </div>
  </footer>