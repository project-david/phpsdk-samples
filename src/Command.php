<?php namespace Console;
use Symfony\Component\Console\Command\Command as SymfonyCommand;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use GravityLegal\GravityLegalAPI\GravityLegalService;
use GravityLegal\GravityLegalAPI\ManualPayment;
use GravityLegal\GravityLegalAPI\Operating;
use GravityLegal\GravityLegalAPI\Statement;
use GravityLegal\GravityLegalAPI\Trust;
use GravityLegal\GravityLegalAPI\CreatePaylink;
use GravityLegal\GravityLegalAPI\CreateMatter;
use GravityLegal\GravityLegalAPI\Utility;

class Command extends SymfonyCommand
{
    public string $PRAHARI_BASE_URL='https://api.sandbox.gravity-legal.com/prahari/v1';
    public string $ENV_URL='https://api.sandbox.gravity-legal.com/pd/v1';
    public string $SYSTEM_TOKEN='eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJzaWQiOiJzYW5kYm94Iiwic3RpZCI6ImYzMDAyNmFmLTMxMjAtNDdmYy05MmRmLWFlNmMyZmEwMThiNSIsInRva2VuX3VzZSI6InN5c3RlbV90b2siLCJybmQiOjQ2NjQyNTEzMjEsImlhdCI6MTYwODY2NjI1MH0.-gtUMBkeIhdLilUJWiCgHWfROgCtWEcx_1gLlNWmVmo';
    public string $APP_ID='soluno';
    public string $ORG_ID='781ac60e-cff5-4971-8053-cddf5eec696f';
    public array $API_KEY;
    public GravityLegalService $gService;
    
    public function __construct()
    {
        parent::__construct();
        $this->setUp();
    }
    public function setUp(): void
    {
        $this->API_KEY = array('PRAHARI_BASE_URL' => $this->PRAHARI_BASE_URL,
                            'ENV_URL' => $this->ENV_URL,
                            'SYSTEM_TOKEN' => $this->SYSTEM_TOKEN,
                            'APP_ID' => $this->APP_ID,
                            'ORG_ID' => $this->ORG_ID );
        $this->gService = new GravityLegalService($this->API_KEY);
    }
    
    protected function makeManualPayment(InputInterface $input, OutputInterface $output)
    {
        // outputs multiple lines to the console (adding "\n" at the end of each line)
        $output -> writeln([
            '====**** Run Samples Console App ****====',
            '==========================================',
            '',
        ]);
        
        // outputs a message without adding a "\n" at the end of the line
        $output -> write($this -> getMakeManualPayment() .  PHP_EOL . $this->getMakeManualPaymentIndividualParam() . PHP_EOL);
    }

    protected function getMakeManualPayment()
    {
        $paylinkId = "87f6dd2e-d8b4-41dd-a609-3e36e414dce2";
        $manualPayment = new ManualPayment();
        $operating = new Operating();
        $operating->amountInCents = 300;
        $operating->bankAccountId = '5d846758-82c0-42ca-b0fe-bb163dd5386c';
        $manualPayment->operating = $operating;
        $manualPayment->paidBy = 'Manoj Srivastava';
        $manualPayment->payerEmail = 'manoj.srivastava+manualpaymentunittest@gmail.com';
        $manualPayment->sendReceiptEmail = true;
        $statement = new Statement();
        $statement->description = 'This is a manual payment for $3 to ops and $7 to trust.';
        $manualPayment->statement = $statement;
        $trust = new Trust();
        $trust->amountInCents = 700;
        $trust->bankAccountId = 'c2e7f2ef-d69e-4927-a48b-0a533f20abc4';
        $manualPayment->trust = $trust;
        $result = $this->gService->MakeManualPayment($paylinkId, $manualPayment);
        return "MakeManualPayment $3 to ops and $7 to trust result = $result";
    }
    protected function getMakeManualPaymentIndividualParam()
    {
        $returnStr = '';
        $result = $this->gService->MakeManualPaymentWithIndividualParams("87f6dd2e-d8b4-41dd-a609-3e36e414dce2", 3.00, 7.00, "Manual Payer",
            "manoj.srivastava+manualpaymentunittest@gmail.com", true, "This is a manual payment for $3 to ops and $7 to trust.");
        $returnStr = $returnStr . "MakeManualPayment $3 to ops and $7 to trust result = $result" . PHP_EOL;
       
        $result = $this->gService->MakeManualPaymentWithIndividualParams("87f6dd2e-d8b4-41dd-a609-3e36e414dce2", null, 10.00, "Null Operating",
            "manoj.srivastava+manualpaymentunittest@gmail.com", true, "This is a manual payment for $10 to trust.");

        $returnStr = $returnStr . "MakeManualPayment $10 to trust result = $result" . PHP_EOL;

        $result = $this->gService->MakeManualPaymentWithIndividualParams("87f6dd2e-d8b4-41dd-a609-3e36e414dce2", 10.00, null, "Null Trust",
            "manoj.srivastava+manualpaymentunittest@gmail.com", true, "This is a manual payment for $10 to opeerating.");

        $returnStr = $returnStr . "MakeManualPayment $10 to opeerating result = $result" . PHP_EOL;
        return $returnStr;
    }
    protected function initiateRefund(InputInterface $input, OutputInterface $output)
    {
        // outputs multiple lines to the console (adding "\n" at the end of each line)
        $output -> writeln([
            '====**** Run Samples Console App ****====',
            '==========================================',
            '',
        ]);
        
        // outputs a message without adding a "\n" at the end of the line
        $output -> write($this -> getInitiateRefund() .  PHP_EOL);
    }
    protected function getInitiateRefund()
    {
        $result = $this->gService->InitiateRefundForPaymentTxn("2becab6e-5b4d-47a9-9059-d857a540aaeb", 2.00, 0.05, "manoj.srivastava+initialRefund@gmail.com");
        return "Return value for InitiateRefundForPaymentTxn = $result";
    }
    protected function createPaylinkWithNewMatter(InputInterface $input, OutputInterface $output)
    {
        // outputs multiple lines to the console (adding "\n" at the end of each line)
        $output -> writeln([
            '====**** Run Samples Console App ****====',
            '==========================================',
            '',
        ]);
        
        // outputs a message without adding a "\n" at the end of the line
        $output -> write($this -> getCreatePaylinkWithNewMatter() .  PHP_EOL);
    }
    protected function getCreatePaylinkWithNewMatter()
    {
        $createPaylink = new CreatePaylink();
        $createMatter = new CreateMatter();
        $operating = new Operating();
        $operating->amount = 10000;
        $trust = new Trust();
        $trust->amount = 20000;
        $createPaylink->customer = "bf193ce3-f54f-40d4-b3e6-da5de83be0be";
        $createPaylink->client = "896d9358-a48d-45ec-946b-6a0357f10afa";
        $createPaylink->externalId = Utility::GUIDv4();
        $createPaylink->operating = $operating;
        $createPaylink->trust = $trust;

        $createMatter->client = 'be086b90-4b15-4c5d-a20b-bcb0821ec522';
        $createMatter->externalId = Utility::GUIDv4();
        $createMatter->name = 'Test Matter ' . $createMatter->externalId;
        $createMatter->status = 'Draft';
        $createMatter->secondClient = '3c41adcc-dd57-464d-987c-245d324e6d2b';

        $paylinkInfo = $this->gService->CreateNewPaylinkWithMatter($createPaylink, $createMatter);
        $result = 'Created Paylink Info: ' . PHP_EOL . json_encode($paylinkInfo) . PHP_EOL;
        $deletionResult = $this->gService->DeletePaylink($paylinkInfo->id);
        $result = $result . "DeletePaylink result = $deletionResult" . PHP_EOL;
        return $result;
    }
    protected function addToPaylink(InputInterface $input, OutputInterface $output)
    {
        // outputs multiple lines to the console (adding "\n" at the end of each line)
        $output -> writeln([
            '====**** Run Samples Console App ****====',
            '==========================================',
            '',
        ]);
        
        // outputs a message without adding a "\n" at the end of the line
        $output -> write($this -> getAddToPaylink() .  PHP_EOL);
    }
    protected function getAddToPaylink()
    {
        $paylink = $this->gService->GetPaylink("87f6dd2e-d8b4-41dd-a609-3e36e414dce2");
        $result = 'Paylink: ' . PHP_EOL . json_encode($paylink) . PHP_EOL;
        $initialBalance = (float)$paylink->balance->totalOutstanding/100;
        $result = $result . 'Paylink Initial Balance : ' . $initialBalance . PHP_EOL;
        $restResponse = $this->gService->AddToPaylink($paylink, 10.00, 20.00);
        $paylink = $this->gService->GetPaylink("87f6dd2e-d8b4-41dd-a609-3e36e414dce2");
        $result = $result . 'Balance After AddToPaylink: ' . (float) $paylink->balance->totalOutstanding / 100 . PHP_EOL;
        return $result;
    }
    protected function updateToPaylink(InputInterface $input, OutputInterface $output)
    {
        // outputs multiple lines to the console (adding "\n" at the end of each line)
        $output -> writeln([
            '====**** Run Samples Console App ****====',
            '==========================================',
            '',
        ]);
        
        // outputs a message without adding a "\n" at the end of the line
        $output -> write($this -> getUpdatePaylink() .  PHP_EOL);
    }
    protected function getUpdatePaylink()
    {
        $paylink = $this->gService->GetPaylink("87f6dd2e-d8b4-41dd-a609-3e36e414dce2");
        $result = 'Paylink: ' . PHP_EOL . json_encode($paylink) . PHP_EOL;
        $initialBalance = (float)$paylink->balance->totalOutstanding/100;
        $result = $result . 'Paylink Initial Balance : ' . $initialBalance . PHP_EOL;
        $restResponse = $this->gService->UpdatePaylink($paylink, 1000.00, 2000.00);
        $paylink = $this->gService->GetPaylink("87f6dd2e-d8b4-41dd-a609-3e36e414dce2");
        $result = $result . 'Balance After UpdatePaylink: ' . (float) $paylink->balance->totalOutstanding / 100 . PHP_EOL;
        return $result;
    }

}