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

    #[Route('/change-locale/{locale}', name: 'change_locale')]
    public function changeLocale(string $locale, Request $request): Response
    {
        $request->getSession()->set('_locale', $locale);
        return $this->redirectToRoute('app_data_page');
    }

    // Route na Načtení Seznamu
    #[Route('/datapage', methods: ['GET'], name: 'app_data_page')]
    public function index(): Response
    {
        return $this->render('userpage/index.html.twig', [
            'userList' => $this->userRepository->findAll()
        ]);
    }

    // Route na Vytvoření
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

    // Route na Úpravu
    #[Route('/datapage/edit/{id}', name: 'edit_user')]
    public function edit($id, Request $request): Response
    {
        $user = $this->userRepository->find($id);
        $form = $this->createForm(UserFormType::class, $user);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) { 
            $user->setFirstname($form->get('firstname')->getData());
            $user->setLastname($form->get('lastname')->getData());
            $user->setPassword($form->get('password')->getData());

            $this->em->flush();
            return $this->redirectToRoute('app_data_page');
        }

        return $this->render('userpage/edit.html.twig', [
            'user' => $user,
            'form' => $form->createView()
        ]);
    }

    // Route na Smazání
    #[Route('/datapage/delete/{id}', methods: ['GET', 'DELETE'], name: 'delete_user')]
    public function delete($id): Response
    {
        try {
            $user = $this->userRepository->find($id);
            $this->em->remove($user);
            $this->em->flush();
        } catch (\Throwable $th) {
        }

        return $this->redirectToRoute('app_data_page');
    }

    // Route na Detail
    #[Route('/datapage/{id}', methods: ['GET'], name: 'app_data_page_show')]
    public function show($id): Response
    {
        $user = $this->userRepository->find($id);

        return $this->render('userpage/show.html.twig', [
            'user' => $user
        ]);
    }
}
