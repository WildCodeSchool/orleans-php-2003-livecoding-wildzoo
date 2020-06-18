<?php

namespace App\Form;

use App\Entity\Activity;
use App\Entity\Animal;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Vich\UploaderBundle\Form\Type\VichImageType;

class ActivityType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', TextType::class, [
                'label' => 'Nom',
                'attr'  => [
                    'placeholder' => 'Nourrir les animaux',
                ],
            ])
            ->add('description', TextareaType::class, [
            ])
            ->add('imageFile', VichImageType::class, [
                'help'         =>
                    'Les fichiers autorisés sont uniquement de type '
                    . implode(', ', Activity::MIME_TYPES)
                    . ' et le poids maximal de ' . Activity::MAX_SIZE,
                'required'     => false,
                'download_uri' => false,
                'label'        => 'Image',
            ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Activity::class,
        ]);
    }
}
