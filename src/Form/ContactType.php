<?php

namespace App\Form;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TelType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\Email;
use Symfony\Component\Validator\Constraints\Regex;

class ContactType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', TextType::class,['label' => 'contact.name'])
            ->add('lastname', TextType::class,['label' => 'contact.lastname'])
            ->add('phone', TelType::class, array(
                'constraints' => array(
                    new Length(array('max' => 12)),
                    new Regex(array( 'pattern' => '#^(0|(\+33))[0-9]{9}#', 'message' => 'Veuillez saisir un numéro de téléphone suivant ce format : +33XXXXXXXXX ou 0XXXXXXXXX'))
                ), 'label' => 'contact.tel'
            ))
            ->add('mail', EmailType::class, array(
                'constraints' => array(
                    new Email(array('message' => 'Votre adresse mail n\'est pas valide'))
                ), 'label' => 'contact.email'
            ))
            ->add('message', TextType::class,['label' => 'contact.message'])            
            ->add('save', SubmitType::class, ['label' => 'contact.save'])
        ;
    }
}