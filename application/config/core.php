<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Core Config File
 */

// Site Details
$config['site_version']          = "3.1.2";
$config['public_theme']          = "Default";
$config['private_theme']         = "Default";
$config['admin_theme']           = "Admin";

// header Details
$config['favicon']          = 'assets/img/favicon.ico';
$config['bootstrap_css']          = 'assets/bootstrap/css/bootstrap-flat.min.css';
$config['bootstrap_js']          = 'assets/bootstrap/js/bootstrap.min.js';
$config['fontawesome_css']          = 'assets/fa/css/font-awesome.min.css';
$config['jquery']          = 'assets/js/jquery-2.1.4.min.js';
$config['custom_css']          = 'assets/css/styles.css';

$config['site_title']          = 'Batichalan';
$config['keywords']          = 'lost, found, promote, sponsor, batichalan';
$config['description']          = '';


// Pagination
$config['num_links']             = 8;
$config['full_tag_open']         = "<div class=\"pagination\">";
$config['full_tag_close']        = "</div>";

// Miscellaneous
$config['profiler']              = FALSE;
$config['error_delimeter_left']  = "";
$config['error_delimeter_right'] = "<br />";
