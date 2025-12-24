<?php

namespace App\Fields;

use Log1x\AcfComposer\Builder;
use Log1x\AcfComposer\Field;

class FeedbackFields extends Field
{
    /**
     * The field group.
     */
    public function fields(): array
    {
        $fields = Builder::make('feedback_fields');

        $fields
            ->setLocation('post_type', '==', 'feedback');

        $fields
            ->addText('t_author_name', [
                'label' => 'Author Name',
                'required'=> 1,
                'wrapper' => [
                    'width' => '50%',
                ]
            ])
            ->addText('t_author_country', [
                'label' => 'Author Country',
                'required'=> 1,
                'wrapper' => [
                    'width' => '50%',
                ]
            ])
            ->addTextarea('t_author_testimonial', [
                'label' => 'Testimonial',
                'required'=> 1,
            ]);

        return $fields->build();
    }
}
