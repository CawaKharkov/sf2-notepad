<?php

namespace Application\NotepadBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class SignupType extends AbstractType
{

    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
        ->add('email', 'email', ['required'=>true, 'attr'=>['class'=>'form-control', 'placeholder'=>'Ваша почта']])
        ->add('username', 'text', ['required'=>true, 'attr'=>['class'=>'form-control', 'placeholder'=>'Ваш ник']])
        ->add('password', 'password', ['required'=>true, 'attr'=>['class'=>'form-control', 'placeholder'=>'Пароль']])
        ->add('save', 'submit', ['attr'=>['class'=>'btn btn-success']])
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Application\NotepadBundle\Entity\User',
            'validation_groups' => ['signup'],
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'signup';
    }
}