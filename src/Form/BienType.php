<?php

namespace App\Form;

use App\Entity\Bien;
use App\Entity\Chauffage;
use App\Entity\TypeDeBien;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class BienType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('titre', TextType::class)
            ->add('description', TextareaType::class, [
            ])
            ->add('numero_rue', IntegerType::class)
            ->add('rue', TextType::class)
            ->add('rue_complement', TextType::class)
            ->add('code_postal', IntegerType::class)
            ->add('ville', TextType::class)
            ->add('surface', IntegerType::class)
            ->add('nombre_de_pieces', IntegerType::class)
            ->add('nombre_chambres', IntegerType::class)
            ->add('surface_terrain', IntegerType::class)
            ->add('prix', IntegerType::class)
            ->add('cheminee', CheckboxType::class)
            ->add('belle_vue', CheckboxType::class)
            ->add('balcon', CheckboxType::class)
            ->add('piscine', CheckboxType::class)
            ->add('ascenseur', CheckboxType::class)
            ->add('terrasse', CheckboxType::class)
            ->add('cave', CheckboxType::class)
            ->add('parking', CheckboxType::class)
            ->add('acces_handicape', CheckboxType::class)
            ->add('baignoire', CheckboxType::class)
            ->add('cuisine_separee', CheckboxType::class)
            ->add('meuble', CheckboxType::class)
            ->add('colocation', CheckboxType::class)
            ->add('wc_separes', CheckboxType::class)
            ->add('type_de_bien', EntityType::class, [
                'class' => TypeDeBien::class
            ])
            ->add('chauffage', EntityType::class, [
                'class' => Chauffage::class
            ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Bien::class,
        ]);
    }
}
