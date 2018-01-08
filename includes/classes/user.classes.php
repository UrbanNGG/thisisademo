<?php
function defaultPermissions($admin_level, Permissions $permissions)
{
	if($admin_level >= 2)
	{
		$permissions->addPermission('cp_admin'.$admin_level);
		$permissions->addPermission('cp_admin'.$admin_level);
	}

}
function idtoname($id)
{
	$db = $GLOBALS['odb'];
	$stmt = $db->prepare("SELECT `Username` FROM `accounts` WHERE `id`=? LIMIT 1");
	$stmt->execute(array($id));
	return $stmt->rowCount() ? $stmt->fetchColumn() : false;
}
function showStats(User $user, Profile $profile, Inventory $inventory, Group $search_group)
{

	?>
	<div class=row>
		<div class='col-md-12'>
			<section class="panel panel-default">
			<header class="panel-heading">
				<h5>Account Overview</h5>
			</header>
			<div class="panel-body">

				<table class='table table-striped no-m'>
					<tr>
						<td><b>Email:</b> <div id='ffff'><?php echo $inventory->returnInventory('Email') ? $inventory->returnInventory('Email') : 'N/A'; ?></div></td>
						<td><b>Last Active:</b> <?php echo $inventory->returnInventory('LastLogin'); ?></td>
						<td><b>Last Logged IP:</b> <?php echo $inventory->returnInventory('IP'); ?></td>
						<td><b>Report Mutes:</b> <?php echo $inventory->returnInventory('ReportMutedTotal'); ?></td>
					</tr>
					<tr>
						<td><b>Group:</b> <?php echo $search_group->Info()['Name'] ? $search_group->Info()['Name'] : 'N/A'; ?></td>
						<td><b>Rank:</b> <?php echo $search_group->Ranks()['Rank'.$inventory->returnInventory('Rank')] ? $search_group->Ranks()['Rank'.$inventory->returnInventory('Rank')] : 'N/A'; ?></td>
						<td><b>Division:</b> <?php echo $search_group->Divisions()['Div'.$inventory->returnInventory('Division')] ? $search_group->Divisions()['Div'.$inventory->returnInventory('Division')] : 'N/A'; ?></td>
						<td><b>Report Mutes:</b> X.X.X.X</td>
					</tr>
				</table>
			</div>

			</section>

			<?php


			?>
		</div>
	</div>
	<div class=row>
		<div class='col-md-12'>
			<section class="panel panel-default">
			<header class="panel-heading">
				<h5>Character Stats</h5>
			</header>
			<div class="panel-body">

				<table class='table table-striped no-m'>
					<tr>
						<td><b>Level:</b> <?php echo $inventory->returnInventory('Level'); ?></td>
						<td><b>Playing Hours:</b> <?php echo $inventory->returnInventory('ConnectedTime'); ?></td>
						<td><b>Age:</b> <?php echo $inventory->returnInventory('Age'); ?></td>
						<td><b>Gender:</b> <?php echo $inventory->returnInventory('Gender'); ?></td>
					</tr>
					<tr>
						<td><b>Total Wealth:</b> $<?php echo number_format($inventory->returnInventory('Bank') + $inventory->returnInventory('Money')); ?></td>
						<td><b>Money (On-Hand):</b> $<?php echo number_format($inventory->returnInventory('Money')); ?></td>
						<td><b>Money (Bank):</b> $<?php echo number_format($inventory->returnInventory('Bank')); ?></td>
						<td><b>Materials:</b> <?php echo $inventory->returnInventory('Materials'); ?></td>
					</tr>
					<tr>
						<td><b>Crack:</b> <?php echo $inventory->returnInventory('Crack'); ?></td>
						<td><b>Pot:</b> <?php echo $inventory->returnInventory('Pot'); ?></td>
						<td><b>Meth:</b> <?php echo $inventory->returnInventory('Meth'); ?></td>
						<td><b>Radio Frequency:</b> #<?php echo $inventory->returnInventory('RadioFreq'); ?></td>
					</tr>
					<tr>
						<td><b>VIP Rank:</b> XX</td>
						<td><b>Crimes:</b> XX</td>
						<td><b>Arrests:</b> XX</td>
						<td><b>Weapon Restriction:</b> <a href='#' id='peen' data-type="select" data-pk="1" data-url="./includes/ajax.php" data-title="Enter username">ff</a></td>
					</tr>
					<tr>
						<td><b>Warnings:</b> XX</td>
						<td><b>Newbie Mutes:</b> XX</td>
						<td><b>Advertisement Mutes:</b> XX</td>
						<td><b>Report Mutes:</b> XX</td>
					</tr>

				</table>
			</div>

			</section>

			<?php


			?>
		</div>
	</div>
	<?php
}
function showVehicles($usersqlid)
{
		?>
		<dl class="accordion">
			<?php
			$vehiclestmt = $GLOBALS['odb']->prepare("SELECT `id`, `sqlID`, `pvModelID`, `pvPlate`,`Lsd`, `Cannabis`, `Meth`, `Heroin`,`Cocaine`, `Crack`, `Opium`,
				 `Ecstasy`, `Speed`, `Alcohol`, `Pot`, `pvPosX`, `pvPosY` FROM `vehicles` WHERE `sqlID`=?");
			$vehiclestmt->execute(array($usersqlid));
			while($pveh=$vehiclestmt->fetch(PDO::FETCH_ASSOC))
			{
			?>
				<br /><dt style="background-color: #F2F2F2;">
					<a href="javascript:;"><?php echo $pveh['pvPlate'];  ?></a>
				</dt>
				<dd><div class='row'><div class='col-md-3'><img src="http://weedarr.wdfiles.com/local--files/veh/<?php echo $pveh['pvModelID'];  ?>.png"></div>
					<div class='col-md-6'>
				<h4>Vehicle Inventory</h4><table class='table table-striped no-m'>
				<tr>
						<td>LSD: <?php echo $pveh['Lsd']; ?></td>
						<td>Cannabis: <?php echo $pveh['Cannabis']; ?></td>
						<td>Meth: <?php echo $pveh['Meth']; ?></td>
						<td>Heroin: <?php echo $pveh['Heroin']; ?></td>
						<td>Cocaine: <?php echo $pveh['Cocaine']; ?></td>
				</tr>
				<tr>
						<td>Crack: <?php echo $pveh['Crack']; ?></td>
						<td>Opium: <?php echo $pveh['Opium']; ?></td>
						<td>Ecstasy: <?php echo $pveh['Ecstasy']; ?></td>
						<td>Speed: <?php echo $pveh['Speed']; ?></td>
						<td>Alcohol: <?php echo $pveh['Alcohol']; ?></td>
				</tr>
				<tr>
						<td>Pot: <?php echo $pveh['Pot']; ?></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
				</tr>

			</table></div>
			<div class='col-md-3'><img src="./includes/map.php?x=<?php echo $pveh['pvPosX']; ?>&y=<?php echo $pveh['pvPosY']; ?>" /></div></div></dd>
			<?php
			}
			?>

		</dl>
		<?php
}
class User
{
	protected $_username;
	protected $_db;
	public $_verified;


	public function __construct(PDO $db, $username)
	{
		$this->_username = htmlentities($username);
		$this->_db = $db;
		$this->verifyAccount();

	}
	protected function verifyAccount()
	{
		$stmt = $this->_db->prepare("SELECT `id` FROM `accounts` WHERE `Username`=:username LIMIT 1");
		$stmt->execute(array(':username' => $this->_username));
		if($stmt->rowCount() == 1)
		{
			$this->_verified = $stmt->fetchColumn();
		}
		else {
			$this->_verified = false;
		}
	}
	public function login($password)
	{

			if($this->_verified)
			{
				$sanitized_password = htmlentities($password);
				$stmt = $this->_db->prepare('SELECT `Salt`, `Key` FROM `accounts` WHERE `Username`=:username LIMIT 1');
				$stmt->execute(array(':username' => $this->_username));
				$details = $stmt->fetch(PDO::FETCH_ASSOC);
				$salt = $details['Salt'];
				$user_password = $details['Key'];
				$check_password = strtoupper(hash("whirlpool", $sanitized_password.$salt));

				if($check_password == $user_password)
				{
					return true;
				}
				else {
					return false;
				}


			}
	}

}
class Profile extends User
{
	protected $_user;
	protected $_information;
	public function __construct(User $user)
	{
		$this->_user = $user;
		$stats_fields = ['id', 'AdminLevel', 'Helper', 'Leader', 'Member', 'BanAppealer',
		'PR', 'HR', 'AP', 'Security', 'ShopTech', 'FactionModerator', 'GangModerator', 'Online'];
		$query = "SELECT ";
		foreach ($stats_fields as $value) {
			if(end($stats_fields) == $value)
			{
				$query .= '`'.$value.'` ';
			}
			else
			{
				$query .= '`'.$value.'`, ';
			}
		}
		$query .= "FROM `accounts` WHERE `Username`=:username LIMIT 1";

		$stmt = $this->_user->_db->prepare($query);
		$stmt->execute(array(":username" => $this->_user->_username));
		$this->_information = $stmt->fetch(PDO::FETCH_ASSOC);
	}
	public function returnInfo($info_field)
	{
		return $this->_information[$info_field];
	}

}
class Inventory extends User
{
	protected $_user;
	protected $_inv;
	public function __construct(User $user)
	{
		$this->_user = $user;
		$inventory_slots = ['Level', 'Division', 'Member', 'Rank', 'ReportMutedTotal', 'LastLogin',
 'IP', 'Email', 'Age', 'Sex', 'Money', 'Bank', 'Materials', 'Crack', 'Pot', 'Meth', 'ConnectedTime', 'RadioFreq'];
 		$query = "SELECT ";
 		foreach ($inventory_slots as $value) {
 			if(end($inventory_slots) == $value)
			{
				$query .= '`'.$value.'` ';
			}
			else
			{
				$query .= '`'.$value.'`, ';
			}
 		}
 		$query .= "FROM `accounts` WHERE `Username`=:username LIMIT 1";

 		$stmt = $this->_user->_db->prepare($query);
 		$stmt->execute(array(":username" => $this->_user->_username));
 		$this->_inv = $stmt->fetch(PDO::FETCH_ASSOC);

	}
	public function returnInventory($type)
	{

 		return $this->_inv[$type];

	}
}
class Punishment extends User
{
	protected $_user;
	protected $_punisher;
	protected $_link;
	protected $values;
	public function __construct(User $user, User $punisher, $link)
	{

		$this->_user = $user;
		$profile = new Profile($user);
		if($profile->returnInfo('AdminLevel') != 99999)
		{
			return 1;
		}
		$this->_punisher = $punisher;
		$this->_link = $link;
		$this->values = ['NULL', '', 'CURDATE()', $this->_punisher->_verified, $reason,
		 1, 'NULL', 'NULL', 'NULL', 'NULL', 'NULL', 'NULL', '"'.$link.'"', 'CURDATE()', $this->_punisher->_verified, 0,
		 0, 0];
	}
	public function jail($time, $reason, $details = '')
	{
		$this->values[1] = $this->_user->_verified;
		$this->values[6] = $time;
		$this->values[4] = '"'.$reason.'"';
		$this->values[11] = '"'.$details.'"';

	}
	public function ban($time, $reason, $details = '')
	{
		$this->values[1] = $this->_user->_verified;
		$this->values[9] = 1;
		$this->values[4] = '"'.$reason.'"';
		$this->values[11] = '"'.$details.'"';
		$this->values[15] = $time;
		$this->values[16] = 1;
		$this->values[17] = $time;
	}
	public function warn($reason, $details = '')
	{
		$this->values[1] = $this->_user->_verified;
		$this->values[7] = 1;
		$this->values[4] = '"'.$reason.'"';
		$this->values[11] = '"'.$details.'"';

	}
	public function fine($amount, $reason, $details = '')
	{
		$this->values[1] = $this->_user->_verified;
		$this->values[8] = $amount;
		$this->values[4] = '"'.$reason.'"';
		$this->values[11] = '"'.$details.'"';
	}
	public function execute()
	{
		if(!empty($this->values))
		{


			$amount = count($this->values);
			$i = 0;
			$query = "INSERT INTO `cp_punishment` VALUES(";

			foreach ($this->values as $value) {
				$i += 1;
				if($i < 18) {
					$query .= $value.", ";
				}
				else {
					$query .= $value;
				}
			}
			$query .= ")";
			//return $query;
			$stmt = $this->_user->_db->query($query);
		}
	}

}
class Permissions extends User
{
	protected $_user;
	public $_sqlid;
	protected $my_permissions;
	public function __construct(User $user)
	{
		$this->_user = $user;
		$this->_sqlid = $user->_verified;
	}
	public function hasPermissions()
	{
		$stmt = $this->_user->_db->prepare("SELECT * FROM `cp_permissions` WHERE `userid`=?");
		$stmt->execute(array($this->_sqlid));
		if($stmt->rowCount() == 1)
		{

			return true;
		}
		if($stmt->rowCount() == 0)
		{
			return false;
		}

	}
	public function newPermissions()
	{
		$stmt = $this->_user->_db->prepare("INSERT INTO `cp_permissions` VALUES(NULL, ?, NULL, NOW())");
		$stmt->execute(array($this->_sqlid));
	}
	public function addPermission($permission)
	{
		$stmt = $this->_user->_db->prepare("SELECT `permissions` FROM `cp_permissions` WHERE `userid`=? LIMIT 1");
		$stmt->execute(array($this->_sqlid));
		$current_permissions = $stmt->fetchColumn();
		if(!in_array($permission, explode(',',$current_permissions)))
		{
			$new_permissions = $current_permissions.$permission.',';
		}
		else {
			$new_permissions = $current_permissions;
		}
		$stmt = $this->_user->_db->prepare("UPDATE `cp_permissions` SET `last_updated`=NOW(), `permissions`=? WHERE `userid`=?");
		$stmt->execute(array($new_permissions, $this->_sqlid));
		// log permissions cp_log_permissions
	}
	public function removePermission($permission)
	{
		$stmt = $this->_user->_db->prepare("SELECT `permissions` FROM `cp_permissions` WHERE `userid`=? LIMIT 1");
		$stmt->execute(array($this->_sqlid));
		$current_permissions = $stmt->fetchColumn();
		if(in_array($permission, explode(',', $current_permissions)))
		{
			$new_permissions = str_replace($permission.",", '', $current_permissions);
			if(empty($new_permissions))
			{
				$new_permissions = 'NULL';
			}
		}
		$stmt = $this->_user->_db->prepare("UPDATE `cp_permissions` SET `last_updated`=NOW(), `permissions`=? WHERE `userid`=?");
		$stmt->execute(array($new_permissions, $this->_sqlid));
	}
	public function returnPermissions()
	{
		$stmt = $this->_user->_db->prepare("SELECT `permissions` FROM `cp_permissions` WHERE `userid`=? LIMIT 1");
		$stmt->execute(array($this->_sqlid));
		$current_permissions = $stmt->fetchColumn();
		$xx = explode(",", $current_permissions);
		array_filter($xx);
		return $xx;
	}
	public function permissionCheck($permission)
	{
		$stmt = $this->_user->_db->prepare("SELECT `permissions` FROM `cp_permissions` WHERE `userid`=? LIMIT 1");
		$stmt->execute(array($this->_sqlid));
		$current_permissions = $stmt->fetchColumn();
		if(in_array($permission, explode(',',$current_permissions)))
		{
			return true;
		}
		else {
			return false;
		}

	}
	public function functionAccess($function_name)
	{
		$stmt1 = $this->_user->_db->prepare("SELECT * FROM `cp_func_permissions` WHERE `function_name`=? LIMIT 1");
		$stmt1->execute(array($function_name));
		$function_info = $stmt1->fetch(PDO::FETCH_ASSOC);
		$stmt2 = $this->_user->_db->prepare("SELECT `permissions` FROM `cp_permissions` WHERE `userid`=? LIMIT 1");
		$stmt2->execute(array($this->_sqlid));
		$current_permissions = explode(',', $stmt2->fetchColumn());
		$func_perms = explode(",", $function_info['required_permissions']);
		if(count(array_intersect($current_permissions, $func_perms)))
		{
			return true;
		}
		else {
			return false;
		}


	}

}
