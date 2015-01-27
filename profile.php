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
        
            
                $email2 = $_POST['email'];
                $dob2 = $_POST['dob'];
                $bio2 = $_POST['bio'];
                $res2 = dbquery("UPDATE users
                                 SET email = :email,
                                     dob = :dob,
                                     bio = :bio
                                 WHERE uid = :uid",
                        array('uid' => $uid,
                              'email' => $email2,
                              'dob' => $dob2,
                              'bio' => $bio2));
            
            echo "
            <h1>Account Details</h1>

                <div class='profile'>
                <form action= echo htmlspecialchars($_SERVER['PHP_SELF']) method='POST'>
                    <fieldset>
                        <legend>Settings</legend>

                        <div>
                            <label for='username'><b>Username:</b></label>
                            $username
                        </div>

                        <div>
                            <label for='email'><b>E-mail address:</b></label>
                            <input name='email' type='text' id='email' class='txt' disabled value=$email />
                            <button name='update' id='emailb' type='button' onclick='editEmail()'>edit</button>
                        </div>

                        <div>
                            <label for='password'><b>Password:</b></label>
                            <a href='changepassword.php'>Change password</a>
                        </div>
                        
                        <div>
                            <label for='dob'><b>Date of birth:</b></label>
                            <input type='date' name='dob' id='dob' max='2015-01-31' min='1900-01-01' class='txt' disabled value=$dob />
                            <button name='update' id='dobb' type='button' onclick='editDob()' >edit</button>

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
                            <textarea type='text' name='bio' id='bio' class='txt' disabled>$bio</textarea>
                            <button name='update' id='biob' type='button' onclick='editBio()' >edit</button>
                        </div>  
                    </fieldset>
                    <button name='submit' type='submit'>Apply all changes</button>
                </form>
                </div>
            ";
        }
        else {
            echo "
                <div class='profile'>
                <form method='POST'>
                    <fieldset>
                        <legend>$username</legend>

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
        }
    }
</script>
