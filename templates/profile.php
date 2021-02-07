<?php

$user = $_SESSION['username'];
if (empty($user)) {
    redirect('/?view=register');
} else {
    $member = find('users', ['username','=',$user]);
    if ($member === null) {
        throw new Exception('Konten hanya untuk user');
    }
}

template('head', ['title' => 'Profile']); 
?>

<div class="container mt-5">
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-body row">
                    <div class="col-4"><img class="rounded-circle img-fluid" src="https://www.w3schools.com/bootstrap4/img_avatar3.png"/></div>
                    <div class="col-8">
                        <b><?php echo $member['username']; ?></b>
                        <p class="text-muted">@<?php echo $member['username']; ?></p>
                        <p class="mt-3">
                        <i class="fas fa-map-marker-alt"></i> Jakarta, Indonesia<br/>
                        <i class="fas fa-link"></i> <a href="#">http://sololearn.com</a></p>
                        <a href="#" class="btn btn-sm btn-success">Follow</a>
                        <a href="#" class="btn btn-sm btn-danger">Message</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-12 mt-3">
            <div class="card">
                <div class="card-header"><div class="font-weight-bold">Setting</div></div>
                <ul class="list-group list-group-flush">
                    <li class="list-group-item"> MyFiles  </li>
                    <li class="list-group-item"> Change Password </li>
                    <li class="list-group-item"> <a href="<?php echo home_url(); ?>/logout" class="text-danger">Logout</a> </li>
                </ul>
            </div>
        </div> <!-- /.col -->
    </div>
</div>
<?php template('foot');
