<?php

namespace App\Form;

use App\Entity\Contact;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ContactType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('prenom', TextType::class,[
                'attr' => [
                    'placeholder' => 'Prénom',
                    'class' => 'widget-symfony'
                ]
            ])
            ->add('nom', TextType::class,[
                'attr' => [
                    'placeholder' => 'Nom',
                    'class' => 'widget-symfony'
                ]
            ])
            ->add('societe', TextType::class,[
                'attr' => [
                    'placeholder' => 'Société',
                    'class' => 'widget-symfony'
                ]
            ])
            ->add('email', TextType::class,[
                'attr' => [
                    'placeholder' => 'Email',
                    'class' => 'widget-symfony'
                ]
            ])
            ->add('telephone', TextType::class,[
                'attr' => [
                    'placeholder' => 'Téléphone (facultatif)',
                    'class' => 'widget-symfony'
                ]
            ])
            ->add('objet', TextType::class,[
                'attr' => [
                    'placeholder' => 'Objet',
                    'class' => 'widget-symfony'
                ]
            ])
            ->add('message', TextType::class,[
                'attr' => [
                    'placeholder' => 'Message',
                    'class' => 'message-widget widget-symfony'
                ]
            ])

            ->add('rgpd', CheckboxType::class,[

            ])
   
            ->add('envoyer', SubmitType::class, [
                'attr' => ['class' => 'button-symfony'],
                'label' => 'ENVOYER'
            ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Contact::class,
        ]);
    }
}
