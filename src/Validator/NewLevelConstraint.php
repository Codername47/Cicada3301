<?php

namespace App\Validator;

use Symfony\Component\Validator\Constraint;

#[\Attribute]
class NewLevelConstraint extends Constraint
{
    public $message = 'You can\'t add/remove "{{ json }}" level.';
    public function getTargets()
    {
        return self::CLASS_CONSTRAINT;
    }
}
