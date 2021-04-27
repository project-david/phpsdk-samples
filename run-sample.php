#!/usr/bin/env php
<?php

require_once __DIR__ . '/vendor/autoload.php';

use Console\AddToPaylinkCommand;
use Console\InitiateRefundCommand;
use Console\MakeManualPaymentCommand;
use Symfony\Component\Console\Application;
use Console\TimeCommand;
use Console\CreatePaylinkWithNewMatterCommand;
use Console\UpdatePaylinkCommand;

$app = new Application('run-sample App', 'v1.0.0');
$app -> add(new MakeManualPaymentCommand());
$app->add(new InitiateRefundCommand());
$app->add(new CreatePaylinkWithNewMatterCommand());
$app->add(new AddToPaylinkCommand());
$app->add(new UpdatePaylinkCommand());
$app -> run();

