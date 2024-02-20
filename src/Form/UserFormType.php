<?php

namespace App\Form;

use App\Entity\Userdata;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;

class UserFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('firstname', TextType::class, [
                'attr' => array(
                    'class' => 'form-control m-3',
                    'placeholder' => 'Zadejte Jméno',
                ),
                    'label' => false
            ])
            ->add('lastname', TextType::class, [
                'attr' => array(
                    'class' => 'form-control m-3',
                    'placeholder' => 'Zadejte Příjmení',
                ),
                    'label' => false
            ])
            ->add('password', PasswordType::class, [
                'attr' => array(
                    'class' => 'form-control m-3',
                    'placeholder' => 'Zadejte Heslo',
                ),
                    'label' => false
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Userdata::class,
        ]);
    }
}
