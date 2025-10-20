<?php

namespace App\Blocks;

use Log1x\AcfComposer\Block;
use Log1x\AcfComposer\Builder;

class HeroBlock extends Block
{
    /**
     * The block name.
     *
     * @var string
     */
    public $name = 'Hero Block';

    /**
     * The block description.
     *
     * @var string
     */
    public $description = 'Block for hero section.';

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
     * The block preview example data.
     *
     * @var array
     */
    public $example = [
        'hero_heading' => 'Full Stack Web Developer',
        'hero_detail' => 'Full stack web developer experienced in building dynamic websites and content management systems.',
        'services_cta' => 'https://khawarmehfooz.com/services',
        'contact_cta' => 'https://khawarmehfooz.com/contact-me'
    ];

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
        $fields = Builder::make('hero_block');


        $fields
            ->addImage('hero_image', [
                'return_format' => 'url',
            ])
            ->addText('hero_heading')
            ->addText('hero_detail')
            ->addLink('primary_button', [
                'wrapper' => [
                    'width' => '50%'
                ],
            ])
            ->addImage('primary_button_icon', [
                'wrapper' => [
                    'width' => '50%'
                ]
            ])
            ->addLink('secondary_button', [
                'wrapper' => [
                    'width' => '50%'
                ],
            ])
            ->addImage('secondary_button_icon', [
                'wrapper' => [
                    'width' => '50%'
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
            'hero_image' => get_field('hero_image'),
            'hero_heading' => get_field('hero_heading'),
            'hero_detail' => get_field('hero_detail'),
            'primary_button' => get_field('primary_button'),
            'primary_button_icon' => get_field('primary_button_icon'),
            'secondary_button' => get_field('secondary_button'),
            'secondary_button_icon' => get_field('secondary_button_icon'),
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
