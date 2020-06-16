<?php

namespace App\Form;

use App\Entity\Animal;
use App\Entity\Area;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Vich\UploaderBundle\Form\Type\VichImageType;

class AnimalType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', TextType::class, [
                'attr' => [
                    'placeholder' => 'Pangolin',
                ]
            ])
            ->add('description', TextareaType::class)
            ->add('area', EntityType::class, [
                'class' => Area::class,
                'choice_label' => 'name',
                'label' => 'Zone',
                'required' => false,
            ])
            ->add('imageFile', VichImageType::class, [
                'help'=>'Fichier jpeg ou png de 2M max',
                'required' => false
            ])
            ->add('isFocus', CheckboxType::class)
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Animal::class,
        ]);
    }
}
