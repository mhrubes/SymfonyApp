<?php

namespace App\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

use Doctrine\ORM\EntityManagerInterface;
use App\Entity\Userdata;

class GetUserCommand extends Command
{
    protected static $defaultName = 'app:get-user-command';

    public function __construct($projectDir, EntityManagerInterface $entityManager){
        $this->$projectDir = $projectDir;
        $this->entityManager = $entityManager;

        parent::__construct('app:get-user-command');
    }

    protected function configure() : void
    {
        $this->setDescription('Get User Command')
            ->setHelp('');
    }

    protected function execute(InputInterface $input, OutputInterface $output) : int
    {
        $repository = $this->entityManager->getRepository(Userdata::class);
        $dataFromDatabase = $repository->findAll();

        foreach ($dataFromDatabase as $userData) {
            $output->writeln('User ID: ' . $userData->getId());
            $output->writeln('User Firstname: ' . $userData->getFirstname());
            $output->writeln('User Lastname: ' . $userData->getLastname());
            $output->writeln('User Password: ' . $userData->getPassword());
            $output->writeln('--------------------------------------------');
        }

        return Command::SUCCESS;
    }
}
