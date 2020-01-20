<?php

namespace App\Form;

use App\Entity\Bien;
use App\Entity\Chauffage;
use App\Entity\TypeDeBien;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
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
        ->add('description', TextareaType::class, [])
        ->add('numero_rue', IntegerType::class)
        ->add('rue', TextType::class)
        ->add('rue_complement', TextType::class, [
            'required' => false
        ])
        ->add('code_postal', IntegerType::class)
        ->add('ville', TextType::class)
        ->add('surface', IntegerType::class)
        ->add('nombre_de_pieces', IntegerType::class)
        ->add('nombre_chambres', IntegerType::class)
        ->add('surface_terrain', IntegerType::class)
        ->add('prix', IntegerType::class)
        ->add('images', FileType::class, [
            "mapped" => false, // permet d'indiquer à symfony que cet input ne correspond à aucun champ de notre entité
            "multiple" => true, // permet d'uploader plusieurs fichiers à la fois
            "label" => "Uploadez vos photos",
            "required" => false
        ]);
}

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Bien::class,
        ]);
    }
}
