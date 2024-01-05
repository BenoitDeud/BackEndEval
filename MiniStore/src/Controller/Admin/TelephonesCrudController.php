<?php

namespace App\Controller\Admin;

use App\Entity\Telephones;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\MoneyField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class TelephonesCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Telephones::class;
    }

    
    public function configureFields(string $pageName): iterable
    {
        return [
            TextField::new('nom'),
            TextField::new('marque'),
            TextField::new('description'),
            MoneyField::new('prix')->setCurrency('EUR')->setNumDecimals(2),
            IntegerField::new('quantiteTelephone'),
            ImageField::new('imageTel')
            ->setFormTypeOptions($pageName == Crud::PAGE_EDIT ? ['allow_delete' => false] : [])
            ->setBasePath('/uploads/photos')
            ->setLabel('Photo')
            ->setUploadDir('/public/uploads/photos/'),
        ];
    }
    
}
