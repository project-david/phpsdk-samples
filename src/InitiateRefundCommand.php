<?php namespace Console;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Console\Command;

class InitiateRefundCommand extends Command
{
    
    public function configure()
    {
        $this -> setName('initiateRefund')
            -> setDescription('It initiates a refund process in the Gravity Legal system.')
            -> setHelp('This command allows you to initiate a refund process in Gravity Legal system');
    }

    public function execute(InputInterface $input, OutputInterface $output)
    {
        $this -> initiateRefund($input, $output);
        return 0;
    }
}
