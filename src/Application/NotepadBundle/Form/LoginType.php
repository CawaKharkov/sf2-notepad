<?php

namespace Application\NotepadBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class LoginType extends AbstractType
{

    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
                ->add('_username', 'text', ['required' => true, 'attr' => ['class' => 'form-control input-lg',
                        'placeholder' => 'Ваш логин']])
                // ->add('name', 'text', ['required'=>true, 'attr'=>['class'=>'form-control', 'placeholder'=>'Ваш ник']])
                ->add('_password', 'password', ['required' => true, 'attr' => ['class' => 'form-control input-lg',
                        'placeholder' => 'Пароль']])
                ->add('login', 'submit', ['attr' => ['class' => 'btn btn-primary btn-lg btn-block']])
        ;
    }

    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Application\NotepadBundle\Entity\User',
            'validation_groups' => ['login'],
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return null;
    }

}
