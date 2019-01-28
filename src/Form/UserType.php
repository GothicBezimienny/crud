<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;



class UserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('Name', TextType::class, ['required' => true,'attr' => ['class' => 'form-control']])
			->add('Surname', TextType::class,['required' => true,'attr' => ['class' => 'form-control']])
			->add('Telephone', NumberType::class, ['required' => true,'attr' => ['class' => 'form-control']])
			->add('Address', TextType::class, ['required' => true,'attr' => ['class' => 'form-control']])
			->add('save', SubmitType::class, [
				'label' => 'Update',
				'attr' =>['class' => 'btn btn-primary']
			]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
		        'data_class' => 'App\Entity\User',

        ]);
    }
}
