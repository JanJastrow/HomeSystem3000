<?

$con        =       mysqli_connect($sql_server,$sql_username,$sql_password,$sql_db);
// Check connection
if (mysqli_connect_errno()) {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
}

?>