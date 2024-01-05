<?php

namespace App\Controller\Admin;

use App\Entity\Montres;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\MoneyField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class MontresCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Montres::class;
    }

    
    public function configureFields(string $pageName): iterable
    {
        return [
            TextField::new('name'),
            TextField::new('marque'),
            TextField::new('description'),
            MoneyField::new('price')->setCurrency('EUR')->setNumDecimals(2),
            IntegerField::new('quantiteMontre'),
            ImageField::new('imageMontre')
            ->setFormTypeOptions($pageName == Crud::PAGE_EDIT ? ['allow_delete' => false] : [])
            ->setBasePath('/uploads/photos')
            ->setLabel('Photo')
            ->setUploadDir('/public/uploads/photos/'),
        ];
    }
    
}
