<?php

namespace App\Form;

use App\Entity\Bien;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class BienType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('titre')
            ->add('description')
            ->add('numero_rue')
            ->add('rue')
            ->add('rue_complement')
            ->add('code_postal')
            ->add('ville')
            ->add('surface')
            ->add('nombre_de_pieces')
            ->add('nombre_chambres')
            ->add('surface_terrain')
            ->add('prix')
            ->add('cheminee')
            ->add('belle_vue')
            ->add('balcon')
            ->add('piscine')
            ->add('ascenseur')
            ->add('terrasse')
            ->add('cave')
            ->add('parking')
            ->add('acces_handicape')
            ->add('baignoire')
            ->add('cuisine_separee')
            ->add('meuble')
            ->add('colocation')
            ->add('wc_separes')
            ->add('created_at')
            ->add('type_de_bien')
            ->add('chauffage')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Bien::class,
        ]);
    }
}
