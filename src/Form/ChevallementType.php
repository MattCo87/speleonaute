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


class ChevallementType extends AbstractType
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
            // On affiche la liste des Formations
           ->add('lienUser', EntityType::class, array(
                'class' => Formation::class,
                'query_builder' => function (FormationRepository $er) {
                    return $er->createQueryBuilder('c')
                        ->leftJoin(User::class,'u')
                        ->where('c.lienUser = :val')
                        ->setParameter('val', $this->security->getUser());
                },
                'choice_label' => 'nom',
                /*'mapped' =>false*/
            ))
        /*  ->add('lienUser', EntityType::class, array(
                'class' => User::class,
                'query_builder' => function (UserRepository $er) {
                    return $er->createQueryBuilder('c')
                    ->leftJoin(Formation::class,'f')
                    ->where('f.lienUser = :val')
                    ->setParameter('val', $this->security->getUser());
                    
                    
                },
                'choice_label' => 'nom',
            ))*/
            // On affiche la liste des Scenario
            

            ->add('lienScenario', EntityType::class, array(
                'class' => Scenario::class,
                'query_builder' => function (ScenarioRepository $er) {
                    return $er->createQueryBuilder('c');
                },
                'choice_label' => 'nom',
            ))
            

            // Bouton pour valider la création de la CreationFormation
            ->add('submit', SubmitType::class, [
                    'label' => 'OK',
                ]
            );
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            /*'data_class' => Combat::class,
            'arg1' =>Formation::class,
            'required' => false,
            'lienUser' =>$this->security->getUser(),*/
            'tab' => [
                'data_class' => Combat::class,
                'arg1' =>Formation::class,
            ]
            
        ]);
    }
}
