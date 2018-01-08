<?php
if(!isset($p))
{
	header("Location: ../index.php?p=dashboard");
}
function displayPages()
{
		$stmt = $GLOBALS['odb']->query("SELECT * FROM `cp_header` WHERE `enabled`=1 AND `display` = 1 AND `required_permissions` IS NULL");

		while($row = $stmt->fetch(PDO::FETCH_ASSOC))
		{
			?>
			<li>
				<a href='<?php echo $GLOBALS['server']->get('core')->setting('user_index_directory').'?p='.$row['identifier']; ?>'><i class="<?php echo $row['icon']; ?>"></i> <span><?php echo $row['title']; ?></span></a>
			</li>
			<?php
		}
		if($GLOBALS['verify_group_leader'] > 0 || $GLOBALS['verify_admin_rank'] >= 2 || $GLOBALS['verify_advisor_rank'] > 0 )
		{

			?><p class="nav-title">COMMUNITY STAFF</p>

			<?php
		}
		if($GLOBALS['verify_advisor_rank'] >= 1 || $GLOBALS['verify_admin_rank'] >= 2)
		{
			?>
			<li>
				<a href='./staff.php?p=advisordashboard'><i class="ti-user"></i> <span>Public Relations</span></a>
			</li>
			<?php
		}
		if($GLOBALS['server']->get('permissions')->functionAccess('group_cp_access'))
		{
			?>
			<li>
				<a href='./group.php?p=dashboard'><i class="ti-id-badge"></i> <span>Group Panel</span></a>
			</li>
			<?php
		}
		if($GLOBALS['server']->get('permissions')->functionAccess('admin_cp_access'))
		{
			?>
			<li>
				<a href='./admin.php?p=dashboard'><i class="ti-star"></i> <span>Admin Panel</span></a>
			</li>
			<?php
		}


}
function displayAdminPages(Permissions $permissions)
{
		?>
		<li>
			<a href='./admin.php?p=dashboard'><i class="ti-home"></i> <span>Dashboard</span></a>
		</li>
		<?php
		$stmt = $GLOBALS['odb']->query("SELECT * FROM `cp_header` WHERE `enabled`=1 AND `display`=1 AND `group_cp`=0 AND `admin_cp`=1 AND `required_permissions` IS NOT NULL");
		$my_permissions = $permissions->returnPermissions();
		while($row = $stmt->fetch(PDO::FETCH_ASSOC))
		{
			$row_page_permissions = explode(',', $row['required_permissions']);
			if(count(array_intersect($row_page_permissions, $my_permissions)) > 0) {
			?>
			<li>

				<a href='<?php echo $GLOBALS['server']->get('core')->setting('admin_index_directory').'?p='.$row['identifier']; ?>'><i class="<?php echo $row['icon']; ?>"></i> <span><?php echo $row['title']; ?></span></a>
			</li>
			<?php
			}
		}
		?>
		<li>
			<a href='./index.php?p=dashboard'><i class="ti-arrow-left"></i> <span>User Dashboard</span></a>
		</li>
		<?php
}
function displayGroupPages(Permissions $permissions)
{
		?>
		<li>
			<a href='./group.php?p=dashboard'><i class="ti-home"></i> <span>Dashboard</span></a>
		</li>
		<?php
		$stmt = $GLOBALS['odb']->query("SELECT * FROM `cp_header` WHERE `enabled`=1 AND `display`=1 AND `group_cp`=1 AND `admin_cp`=0 AND `required_permissions` IS NOT NULL");
		$my_permissions = $permissions->returnPermissions();
		while($row = $stmt->fetch(PDO::FETCH_ASSOC))
		{
			$row_page_permissions = explode(',', $row['required_permissions']);
			if(count(array_intersect($row_page_permissions, $my_permissions)) > 0) {
			?>
			<li>

				<a href='<?php echo $GLOBALS['server']->get('core')->setting('group_index_directory').'?p='.$row['identifier']; ?>'><i class="<?php echo $row['icon']; ?>"></i> <span><?php echo $row['title']; ?></span></a>
			</li>
			<?php
			}
		}
		?>
		<li>
			<a href='./index.php?p=dashboard'><i class="ti-arrow-left"></i> <span>User Dashboard</span></a>
		</li>
		<?php
}
class Server
{
	public $classes;

	public function set($key, $value)
	{
		$this->classes[$key] = $value;

	}
	public function get($key)
	{
		if(array_key_exists($key, $this->classes))
		{
			return $this->classes[$key];
		}
		else
		{
			return false;
		}
	}


}
class Page
{
		protected $_db;
		protected $_pagename;
		public function __construct(PDO $db, $pagename)
		{
				$this->_db = $db;
				$this->_pagename = htmlentities($pagename);
		}
		public function pageExists()
		{
				$stmt = $this->_db->prepare("SELECT `id` FROM `cp_header` WHERE `identifier`=:identifier LIMIT 1");
				$stmt->execute(array(':identifier' => $this->_pagename));
				if($stmt->rowCount() == 1)
				{
						return true;
				}
				else {
						return false;
				}
		}
		public function pageTitle()
		{
				$stmt = $this->_db->prepare("SELECT `title` FROM `cp_header` WHERE `identifier`=:identifier LIMIT 1");
				$stmt->execute(array(':identifier' => $this->_pagename));
				if($stmt->rowCount() == 1)
				{
						return $stmt->fetchColumn();
				}
				else {
						return "Dashboard";
				}
		}
		/*public function pagePerms($permission)
		{
			$stmt = $this->_db->prepare("SELECT `admin_level`, `advisor_level`, `group_types`, `BanAppealer`,
				`AP`, `HR`, `PR`, `ShopTech`, `FactionMod`, `GangMod` FROM `cp_header` WHERE `identifier`=:identifier LIMIT 1");
			$stmt->execute(array(':identifier' => $this->_pagename));
			if($stmt->rowCount() == 1)
			{
					$arr = $stmt->fetch(PDO::FETCH_ASSOC);
					return $arr[$permission];
			}


		}*/
		public function pagePerms()
		{
			$stmt = $this->_db->prepare("SELECT `required_permissions` FROM `cp_header` WHERE `identifier`=:identifier LIMIT 1");
			$stmt->execute(array(':identifier' => $this->_pagename));
			if($stmt->rowCount() == 1)
			{
					$perm = $stmt->fetchColumn();
					if(is_null($perm))
					{
						return false;
					}

					return explode(',', $perm);
			}


		}


}
class Session
{
	public $session_exists;
	protected $session_usersqlid;
	protected $session_username;
	protected $_db;
	public function __construct($db, $username)
	{
		$this->_db = $db;
		$this->session_username = $username;
		$stmt = $this->_db->prepare("SELECT `id` FROM `accounts` WHERE `Username`=? LIMIT 1");
		$stmt->execute(array($username));

		$this->session_usersqlid = $stmt->fetchColumn();

		$stmt = $this->_db->prepare("SELECT * FROM `cp_session` WHERE `Userid`=:sqlid LIMIT 1");
		$stmt->execute(array(':sqlid' => $this->session_usersqlid));
		if($stmt->rowCount() == 1 )
		{
			$this->session_exists = true;

		}

		else {
			$this->session_exists = false;
			// add new and gen new session
		}
	}
	public function new_session()
	{
		$characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
		$charactersLength = strlen($characters);
		$randomString = '';
		for ($i = 0; $i < 128; $i++) {
				$randomString .= $characters[rand(0, $charactersLength - 1)];
		}

		$stmt = $this->_db->prepare("INSERT INTO `cp_session` VALUES (?, ?, ?, ?)");
		$stmt->execute(array(NULL, $this->session_usersqlid, $randomString, strtotime("30 minutes")));
		$this->session_exists = true;
		$_SESSION['session_id'] = $randomString;
		$_SESSION['username'] = $this->session_username;
	}
	public function destroy_session()
	{
		$stmt= $this->_db->prepare("DELETE FROM `cp_session` WHERE `Userid`=?");
		$stmt->execute(array($this->session_usersqlid));
		unset($_SESSION['session_id']);
		unset($_SESSION['username']);
	}
	public function renew_session()
	{
		$stmt = $this->_db->prepare("UPDATE `cp_session` SET `Expire`=? WHERE `Userid`=?");
		$stmt->execute(array(strtotime("30 minutes"), $this->session_usersqlid));
	}
	public function sessionMatch()
	{
			$current_session = $_SESSION['session_id'];
			$stmt = $this->_db->prepare("SELECT `Token`, `Expire` FROM `cp_session` WHERE `Userid` = ? AND `Token` = ? AND `Expire` >= UNIX_TIMESTAMP()");
			$stmt->execute(array($this->session_usersqlid, $current_session));
			if($stmt->rowCount() == 1)
			{
				return true;
			}
			else {
				return false;

			}
	}
	public function sessionKeyMatch($key)
	{
		$current_session = $key;
		$stmt = $this->_db->prepare("SELECT `Token`, `Expire` FROM `cp_session` WHERE `Userid` = ? AND `Token` = ? AND `Expire` >= UNIX_TIMESTAMP()");
		$stmt->execute(array($this->session_usersqlid, $current_session));
		if($stmt->rowCount() == 1)
		{
			return true;
		}
		else {
			return false;

		}
	}

}
