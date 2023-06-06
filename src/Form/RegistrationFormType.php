<?php

namespace App\Form;

use App\Entity\User;
use Karser\Recaptcha3Bundle\Form\Recaptcha3Type;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\IsTrue;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;

class RegistrationFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
           
            ->add('firstname',TextType::class,[
                'label'=>false,
                'attr' =>[
                    'placeholder' =>'First name'
                ]
            ])
            ->add('lastname',TextType::class,[
                'label'=>false,
                'attr' =>[
                    'placeholder' =>'Last name'
                ]
            ])
            ->add('email',EmailType::class,[
                'label'=>false,
                'attr' =>[
                    'placeholder' =>'Email'
                ]
            ])
            ->add('password', RepeatedType::class, [
                'type' => PasswordType::class,
                'invalid_message' => 'The passwords are not identical.',
                'options' => ['attr' => ['class' => 'password-field']],
                'required' => true,
                'first_options'  => ['label'=> false,
                                    'attr' => ['placeholder' => 'Password']],
                'second_options' => ['label'=> false,
                                    'attr' => ['placeholder' => 'Confirm Password']],
            ])
            
            ->add('programme',ChoiceType::class,[
                'label'=>false,
                'placeholder' => 'are you ?',
                'choices'=>[
                            'Venture' => 'venture',
                            'Investor' => 'investor',
                            'Mentor' => 'mentor',
							'Expert' => 'expert',
                        ],
            ])
            ->add('agreeTerms', CheckboxType::class, [
                'mapped' => false,
                'constraints' => [
                    new IsTrue([
                        'message' => 'You should agree to our terms.',
                    ]),
                ],
            ])
            ->add('recaptcha', Recaptcha3Type::class);
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
