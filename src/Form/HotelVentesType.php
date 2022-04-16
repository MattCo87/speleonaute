<?php

namespace App\Form;

use App\Entity\Combat;
use App\Entity\User;
use App\Entity\CreatureFormation;
use App\Entity\Formation;
use App\Entity\Creature;
use App\Entity\Scenario;
use App\Repository\FormationRepository;
use App\Repository\CreatureFormationRepository;
use App\Repository\CreatureRepository;
use App\Repository\ScenarioRepository;
use App\Repository\UserRepository;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Security\Core\Security as CoreSecurity;
use Doctrine\Persistence\ManagerRegistry;


class HotelVentesType extends AbstractType
{
    private $security;

    public function __construct(CoreSecurity $security, ManagerRegistry $registry)
    {
        $this->security = $security;
        $this->registry = $registry;
    }

    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add(
                'submit',
                SubmitType::class,
                [
                    'label' => 'Pull un hote',
                ]
            );
    }
/*
    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'tab' => [
                'data_class' => "coucou",
            ]

        ]);
    }*/
}
