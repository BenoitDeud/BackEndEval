<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints\IsTrue;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;

class RegistrationFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
        ->add('nomUser',TextType::class,[
            'attr'=> [
                'class'=> 'form-control',
                'minLenght'=> '2',
                'maxLenght'=> '50'
                ],
                'label'=> 'Nom',
                'label_attr'=> [
                    'class'=> 'form-label'
                ],
                'constraints'=> [
                    new Assert\NotBlank(),
                    new Assert\Length(['min'=> 2,'max'=> 50]),
                    ]
        ])
        ->add('prenomUser',TextType::class,[
            'attr'=> [
                'class'=> 'form-control',
                'minLenght'=> '2',
                'maxLenght'=> '50'
                ],
                'label'=> 'Prenom',
                'label_attr'=> [
                    'class'=> 'form-label'
                ],
                'constraints'=> [
                    new Assert\Length(['min'=> 2,'max'=> 50]),
                    ]
        ])

        ->add('tel',TextType::class,[
            'attr'=> [
                'class'=> 'form-control',
                'minLenght'=> '10',
                'maxLenght'=> '12'
                ],
                'label'=> 'Numéro de téléphone',
                'label_attr'=> [
                    'class'=> 'form-label'
                ],
                'constraints'=> [
                    new Assert\Length(['min'=> 10,'max'=> 12]),
                    ]
        ])

        ->add('PseudoUser',TextType::class,[
            'attr'=> [
                'class'=> 'form-control',
                'minLenght'=> '2',
                'maxLenght'=> '50'
                ],
                'label'=> 'Pseudo',
                'label_attr'=> [
                    'class'=> 'form-label'
                ],
                'constraints'=> [
                        new Assert\Length(['min'=> 2,'max'=> 50]),
                ]
        ])
        
        ->add('email',EmailType::class,[
            'attr'=>[
                'class'=>'form-control',
                'minLenght'=>'2',
                'maxLenght'=>'180'
                ],
                'label'=> 'Adresse email',
                'label_attr'=> [
                    'class'=> 'form-label',
                ],
                'constraints'=>[
                    new Assert\NotBlank(),
                    new Assert\Email(),
                    new Assert\Length(['min'=>2,'max'=> 180]),
                    ]
        ])
        
        ->add('plainPassword',RepeatedType::class,[
            'type'=>PasswordType::class,
            'first_options'=>[
                'attr'=>[
                    'class'=> 'form-control'
                ],
                'label'=>'Mot de passe',
                'label_attr'=> [
                    'class'=> 'form-label'
            ],
        ],
            'second_options'=>[
                'attr'=>[
                    'class'=>'form-control'
                    ],
                'label'=>"Confirmation du mot de passe",
                'label_attr'=>[
                    'class'=> 'form-label',
                ],
            ],
            'invalid_message'=>"Les mots de passe correspondent pas"
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

        ->add('agreeTerms', CheckboxType::class, [
            'mapped' => false,
            'label'=> 'RGPD ',
                'label_attr'=> [
                    'class'=> 'form-label gape',
                ],
            'constraints' => [
                new IsTrue([
                    'message' => 'You should agree to our terms.',
                ]),
            ],
        ])

        ->add('submit',SubmitType::class,[
            'attr'=>[
                'class'=> 'btn btn-primary'
            ],
            'label'=> 'Enregistrer'
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
