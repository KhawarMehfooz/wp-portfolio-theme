<?php

namespace App\Blocks;

use Log1x\AcfComposer\Block;
use Log1x\AcfComposer\Builder;

class PostsBlock extends Block
{
    /**
     * The block name.
     *
     * @var string
     */
    public $name = 'Posts Block';

    /**
     * The block description.
     *
     * @var string
     */
    public $description = 'A block to display posts in a grid';

    /**
     * The block category.
     *
     * @var string
     */
    public $category = 'reusable';

    /**
     * The block icon.
     *
     * @var string|array
     */
    public $icon = 'editor-ul';

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
    public $post_types = ['page'];

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
    public $mode = 'preview';

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
     * The default block spacing.
     *
     * @var array
     */
    public $spacing = [
        'padding' => null,
        'margin' => null,
    ];

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
            'background' => false,
            'text' => false,
            'gradients' => false,
        ],
        'spacing' => [
            'padding' => false,
            'margin' => false,
        ],
    ];

    /**
     * The block styles.
     *
     * @var array
     */
    public $styles = ['light', 'dark'];

    /**
     * Data to be passed to the block before rendering.
     */
    public function with(): array
    {
        return [
            'items' => $this->items(),
        ];
    }

    /**
     * The block field group.
     */
    public function fields(): array
    {
        $fields = Builder::make('posts_block');

        // Get all public post types 
        $post_types = get_post_types(['public' => true], 'objects');

        $choices = [];

        // Always include the default "post" type
        if (isset($post_types['post'])) {
            $choices['post'] = $post_types['post']->labels->singular_name;
        }

        // Loop through all post types and include only non-built-in custom ones
        foreach ($post_types as $slug => $type) {
            if ($slug !== 'post' && !in_array($slug, ['page', 'attachment', 'revision', 'nav_menu_item'])) {
                $choices[$slug] = $type->labels->singular_name;
            }
        }

        $fields
            ->addText('block_section_title', [
                'default_value' => "Services"
            ])
            ->addText('block_section_description')
            ->addSelect('block_post', [
                'label' => 'Select Post Type',
                'choices' => $choices,
                'ui' => 1,
                'wrapper' => [
                    'width' => '25%'
                ]
            ])
            ->addSelect('block_post_count', [
                'label' => 'Posts to Show?',
                'wrapper' => [
                    'width' => '25%'
                ],
                'choices' => [
                    '2' => '2',
                    '4' => '4',
                    '6' => '6',
                ],
                'ui' => 1,
            ])
            ->addSelect('block_post_order', [
                'label' => 'Post Order',
                'choices' => [
                    'asc' => 'ASC',
                    'desc' => 'DESC',
                ],
                'ui' => 1,
                'wrapper' => [
                    'width' => '25%'
                ]
            ])
            ->addSelect('block_post_grid_cols', [
                'label' => 'Posts Per Row?',
                'choices' => [
                    '2' => '2',
                    '3' => '3',
                ],
                'ui' => 1,
                'wrapper' => [
                    'width' => '25%'
                ]
            ]);

        return $fields->build();
    }

    /**
     * Retrieve the items.
     *
     * @return array
     */
    public function items()
    {
        return [
            'block_section_title' => get_field('block_section_title'),
            'block_section_description' => get_field('block_section_description'),
            'block_post' => get_field('block_post'),
            'block_post_count' => get_field('block_post_count'),
            'block_post_order' => get_field('block_post_order'),
            'block_post_grid_cols' => get_field('block_post_grid_cols'),
        ];
    }

    /**
     * Assets enqueued with 'enqueue_block_assets' when rendering the block.
     *
     * @link https://developer.wordpress.org/block-editor/how-to-guides/enqueueing-assets-in-the-editor/#editor-content-scripts-and-styles
     */
    public function assets(array $block): void
    {
        //
    }
}
