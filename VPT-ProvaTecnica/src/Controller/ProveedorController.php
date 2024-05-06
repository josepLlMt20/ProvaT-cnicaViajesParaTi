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
    public function getAll(): Response
    {
        $proveedores = $this->getDoctrine()->getRepository(Proveedor::class)->findAll();

        return $this->render('proveedor/index.html.twig', ['proveedores' => $proveedores]);
    }
    /**
     * @Route("/proveedor/{id}", name="proveedor_detalles", methods={"GET"})
     */
    public function getProveedor($id): Response
    {
        $proveedor = $this->getDoctrine()->getRepository(Proveedor::class)->find($id);

        return $this->render('proveedor/detalles.html.twig', ['proveedor' => $proveedor]);
    }

    /**
     * @Route("/proveedor/create", name="proveedor_create", methods={"GET","POST"})
     */
    public function createProveedor(Request $request): Response
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

    /**
     * @Route("/proveedor/{id}/update", name="proveedor_update", methods={"GET","POST"})
     */
    public function updateProveedor(Request $request, $id): Response{
        $proveedor = $this->getDoctrine()->getRepository(Proveedor::class)->find($id);
        $form = $this->createForm(Proveedor::class, $proveedor);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('proveedor_index');
        }

        return $this->render('proveedor/editar.html.twig', [
            'proveedor' => $proveedor,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/proveedor/{id}/delete", name="proveedor_delete", methods={"DELETE"})
     */
    public function deleteProveedor(Request $request, $id): Response{
        $proveedor = $this->getDoctrine()->getRepository(Proveedor::class)->find($id);
        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->remove($proveedor);
        $entityManager->flush();

        return $this->redirectToRoute('proveedor_index');
    }
}

