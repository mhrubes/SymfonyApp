<?php

namespace App\Tests\Command;

use Symfony\Bundle\FrameworkBundle\Console\Application;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Symfony\Component\Console\Tester\CommandTester;
use App\Command\GetUserCommand;

class GetUserCommandTest extends KernelTestCase
{
    public function testExecute(): void
    {
        $kernel = self::bootKernel();
        $application = new Application($kernel);

        $application->add(new GetUserCommand($kernel->getProjectDir(), $kernel->getContainer()->get('doctrine')->getManager()));

        $command = $application->find('app:get-user-command');
        $commandTester = new CommandTester($command);

        $commandTester->execute([]);

        $output = $commandTester->getDisplay();
        $this->assertStringContainsString('User ID:', $output);
        $this->assertStringContainsString('User Firstname:', $output);
        $this->assertStringContainsString('User Lastname:', $output);
        $this->assertStringContainsString('User Password:', $output);
        $this->assertStringContainsString('--------------------------------------------', $output);
    }
}
