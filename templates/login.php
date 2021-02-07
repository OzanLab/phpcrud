<?php

$messages = array();
if (!empty($_POST)) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $user = find('users', array('username', '=', $username));
    if ($user) {
        if (!password_verify($password,$user['password'])) {
            $messages['danger'][] = "Wrong password!";
        } else {
            $_SESSION['username'] = $username;
            redirect( '/profile' );
        }
    } else {
        $messages['danger'][] = "Username is not registered!<br>Please register it by clicking registration button";
    }
}

template('head',[
    'title' => 'Login'
]);
?>

<div class="container my-5">
        <div class="row">
            <div class="col-12">
                <div class="card">

                    <div class="card-header">
                        <h4>Login</h4>
                    </div>
                    <div class="card-body">
                    <?php getAlert($messages); ?>
                        <form method="post">
                            <div class="form-group">
                                <label for="username">Username</label>
                                <input id="" class="form-control" type="text" name="username" value="">
                                </div>

                                <div class="form-group">
                                    <label for="password">Password</label>
                                    <input id="" class="form-control" type="password" name="password" placeholder="******">
                                </div>
                                <div class="form-group">
                                    <input class="btn btn-info btn-block" class="form-control" type="submit" value="Login">
                                </div>
                        </form>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
<?php template('head');
