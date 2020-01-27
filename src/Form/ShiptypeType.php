<?php

namespace App\Form;

use App\Entity\Shiptype;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use FOS\CKEditorBundle\Form\Type\CKEditorType;
use Symfony\Component\Form\Extension\Core\Type\FileType;

class ShiptypeType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('Shipname')
            ->add('Shipcontent',CKEditorType::class,[
                'config' => [
                    'uicolor' => '#e2e2e2',
                    'toolbar' => 'full',
                    'required' => true
                ]
            ])
            ->add('Image',FileType::class,[
                'mapped'=>false,
                'label'=>'Please upload a file'
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Shiptype::class,
        ]);
    }
}
