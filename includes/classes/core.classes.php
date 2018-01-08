<?php
if(!isset($p))
{
	header("Location: ../index.php?p=dashboard");
}
Class Core
{
	protected $_db;

	public function __construct($db)
	{
		$this->_db = $db;
		
	}
	public function setting($setting)
	{
		$setting_sanitized = htmlentities($setting);
		$query = 'SELECT `'.$setting_sanitized.'` FROM `cp_settings` WHERE `id`=1 LIMIT 1';
		$stmt = $this->_db->query($query);
		return $stmt->fetchColumn();

	}

}
?>