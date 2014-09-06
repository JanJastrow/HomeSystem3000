<?php
$site_function      =       $_GET['function'];

require('settings.inc.php');
require('mysql.inc.php');

if(empty($site_function))
{
?>

<h1>Benutzerverwaltung</h1>
<table class="users"><tbody>
<?php



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
<?php
}
?>
</tbody></table>
<div class="users--add">
<p>
    <a href="?site=management_users&function=create"><i class="fa fa-plus-square"></i></i>neuen User erstellen</a>
</p>
</div>
<?
}
elseif($site_function   ==  "create")
{
?>
<h1>Benutzer erstellen</h1>
<form method="POST" name="form" action="?site=management_users&function=create_user">
    <table class="users">
        <tbody>
            <tr>
                <td>Vorname:</td>
                <td><input type="text" name="fname" id="fname" /></td>
            </tr>
            <tr>
                <td>Nachname:</td>
                <td><input type="text" name="lname" id="lname" onblur="
    if(document.form.username.value=='' && document.form.fname.value!='' && document.form.lname.value!='') {
         var username =  document.form.lname.value.substr(0,49)  +  document.form.fname.value.substr(0,2);
         username = username.replace(/\s+/g, '');
         username = username.replace(/\'+/g, '');
         username = username.replace(/-+/g, '');
         username = username.toLowerCase();
         document.form.username.value = username;
    }" /></td>
            </tr>
            <tr>
                <td>Benutzername:</td>
                <td><input type="text" name="username" id="username" /></td>
            </tr>
            <tr>
                <td>E-Mail:</td>
                <td><input type="email" name="system_user_email"/></td>
            </tr>
            <tr>
                <td colspan="2"><input type="submit" value="Benutzer erstellen"/></td>
            </tr>                                
        </tbody>
    </table>
</form>
<?
}
elseif($site_function   ==  "create_user")
{
    $system_user_fname      =       $_POST['fname'];
    $system_user_lname      =       $_POST['lname'];
    $system_user_login_name =       $_POST['username'];
    $system_user_email      =       $_POST['system_user_email'];
    
    //generate password
    $alphabet = "abcdefghijklmnopqrstuwxyzABCDEFGHIJKLMNOPQRSTUWXYZ0123456789!";
    $pass = array(); //remember to declare $pass as an array
    $alphaLength = strlen($alphabet) - 1; //put the length -1 in cache
    for ($i = 0; $i < 13; $i++) {
        $n = rand(0, $alphaLength);
        $pass[] = $alphabet[$n];
    }
    $pass = implode($pass); //turn the array into a string
    
    function createHash ($name,$pwd,$saltOne,$saltTwo='ZPZw$[pkJF!;SHdl',$iterate=2000) 
    {
        $pwdSplit=str_split($pwd,(strlen($pwd)/2)+1);
        $nameSplit=str_split($name,(strlen($name)/2)+1);
        $hash='';
        for ($i=0;$i<=$iterate;$i++) {
            $hash=hash('sha512',$nameSplit[0].$saltOne.$pwdSplit[0].$hash.$nameSplit[1].$saltTwo.$pwdSplit[1]);
        }
        return $hash;
    }

    $system_user_password   =   $pass;
    $system_user_salt       =   hash('sha512',$pass);
    
    //sql qry
    $insert_qry             =       "
    INSERT INTO system_user
    (
         `system_user_name`, 
         `system_user_login_name`, 
         `system_user_email`, 
         `system_user_password`, 
         `system_user_salt`, 
         `system_user_status`
    ) 
        VALUES 
    (
        '$system_user_fname $system_user_lname',
        '$system_user_login_name', 
        '$system_user_email', 
        '$system_user_password', 
        '$system_user_salt', 
        '0'
    );";
    
    $qry            =       mysqli_query($con,$insert_qry);
    
    //get ai id from qry back
    $system_user_id =       mysqli_insert_id($con);
    
    mysqli_close($con);
    
    //token
    $mail_token     =       hash(sha256,$pass);
    //mail template
    $system_user_mail_template  =
    "
    Hallo $system_user_fname $system_user_lname,
    
    für dich wurde im HomeSystem3000 welches unter:
    
    $project_url
    
    erreichbar ist, ein Benutzer angelegt.
    
    Anbei findest du die Zugangsdaten um dich auf der Seite einzuloggen.
    
    Bitte verifiziere deine E-Mailadresse noch durch einen Klick auf den nachfolgenden Link:
    
    $project_url?site=management_users&action=activate_user&userid=$system_user_id&token=$mail_token
    
    Benutzername: $system_user_login_name
    Passwort: $system_user_password
    
    Deine Daten werden ausschließlich verschlüsselt gespeichert!
    
    Viel Spaß mit dem System!
    ";
/*    
    $header = 'From: ' .$email_from "\r\n" .
    'Reply-To: ' . "\r\n" .
    'X-Mailer: PHP/' . phpversion();

    mail($system_user_email, $betreff, $system_user_mail_template, $header);
  */      
?>
<h1>Der Benutzer wurde angelegt.</h1>

<p>
Die Zugangsdaten wurden dem Benutzer via E-Mail zugeschickt.
<br />
<br />
<a href="?site=management_users">Zurück zur Benutzerübersicht</a>
</p>
<?    
}
?>

