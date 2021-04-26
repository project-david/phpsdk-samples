<?php namespace Console;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Console\Command;

class AddToPaylinkCommand extends Command
{
    
    public function configure()
    {
        $this -> setName('addToPaylink')
            -> setDescription('It adds amount due to an existing paylinkin the Gravity Legal system.')
            -> setHelp('This command allows you to add additional amount due to an existing paylink in the Gravity Legal system');
    }

    public function execute(InputInterface $input, OutputInterface $output)
    {
        $this -> addToPaylink($input, $output);
        return 0;
    }
}
