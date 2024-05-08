<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface;

use App\Entity\Proveedor;
use App\Form\ProveedorType;
use App\Repository\ProveedorRepository;

class ProveedorController extends AbstractController
{

    private $em;
    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }

    /**
     * @Route("/", name="homepage")
     */
    public function index(): Response
    {
        $proveedores = $this->getDoctrine()->getRepository(Proveedor::class)->findAll();

        return $this->render('proveedor/index.html.twig', ['proveedores' => $proveedores]);
    }
    
    /**
     * @Route("/proveedor/create", name="proveedor_create", methods={"POST"})
     */
    public function nuevoProveedor(Request $request): Response
    {
        // $proveedor = new Proveedor();
        $form = $this->createForm(ProveedorType::class);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $proveedor = $form->getData();
            $this->em->persist($proveedor);
            $this->em->flush();
            return $this->redirectToRoute('homepage');
        }

        return $this->render('proveedor/nuevo.html.twig', [
            'form' => $form->createView()

        ]);
    }

    /**
     * @Route("/proveedor/detalles/{id}", name="proveedor_detalles", methods={"GET"})
     */
    public function detallesProveedor($id): Response
    {
        $proveedor = $this->getDoctrine()->getRepository(Proveedor::class)->find($id);

        if (!$proveedor) {
            throw $this->createNotFoundException('No se encontró ningún usuario con el ID: '.$id);
        }

        return $this->render('proveedor/detalles.html.twig', [
            'proveedor' => $proveedor,
        ]);
    }

    /**
     * @Route("/proveedor/{id}/update", name="proveedor_update", methods={"GET","POST"})
     */
    public function actualizarProveedor(Request $request, $id): Response{
        $proveedor = $this->getDoctrine()->getRepository(Proveedor::class)->find($id);
        $form = $this->createForm(ProveedorType::class, $proveedor);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $proveedor = $form->getData();
            $proveedor->setActualizadoEn(new \DateTime());
            $this->em->flush($proveedor);
            return $this->redirectToRoute('homepage');
        }

        return $this->render('proveedor/actualizar.html.twig', [
            'proveedor' => $proveedor,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/proveedor/{id}/delete", name="proveedor_delete", methods={"DELETE"})
     */
    public function borrarProveedor(Request $request, $id): Response{
        $proveedor = $this->getDoctrine()->getRepository(Proveedor::class)->find($id);
        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->remove($proveedor);
        $entityManager->flush();

        return $this->redirectToRoute('homepage');
    }
}

