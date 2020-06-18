<?php

namespace App\Form;

use App\Entity\Activity;
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
                ],
            ])
            ->add('description', TextareaType::class)
            ->add('area', EntityType::class, [
                'class'        => Area::class,
                'choice_label' => 'name',
                'label'        => 'Zone',
                'required'     => false,
            ])
            ->add('imageFile', VichImageType::class, [
                'help'         =>
                    'Les fichiers autorisés sont uniquement de type '
                    . implode(', ', Animal::MIME_TYPES)
                    . ' et le poids maximal de ' . Animal::MAX_SIZE,
                'required'     => false,
                'download_uri' => false,
                'label'        => 'Image',
            ])
            ->add('isFocus', CheckboxType::class, [
                'label' => 'Mettre en avant',
                'help'  => 'Affiche cet animal sur la page d\'accueil',
            ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Animal::class,
        ]);
    }
}
