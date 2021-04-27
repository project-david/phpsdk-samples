<?php namespace Console;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Console\Command;

class UpdatePaylinkCommand extends Command
{
    
    public function configure()
    {
        $this -> setName('updatePaylink')
            -> setDescription('It updates the amount due for an existing paylink in the Gravity Legal system.')
            -> setHelp('This command allows you to update the amount due for an existing paylink in the Gravity Legal system');
    }

    public function execute(InputInterface $input, OutputInterface $output)
    {
        $this -> updateToPaylink($input, $output);
        return 0;
    }
}
