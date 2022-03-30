<?php

namespace App\Form;

use App\Entity\CreatureFormation;
use App\Entity\Formation;
use App\Entity\Creature;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;


class CreatureFormationType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            // On affiche la liste des Formations
            ->add('lienFormation', EntityType::class, array(
                'class' => Formation::class,
                'choice_label' => 'nom',
            ))

            // On affiche la liste des Créatures
            ->add('lienCreature', EntityType::class, array(
                'class' => Creature::class,
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
