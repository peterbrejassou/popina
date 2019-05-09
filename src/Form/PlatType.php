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

    class PlatType extends AbstractType
    {
        public function buildForm(FormBuilderInterface $builder, array $options)
        {
            $builder
                ->add('nom', TextType::class,['label' => 'plat.nom'])
                ->add('description', TextType::class,['label' => 'carte.description']) 
                ->add('prix', NumberType::class,['label' => 'carte.prix'])               
                ->add('save', SubmitType::class, ['label' => 'carte.save'])
            ;
        }
    }