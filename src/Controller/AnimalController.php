<?php

namespace App\Controller;

use App\Form\Type\AnimalType;
use App\Entity\Animal;
use App\Entity\Color;
use App\Entity\Breed;
use Symfony\Component\Routing\Annotation\Route;     
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\HttpFoundation\RedirectResponse;

class AnimalController extends AbstractController
{
    /**
     * @Route("/animal/add", name="animal_add")
     */
    public function add(Request $request)
    {
        $animal = new Animal();

        $form = $this->createForm(AnimalType::class, $animal);

        if ($request->isMethod('POST'))
        {
            $form->submit($request->request->get($form->getName()));
    
            if ($form->isSubmitted() && $form->isValid())
            {
                $animal = $form->getData();
    
                $entityManager = $this->getDoctrine()->getManager();
                $entityManager->persist($animal);
                $entityManager->flush();

                return $this->redirectToRoute('app_homepage');
            }
        }

        return $this->render("animal/edit.html.twig", [ 'form' => $form->createView() ]);
    }

    /**
     * @Route("/animal/edit/{id}", name="animal_edit")
     */
    public function edit(Request $request, $id)
    {
        $animal = $this->getDoctrine()->getRepository(Animal::class)->find($id);

        if ($animal)
        {
            $form = $this->createForm(AnimalType::class, $animal);
            
            if ($request->isMethod('POST'))
            {
                $form->submit($request->request->get($form->getName()));
                
                if ($form->isSubmitted() && $form->isValid())
                {      
                    $entityManager = $this->getDoctrine()->getManager();

                    $animal = $form->getData();
                    $entityManager->flush();

                    return $this->redirectToRoute('app_homepage');
                }
            }

            return $this->render("animal/edit.html.twig", [ 'form' => $form->createView() ]);
        }

        throw $this->createNotFoundException();
    }

    /**
     * @Route("/", name="home")
     */
    public function index(Request $request)
    {
        return $this->redirectToRoute('app_homepage');
    }

    /**
     * @Route("/animals", name="animals")
     */
    public function animals(Request $request)
    {
        $animals = $this->getDoctrine()->getRepository(Animal::class)->findAll();
        return $this->render("animal/animals.html.twig", [ 'animals' => $animals ]);
    }

    /**
     * @Route("/animal/show/{id}", name="animal_show")
     */
    public function show(Request $request, $id)
    {
        $animal = $this->getDoctrine()->getRepository(Animal::class)->find($id);

        if ($animal)
            return $this->render("animal/info.html.twig", [ 'animal' => $animal ]);
        
        throw $this->createNotFoundException();
    }

    /**
     * @Route("/animal/delete/{id}", name="animal_delete")
     */
    public function delete(Request $request, $id)
    {
        $animal = $this->getDoctrine()->getRepository(Animal::class)->find($id);

        if ($animal)
        {
            $defaultData = ['id' => $animal->getId()];
            $form = $this->createFormBuilder($defaultData)
                ->add('id', HiddenType::class)
                ->add('delete', SubmitType::class, [ 'label' => 'Usuń' ])
                ->add('cancel', SubmitType::class, [ 'label' => 'Anuluj' ])
                ->getForm();

            $form->handleRequest($request);

            if ($form->isSubmitted() && $form->isValid())
            {
                if ($form->getClickedButton() === $form->get('delete'))
                {
                    $animal = $this->getDoctrine()->getRepository(Animal::class)->find($form->getData()["id"]);
                    $entityManager = $this->getDoctrine()->getManager();
                    $entityManager->remove($animal);
                    $entityManager->flush();
                }
                
                return $this->redirectToRoute('app_homepage');
            }

            return $this->render("animal/delete.html.twig",
                [
                    'animal' => $animal,
                    'form' => $form->createView()
                ]
            );
        }

        throw $this->createNotFoundException();
    }
}