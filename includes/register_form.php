<div class="container">
    <div class="row">
        <div class="col-md-6 offset-md-3 mt-5">
            <h1 class="display-4 text-center">Create account</h1>
            <form action="<?php echo $_SERVER['PHP_SELF'];?>" method="post">
                <div class="form-group">
                    <label for="first_name">First Name</label>
                    <input type="text" class="form-control" name="first_name" placeholder="Enter First Name" maxlength="30" value="<?php echo $_SESSION['first_name'];?>"><span class="error"><?php echo $first_nameErr;?></span>
                </div>

                <div class="form-group">
                    <label for="last_name">Last Name</label>
                    <input type="text" class="form-control" name="last_name" placeholder="Enter Last Name" maxlength="30" value="<?php echo $_SESSION['last_name'];?>"><span class="error"><?php echo $last_nameErr;?></span>
                </div>

                <div class="form-group">
                    <label for="user">Username</label>
                    <input class="form-control" name="username" type="text" id="username" placeholder="Enter Username" maxlength="30" value="<?php echo $_SESSION['username']; ?>"><span class="error"><?php echo $usernameErr;?></span>
                </div>

                <div class="form-group">
                    <label for="email">Email</label>
                    <input class="form-control" name="email" type="text" id="email" placeholder="Enter Email" maxlength="30" value="<?php echo $_SESSION['email']; ?>"><span class="error"><?php echo $emailErr;?></span>
                </div>

                <div class="form-group">
                    <label for="password">Password</label>
                    <input class="form-control" name="password" type="password" id="password" placeholder="Enter password" maxlength="30" value="<?php echo $_SESSION['password']; ?>"><span class="error"><?php echo $passwordErr;?></span>
                </div>

                <div class="form-group">
                    <label for="confirm_password">Confirm Password</label>
                    <input class="form-control" name="confirm_password" type="password" placeholder="Confirm password" id="password2" maxlength="30" value="<?php echo $_SESSION['confirm_password']; ?>"><span class="error"><?php echo $confirm_passwordErr;?></span>
                </div>

                <div class="form-group">
                    <label for="age">Age</label>
                    <input type="text" class="form-control" name="age" placeholder="Enter your age" maxlength="3"  value="<?php echo $_SESSION['age'];?>"><span class="error"><?php echo $ageErr;?></span>
                </div>

                <button class="btn btn-primary btn-block" type="submit" name="register">Register</button>
                <a href="login.php" class="btn btn-success btn-block"  name="login">Login</a>

            </form>
        </div>
    </div>
</div>