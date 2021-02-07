<?php

template('head', array(
    'title' => 'Home',
)); 
?>

<div class="jumbotron jumbotron-fluid bg-light">
    <div class="container">
    <h1 class="h2">Hello, Welcome to PHPCrud!</h1>
        <p class="lead">This is a simple project i made to learn php with procedural paradigm</p>
        <p>
        <a class="btn btn-primary" href="<?php echo home_url(); ?>/login">Login</a>
            <a class="btn btn-info" href="<?php echo home_url(); ?>/register">Register</a>
        </p>
    </div>
</div>

<?php template('foot');
