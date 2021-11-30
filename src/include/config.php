<?php
/**
 * Configuration File. 
 * @author Vlachopoulos Dimitrios
 * @since v1.0.0.0
 */


// DATABASE CONFIGURATION
define('HOST', 'localhost');
define('USERNAME', 'root');
define('PASSWORD', '');
define('DATABASE', 'vaccation_portal');
define('PORT', '3306');
define('COLLATE', 'utf8');
define('DNS', 'mysql:dbname=' . DATABASE . ';host=' . HOST . ';charset=' . COLLATE . ';port=' . PORT);

// BASIC DEFINE
define('SITE_URL', 'https://vacation_portal.test');
define('APP_SITE', dirname(__DIR__,1) . "/");

// SECUTIRY
define('SALT', '1522a89c9d4e35043ac072439dd14bf6aa84f201f1325b497cc51235de6aeb63052ee25ddf0c0f64c32dbfee18e8f926234f54426a3561ab0fcaddd5d2a87ad8');


