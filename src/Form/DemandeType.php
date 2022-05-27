<?php

namespace App\Form;

use App\Entity\City;
use App\Entity\Demande;
use App\Entity\SubCategory;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\MoneyType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class DemandeType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('title', TextType::class, [
                'required' => true,
                'label' => 'Titre'
            ])
            ->add('description', TextareaType::class, [
                'required' => true,
                'label' => 'Description'
            ])
            ->add('budget', MoneyType::class, [
                'required' => true,
                'label' => 'Budget',
                'currency' => 'TND'
            ])
            ->add('address', TextareaType::class, [
                'required' => true,
                'label' => 'Adresse'
            ])
            ->add('postalCode', IntegerType::class, [
                'required' => true,
                'label' => 'Code postal'
            ])
            ->add('city', EntityType::class, [
                'class' => City::class,
                'choice_label' => 'name',
                'required' => true,
                'label' => 'Gouvernorat'
            ])
            ->add('subCategory', EntityType::class, [
                'class' => SubCategory::class,
                'choice_label' => 'name',
                'required' => true,
                'label' => 'Catégorie'
            ])
            ->add('startAt', DateType::class, [
                'required' => true,
                'label' => 'Date de départ'
            ])
            ->add('endAt', DateType::class, [
                'required' => true,
                'label' => 'Date de fin'
            ])
            ->add('limitAt', DateType::class, [
                'required' => true,
                'label' => 'Date limite'
            ]);

    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Demande::class,
        ]);
    }
}
