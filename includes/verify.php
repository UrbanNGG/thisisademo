<?php

// Included on index
// 1) check $_SESSION['logged_in'] if fail -> login.php
// 2) if has $_SESSION['logged_in'] check session id with DB, if session is active then set
// $_SESSION['username'] = 'SESSION USERNAME', if not set, -> login.php
// 3) If session not expired set user objects and update the session to time + 30 minutes
// BAN CHECK???

$server->set("session", new Session($odb, $_SESSION['username']));

$page_admin = $server->get("page")->pagePerms('admin_level');
$page_advisor = $server->get("page")->pagePerms('advisor_level');
$page_groups = $server->get("page")->pagePerms('group_types');

if($server->get('session')->session_exists && $server->get('session')->sessionMatch())
{
	$server->set('user_init', new User($odb, $_SESSION['username']));
	$server->set('user_profile', new Profile($server->get('user_init')));
	$server->set('permissions', new Permissions($server->get('user_init')));
	$server->get('session')->renew_session();
}
else {
	$server->get('session')->destroy_session();
	header("Location: ./login.php");
}

$verify_admin_rank = $server->get("user_profile")->returnInfo('AdminLevel');
$verify_group_id = $server->get("user_profile")->returnInfo('Member');
$verify_advisor_rank = $server->get("user_profile")->returnInfo('Helper');
$verify_group_leader = $server->get("user_profile")->returnInfo('Leader');
echo $server->get('permissions')->functionAccess('devin_clark');
if(($verify_admin_rank || $verify_group_id > 0 || $verify_advisor_rank || $verify_group_leader) &&
!$server->get('permissions')->hasPermissions())
{
	$server->get('permissions')->newPermissions();
	defaultPermissions($verify_admin_rank, $server->get('permissions'));

}

//print_r($server->get('permissions')->returnPermissions());
$my_permissions = $server->get('permissions')->returnPermissions();
$difference = array_diff($page_permissions, $server->get('permissions')->returnPermissions());
//!empty($difference)
//print_r(array_intersect($my_permissions, $page_permissions));
//echo count(array_intersect($my_permissions, $page_permissions));
if($_SERVER['PHP_SELF'] == $admin_index_directory && $verify_admin_rank < 2 &&
!$server->get("permissions")->permissionCheck('C_ALL'))
{
	header("Location: ".$default_page);
}
if($_SERVER['PHP_SELF'] == $group_index_directory && $verify_group_id <= 0 &&
!$server->get("permissions")->functionAccess('group_cp_access'))
{
	header("Location: ".$default_page);
}
// if in advisor directory and not an advisor or at least JA then kick

if(!count(array_intersect($page_permissions, $my_permissions)) > 0 && !empty($page_permissions) && !$server->get('permissions')->permissionCheck("C_ALL"))
{
	header("Location: ".$default_page);
	// permissions bad, send to main page
}


?>
