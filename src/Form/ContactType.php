<?php

namespace App\Form;

use App\Entity\Contact;
use Karser\Recaptcha3Bundle\Form\Recaptcha3Type;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ContactType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name',TextType::class,[
                'label'=>false,
                'attr' =>[
                    'placeholder' =>'Name'
                ]
            ])
            ->add('email',EmailType::class,[
                'label'=>false,
                'attr' =>[
                    'placeholder' =>'Email'
                ]
            ])
            ->add('phone',NumberType::class,[
                'label'=>false,
                'attr' =>[
                    'placeholder' =>'Phone'
                ]
            ])
            ->add('subject',TextType::class,[
                'label'=>false,
                'attr' =>[
                    'placeholder' =>'Subject'
                ]
            ])
            ->add('message',TextareaType::class,[
                'label'=>false,
                'attr' =>[
                    'placeholder' =>'Message'
                ]
            ])
            ->add('recaptcha', Recaptcha3Type::class);
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Contact::class,
        ]);
    }
}
