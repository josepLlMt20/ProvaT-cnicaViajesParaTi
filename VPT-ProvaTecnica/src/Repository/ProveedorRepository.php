<?php
// src/Repository/ProveedorRepository.php
namespace App\Repository;

use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use App\Entity\Proveedor;

class ProveedorRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Proveedor::class);
    }

    public function getProveedorById($id)
    {
        return $this->getEntityManager()
            ->createQuery(
                'SELECT p
                FROM App\Entity\Proveedor p
                WHERE p.id = :id'
            )
            ->setParameter('id', $id)
            ->getSingleResult();
    }

    public function getProveedores()
    {
        return $this->getEntityManager()
            ->createQuery(
                'SELECT p
                FROM App\Entity\Proveedor p'
            )
            ->getResult();
    }

    public function createProveedor($proveedor)
    {
        $entityManager = $this->getEntityManager();
        $entityManager->persist($proveedor);
        $entityManager->flush();
    }

    public function updateProveedor($proveedor)
    {
        $entityManager = $this->getEntityManager();
        $entityManager->persist($proveedor);
        $entityManager->flush();
    }

    public function deleteProveedor($proveedor)
    {
        $entityManager = $this->getEntityManager();
        $entityManager->remove($proveedor);
        $entityManager->flush();
    }

    public function getProveedoresActivos()
    {
        return $this->getEntityManager()
            ->createQuery(
                'SELECT p
                FROM App\Entity\Proveedor p
                WHERE p.activo = 1'
            )
            ->getResult();
    }

    public function getProveedoresInactivos()
    {
        return $this->getEntityManager()
            ->createQuery(
                'SELECT p
                FROM App\Entity\Proveedor p
                WHERE p.activo = 0'
            )
            ->getResult();
    }

    public function getProveedoresPorTipo($tipo)
    {
        return $this->getEntityManager()
            ->createQuery(
                'SELECT p
                FROM App\Entity\Proveedor p
                WHERE p.tipo = :tipo'
            )
            ->setParameter('tipo', $tipo)
            ->getResult();
    }

    public function getProveedoresPorNombre($nombre)
    {
        return $this->getEntityManager()
            ->createQuery(
                'SELECT p
                FROM App\Entity\Proveedor p
                WHERE p.nombre = :nombre'
            )
            ->setParameter('nombre', $nombre)
            ->getResult();
    }

    public function getProveedoresPorCorreo($correo)
    {
        return $this->getEntityManager()
            ->createQuery(
                'SELECT p
                FROM App\Entity\Proveedor p
                WHERE p.correoElectronico = :correo'
            )
            ->setParameter('correo', $correo)
            ->getResult();
    }

    public function getProveedoresPorTelefono($telefono)
    {
        return $this->getEntityManager()
            ->createQuery(
                'SELECT p
                FROM App\Entity\Proveedor p
                WHERE p.telefono = :telefono'
            )
            ->setParameter('telefono', $telefono)
            ->getResult();
    }

    

    





}


?>