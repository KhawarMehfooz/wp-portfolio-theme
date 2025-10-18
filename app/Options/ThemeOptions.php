<?php

namespace App\Options;

use Log1x\AcfComposer\Builder;
use Log1x\AcfComposer\Options as Field;

class ThemeOptions extends Field
{
    /**
     * The option page menu name.
     *
     * @var string
     */
    public $name = 'Theme Options';

    /**
     * The option page document title.
     *
     * @var string
     */
    public $title = 'Theme Options | Options';

    /**
     * The option page field group.
     */
    public function fields(): array
    {
        $fields = Builder::make('theme_options');

        $fields
            ->addTab('project_archive_page_settings')
            ->addText('archive_description', [
                'default_value' => 'A collection of web development projects and case studies showcasing technical solutions, challenges overcome, and measurable results delivered for clients.'
            ])
            ->addTab('service_archive_page_settings')
            ->addText('service_archive_description', [
                'default_value' => 'Comprehensive web development services tailored to your needs. From initial concept to final deployment, I provide end-to-end solutions that deliver results.'
            ]);

        return $fields->build();
    }
}
