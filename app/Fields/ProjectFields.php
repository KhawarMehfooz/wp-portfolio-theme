<?php

namespace App\Fields;

use Log1x\AcfComposer\Builder;
use Log1x\AcfComposer\Field;

class ProjectFields extends Field
{
    /**
     * The field group.
     */
    public function fields(): array
    {
        $fields = Builder::make('project_fields');

        $fields
            ->setLocation('post_type', '==', 'project');

        $fields
            ->addDatePicker('project_date')
            ->addRelationship('project_feedback',[
                'post_type'=> 'feedback',
                'min'=> 1,
                'max'=> 1,
                'return_format' => 'object',
            ]);

        return $fields->build();
    }
}
