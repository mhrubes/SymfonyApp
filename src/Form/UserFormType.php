<?php

namespace App\Form;

use App\Entity\Userdata;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

use Symfony\Component\Form\Extension\Core\Type\TextType;
// use Symfony\Component\Form\Extension\Core\Type\PasswordType;

class UserFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('firstname', TextType::class, [
                'attr' => array(
                    'class' => 'form-control m-3',
                    'placeholder' => $options['placeholder']['firstname'],
                ),
                    'label' => false,
                    'required' => false
            ])
            ->add('lastname', TextType::class, [
                'attr' => array(
                    'class' => 'form-control m-3',
                    'placeholder' => 'Zadejte Příjmení',
                ),
                    'label' => false,
                    'required' => false
            ])
            ->add('password', TextType::class, [
                'attr' => array(
                    'class' => 'form-control m-3',
                    'placeholder' => 'Zadejte Heslo',
                ),
                    'label' => false,
                    'required' => false
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Userdata::class,
            'placeholder' => [
                'firstname' => 'enterUserFirstname',
                'lastname' => 'enterUserLastname',
                'password' => 'enterPassword',
            ],
        ]);
    }
}
