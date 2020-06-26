<?php

namespace App\Form;

use App\Entity\Nieuws;
use FOS\CKEditorBundle\Form\Type\CKEditorType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Vich\UploaderBundle\Form\Type\VichImageType;


class NieuwsType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('titel')
            ->add('samenvatting')
            ->add('tekst', CKEditorType::class, [
                'config' => ['toolbar' => 'full'],])
            ->add('imageFile', VichImageType::class, [
                'required' => false,
                'allow_delete' => true,
                'download_label' => '...',
                'download_uri' => true,
                'image_uri' => true,
                'asset_helper' => true,])
            ->add('auteur')
           # ->add('datum')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Nieuws::class,
        ]);
    }
}
