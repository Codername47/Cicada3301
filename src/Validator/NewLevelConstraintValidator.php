<?php

namespace App\Validator;

use App\Entity\AchievedLevel;
use App\Entity\Level;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Security;
use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;
use Symfony\Component\Validator\Exception\UnexpectedTypeException;
use Symfony\Component\Validator\Exception\UnexpectedValueException;

class NewLevelConstraintValidator extends ConstraintValidator
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
        if (!$constraint instanceof NewLevelConstraint) {
            throw new UnexpectedTypeException($constraint, NewLevelConstraint::class);
        }

        // custom constraints should ignore null and empty values to allow
        // other constraints (NotBlank, NotNull, etc.) to take care of that


        if (!$value instanceof AchievedLevel || !$value->getLevel() instanceof Level) {

            // throw this exception if your validator cannot handle the passed type so that it can be marked as invalid
            throw new UnexpectedValueException($value, 'Level');

            // separate multiple types using pipes
            // throw new UnexpectedValueException($value, 'string|int');
        }

        if (null == $value->getLevel() || '' == $value->getLevel() || false == $value->getLevel()) {
            return;
        }

        // access your configuration options like this:


        $allUserLevels = $value->getUser()->getAchievedLevels();


        if ($value->getUser()->getAchievedLevels()->count() == 0)
            return;
        $debug = [];
        foreach ($allUserLevels as $level)
        {
            $debug[] = $level->getLevel()->getNextLevel()->getId();
            if ($level->getLevel()->getNextLevel()->getId() == $value->getLevel()->getId()) {
                return;
            }
        }
        $this->context->buildViolation($constraint->message)
            ->setParameter('{{ json }}', $value->getLevel()->getName())
            ->addViolation();


    }
}