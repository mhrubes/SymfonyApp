<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Attribute\Route;
use Doctrine\ORM\EntityManagerInterface;

use App\Repository\UserdataRepository;
use App\Entity\Userdata;
use App\Form\UserFormType;

class UserController extends AbstractController
{
    private $em;
    private $userRepository;
    public function __construct(UserdataRepository $userdataRepository, EntityManagerInterface $em) {
        $this->userRepository = $userdataRepository;
        $this->em = $em;
    }

    #[Route('/datapage', methods: ['GET'], name: 'app_data_page')]
    public function index(): Response
    {
        return $this->render('userpage/index.html.twig', [
            'userList' => $this->userRepository->findAll()
        ]);
    }

    #[Route('/datapage/create', name: 'create_user')]
    public function create(Request $request): Response
    {
        $user = new UserData();
        $form = $this->createForm(UserFormType::class, $user);

        $form->handleRequest($request);        
        if ($form->isSubmitted() && $form->isValid()) { 
            $newUser = $form->getData();

            $this->em->persist($newUser);
            $this->em->flush();

            return $this->redirectToRoute('app_data_page');
        }

        return $this->render('userpage/create.html.twig', [
            'form' => $form->createView()
        ]);
    }

    #[Route('/datapage/{id}', methods: ['GET'], name: 'app_data_page_show')]
    public function show($id): Response
    {
        $user = $this->userRepository->find($id);

        return $this->render('userpage/show.html.twig', [
            'user' => $user
        ]);
    }
}
