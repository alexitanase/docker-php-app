#!/usr/bin/env php
<?php

error_reporting(E_ERROR);

// Path to the front controller (this file)
define('FCPATH', __DIR__ . DIRECTORY_SEPARATOR);

// Ensure the current directory is pointing to the front controller's directory
chdir(FCPATH);

/*
 *---------------------------------------------------------------
 * BOOTSTRAP THE APPLICATION
 *---------------------------------------------------------------
 * This process sets up the path constants, loads and registers
 * our autoloader, along with Composer's, loads our constants
 * and fires up an environment-specific bootstrapping.
 */

// Load our paths config file
// This is the line that might need to be changed, depending on your folder structure.
require FCPATH . 'app/Config/Paths.php';
// ^^^ Change this line if you move your application folder

$paths = new Config\Paths();

// Location of the framework bootstrap file.
require rtrim($paths->systemDirectory, '\\/ ') . DIRECTORY_SEPARATOR . 'bootstrap.php';

// Load environment settings from .env files into $_SERVER and $_ENV
require_once SYSTEMPATH . 'Config/DotEnv.php';
(new CodeIgniter\Config\DotEnv(ROOTPATH))->load();

use App\Libraries\Cron;

$cron = new Cron();

$val = getopt(null, [
    "command:",
    "start::",
    "end::"
]);

if(empty($val['command'])){
    exit;
}

$command = $val['command'];

$args = [];
if(isset($val['start'])) $args = [...$args,$val['start']];
if(isset($val['end'])) $args = [...$args,$val['end']];

if (method_exists($cron, $command)) {
    print("Executing cron::$command -> Arguments: ".implode(",", $args)."\n");
    call_user_func_array([$cron, $command], $args);
}