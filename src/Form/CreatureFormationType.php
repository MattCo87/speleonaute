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

            ->add('lienFormation', EntityType::class, array(
                // query choices from this entity
                'class' => Formation::class,

                // use the User.username property as the visible option string
                'choice_label' => 'nom',

                // used to render a select box, check boxes or radios
                // 'multiple' => true,
                // 'expanded' => true,
            ))

            ->add('lienCreature', EntityType::class, array(
                // query choices from this entity
                'class' => Creature::class,

                // use the User.username property as the visible option string
                'choice_label' => 'nom',

                // used to render a select box, check boxes or radios
                // 'multiple' => true,
                // 'expanded' => true,
            ))

            /*
            ->add('lienFormation', EntityType::class, [
                // looks for choices from this entity
                'class' => Formation::class,
            
                // uses the User.username property as the visible option string
                'choice_label' => 'Formation',
            
                // used to render a select box, check boxes or radios
                // 'multiple' => true,
                // 'expanded' => true,
            ])

            ->add('lienCreature', EntityType::class, [
                // looks for choices from this entity
                'class' => Creature::class,
            
                // uses the User.username property as the visible option string
                'choice_label' => 'Creature',
            
                // used to render a select box, check boxes or radios
                // 'multiple' => true,
                // 'expanded' => true,
            ])
*/
            ->add('localisation', ChoiceType::class, array(
                'choices'  => [
                    'Devant' => 0,
                    'Milieu' => 1,
                    'Derrière' => 2,
                ],
            ))

            ->add('strategie', ChoiceType::class, [
                'choices'  => [
                    '1' => 1,
                    '2' => 2,
                    '3' => 3,
                    '4' => 4,
                ],
            ])

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
