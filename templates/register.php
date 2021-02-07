<?php 

$messages = array();
if (!empty($_POST)) {
    $submited_items = array(
    'username' => $_POST['username'],
    'email' => $_POST['email'],
    'password' => $_POST['password'],
    're_password' => $_POST['re_password']
    );

    $validated_items = validate($submited_items, array(
        'username' => array(
            'label' => 'Username',
            'required' => true,
            'sanitize' => 'string',
            'min' => 4,
            'max' => 10,
            'regexp' => '/^[a-zA-Z0-9]+$/'
        ),
        'email' => array(
            'label' => 'Email',
            'required' => true,
            'sanitize' => 'email',
        ),
        'password' => array(
            'label' => 'Password',
            'required' => true,
            'sanitize' => 'string',
            'min' => 6,
            'max' => 20,
            'regexp' => '/[a-zA-Z]+[0-9]|[0-9]+[a-zA-Z]/'
        ),
        're_password' => array(
            'label' => 'Ulangi Password',
            'required' => true,
            'sanitize' => 'string',
            'mathces' => 'password',
        )
    ));

    $result = check_validation($validated_items, array('hash' => 'password:PASSWORD_DEFAULT' ,'remove' => 're_password'));
    if (!is_passed($result)) {
        $messages = $result; 
    } else {
        if(insert('users', $result)) {
            $_SESSION['username'] = $username;
            redirect( '/login' );
        }
    }
}

template('head', ['title' => 'Register']); 
?>

<div class="container py-4">
    <div class="row">
        <div class="col-12">
            <div id="registration" class="card">
                <div class="card-header">
                <a href="<?php echo home_url(); ?>/login" class="float-right btn btn-outline-success mt-1">Log In</a>
                    <h4 class="card-title mt-2">Register</h4>
                </div>
                <div class="card-body">
                    <?php getAlert($messages); ?>
                    <!-- registration form -->
                    <form method="post">
                        <!--kolom username-->
                        <div class="form-group">
                            <label>Username</label>
                            <input type="text" name="username" value="" class="form-control" />
                        </div>
                        <!--end kolom username.//-->
                        
                        <!--kolom email-->
                        <div class="form-group">
                            <label>Email</label>
                            <input type="text" name="email" value="" placeholder="@" class="form-control" />
                        </div>
                        <!--end kolom email.//-->
                        
                        <!--kolom password-->
                        <div class="form-group">
                            <label>Password</label>
                            <input type="password" name="password" placeholder="******" class="form-control" />
                        </div>
                        <!--end kolom password//-->
                        
                        <!--kolom re-password-->
                       <div class="form-group">
                            <label>Konfirmasi password</label>
                            <input type="password" name="re_password" placeholder="******" class="form-control" />
                        </div>
                        <!--end kolom re-password//-->
                            
                        <div class="form-group">
                            <input class="btn btn-info" type="submit" name="register" value="Register"/>
                        </div>
                    </form>
                        </div>
                        <div class="border-top card-body text-center">Sudah mempunyai akun? <a href="./login.php">Log In</a></div>
            </div><!-- /#registration -->
                <small class="text-muted">Dengan mengeklik tombol "Register", Anda menyetujui ketentuan layanan kami.</small>
        </div> <!-- /.col -->
    </div> <!-- /.row -->
</div> <!-- /.container -->

<?php template('register');
