<?php

namespace App\EventSubscriber;

use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpKernel\Event\RequestEvent;
use Symfony\Component\Console\Application;
use Symfony\Component\Console\Input\ArrayInput;
use Symfony\Component\Console\Output\BufferedOutput;
use Symfony\Bundle\FrameworkBundle\Console\Application as SymfonyApplication;
use Symfony\Component\HttpKernel\KernelInterface;

class RunTestsOnStartupSubscriber implements EventSubscriberInterface
{
    private $kernel;

    public function __construct(KernelInterface $kernel)
    {
        $this->kernel = $kernel;
    }

    public function onKernelRequest(RequestEvent $event)
    {
        // Ne pas exécuter les tests sur chaque requête, juste la première fois
        static $testsExecuted = false;
        if ($testsExecuted) {
            return;
        }

        $testsExecuted = true;

        // Exécuter la commande app:run-tests
        $application = new SymfonyApplication($this->kernel);
        $application->setAutoExit(false);

        $input = new ArrayInput(['command' => 'app:run-tests']);
        $output = new BufferedOutput();
        $application->run($input, $output);

        file_put_contents('php://stdout', $output->fetch());
    }

    public static function getSubscribedEvents(): array
    {
        return [
            'kernel.request' => 'onKernelRequest',
        ];
    }
}
