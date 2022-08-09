<?php

namespace App\Validator;

use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Security;
use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;
use Symfony\Component\Validator\Exception\UnexpectedTypeException;
use Symfony\Component\Validator\Exception\UnexpectedValueException;

class RoleConstraintValidator extends ConstraintValidator
{
    protected EntityManagerInterface $em;
    protected Security $security;
    public function __construct(EntityManagerInterface $em, Security $security)
    {
        $this->security = $security;
        $this->em = $em;

    }

    public function validate(mixed $value, Constraint $constraint)
    {
        if (!$constraint instanceof RoleConstraint) {
            throw new UnexpectedTypeException($constraint, RoleConstraint::class);
        }

        // custom constraints should ignore null and empty values to allow
        // other constraints (NotBlank, NotNull, etc.) to take care of that
        if (null === $value || '' === $value) {
            return;
        }


        if (!is_countable($value)) {

            // throw this exception if your validator cannot handle the passed type so that it can be marked as invalid
            throw new UnexpectedValueException($value, 'ArrayCollection');

            // separate multiple types using pipes
            // throw new UnexpectedValueException($value, 'string|int');
        }

        // access your configuration options like this:




        $censoredRoles = ['ROLE_USER', 'ROLE_ADMIN'];

        foreach ($value as $role)
        {
            if (!in_array($role, $censoredRoles))
            {
                $this->context->buildViolation($constraint->message)
                    ->setParameter('{{ string }}', implode($value))
                    ->addViolation();
                break;
            }
        }


    }
}