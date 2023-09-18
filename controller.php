<?php
include 'ftpConn.php';
Spec spec=new Spec();

function change_directory($ftp_conn, $dir){
  spec->login();
ftp_chdir($ftp_conn, $dir);

// output current directory name (/php)
echo ftp_pwd($ftp_conn);

// close connection
ftp_close($ftp_conn);
}

function change_file_mode($ftp_conn, $mode, $file){
    spec->login();

// Try to set read and write for owner and read for everybody else
if (ftp_chmod($ftp_conn, 0644, $file) !== false)
  {
  echo "Successfully chmoded $file to 644.";
  }
else
  {
  echo "chmod failed.";
  }

// close connection
ftp_close($ftp_conn);
}


function delete_file($ftp_conn, $file){
    spec->login();

// try to delete file
if (ftp_delete($ftp_conn, $file))
  {
  echo "$file deleted";
  }
else
  {
  echo "Could not delete $file";
  }

// close connection
ftp_close($ftp_conn);
}

function execute_cmd($ftp_conn,$command){
    spec->login();
  $command = "ls-al > somefile.txt";

// execute command
if (ftp_exec($ftp_conn,$command))
  {
  echo "$command executed successfully.";
  }
else
  {
  echo "Execution of $command failed.";
  }

// close connection
ftp_close($ftp_conn);
}


function get_timeout($ftp_conn){
    spec->login();
  // could return 90
echo ftp_get_option($ftp_conn,FTP_TIMEOUT_SEC);

// close connection
ftp_close($ftp_conn);
}

function get_last_mode($ftp_conn, $file){
 $file = "somefile.txt";

// get the last modified time
$lastchanged = ftp_mdtm($ftp_conn, $file);
if ($lastchanged != -1)
  {
  echo "$file was last modified on : " . date("F d Y H:i:s.",$lastchanged);
  }
else
  {
  echo "Could not get last modified";
  }

// close connection
ftp_close($ftp_conn); 
}

function create_directory($ftp_conn, $dir){
  spec->login();
$dir = "images";

// try to create directory $dir
if (ftp_mkdir($ftp_conn, $dir))
  {
  echo "Successfully created $dir";
  }
else
  {
  echo "Error while creating $dir";
  }

// close connection
ftp_close($ftp_conn);
}

function show_directories($ftp_conn, $dir){
    spec->login();
  $dir = "/images";
$dirlist = ftp_mlsd($ftp_conn, $dir);

// output directory list
echo($dirlist);

// close connection
ftp_close($ftp_conn);
}

function dowload($ftp_conn){
    spec->login();
  // initiate download
$d = ftp_nb_get($ftp_conn, "local.txt", "server.txt", FTP_BINARY)

while ($d == FTP_MOREDATA)
  {
  // do whatever you want
  // continue downloading
  $d = ftp_nb_continue($ftp_conn);
  }

if ($d != FTP_FINISHED)
  {
  echo "Error downloading file.";
  exit(1);
  }

}


function upload_file($ftp_conn, $server_file, $local_file){
    spec->login();
// initiate upload
$d = ftp_nb_put($ftp_conn, $server_file, $local_file, FTP_BINARY)

while ($d == FTP_MOREDATA)
  {
  // do whatever you want
  // continue uploading
  $d = ftp_nb_continue($ftp_conn);
  }

if ($d != FTP_FINISHED)
  {
  echo "Error uploading $local_file";
  exit(1);
  }

// close connection
ftp_close($ftp_conn);
}

function get_file_list($ftp_conn){
    spec->login();
  // get file list of current directory
$file_list = ftp_nlist($ftp_conn, ".");
var_dump($file_list);

// close connection
ftp_close($ftp_conn);
}

function get_all_files($ftp_conn){
  // get the file list for /
  $filelist = ftp_rawlist($ftp_conn, "/");

// close connection
ftp_close($ftp_conn);

// output $filelist
var_dump($filelist);
}


function rename_file($ftp_conn, $old_file, $new_file){
    spec->login();

// try to rename $old_file to $new_file
if (ftp_rename($ftp_conn, $old_file, $new_file))
  {
  echo "Renamed $old_file to $new_file";
  }
else
  {
  echo "Problem renaming $old_file to $new_file";
  }

// close connection
ftp_close($ftp_conn);
}

function delete_directory($ftp_conn, $dir){
    spec->login();
// try to delete $dir
if (ftp_rmdir($ftp_conn, $dir))
  {
  echo "Directory $dir deleted";
  }
else
  {
  echo "Problem deleting $dir";
  }

// close connection
ftp_close($ftp_conn);
}

function set_timeout($ftp_conn){
    spec->login();
  // set network operation timeout to 120 seconds
echo ftp_set_option($ftp_conn,FTP_TIMEOUT_SEC,120);

// close connection
ftp_close($ftp_conn);
}

function exe_commands($ftp_conn, $command){
    spec->login();
  // try to send SITE command
if (ftp_site($ftp_conn, $command))
  {
  echo "Command executed successfully";
  }
else
  {
  echo "Command failed";
  }

// close connection
ftp_close($ftp_conn);
}

function get_file_size($ftp_conn, $file){
    spec->login();
    
// get size of $file
$fsize = ftp_size($ftp_conn, $file);
if ($fsize != -1)
  {
  echo "$file is $fsize bytes.";
  }
else
  {
  echo "Error getting file size.";
  }

// close connection
ftp_close($ftp_conn);
}
?>