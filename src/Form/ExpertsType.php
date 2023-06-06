<?php

namespace App\Form;

use App\Entity\Expert;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\HttpFoundation\File\File;

class ExpertsType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
        ->add('firstname',TextType::class,[
            'required'=>true,
        ])
        ->add('lastname')
        ->add('company')
        ->add('country')
        ->add('phone')
        ->add('biography',TextareaType::class)
        ->add('picture',FileType::class, [
            'required'   => true,
            'mapped'=>false,
            'label'=> 'Upload your picture *'
        ])
        ->add('linkedin')
        ->add('twitter')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Expert::class,
        ]);
    }
}
