<?php
require("msql.php");
class Backend extends M_MSQL
{
	private static $instance;
	private $msql;
	
	public function __construct()
	{
		$this->msql = M_MSQL::Instance();
	}
	
	public static function Instance()
	{
		if (self::$instance == null)
			self::$instance = new Backend();
		
		return self::$instance;
	}
	
	public function get_comment($user_name)
	{
		if ($user_name == ""){
			$query = "SELECT * FROM comm WHERE comment_type = 'public' ORDER BY date LIMIT 10";		
			$res = ($this -> msql -> Select($query));
			return $res;
		}
		else {
			$query = "SELECT * FROM comm WHERE comment_type = 'public' OR name = '$user_name' OR recipient = '$user_name' ORDER BY date LIMIT 10";		
			$res = ($this -> msql -> Select($query));
			return $res;
		}
	}
	
	public function get_user()
	{
		$query = "SELECT * FROM user ORDER BY id_user";		
		$res = ($this -> msql -> Select($query));
		return $res;
		
	}
	
	public function get_user_online()
	{
		$mark ='online';
		$query = "SELECT * FROM user WHERE status = 'online' AND name NOT LIKE '#all'";		
		$res = ($this -> msql -> Select($query));
		return $res;		
	}

	public function add_comment($name, $recipient, $comment, $status)
	{
				$obj = array();
				$obj["name"] = $name;	
				$obj["recipient"] = $recipient;	
				$obj["comment"] = $comment;
				$obj["comment_type"] = $status;
				$obj["date"] = date("Y-m-d");				
		$this -> msql -> Insert("comm", $obj);
		sleep(2);
		header("Location: index.php");		
	}
}

$obj = new Backend;

if (isset ($_POST["hide_add_comm"]))
	{
		$name = $_POST["hide_name"];	
		if ($_POST["hide_recipient"] == "") $recipient = $_POST["hide_user"]; 
		else $recipient = $_POST["hide_recipient"]; 
		$status = $_POST["hide_type"]; 
		$comment = $_POST["hide_comment"];			
		$comment = trim($comment);
		$comment = mysql_real_escape_string($comment);
		$comment = strip_tags($comment);
		$obj -> add_comment($name, $recipient, $comment, $status);			
							
	}
		
if (isset ($_POST["hide-publick"]))
	{			
		$users = $obj -> get_user();
		$comment_type = "public";			
	}
		
if (isset ($_POST["hide-private"]))
	{			
		$users = $obj -> get_user_online();
		$comment_type = "private";		
	}
		
		
?>