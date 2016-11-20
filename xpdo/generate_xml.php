<?php

ini_set('display_errors', 1);
error_reporting(E_ALL);

use \xPDO\xPDO;

// setup the autoloading
require_once __DIR__ . '/../vendor/autoload.php';

//config
require_once __DIR__ . '/../config.php';

$debug = false;         // if true, will include verbose debugging info, including SQL errors.
$verbose = true;        // if true, will print status info.
$regenerate_schema = true;
 
// Class files are not overwritten by default
$regenerate_classes = true;
 
// Your package shortname:
$package_name = 'bookstore';
$table_prefix = '';
$restrict_prefix = false;

// A few definitions of files/folders:
$package_dir = __DIR__ . "/model/$package_name/";
$model_dir = __DIR__ . "/model/$package_name/model/";
$class_dir = __DIR__ . "/model/$package_name/model/$package_name";
$schema_dir = __DIR__ . "/model/$package_name/model/schema";
$mysql_class_dir = __DIR__ . "/model/$package_name/model/$package_name/mysql";
$xml_schema_file = __DIR__ . "/model/$package_name/model/schema/$package_name.mysql.schema.xml";

// A few variables used to track execution times.
$mtime = microtime();
$mtime = explode(' ', $mtime);
$mtime = $mtime[1] + $mtime[0];
$tstart = $mtime;

// Create directories if necessary
$dirs = array($package_dir, $schema_dir, $mysql_class_dir, $class_dir);
 
foreach ($dirs as $d) {
    if (!file_exists($d)) {
        if (!mkdir($d, 0777, true)) {
            print_msg(sprintf('<h1>Reverse Engineering Error</h1>
                                <p>Error creating <code>%s</code></p>
                                <p>Create the directory (and its parents) and try again.</p>'
                            , $d
            ));
            exit;
        }
    }
    if (!is_writable($d)) {
        print_msg(sprintf('<h1>Reverse Engineering Error</h1>
                        <p>The <code>%s</code> directory is not writable by PHP.</p>
                        <p>Adjust the permissions and try again.</p>'
                        , $d));
        exit;
    }
}

$xpdo = \xPDO\xPDO::getInstance('aMySQLDatabase', [
    \xPDO\xPDO::OPT_CACHE_PATH => __DIR__ . '/xpdo/cache/',
    \xPDO\xPDO::OPT_HYDRATE_FIELDS => true,
    \xPDO\xPDO::OPT_HYDRATE_RELATED_OBJECTS => true,
    \xPDO\xPDO::OPT_HYDRATE_ADHOC_FIELDS => true,
    \xPDO\xPDO::OPT_CONNECTIONS => [
        [
            'dsn' => 'mysql:host=' . $config['db']['host'] . ';dbname=' . $config['db']['dbname'] . ';charset=utf8',
            'username' => $config['db']['username'],
            'password' => $config['db']['password'],
            'options' => [
                \xPDO\xPDO::OPT_CONN_MUTABLE => true,
            ],
            'driverOptions' => [],
        ],
    ],
]);

// Set the package name and root path of that package
$xpdo->setPackage($package_name, $package_dir, $package_dir);
$xpdo->setDebug($debug);

$manager = $xpdo->getManager();
$generator = $manager->getGenerator();
$time = time();
//Use this to create an XML schema from an existing database
if ($regenerate_schema) {
    if (is_file($xml_schema_file)) {
        $rename = $xml_schema_file . '-' . $time;
        print_msg("<br>The old XML schema file: <br><code>{$xml_schema_file}</code> <br>has been renamed to <br><code>{$rename}</code>.");
        rename($xml_schema_file, $rename);
    }
    $xml = $generator->writeSchema($xml_schema_file, $package_name, 'xPDOObject', $table_prefix, $restrict_prefix);
    if ($verbose) {
        print_msg(sprintf('<br><strong>Ok:</strong> XML schema file generated: <code>%s</code><hr>', $xml_schema_file));
    }
}

// Use this to generate classes and maps from your schema
if ($regenerate_classes) {
    if (is_dir($class_dir)) {
        $rename = $class_dir . '-' . $time;
        print_msg("<br>The old class dir: <br><code>{$class_dir}</code> <br>has been renamed to <br><code>{$rename}</code>.");
        rename($class_dir, $rename);
    }
    $generator->parseSchema($xml_schema_file, $model_dir);
}

$mtime = microtime();
$mtime = explode(" ", $mtime);
$mtime = $mtime[1] + $mtime[0];
$tend = $mtime;
$totalTime = ($tend - $tstart);
$totalTime = sprintf("%2.4f s", $totalTime);

function print_msg($msg) {
    if (php_sapi_name() == 'cli') {
        $msg = preg_replace('#<br\s*>#i', "\n", $msg);
        $msg = preg_replace('#<h1>#i', '== ', $msg);
        $msg = preg_replace('#</h1>#i', ' ==', $msg);
        $msg = preg_replace('#<h2>#i', '=== ', $msg);
        $msg = preg_replace('#</h2>#i', ' ===', $msg);
        $msg = strip_tags($msg) . "\n";
    }
    print $msg;
}

echo "<br><br><strong>Finished!</strong> Execution time: {$totalTime}<br>";
