<?php

namespace App\Form;

use App\Entity\Team;
use App\Entity\Ventures;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\OptionsResolver\OptionsResolver;

class VenturesType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('title',TextType::class,[
                'required'   => true,
                'label'   => 'Title *',

            ])
            ->add('years', DateType::class,[
                'label' => 'Foundation date *',
                'widget' => 'single_text',
                'required'   => true,
            ])
            ->add('cover', FileType::class, [
                'required'   => false,
                'mapped'=>false,
                'label'=> 'background image'
            ])
            ->add('country',TextType::class,[
                'required'   => true,
                'label'   => 'Country *',
            ])
            ->add('sector',TextType::class,[
                'required'   => true,
                'label'   => 'Sector *',
            ])
            ->add('flag', FileType::class, [
                'required'   => true,
                'mapped'=>false,
                'label'=> 'Upload your logo *'
            ])
            ->add('linkedIn')
           
            ->add('facebook')
            ->add('founder',IntegerType::class,[
                'label'=>'number of founder'
            ])
            ->add('description',TextareaType::class,[
                'required'   => true,
                'label'=>'Description *'
            ])
            ->add('phone',TextType::class,[
                'required'   => true,
                'label'   => 'Phone *',
            ])
            ->add('address',TextType::class,[
                'required'   => true,
                'label'   => 'Address *',
            ])
            ->add('website')
            ;
            
        
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Ventures::class,
        ]);
    }
}
