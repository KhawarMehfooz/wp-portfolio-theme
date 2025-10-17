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
            ->addDatePicker('project_date');

        return $fields->build();
    }
}
