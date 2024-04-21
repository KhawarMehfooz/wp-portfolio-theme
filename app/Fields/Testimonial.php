<?php

namespace App\Fields;

use Log1x\AcfComposer\Builder;
use Log1x\AcfComposer\Field;

class Testimonial extends Field
{
    /**
     * The field group.
     */
    public function fields(): array
    {
        $testimonial = Builder::make('testimonial');

        $testimonial
            ->setLocation('post_type', '==', 'testimonial');

        $testimonial
            ->addTextarea('testimonial_text',[
                'label'=>__('Testimonail Text', 'khawar'),
                'required'=> 1,
                'wrapper' => [
                    'width' => '100%',
                    'class' => '',
                    'id' => '',
                ],
            ])
            ->addImage('testimonial_author_image',[
                'label'=> __('Author Image','khawar'),
                'return_format'=>'url',
                'required'=> 1,
            ])
            ->addText('testimonial_author_name',[
                'label'=> __('Author Name','khawar'),
                'required'=> 1,
            ])
            ->addText('testimonial_author_location',[
                'label'=> __('Author Location','khawar'),
                'required'=> 1,
            ]);

        return $testimonial->build();
    }
}
