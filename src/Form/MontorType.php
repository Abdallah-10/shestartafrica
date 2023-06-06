<?php

namespace App\Form;

use App\Entity\Mentor;
use EasyCorp\Bundle\EasyAdminBundle\Form\Type\SlugType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class MontorType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name')
            ->add('description')
            ->add('cover',FileType::class)
            ->add('localisation')
            ->add('skills')
            ->add('occupation')
            ->add('speciality')
            ->add('programs')
            ->add('linkedin',TextType::class,[
                    'required' => false,
            ])
            ->add('submit',SubmitType::class)
   
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Mentor::class,
        ]);
    }
}
