<?php

/*
Author : Yonis Ismail
Title : To-do list application
Last modified : 04/04/2022
Task : Add or link create button
*/

namespace App\Controller;

use App\Entity\Crud;
use App\Form\CrudType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\Bundle\DoctrineBundle\Registry;
use Doctrine\Persistence\ManagerRegistry;
use Doctrine\ORM\EntityManager;
use Doctrine\Persistence\ManagerRegistry as PersistenceManagerRegistry;
use Doctrine\ORM\Tools\Console\ConsoleRunner;


class MainController extends AbstractController
{
    
    #[Route('/main', name: 'app_main')]
    public function index(ManagerRegistry $doctrine): Response
    {
        $data = $doctrine->getRepository(Crud::class)->findAll();
        return $this->render('main/index.html.twig', [
            'list' => $data
        ]);
    }



    ## Create function where data will be added to the database through user input
    #[Route('/create', name: 'create')]
    public function create(Request $request, ManagerRegistry $doctrine){
        $crud = new Crud();
        $form = $this->createForm(CrudType::class, $crud);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            $em = $doctrine->getManager();
            $em->persist($crud);
            $em->flush();
            
            // If user inputted in data successfully
            $this->addFlash('notice','Submitted Successfully');

            return $this->redirectToRoute('app_main');
        }
        return $this->render('main/create.html.twig', [
            'form' => $form->createView()
        ]);
    }

    # Update function where user can modify the data in the database.
    #[Route('/update/{id}', name: 'update')]
    public function update(Request $request, $id, ManagerRegistry $doctrine){
        $crud = $doctrine->getRepository(Crud::class)->find($id);
        $form = $this->createForm(CrudType::class, $crud);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            $em = $doctrine->getManager();
            $em->persist($crud);
            $em->flush();
            
            // If user inputted in data successfully
            $this->addFlash('notice',"Submitted Successfully");

            return $this->redirectToRoute('app_main');
        }
        return $this->render('main/update.html.twig', [
            'form' => $form->createView()
        ]);

    }
    # Delete function where user can delete data such as a task that they have finished
    #[Route('/delete/{id}', name: 'delete')]
    public function delete($id, ManagerRegistry $doctrine){
        $data = $doctrine->getRepository(Crud::class)->find($id);
        $em = $doctrine->getManager();
        $em->remove($data);
        $em->flush();

        # Data is deleted succesfully
        $this->addFlash('notice', "Deleted successfully");

        return $this->redirecttoRoute('app_main');
    }
}
