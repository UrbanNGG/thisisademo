<?php
if(!isset($p))
{
	header("Location: ../index.php?p=dashboard");
}

class DB_Connect
{
	protected $_db;
	public $_connected;
	public function __construct(PDO $db)
	{
		$this->_db = $db;
		$this->_connected = true;
	}
}
class rowCount
{
	
	function __construct(DB_Connect $pipeline)
	{
		if(!$pipeline->_connected)
		{
			return false;
		}
	}
}


?>