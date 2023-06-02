<?php
session_start();

$message = "Pls, set correct login and password";

$users = array('admin'=>'12qwerty','user'=>'23qwerty','guest'=>'');

//if user try to log in
if (!empty($_POST['name']) || !empty($_POST['password'])) {
//set value from user input
                    $login = $_POST['name'];
                    $password = $_POST['password'];
                    //get users and passwords
                    foreach ($users as $key => $value) {
                        //compare users input and users data
                        if ($key == $login && $password == $value) {
                            $_SESSION['name'] = $login;
                            $message = "Hi, ".$login. ", you are authorized now";
                            unset($_SESSION['attempt']);
                        }
                    }
                    //set attempts number
                    $_SESSION['attempt']+=1;
                    if ($_SESSION['attempt']>0) {
                        echo "Attempts to log in = " . $_SESSION['attempt'];
                    }
                    //redirect if attempts number more /then 5
                    if ($_SESSION['attempt']>=5){
                        unset($_SESSION['attempt']);
                        header('location:cooldown.php');
                    }

}



?>
<p><?php echo $message ?></p>
<form method="post" name="auth">
    <label for="name">Login
        <input type="text" name="name">
    </label>
    <br>
    <label for="password">Password
        <input type="password" name="password">
    </label>

    <br>

    <input style="color: forestgreen" type="submit">
    <input style="color: red" type="reset">
</form>

