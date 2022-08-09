<?php

namespace App\Validator;

use Symfony\Component\Validator\Constraint;

#[\Attribute]
class NewFlagConstraint extends Constraint
{
    public $message = 'You can\'t add "{{ flag }}", because user doesn\'t reached this level.';
    public function getTargets()
    {
        return self::CLASS_CONSTRAINT;
    }
}