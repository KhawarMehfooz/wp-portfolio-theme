<?php

namespace App\Options;

use Log1x\AcfComposer\Builder;
use Log1x\AcfComposer\Options as Field;

class FooterOptions extends Field
{
    /**
     * The option page menu name.
     *
     * @var string
     */
    public $name = 'Footer Options';

    /**
     * The option page document title.
     *
     * @var string
     */
    public $title = 'Footer Options | Options';

    /**
     * The option page field group.
     */
    public function fields(): array
    {
        $fields = Builder::make('footer_options');

        $fields
            ->addText('footer_tagline')
            ->addRepeater('footer_social_links')
            ->addText('social_label', [
                'wrapper' => [
                    'width' => '33%'
                ]
            ])
            ->addImage('social_icon', [
                'wrapper' => [
                    'width' => '33%'
                ]
            ])
            ->addText('social_link', [
                'wrapper' => [
                    'width' => '33%'
                ]
            ])
            ->endRepeater();

        return $fields->build();
    }
}
