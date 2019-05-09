<?php
    // src/Form/RestaurantType.php
    namespace App\Form;
    use Symfony\Component\Form\AbstractType;
    use Symfony\Component\Form\FormBuilderInterface;
    use Symfony\Component\Form\Extension\Core\Type\SubmitType;
    use Symfony\Component\Form\Extension\Core\Type\TextType;
    use Symfony\Component\Form\Extension\Core\Type\TelType;
    use Symfony\Component\Form\Extension\Core\Type\EmailType;
    use Symfony\Component\Form\Extension\Core\Type\FileType;
    use Symfony\Component\Validator\Constraints\Length;
    use Symfony\Component\Validator\Constraints\Email;
    use Symfony\Component\Validator\Constraints\File;
    use Symfony\Component\Validator\Constraints\Regex;

    class CarteType extends AbstractType
    {
        public function buildForm(FormBuilderInterface $builder, array $options)
        {
            $builder
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
                        new Length(array('max' => 12)),
                        new Regex(array( 'pattern' => '#^(0|(\+33))[0-9]{9}#', 'message' => 'Veuillez saisir un numéro de téléphone suivant ce format : +33XXXXXXXXX ou 0XXXXXXXXX'))
                    ), 'label' => 'restaurant.tel'
                ))
                ->add('email', EmailType::class, array(
                    'constraints' => array(
                        new Email(array('message' => 'Votre adresse mail n\'est pas valide'))
                    ), 'label' => 'restaurant.email'
                ))
                ->add('site_web', TextType::class, ['label' => 'restaurant.site_web'])
                ->add('horaires', TextType::class, ['label' => 'restaurant.horaire'])
                ->add('type', TextType::class, ['label' => 'restaurant.type'])                
                ->add('photo', FileType::class, array(
                    'constraints' => array(
                        new File(array('maxSize' => '5M','mimeTypes' => [
                            'image/png',
                            'image/jpeg',
                        ], 'mimeTypesMessage' => 'Votre image doit être au format jpeg ou png'))
                    ), 'label' => 'restaurant.photo'
                ))
                ->add('save', SubmitType::class, ['label' => 'restaurant.save'])
            ;
        }
    }