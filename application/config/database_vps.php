<?php
defined('BASEPATH') OR exit('No direct script access allowed');

// Template database config untuk VPS
// Rename file ini menjadi database.php setelah edit

$active_group = 'default';
$query_builder = TRUE;

$db['default'] = array(
	'dsn'	=> '',
	'hostname' => 'localhost', // Ganti dengan hostname database VPS
	'username' => 'your_db_user', // Ganti dengan username database VPS
	'password' => 'your_db_pass', // Ganti dengan password database VPS
	'database' => 'your_db_name', // Ganti dengan nama database VPS
	'dbdriver' => 'mysqli',
	'dbprefix' => '',
	'pconnect' => FALSE,
	'db_debug' => FALSE, // Set FALSE untuk production
	'cache_on' => FALSE,
	'cachedir' => '',
	'char_set' => 'utf8',
	'dbcollat' => 'utf8_general_ci',
	'swap_pre' => '',
	'encrypt' => FALSE,
	'compress' => FALSE,
	'stricton' => FALSE,
	'failover' => array(),
	'save_queries' => FALSE // Set FALSE untuk production
);