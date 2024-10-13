<?php

namespace App\Form;

use App\Entity\Sweatshirt;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType; 
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class SweatshirtType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('image', FileType::class, [
                'label' => 'Photo',
                'mapped' => false,
                'required' => true,
            ])
            ->add('name', TextType::class, [
                'label' => 'Nom',
            ])
            ->add('price', NumberType::class, [
                'label' => 'Prix',
                'scale' => 2,
            ])
            ->add('highlight', CheckboxType::class, [ 
                'label' => 'Mettre en avant',
                'required' => false,
            ])
            ->add('sizes', CollectionType::class, [
                'label' => 'Tailles',
                'entry_type' => SizeType::class,
                'allow_add' => true,
                'allow_delete' => true,
                'by_reference' => false,
                'prototype' => true,
                'prototype_name' => '__name__',
                'entry_options' => [
                    'label' => false,
                ],
                'attr' => [
                    'class' => 'sizes-collection',
                ],
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Sweatshirt::class,
        ]);
    }
}
