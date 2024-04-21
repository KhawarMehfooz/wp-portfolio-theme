<?php

namespace App\Blocks;

use Log1x\AcfComposer\Block;
use Log1x\AcfComposer\Builder;

class Projects extends Block
{
    /**
     * The block name.
     *
     * @var string
     */
    public $name = 'Projects';

    /**
     * The block description.
     *
     * @var string
     */
    public $description = 'Block to display the projects.';

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
    public $icon = 'welcome-widgets-menus';

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
        'blocks/projects'
    ];

    /**
     * Data to be passed to the block before rendering.
     */
    public function with(): array
    {
        return [
            'project_section_title' => $this->project_section_title(),
            'projects'=>$this->projects(),
        ];
    }

    /**
     * The block field group.
     */
    public function fields(): array
    {
        $projects = Builder::make('projects');

        $projects
            ->addText('project_section_title',[
            'label'=>__('Section Title','khawar'),
            'value'=> __('Projects','khawar'),
           ])
            ->addRelationship('projects',[
                'label'=>__('Select Projects','khawar'),
                'post_type'=>['project'],
                'required'=>1,
                'return_format'=>'object',
                'min'=>2
            ]);
        return $projects->build();
    }

    /**
     * Retrieve the section title.
     *
     * @return string
     */
    public function project_section_title(){
        return get_field('project_section_title');
    }

    /**
     * Retrieve the projects.
     *
     * @return array
     */
    public function projects(){
        return get_field('projects');
    }

    /**
     * Assets enqueued when rendering the block.
     */
    public function assets(array $block): void
    {
        //
    }
}
