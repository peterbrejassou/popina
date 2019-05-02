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

    class RestaurantType extends AbstractType
    {
        public function buildForm(FormBuilderInterface $builder, array $options)
        {
            $builder
                ->add('nom', TextType::class)
                ->add('adresse', TextType::class)
                ->add('code_postal', TextType::class, array(
                    'constraints' => array(
                        new Length(array('max' => 5, 'min' => 5))
                    )
                ))
                ->add('ville', TextType::class)
                ->add('telephone', TelType::class, array(
                    'constraints' => array(
                        new Length(array('max' => 12)),
                        new Regex(array( 'pattern' => '#^(0|(\+33))[0-9]{9}#', 'message' => 'Veuillez saisir un numéro de téléphone suivant ce format : +33XXXXXXXXX ou 0XXXXXXXXX'))
                    )
                ))
                ->add('email', EmailType::class, array(
                    'constraints' => array(
                        new Email(array('message' => 'Votre adresse mail n\'est pas valide'))
                    )
                ))
                ->add('site_web', TextType::class)
                ->add('horaires', TextType::class)
                ->add('type', TextType::class, ['label' => 'Type de nourriture'])                
                ->add('photo', FileType::class, array(
                    'constraints' => array(
                        new File(array('maxSize' => '5M','mimeTypes' => [
                            'image/png',
                            'image/jpeg',
                        ], 'mimeTypesMessage' => 'Votre image doit être au format jpeg ou png'))
                    ), 'label' => 'Choissisez votre photo'
                ))
                ->add('save', SubmitType::class, ['label' => 'Ajouter'])
            ;
        }
    }