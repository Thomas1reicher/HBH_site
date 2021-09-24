<?php


namespace Form\AdminForm\Type;


use App\Entity\Image;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\AbstractType;

use Symfony\Component\OptionsResolver\OptionsResolver;

use Symfony\Component\Form\FormBuilderInterface;

class ImageClassType extends AbstractType
{


    public function buildForm(FormBuilderInterface $builder, array $options)
    {

      
        $builder->add('nom_img',FileType::class, [
            'mapped' => false,

            'required' => false,

        ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Image::class,
        ]);
    }
}
