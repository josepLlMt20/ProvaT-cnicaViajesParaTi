<?php

namespace App\Form;

use App\Entity\Proveedor;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\ButtonType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Validator\Constraints\Length;
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
            ->add('telefono', TextType::class, [
                'constraints' => [
                    new Length([
                        'min' => 9,
                        'max' => 9,
                    ]),
                ],
            ])
            ->add('tipo', ChoiceType::class, [ // Use ChoiceType for the 'tipo' field
                'choices' => [
                    'Hotel' => 'hotel',
                    'Pista' => 'pista',
                    'Complemento' => 'complemento',
                ],
                'expanded' => false, // Use radio buttons or select dropdown
                'multiple' => false, // Allow multiple selections
            ])
            ->add('activo')
            ->add('guardar', SubmitType::class)
            ->add('volver', ButtonType::class, [
                'attr' => ['onclick' => 'location.href="' . $this->urlGenerator->generate('inicio') . '"']
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Proveedor::class,
        ]);
    }
}