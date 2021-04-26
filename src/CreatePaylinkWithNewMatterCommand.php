<?php namespace Console;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Console\Command;

class CreatePaylinkWithNewMatterCommand extends Command
{
    
    public function configure()
    {
        $this -> setName('createPaylinkWithNewMatter')
            -> setDescription('It creates a new paylink associated with a matter in the Gravity Legal system.')
            -> setHelp('This command allows you to create a new paylink associated with a matter in the Gravity Legal system');
    }

    public function execute(InputInterface $input, OutputInterface $output)
    {
        $this -> createPaylinkWithNewMatter($input, $output);
        return 0;
    }
}
