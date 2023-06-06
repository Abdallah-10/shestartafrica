<?php

namespace App\Form;

use App\Entity\Investor;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class InvestorType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('title')
            ->add('description',TextareaType::class)
            ->add('logo', FileType::class, [
                'required'   => false,
                'mapped'=>false,
                'label'=> 'Upload your logo'
            ])
            ->add('type',ChoiceType::class,[
                'label'=> 'Type',
                'placeholder' => 'Type',
                'choices'=>[
                            'Partner' => 'partner',
                            'Investor' => 'investor',
                        ],
            ])
            ->add('category')
            ->add('country')
            ->add('phone')
            ->add('field',ChoiceType::class,[
                'label'=> 'Type of investment',
                'placeholder' => 'Type of investment',
                'choices'=>[
                            'Equity' => 'equity',
                            'Loan' => 'loan',
                            'Angel Investors' => 'angel investors',
							'Venture Capitalists' => 'venture capitalists',
                            'Donation' => 'donation',
                        ],
            ])
            
            ->add('linkedin')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Investor::class,
        ]);
    }
}
