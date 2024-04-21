<section class="{{ $block->classes }}" style="{{ $block->inlineStyle }}">
<div class="pt-4 pb-8 lg:pb-16 border-y-2 border-gray-800">
    <div id="projects" class="px-4 md:px-2">
      @if($project_section_title)
      <h2
        class="text-2xl lg:text-3xl lg:leading-relaxed font-semibold leading-snug text-gray-900"
      >
        {{$project_section_title}}
      </h2>
      @endif
      @if($projects)
      <div class="grid projects__grid mt-4">
        @foreach($projects as $project)
        
        <article
          key="{{$project->ID}}"
          class="border rounded border-gray-800 h-fit"
        >
          <a href="{{get_the_permalink($project->ID)}}">
            <div class="relative border-b border-gray-800">
              <div class="">
                <img
                  class="rounded-t w-[100%] bg-cover object-cover aspect-video"
                  src="{{get_the_post_thumbnail_url($project->ID)}}"
                  alt=""
                  loading="lazy"
                />
              </div>
            </div>
          </a>
          <header class="px-4 py-2 border-b border-gray-800">
            <h3 class="text-xl font-medium">{{$project->post_title}}</h3>
          </header>
          <footer class="flex">
            <div
              class="w-full flex items-center flex-wrap p-1 gap-1 md:p-2 md:gap-2"
            >
            @foreach(get_the_terms($project->ID,'project_tag') as $tag)
              <span
                id="{{$tag->slug}}"
                class="tag tag__{{$tag->slug}}"
                >
                {{$tag->name}}
                </span
              >
              @endforeach
            </div>
            <!-- <div class="p-2 w-[20%]">
              <a href="{{get_field('project_github_url',$project->ID)}}">
                <img class="w-[70%] mx-auto" src="/images/github.svg" alt="" />
              </a>
            </div> -->
          </footer>
        </article>
        @endforeach
      </div>
      @endif
    </div>
  </div>
  </section>
