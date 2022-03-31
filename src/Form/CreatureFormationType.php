<?php

namespace App\Form;

use App\Entity\CreatureFormation;
use App\Entity\Formation;
use App\Entity\Creature;
use App\Repository\FormationRepository;
use App\Repository\CreatureFormationRepository;
use App\Repository\CreatureRepository;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

use Symfony\Component\Security\Core\Security as CoreSecurity;
use Doctrine\Persistence\ManagerRegistry;


class CreatureFormationType extends AbstractType
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
            /*
            ->add('lienFormation', EntityType::class, array(
                'class' => Formation::class,
                'choice_label' => 'nom',
            ))
            */

            ->add('lienFormation', EntityType::class, array(
                'class' => Formation::class,

                'query_builder' => function (FormationRepository $er) {
                    return $er->createQueryBuilder('c')
                        ->where('c.lienUser = :val')
                        ->setParameter('val', $this->security->getUser());
                },

                'choice_label' => 'nom',
            ))


            // On affiche la liste des Créatures
            /*
            ->add('lienCreature', EntityType::class, array(
                'class' => Creature::class,
                'choice_label' => 'nom',
            ))
            */

            ->add('lienCreature', EntityType::class, array(
                'class' => Creature::class,             
                
                'query_builder' => function () {
                    // Une sous requête affichant la liste des personnages appartenant à une formation
                    $ecf = new CreatureFormationRepository($this->registry);
                    $subQueryBuilder = $ecf->createQueryBuilder('cf');
                    $subQuery = $subQueryBuilder
                        ->select('IDENTITY(cf.lienCreature)')            
                    ;

                    // Une requête retournant les personnages appartenants à l'utilisateur et qui ne sont pas dans une formation
                    $er = new CreatureRepository($this->registry);
                    $queryBuilder = $er->createQueryBuilder('c');
                    $query = $queryBuilder
                        ->where($queryBuilder->expr()->notIn('c.id', $subQuery->getDQL()))
                        ->andwhere('c.lienUser = :val')                       
                        ->setParameter('val', $this->security->getUser())    
                    ;
                    
                    return $query;           
                },

                'choice_label' => 'nom',

            ))









            // On choisit sa localisation
            ->add('localisation', ChoiceType::class, array(
                'choices'  => [
                    'Devant' => 0,
                    'Milieu' => 1,
                    'Derrière' => 2,
                ],
            ))

            // On choisit la stratégie
            ->add('strategie', ChoiceType::class, [
                'choices'  => [
                    '1' => 1,
                    '2' => 2,
                    '3' => 3,
                    '4' => 4,
                ],
            ])

            // Bouton pour valider la création de la CreationFormation
            ->add(
                'submit',
                SubmitType::class,
                [
                    'label' => 'OK'
                ],
            );
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => CreatureFormation::class,
        ]);
    }
}
