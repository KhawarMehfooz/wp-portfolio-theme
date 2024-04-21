<?php

namespace App\Options;

use Log1x\AcfComposer\Builder;
use Log1x\AcfComposer\Options as Field;

class PortfolioSettings extends Field
{
    /**
     * The option page menu name.
     *
     * @var string
     */
    public $name = 'Portfolio Settings';

    /**
     * The option page document title.
     *
     * @var string
     */
    public $title = 'Portfolio Settings | Options';

    /**
     * The option page field group.
     */

    public function fields(): array
    {
        $portfolioSettings = Builder::make('portfolio_settings');

        $portfolioSettings
            ->addImage('portfolio_logo',[
                'label'=> __('Logo','pfc'),
                'return_format'=>'url',
                'required'=> 1,
                'preview'=>'thumbnail'
            ])
            ->addText('portfolio_copyright',[
                'label'=> __('Copyright Text','pfc'),
                'required'=>1,
            ])
            ->addRepeater('portfolio_social_link',[
                'label'=> __('Footer Social Links','pfc'),
                'required'=> 1,
                'return_format'=>'object',
                'min'=>1,
                'button_label'=> 'Add Link',
            ])
                ->addText('portfolio_social_link_name',[
                    'label'=> __('Social Link Name','pfc'),
                    'required'=> 1,
                ])
                ->addUrl('portfolio_social_link_url',[
                    'label'=> __('URL','pfc'),
                    'required'=> 1,
                ])
            ->endRepeater();

        return $portfolioSettings->build();
    }
}
