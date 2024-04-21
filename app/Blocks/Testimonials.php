<?php

namespace App\Blocks;

use Log1x\AcfComposer\Block;
use Log1x\AcfComposer\Builder;

class Testimonials extends Block
{
    /**
     * The block name.
     *
     * @var string
     */
    public $name = 'Testimonials';

    /**
     * The block description.
     *
     * @var string
     */
    public $description = 'Block to display testimonials.';

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
    public $icon = 'testimonial';

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

    ];

    /**
     * The block template.
     *
     * @var array
     */
    public $template = [
        'blocks/testimonial',
    ];

    /**
     * Data to be passed to the block before rendering.
     */
    public function with(): array
    {
        return [
            'testimonial_section_title' => $this->testimonial_section_title(),
            'testimonials'=>$this->testimonials(),
            'first_column'=>$this->first_column(),
            'second_column'=>$this->second_column(),
            'third_column'=>$this->third_column(),
        ];
    }

    /**
     * The block field group.
     */
    public function fields(): array
    {
        $testimonials = Builder::make('testimonials');

        $testimonials
            ->addText('testimonial_section_title',[
            'label'=>__('Testimonial Title','pfc'),
            'value'=> __('Testimonials','pfc'),
           ])
            ->addRelationship('testimonials',[
                'label'=>__('Select Testimonials','pfc'),
                'post_type'=>['testimonial'],
                'required'=>1,
                'return_format'=>'object',
                'min'=>2
            ]);
        return $testimonials->build();
    }

    /**
     * Retrieve the section title.
     *
     * @return string
     */
    public function testimonial_section_title(){
        return get_field('testimonial_section_title');
    }
    /**
     * Retrieve the section testimonials.
     *
     * @return array
     */

    public function testimonials(){
        return get_field('testimonials');
    }
    /**
     * Retrieve the testimonials for first column
     *
     * @return array
     */
    public function first_column(){
        return array_filter($this->testimonials(),function($key){
            return $key % 3 === 0;
        },ARRAY_FILTER_USE_KEY);
    }

    /**
     * Retrieve the testimonials for second column
     *
     * @return array
     */

    public function second_column(){
        return array_filter($this->testimonials(),function($key){
            return $key %3 === 1;
        }, ARRAY_FILTER_USE_KEY);
    }

    /**
     * Retrieve the testimonials for third column
     *
     * @return array
     */
    public function third_column(){
        return array_filter($this->testimonials(),function($key){
            return $key %3=== 2;
        },ARRAY_FILTER_USE_KEY);
    }
    /**
     * Assets enqueued when rendering the block.
     */
    public function assets(array $block): void
    {
        //
    }
}
