<?php

namespace App\Validator;

use Symfony\Component\Validator\Constraint;

#[\Attribute]
class RoleConstraint extends Constraint
{
    public $message = 'The json "{{ json }}" contains an illegal role string.';
}