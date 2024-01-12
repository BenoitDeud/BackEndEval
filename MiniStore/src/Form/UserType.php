<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\BrowserKit\Response;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints\Image;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;

class UserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('pseudoUser', TextType::class, [
                'attr' => [
                    'class' => 'form-control',
                    'minLenght' => '2',
                    'maxLenght' => '50'
                ],
                'label' => 'Pseudo',
                'label_attr' => [
                    'class' => 'form-label mt-4'
                ],
                'constraints' => [
                    new Assert\Length(['min' => 2, 'max' => 50]),
                ]
            ])
            ->add('photo', FileType::class, [
                'attr' => [
                    'class' => 'form-control'
                ],
                'required' => false,
                'mapped' => false,
                'constraints' => [
                    new Image(['maxSize' => '1024k'])
                ],
                'label' => 'Photo utilisateur',
                'label_attr' => [
                    'class' => 'form-label mt-4'
                ]
            ])

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


            ->add('plainPassword', PasswordType::class, [
                'attr' => [
                    'class' => 'form-control'
                ],
                'label' => 'Mot de passe',
                'label_attr' => [
                    'class' => 'form-label mt-4'
                ],
            ])

            ->add('submit', SubmitType::class, [
                'attr' => [
                    'class' => 'btn btn-danger mt-4'
                ],
                'label' => 'Enregistrer'
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
