<?php

namespace App\Form;

use App\Entity\Proveedor;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\ButtonType;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;


class ProveedorType extends AbstractType
{

    private $urlGenerator;

    public function __construct(UrlGeneratorInterface $urlGenerator)
    {
        $this->urlGenerator = $urlGenerator;
    }
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nombre')
            ->add('correoElectronico')
            ->add('telefono')
            ->add('tipo')
            ->add('activo')
            /*
            ->add('guardar', SubmitType::class, [
                'label' => '<i class="fa-solid fa-save"></i> Guardar',
                'label_html' => true,
                'attr' => [
                    'class' => 'text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-green-600 dark:hover:bg-green-700 focus:outline-none dark:focus:ring-green-800',
                ],
            ])
            ->add('volver', ButtonType::class, [
                'label' => '<i class="fa-solid fa-arrow-rotate-left"></i> Volver al listado',
                'label_html' => true,
                'attr' => [
                    'class' => 'text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800',
                    'onclick' => sprintf("location.href='%s'", $this->urlGenerator->generate('all_proveedor'))
                ],
            ]);*/
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Proveedor::class,
        ]);
    }
}
