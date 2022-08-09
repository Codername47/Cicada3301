<?php

namespace App\Validator;

use App\Entity\AchievedFlag;
use App\Entity\AchievedLevel;
use App\Entity\Level;
use App\Entity\LevelFlag;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Security\Core\Security;
use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;
use Symfony\Component\Validator\Exception\UnexpectedTypeException;
use Symfony\Component\Validator\Exception\UnexpectedValueException;

class NewFlagConstraintValidator extends ConstraintValidator
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
        if (!$constraint instanceof NewFlagConstraint) {
            throw new UnexpectedTypeException($constraint, NewFlagConstraint::class);
        }

        // custom constraints should ignore null and empty values to allow
        // other constraints (NotBlank, NotNull, etc.) to take care of that


        if (!$value instanceof AchievedFlag || !$value->getLevelFlag() instanceof LevelFlag) {

            // throw this exception if your validator cannot handle the passed type so that it can be marked as invalid
            throw new UnexpectedValueException($value, 'AchievedLevelFlag');

            // separate multiple types using pipes
            // throw new UnexpectedValueException($value, 'string|int');
        }

        if (null == $value->getLevelFlag() || '' == $value->getLevelFlag() || false == $value->getLevelFlag()) {
            return;
        }

        // access your configuration options like this:


        $allUserLevels = $value->getUser()->getAchievedLevels();

        foreach ($allUserLevels as $level)
        {
            if ($level->getLevel()->getId() == $value->getLevelFlag()->getLevel()->getId()) {
                return;
            }
        }
        $this->context->buildViolation($constraint->message)
            ->setParameter('{{ flag }}', $value->getLevelFlag()->getName())
            ->addViolation();



    }

}