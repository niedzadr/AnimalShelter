<?php

namespace App\Controller;

use App\Entity\Breed;
use App\Form\Type\BreedType;
use Symfony\Component\Routing\Annotation\Route;     
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\HttpFoundation\RedirectResponse;

class BreedController extends AbstractController
{
    /**
     * @Route("/breed", name="breed")
     */
    public function breed(Request $request)
    {
        $breed = new Breed();
        $form = $this->createForm(BreedType::class, $breed);

        if ($request->isMethod('POST'))
        {
            $form->submit($request->request->get($form->getName()));
    
            if ($form->isSubmitted() && $form->isValid())
            {
                $data = $form->getData();
    
                $entityManager = $this->getDoctrine()->getManager();
                $entityManager->persist($data);
                $entityManager->flush();

                return $this->redirectToRoute('breed');
            }
        }

        $breeds = $this->getDoctrine()->getRepository(Breed::class)->findAll();
        return $this->render("breed/list.html.twig", [ 'breeds' => $breeds, 'form' => $form->createView() ]);
    }
    
    /**
     * @Route("/breed/{id}", name="breed_edit")
     */
    public function edit(Request $request, $id)
    {
        $breed = $this->getDoctrine()->getRepository(Breed::class)->find($id);
        
        if ($breed)
        {
            $form = $this->createForm(BreedType::class, $breed);

            if ($request->isMethod('POST'))
            {
                $form->submit($request->request->get($form->getName()));
        
                if ($form->isSubmitted() && $form->isValid())
                {
                    $data = $form->getData();
        
                    $entityManager = $this->getDoctrine()->getManager();
                    $breed = $data;
                    $entityManager->flush();

                    return $this->redirectToRoute('breed');
                }
            }

            $breeds = $this->getDoctrine()->getRepository(Breed::class)->findAll();
            return $this->render("breed/list.html.twig", [ 'breeds' => $breeds, 'form' => $form->createView() ]);
        }
        
        throw $this->createNotFoundException();
    }

    /**
     * @Route("/breed/delete/{id}", name="breed_delete")
     */
    public function delete(Request $request, $id)
    {
        $breed = $this->getDoctrine()->getRepository(Breed::class)->find($id);

        if ($breed)
        {
            $count = count($breed->getAnimals());

            $defaultData = ['id' => $breed->getId()];
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
                    $breed = $this->getDoctrine()->getRepository(Breed::class)->find($form->getData()["id"]);
                    $entityManager = $this->getDoctrine()->getManager();
                    $entityManager->remove($breed);
                    $entityManager->flush();
                }
                
                return $this->redirectToRoute('breed');
            }

            return $this->render("breed/delete.html.twig",
                [
                    'breed' => $breed,
                    'count' => $count,
                    'form' => $form->createView()
                ]
            );
        }
        
        throw $this->createNotFoundException();
    }
}