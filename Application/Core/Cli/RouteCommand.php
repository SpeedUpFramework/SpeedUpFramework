<?php
namespace Core\Cli;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Services\ReservedWords;

class RouteCommand extends Command
{
    private $routeName;
    private $methods;

    protected function configure()
    {
        $this
            ->setName('generate:route')
            ->setDescription('Creer une route')
            ->addArgument(
                'routeName',
                InputArgument::REQUIRED,
                'Quel nom désirez vous pour votre route?'
            )
            ->addArgument(
                'methods',
                InputArgument::REQUIRED,
                'Vers quel controller et méthode redirige votre route ex. (Controller@methode)? Sans namespace'
            )
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $this->RouteName = $input->getArgument('routeName');
        $this->methods = $input->getArgument('methods');

        $error = null;
        if (in_array($this->RouteName, ReservedWords::getList())) {
            $output->writeln("<error>La route ne peux pas avoir un nom réservé à php</>");
            $error = true;
        }

        if (in_array($this->methods, ReservedWords::getList())) {
                    $output->writeln("<error>La méthode ($method) ne peux pas avoir un nom réservé</>");
                    $error = true;
                }



        if ($error == true) {
            exit;
        }


        $this->makeRoutes();

        $output->writeln("<info>La route ".$this->RouteName." Crée </>");
    }


    public function makeRoutes()
    {

        $methods ="\$router->get('".strtolower($this->RouteName)."', 'Controllers\\".ucwords($this->methods)."');\n";


            $file = file_get_contents("Application/Core/routes.php");
            $file = str_replace("/** Fin routes */", "$methods/** Fin routes */", $file);
            file_put_contents("Application/Core/routes.php", $file);

    }


}
