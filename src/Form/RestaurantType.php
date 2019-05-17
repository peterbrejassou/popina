<?php

namespace App\Form;
use App\Entity\Restaurant;
use App\Entity\TypeRestaurant;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TelType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\Email;
use Symfony\Component\Validator\Constraints\File;
use Symfony\Component\Validator\Constraints\Regex;

class RestaurantType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('slug', TextType::class,['label' => 'restaurant.slug'])
            ->add('nom', TextType::class,['label' => 'restaurant.nom'])
            ->add('adresse', TextType::class, ['label' => 'restaurant.adresse'])
            ->add('code_postal', TextType::class, array(
                'constraints' => array(
                    new Length(array('max' => 5, 'min' => 5))
                ), 'label' => 'restaurant.cp'
            ))
            ->add('ville', TextType::class, ['label' => 'restaurant.ville'])
            ->add('telephone', TelType::class, array(
                'constraints' => array(
                    new Length(array('min' => 10, 'max' => 18)),
                    new Regex(array( 'pattern' => '#^(0|(\+33))[1-9]{1} ?[0-9 ]{8}#', 'message' => 'validations.telephone'))
                ), 'label' => 'restaurant.tel'
            ))
            ->add('email', EmailType::class, array(
                'constraints' => array(
                    new Email(array('message' => 'Votre adresse mail n\'est pas valide'))
                ), 'label' => 'restaurant.email'
            ))
            ->add('site_web', TextType::class, ['label' => 'restaurant.site_web'])
            ->add('horaires', TextType::class, ['label' => 'restaurant.horaire'])
            ->add('type', EntityType::class, [
                'class' => TypeRestaurant::class,
                'choice_label' => 'nom',
            ])
            ->add('photo', FileType::class, array(
                'constraints' => array(
                    new File(array('maxSize' => '5M','mimeTypes' => [
                        'image/png',
                        'image/jpeg',
                        'image/jpg',
                    ], 'mimeTypesMessage' => 'Votre image doit être au format jpeg ou png'))
                ), 'label' => 'restaurant.photos'
            ))
            ->add('save', SubmitType::class, ['label' => 'restaurant.save']);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Restaurant::class,
        ]);
    }
}