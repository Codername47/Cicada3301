<?php

namespace App\Controller\Admin;

use App\Entity\ContentType;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\Field;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;

class ContentTypeCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return ContentType::class;
    }

    public function configureFields(string $pageName): iterable
    {
        yield IdField::new('id')
            ->hideOnForm();
        yield Field::new('name');
        yield Field::new('icon', 'icon URL');
        yield AssociationField::new('contents')->autocomplete()->hideOnForm();

    }
}
