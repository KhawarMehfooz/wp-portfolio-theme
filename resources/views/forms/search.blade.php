<form role="search" method="get" class="search-form my-6 w-xl mx-auto" action="{{ home_url('/') }}">
    <fieldset class="flex items-center justify-center gap-4">
        <label>
            <span class="sr-only">{{ _x('Search for:', 'label', 'sage') }}</span>
            <input 
              type="search" 
              placeholder="{!! esc_attr_x('Search &hellip;', 'placeholder', 'sage') !!}" 
              value="{{ get_search_query() }}" 
              name="s"
              class="font-display flex w-full border bg-background px-3 py-2 text-2xl text-foreground placeholder:text-muted-foreground border-dashed border-primary focus:outline-none disabled:cursor-not-allowed disabled:opacity-50">
        </label>
        <button
          class="font-display text-2xl resize-none inline-flex items-center justify-center gap-2 whitespace-nowrap font-medium ring-offset-background transition-colors focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:pointer-events-none disabled:opacity-50 cursor-pointer bg-primary text-primary-foreground hover:bg-primary/90 px-4 py-2">
          {{ _x('Search', 'submit button', 'sage') }}
        </button>
    </fieldset>
</form>
