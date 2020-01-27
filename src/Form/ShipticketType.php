<?php

namespace App\Form;

use App\Entity\Shipticket;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
//use
//form type
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use App\Entity\Shiptype;

class ShipticketType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('Shiptype', EntityType::class,[
                'class'=> Shiptype::class,
                'choice_label'=> function ($Shiptype) {
                    return $Shiptype->getDisplayShipname();
                }
            ])
            ->add('Fullfare')
            ->add('Studentfare')
            ->add('Seniorfare')
            ->add('Pwdfare')
            ->add('Shiptype')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Shipticket::class,
        ]);
    }
}
