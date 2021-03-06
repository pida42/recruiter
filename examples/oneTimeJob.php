#!/usr/bin/env php
<?php

require __DIR__ . '/../vendor/autoload.php';

use Recruiter\Recruiter;
use Recruiter\Factory;
use Recruiter\Workable\LazyBones;
use Recruiter\Worker;

$factory = new Factory();
$db = $factory->getMongoDb(
    $hosts = 'localhost:27017',
    $options = [],
    $dbName = 'recruiter'
);
$db->drop();

$recruiter = new Recruiter($db);

LazyBones::waitForMs(200, 100)
    ->asJobOf($recruiter)
    ->inBackground()
    ->execute();

$worker = $recruiter->hire();
$assignments = $recruiter->assignJobsToWorkers();
$worker->work();
