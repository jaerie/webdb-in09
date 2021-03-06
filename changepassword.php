<?php
    dbconnect();
    $uid = $_GET['uid'];

    $res = dbquery("SELECT passwd FROM users 
                    WHERE uid=:uid",
                    array('uid'=>$uid));

    while($row = $res->fetch(PDO::FETCH_ASSOC)) {
        $passwd = $row['passwd'];

    if (isset($_POST['submit'])) {

        if($_POST['newpass']==$_POST['repass'] && password_verify($_POST['oldpass'], $passwd)) {
            
            $password = $_POST['newpass'];
            $hash = password_hash($password, PASSWORD_DEFAULT);

            $res2 = dbquery("UPDATE users
                             SET passwd = :password
                             WHERE uid = :uid",
                    array('uid' => $uid,
                          'password' => $hash));
        } 
		else {
		echo "Wrong password.";
		}
    }
    }
    
    
?>
<div id="registration">
    <form method="POST">
        <fieldset>
        <legend>Change Password</legend>
        <div>
            <label for='oldpass'><b>Old password:</b></label>
            <input name='oldpass' type='password' id='oldpass' class='txt'/>
        </div>

        <div>
            <label for='newpass'><b>New password:</b></label>
            <input name='newpass' type='password' id='newpass' class='txt'/>
        </div>

        <div>
            <label for='repass'><b>Confirm new password:</b></label>
            <input name='repass' type='password' id='repass' class='txt'/>
        </div>

        <div class="buttons">
        <button name="submit" type='submit'>Apply all changes</button>
        </div>  
        </fieldset>
    </form>
</div>