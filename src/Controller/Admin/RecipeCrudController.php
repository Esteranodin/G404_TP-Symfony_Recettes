<?php

namespace App\Controller\Admin;

use App\Entity\Recipe;
use Doctrine\DBAL\Types\DateImmutableType;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class RecipeCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Recipe::class;
    }

    
    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('name'),
            TextField::new('slug'),
            TextEditorField::new('description'),
            DateTimeField::new('createdAt'),
            AssociationField::new ('category') -> autocomplete(),
            AssociationField::new ('author') -> autocomplete(),
        ];
    }
    
}
