<?php

namespace App\Services;

use Symfony\Component\Form\Form;
use Symfony\Component\Form\FormError;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\HttpFoundation\Request;

class FormErrorHandler
{
    public function __construct()
    {
    }

    public function loadErrorsOnSession(array $errors, Request $request){
        foreach ($errors as $key => $error){
            $request->getSession()->set($key,$error);
        }
    }

    public function setErrorMessages(Form &$form, $errors) {
        foreach ($form->all() as &$child) {
            $name = $child->getName();
            if(isset($errors[$name]))
                $child->addError($errors[$name]);
        }
    }

    public function getErrorMessages(FormInterface $form) {

        $errors = null;

        foreach ($form->all() as $child) {
            foreach ($child->getErrors() as $error) {
                $name = $child->getName();
                $errors[$name] = $error->getMessage();
            }
        }

        return $errors;
    }

    public function appendErrorMessages(FormInterface &$form, Request &$request): bool
    {
        $errorForm = $request->getSession()->get($form->getName());
        $flagResetSession = false;
        if(isset($errorForm)) {
            $form->addError(new FormError($errorForm));
            $request->getSession()->remove($errorForm);
            $flagResetSession = true;
        }
        foreach ($form->all() as &$child)
        {
            $error = $request->getSession()->get($child->getName());
            if(isset($error)) {
                $child->addError(new FormError($error));
                $request->getSession()->remove($error);
                $flagResetSession = true;
            }
        }
        return $flagResetSession;
    }
}