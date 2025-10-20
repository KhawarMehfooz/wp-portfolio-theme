<?php

namespace App\Fields;

use Log1x\AcfComposer\Builder;
use Log1x\AcfComposer\Field;

class ServiceFields extends Field
{
    /**
     * The field group.
     */
    public function fields(): array
    {
        $fields = Builder::make('service_fields');

        $fields
            ->setLocation('post_type', '==', 'service');

        $fields
            ->addImage('service_icon',[
                'required'=>true
            ])
            ->addRelationship('related_projects',[
                'post_type'=>['project'],
                'max'=>4
            ]);

        return $fields->build();
    }
}
