<?php

namespace App\Form;

use App\Entity\Experience;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ExperienceType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
        ->add('title', TextType::class, ['label' =>'Titre'])
        ->add('role', TextType::class, ['label' =>'Rôle'])
        ->add('place', TextType::class, ['label' =>'Établissement'])
        ->add('startDate', DateType::class, [
            'label' => 'Date de début',
            'widget' => 'single_text',
            'format' => 'yyyy-MM-dd',
        ])
        ->add('endDate', DateType::class, [
            'label' => 'Date de fin',
            'widget' => 'single_text',
            'format' => 'yyyy-MM-dd',
        ])
        ->add('description', TextareaType::class, ['label' =>'Description']);        
 
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Experience::class,
        ]);
    }
}
