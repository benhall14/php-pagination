<?php

// either 'require' the class or use autoload
require 'vendor/autoload.php';

// set namespace
use benhall14\PHPPagination\Pagination as Pagination;

// add bootstrap css
echo '<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">';

// instaniate the class
$pagination = new Pagination();

// set the config options and output
$pagination->total(100)->output();
