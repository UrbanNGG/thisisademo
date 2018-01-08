<?php
session_start();
error_reporting(E_ALL);
$main_directory = $_SERVER['DOCUMENT_ROOT']."/cpv2";
if(!isset($p))
{
	header("Location: ./index.php?p=dashboard"); exit;
}
$directory = new RecursiveDirectoryIterator($main_directory."/includes/classes");
foreach($directory as $file_name)
{
  if(!strpos($file_name, "/.") && strpos($file_name, '.php'))
  {
    if(file_exists($file_name))
    {
      include($file_name);
    }
  }
}


$dsn = 'mysql:dbname=ngg_main;host=localhost';
$user = 'root';
$password = '$Josh&Niko^18';

try {
    $odb = new PDO($dsn, $user, $password);
    $odb->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo 'Connection failed: ' . $e->getMessage();
}
// Set up server which stores all classes
$server = new Server;
// Core includes everything from cp_settings table
$server->set('core', new Core($odb));
$root = $server->get("core")->setting("root");
$default_page = $server->get("core")->setting("default_page");
$default_page_admin = $server->get("core")->setting("default_page_admin");
$default_template = $server->get("core")->setting("default_template");
$admin_index_directory = $server->get('core')->setting('admin_index_directory');

/* Classes Needed for Page Verification */
// IF SESSION CHECKS ONLY
$server->set("page", new Page($odb, $p));
$page_permissions = $server->get('page')->pagePerms();
//$server->set('user_init', new User($odb, "Tyrone_Honest"));
//$server->set('user_profile', new Profile($server->get('user_init')));
