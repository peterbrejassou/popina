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
    use Symfony\Component\Form\Extension\Core\Type\NumberType;
    use Symfony\Component\Validator\Constraints\Length;
    use Symfony\Component\Validator\Constraints\Email;
    use Symfony\Component\Validator\Constraints\File;
    use Symfony\Component\Validator\Constraints\Regex;

    class BoissonType extends AbstractType
    {
        public function buildForm(FormBuilderInterface $builder, array $options)
        {
            $builder
                ->add('nom', TextType::class,['label' => 'nom boisson'])
                ->add('description', TextType::class,['label' => 'description'])
                ->add('quantite', NumberType::class,['label' => 'quantité'])
                ->add('prix', NumberType::class,['label' => 'prix'])
                ->add('save', SubmitType::class, ['label' => 'restaurant.save'])
            ;
        }
    }