<header class="banner border-b-2 border-gray-800">
  <div class="container mx-auto px-3 md:px-0 flex flex-wrap py-4 flex-col md:flex-row items-center">
    <a class="brand flex title-font font-semibold items-center text-gray-900 mb-4 md:mb-0 hover:opacity-75 transition-opacity duration-200" href="{{ home_url('/') }}">
    @if(!get_field('portfolio_logo', 'option'))
      {!! $siteName !!}
    @endif
    <img class="w-14 h-14 rounded-full" src="{{get_field('portfolio_logo', 'option')}}" alt="{!! $siteName !!}" loading="lazy"/>
    </a>
    @if (has_nav_menu('primary_navigation'))
      <nav class="nav-primary mx-auto md:ml-auto md:mr-0" aria-label="{{ wp_get_nav_menu_name('primary_navigation') }}">
        {!! wp_nav_menu(['theme_location' => 'primary_navigation', 'menu_class' => 'nav', 'echo' => false]) !!}
      </nav>
    @endif
  </div>
</header>