<?php

namespace App\Form;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;

class BoissonType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nom', TextType::class,['label' => 'carte.nom'])
            ->add('description', TextType::class,['label' => 'carte.description'])
            ->add('quantite', NumberType::class,['label' => 'carte.quantite'])
            ->add('prix', NumberType::class,['label' => 'carte.prix'])
            ->add('save', SubmitType::class, ['label' => 'carte.save'])
        ;
    }
}