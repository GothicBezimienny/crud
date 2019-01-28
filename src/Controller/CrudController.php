<?php


namespace App\Controller;

use App\Form\UserType;
use App\Entity\User;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityRepository;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class CrudController extends ApiController
{
    /**
    * @Route("/", name="list")	
	* Method({"GET"})
    */
    public function indexAction(UserRepository $userRepository)
    {
        $users = $userRepository->transformAll();
		return $this->render('base.html.twig',array(
                'users' => $users,
                ));
    }

	/**
    * @Route("/show/{id}")
	* Method({"GET"})
    */
    public function showAction($id, UserRepository $userRepository)
    {
        $user = $userRepository->transformOne($id);
		return $this->render('user.html.twig',array(
                'user' => $user[0],
                ));
    }
	
	
    /**
     * @Route("/edit/{id}")     
	 * Method({"GET", "POST"})
     */
    public function editAction($id,  Request $request, UserRepository $userRepository) {
      $user = new User();
      $user = $this->getDoctrine()->getRepository(User::class)->find($id);
	  $form = $this->createForm(UserType::class,$user);
	  
      $form->handleRequest($request);
      if($form->isSubmitted() && $form->isValid()) {
        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->flush();
        return $this->redirectToRoute('list');
      }
      return $this->render('edit.html.twig', array(
        'form' => $form->createView()
      ));
    }
	
	/**
     * @Route("/add")
     * Method({"GET", "POST"})
     */
    public function new(Request $request) {
		$user = new User();
		$form = $this->createForm(UserType::class);
		$form->handleRequest($request);
		if($form->isSubmitted() && $form->isValid()) {
			$user = $form->getData();
			$entityManager = $this->getDoctrine()->getManager();
			$entityManager->persist($user);
			$entityManager->flush();
			return $this->redirectToRoute('list');
		}
      return $this->render('add.html.twig', array(
        'form' => $form->createView()
      ));
    }

	
    /**
     * @Route("/delete/{id}")
     * @Method({"DELETE"})
     */
    public function delete(UserRepository $userRepository, Request $request, $id) {
		$entityManager = $this->getDoctrine()->getManager();
		$user = $entityManager->getRepository(User::class)->find($id);
		$entityManager->remove($user);
		$entityManager->flush();
		return $this->respond($user);
    }

}

