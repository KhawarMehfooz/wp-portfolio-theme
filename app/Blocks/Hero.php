<?php

namespace App\Blocks;

use Log1x\AcfComposer\Block;
use Log1x\AcfComposer\Builder;

class Hero extends Block
{
    /**
     * The block name.
     *
     * @var string
     */
    public $name = 'Hero';

    /**
     * The block description.
     *
     * @var string
     */
    public $description = 'Hero block for portfolio';

    /**
     * The block category.
     *
     * @var string
     */
    public $category = 'widgets';

    /**
     * The block icon.
     *
     * @var string|array
     */
    public $icon = 'cover-image';

    /**
     * The block keywords.
     *
     * @var array
     */
    public $keywords = [];

    /**
     * The block post type allow list.
     *
     * @var array
     */
    public $post_types = [];

    /**
     * The parent block type allow list.
     *
     * @var array
     */
    public $parent = [];

    /**
     * The ancestor block type allow list.
     *
     * @var array
     */
    public $ancestor = [];

    /**
     * The default block mode.
     *
     * @var string
     */
    public $mode = 'edit';

    /**
     * The default block alignment.
     *
     * @var string
     */
    public $align = '';

    /**
     * The default block text alignment.
     *
     * @var string
     */
    public $align_text = '';

    /**
     * The default block content alignment.
     *
     * @var string
     */
    public $align_content = '';

    /**
     * The supported block features.
     *
     * @var array
     */
    public $supports = [
        'align' => true,
        'align_text' => false,
        'align_content' => false,
        'full_height' => false,
        'anchor' => false,
        'mode' => true,
        'multiple' => true,
        'jsx' => true,
        'color' => [
            'background' => true,
            'text' => true,
            'gradient' => true,
        ],
    ];

    /**
     * The block styles.
     *
     * @var array
     */
    public $styles = ['light', 'dark'];

    /**
     * The block preview example data.
     *
     * @var array
     */
    public $example = [
        'items' => [
            ['item' => 'Item one'],
            ['item' => 'Item two'],
            ['item' => 'Item three'],
        ],
        'hero_title'=>'Web developer with a love for Laravel, Vue, and WordPress',
        'hero_description'=>"Hey everyone, Khawar here! I'm web developer passionate about Laravel, Vue.js, and WordPress. I specialize in creating dynamic websites and web applications using PHP and WordPress. Explore my projects below!"
    ];

    /**
     * The block template.
     *
     * @var array
     */
    public $template = [
        'blocks/hero'
    ];

    /**
     * Data to be passed to the block before rendering.
     */
    public function with(): array
    {
        return [
            'items' => $this->items(),
            'hero_title'=> $this->hero_title(),
            'hero_description'=> $this->hero_description(),
            'skills_logo'=> $this->skills_logo(),
            'social_links'=> $this->social_links(),
        ];
    }

    /**
     * The block field group.
     */
    public function fields(): array
    {
        $hero = Builder::make('hero');

        $hero
            ->addText('hero_title', [
                'label' => __('Title', 'pfc'),
                'required'=>1
            ])
            ->addText('hero_description',[
                'label'=> __('Description','pfc'),
                'required'=> 1
            ])
            ->addRepeater('skills_logo',[
                'label'=>__('Skills Logo','pfc'),
                'min'=> 1,
                'max'=> 3,
                'required'=> 1
            ])
                ->addImage('skill_logo',[
                    'label'=> __('Logo','pfc'),
                    'required'=>1,
                    'return_format'=>'url'
                ])
                ->addText('skill_logo_alt_text',[
                    'label'=> __('Alt Text','pfc'),
                    'required'=> 1
                ])
            ->endRepeater()
            ->addRepeater('social_links',[
                'label'=>__('Social Links','pfc'),
                'min'=>1,
                'max'=> 5,
            ])
                ->addImage('social_logo',[
                    'label'=> __('Logo','pfc'),
                    'return_format'=>'url',
                    'required'=>1,
                ])
                ->addText('social_logo_alt_text',[
                    'label'=> __('Alt Text','pfc'),
                    'required'=>1
                ])
                ->addUrl('social_link_url',[
                    'label'=> __('URL','pfc'),
                    'required'=> 1
                ])
            ->endRepeater();

        return $hero->build();
    }

    /**
     * Retrieve the items.
     *
     * @return array
     */
    public function items()
    {
        return get_field('items') ?: $this->example['items'];
    }
    public function hero_title(){
        return get_field('hero_title');
    }
    public function hero_description(){
        return get_field('hero_description');
    }
    public function skills_logo(){
        return get_field('skills_logo');
    }
    public function social_links(){
        return get_field('social_links');
    }

    /**
     * Assets enqueued when rendering the block.
     */
    public function assets(array $block): void
    {
        //
    }
}
