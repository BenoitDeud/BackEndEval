<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;

class LivraisonType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
        ->add('adresse',TextType::class,[
            'attr'=> [
                'class'=> 'form-control',
                'minLenght'=> '2',
                'maxLenght'=> '255'
                ],
                'label'=> 'Adresse',
                'label_attr'=> [
                    'class'=> 'form-label'
                ],
                'constraints'=> [
                    new Assert\NotBlank(),
                    new Assert\Length(['min'=> 2,'max'=> 255]),
                    ]
        ])

        ->add('codePostal',TextType::class,[
            'attr'=> [
                'class'=> 'form-control',
                'minLenght'=> '5',
                'maxLenght'=> '5'
                ],
                'label'=> 'Code Postal',
                'label_attr'=> [
                    'class'=> 'form-label'
                ],
                'constraints'=> [
                    new Assert\NotBlank(),
                    new Assert\Length(['min'=> 5,'max'=> 5]),
                    ]
        ])

        ->add('ville',TextType::class,[
            'attr'=> [
                'class'=> 'form-control',
                'minLenght'=> '2',
                'maxLenght'=> '150'
                ],
                'label'=> 'Ville',
                'label_attr'=> [
                    'class'=> 'form-label'
                ],
                'constraints'=> [
                    new Assert\NotBlank(),
                    new Assert\Length(['min'=> 2,'max'=> 150]),
                    ]
        ])

        ->add('favoris', CheckboxType::class, [
            'mapped' => false,
            'required' => false,
            'label'=> 'Mettre cette adresse en favoris ',
            'label_attr'=> [
                'class'=> 'form-label fs-5 text'
            ],
            'attr' => [
                'style' => 'margin-left:10px;'
            ],
        ])

        
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
