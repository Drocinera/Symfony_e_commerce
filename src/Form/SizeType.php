<?php

namespace App\Form;

use App\Entity\SweatshirtSize;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class SizeType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('size', TextType::class, [
                'label' => 'Taille',
                'attr' => ['class' => 'form-size-input'],
            ])
            ->add('stock', IntegerType::class, [
                'label' => 'Stock disponible',
                'attr' => [
                    'min' => 0,
                    'class' => 'form-stock-input',
                ],
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => SweatshirtSize::class,
        ]);
    }
}
