<h1>Account Details</h1>
<?php
    dbconnect();
    $uid = $_GET['uid'];

    $res = dbquery("SELECT * FROM users WHERE uid = :uid",
                  array('uid'=>$uid));
    

    while($row = $res->fetch(PDO::FETCH_ASSOC)) {
        $username = $row['username'];
        $email = $row['email'];
        $dob = $row['dob'];
        $passwd = $row['passwd'];
        $sex = $row['sex'];
        $bio = $row['bio'];

    
        if ($_SESSION['user']->uid == $_GET['uid']) {
        
            echo "
                <div class='profile'>
                <form method='POST'>
                    <fieldset>
                        <legend>Settings</legend>

                        <div>
                            <label for='username'><b>Username:</b></label>
                            $username
                        </div>

                        <div>
                            <label for='email'><b>E-mail address:</b></label>
                            <input type='text' id='email' class='txt' value='$email' disabled/>
                            <button id='emailb' type='button' onclick='editEmail()'>edit</button>
                        </div>

                        <div>
                            <label for='password'><b>Password:</b></label>
                            <a href='passwordchange'>Change password</a>
                        </div>
                        
                        <div>
                            <label for='dob'><b>Date of birth:</b></label>
                            <input type='date' id='dob' max='2015-01-31' min='1900-01-01' class='txt' value='$dob' disabled/>
                            <button id='dobb' type='button' onclick='editDob()' >edit</button>

                        </div>

                        <div>
                            <label for='sex'><b>Sex:</b></label>
                            ";
                            if ($sex == 'm') {echo 'Male';}
                            else {echo 'Female';}
                             echo "
                        </div> 

                        <div>
                            <label for='bio'><b>Bio:</b></label>
                            <textarea type='text' id='bio' class='txt' disabled>$bio</textarea>
                            <button id='biob' type='button' onclick='editBio()' >edit</button>

                        </div>
                    
                    </fieldset>
      
                </form>
                </div>
        ";
    }
        else {
            echo "
                <div class='profile'>
                <form method='POST'>
                    <fieldset>
                        <legend>Settings</legend>

                        <div>
                            <label for='username'><b>Username:</b></label>
                            <input type='text' id='username' class='txt' disabled value=$username />
                        </div>

                        <div>
                            <label for='bio'><b>Bio:</b></label>
                            <textarea type='text' id='bio' class='txt' disabled>$bio</textarea>
                        </div>
                    
                    </fieldset>
      
                </form>
                </div>
        ";
        }
    }
?> 



<script>
    function editEmail() {
        var elem = document.getElementById("emailb");
        if (elem.innerHTML == "edit") { 
            document.getElementById("email").disabled = false; 
            elem.innerHTML = "save";
        }
        else {
            document.getElementById("email").disabled = true;
            elem.innerHTML = "edit";
            <?php $res = dbquery("UPDATE users SET email = :elemValue WHERE uid = :uid",
                array('uid'=>$uid,
                      'elemValue'=>$elemValue));
                $elemValue = elem.value; ?>
        }
    }
    function editDob() {
        var elem = document.getElementById("dobb");
        if (elem.innerHTML == "edit") { 
            document.getElementById("dob").disabled = false; 
            elem.innerHTML = "save";
        }
        else {
            document.getElementById("dob").disabled = true;
            elem.innerHTML = "edit";
            <?php $res = dbquery("UPDATE users SET dob = :elemValue WHERE uid = :uid",
                  array('uid'=>$uid,
                        'elemValue'=>$elemValue));
                $elemValue = elem.value ?>
        }
    }
    function editBio() {
        var elem = document.getElementById("biob");
        if (elem.innerHTML == "edit") { 
            document.getElementById("bio").disabled = false; 
            elem.innerHTML = "save";
        }
        else {
            document.getElementById("bio").disabled = true;
            elem.innerHTML = "edit";
            <?php $res = dbquery("UPDATE users SET bio= :elemInnerHTML WHERE uid = :uid",
                  array('uid'=>$uid,
                        'elemInnerHTML'=>$eleminnerHTML));
                $elemInnerHTML = elem.innerHTML ?>
        }
    }
</script>
?>
