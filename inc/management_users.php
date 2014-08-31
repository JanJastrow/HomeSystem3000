<h1>Benutzerverwaltung</h1>
<table class="users">
<?


require('settings.inc.php');
require('mysql.inc.php');

$result = mysqli_query($con,"SELECT system_user_id, system_user_name, system_user_last_login, system_user_status FROM system_user");

while($row = mysqli_fetch_array($result)) {

    $system_user_id                 =       $row['system_user_id'];
    $system_user_name               =       $row['system_user_name'];
    $system_user_last_login         =       $row['system_user_last_login'];
    $system_user_last_login_date    =       date("d.m.Y - H:i:s", $system_user_last_login);
    $system_user_status             =       $row['system_user_status'];

    if($system_user_status == "1")
    {
        $system_user_status_indicator   =   "fa fa-circle sensors--status__green";
    }
    elseif($system_user_status == "0")
    {
        $system_user_status_indicator   =   "fa fa-circle-o sensors--status__red";
    }

?>
<tr>
    <td class="users--status"><i class="<? echo $system_user_status_indicator ?>"></i></td>
    <td class="users--name"><? echo $system_user_name ?></td>
    <td class="users--lastlogin"><? echo $system_user_last_login_date ?></td>
    <td class="sensors--edit">
        <a href="?site=system_user_edit&system_user_id=<? echo $system_user_id ?>"><i class="fa fa-pencil-square-o fa-2x"></i></a>
        <a href="?site=system_user_deactivate&system_user_id=<? echo $system_user_id ?>"><i class="fa fa-power-off fa-2x"></i></a>
        <a href="?site=system_user_remove&system_user_id=<? echo $system_user_id ?>"><i class="fa fa-remove fa-2x"></i></a>
    </td>
</tr>
<?
}
?>
</table>
<div class="users--add">
<p>
    <a href="?site=management_users_create"><i class="fa fa-plus-square"></i></i>neuen User erstellen</a>
</p>
</div>
