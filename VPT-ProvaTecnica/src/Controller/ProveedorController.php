<?php


namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

use App\Entity\Proveedor;
use App\Form\ProveedorType;

class ProveedorController extends AbstractController
{
    /**
     * @Route("/proveedor", name="proveedor_index", methods={"GET"})
     */
    public function index(): Response
    {
        $proveedores = $this->getDoctrine()->getRepository(Proveedor::class)->findAll();

        return $this->render('proveedor/index.html.twig', ['proveedores' => $proveedores]);
    }

    /**
     * @Route("/proveedor/nuevo", name="proveedor_nuevo", methods={"GET","POST"})
     */
    public function nuevo(Request $request): Response
    {
        $proveedor = new Proveedor();
        $form = $this->createForm(Proveedor::class, $proveedor);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($proveedor);
            $entityManager->flush();

            return $this->redirectToRoute('proveedor_index');
        }

        return $this->render('proveedor/nuevo.html.twig', [
            'proveedor' => $proveedor,
            'form' => $form->createView(),
        ]);
    }

    // Otros métodos para editar, eliminar y ver detalles de proveedores
}

