<?php
/**
 * 
 */
class Spec
{
	public $ftp_conn;
	public function login()
	{
 $ftp_server = $_SESSION['server'];
 $username=$_SESSION['username'];
 $password=$_SESSION['password'];	}
 $ftp_conn = ftp_connect($ftp_server) or die("Could not connect to $ftp_server");
$login = ftp_login($ftp_conn, $ftp_username, $ftp_userpass);

}
?>