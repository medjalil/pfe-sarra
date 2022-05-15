<?php

namespace App\Form;

use App\Entity\City;
use App\Entity\Profile;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Security\Core\Security;

class ProfileType extends AbstractType
{

    /**
     * @var Security
     */
    private $security;

    public function __construct(Security $security)
    {
        $this->security = $security;
    }

    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        if ($this->security->isGranted('ROLE_CUSTOMER')) {
            $builder
                ->add('phone', TextType::class, [
                    'required' => true,
                    'label' => 'Téléphone'
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
                ]);
        } else {
            $builder->add('company', TextType::class, [
                'required' => true,
                'label' => 'Nom de l\' entreprise',
            ])
                ->add('type', ChoiceType::class, [
                    'choices' => [
                        'La société à responsabilité limitée' => 'La société à responsabilité limitée',
                        'La société unipersonnelle à responsabilité limitée' => 'La société unipersonnelle à responsabilité limitée',
                        'Société anonyme' => 'Société anonyme',
                        'La société en nom collectif' => 'La société en nom collectif',
                        'La société en commandite simple' => 'La société en commandite simple',
                        'La société en participation' => 'La société en participation'
                    ],
                    'label' => 'Type d\' entreprise',
                    'required' => true,
                ])
                ->add('activity', TextType::class, [
                    'required' => true,
                    'label' => 'Activité'
                ])
                ->add('bio', TextareaType::class, [
                    'required' => false,
                    'label' => 'Description'
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
                ->add('vatId', TextType::class, [
                    'required' => false,
                    'label' => 'Matricule fiscale',
                ])
                ->add('phone', TextType::class, [
                    'required' => true,
                    'label' => 'Téléphone',
                ])
                ->add('mobile', TextType::class, [
                    'required' => false,
                    'label' => 'Portable',
                ])
                ->add('webSite', TextType::class, [
                    'required' => false,
                    'label' => 'Site web',
                ]);
        }
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Profile::class,
        ]);
    }
}
