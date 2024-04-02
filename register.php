<?php include 'header.php'; ?>

<div class="back">
  <div class="div-center">
    <div class="content">
      <h3>Register</h3>
      <hr />
      <form action="register_process.php" method="post">
        <div class="form-group">
          <label for="exampleInputEmail1">Email address</label>
          <input type="email" class="form-control" id="exampleInputEmail1" name="email" placeholder="Email" required>
        </div>
        <div class="form-group">
          <label for="exampleInputUsername">Username</label>
          <input type="text" class="form-control" id="exampleInputUsername" name="username" placeholder="Username" required>
        </div>
        <div class="form-group">
          <label for="exampleInputPassword1">Password</label>
          <input type="password" class="form-control" id="exampleInputPassword1" name="password" placeholder="Password" required>
        </div>
        <button type="submit" class="btn btn-primary">Register</button>
        <hr />
        <a href="login.php" class="btn btn-link">Login</a>
      </form>
    </div>
  </div>
</div>

<?php include 'footer.php'; ?>
