<?php

namespace App\Blocks;

use Log1x\AcfComposer\Block;
use Log1x\AcfComposer\Builder;

class ContactFormBlock extends Block
{
    /**
     * The block name.
     *
     * @var string
     */
    public $name = 'Contact Form Block';

    /**
     * The block description.
     *
     * @var string
     */
    public $description = 'contact form block';

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
    public $post_types = ['page','service'];

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
        $fields = Builder::make('contact_form_block');


        $fields
            ->addTrueFalse('enable_header', [
                'label' => 'Enable Header',
                'instructions' => 'Checking this will enable header for contact form.',
                'ui' => 1,
            ])

            ->addText('contact_form_heading', [
                'label' => 'Heading',
                'conditional_logic' => [
                    [
                        [
                            'field' => 'enable_header',
                            'operator' => '==',
                            'value' => 1,
                        ],
                    ],
                ],
            ])
            ->addText('contact_form_description', [
                'label' => 'Description',
                'conditional_logic' => [
                    [
                        [
                            'field' => 'enable_header',
                            'operator' => '==',
                            'value' => 1,
                        ],
                    ],
                ],
            ])
            ->addTrueFalse('header_alignment', [
                'label' => 'Center Align?',
                'ui'=>1,
                'conditional_logic' => [
                    [
                        [
                            'field' => 'enable_header',
                            'operator' => '==',
                            'value' => 1,
                        ],
                    ],
                ],
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
            'enable_header' => get_field('enable_header'),
            'contact_form_heading' => get_field('contact_form_heading'),
            'contact_form_description' => get_field('contact_form_description'),
            'header_alignment' => get_field('header_alignment'),
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
