<?php

namespace App\Form;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class DessertType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nom', TextType::class,['label' => 'form.dessert'])
            ->add('description', TextType::class,['label' => 'carte.description'])
            ->add('save', SubmitType::class, ['label' => 'carte.save'])
        ;
    }
}