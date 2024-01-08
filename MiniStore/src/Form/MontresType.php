<?php

namespace App\Form;

use App\Entity\Montres;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class MontresType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name')
            ->add('marque')
            ->add('price')
            ->add('description')
            ->add('imageMontre')
            ->add('quantiteMontre')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Montres::class,
        ]);
    }
}
