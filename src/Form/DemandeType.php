<?php

namespace App\Form;

use App\Entity\Demande;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\MoneyType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class DemandeType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('title', TextType::class, [
                'required' => true,
                'label' => 'titre'
            ])
            ->add('description', TextareaType::class, [
                'required' => true,
                'label' => 'description'
            ])
            ->add('budget', MoneyType::class, [
                'required' => true,
                'label' => 'budget'
            ])
           
            ->add('address', TextareaType::class, [
                'required' => true,
                'label' => 'Adresse'
            ])

            ->add('postalCode', IntegerType::class, [
                'required' => true,
                'label' => 'Code postal'

            ])

            ->add('city')

            ->add('status', TextType::class, [
                'required' => true,
                'label' => 'statue'
            ])
            
            ->add('subCategory')

            ->add('startAt')
            ->add('endAt')
            ->add('limitAt')
            ->add('createdAt');

    }       

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Demande::class,
        ]);
    }
}
