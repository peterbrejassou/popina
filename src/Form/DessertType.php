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

    class DessertType extends AbstractType
    {
        public function buildForm(FormBuilderInterface $builder, array $options)
        {
            $builder
                ->add('nom', TextType::class,['label' => 'nom dessert'])
                ->add('description', TextType::class,['label' => 'description'])
                ->add('save', SubmitType::class, ['label' => 'restaurant.save'])
            ;
        }
    }