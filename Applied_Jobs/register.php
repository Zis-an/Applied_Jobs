<?php

include('config/db_connect.php');

$name = $email = $password = $confirm = '';
$errors = array('name' => '', 'email' => '', 'password' => '', 'confirm' => '');

if (isset($_POST['submit'])) {

    if (empty($_POST['name'])) {
        $errors['name'] = 'Name is required <br/>';
    } else {
        $name = $_POST['name'];
        if (!preg_match('/^[a-zA-Z\s]+$/', $name)) {
            $errors['name'] = 'Name must be letters only <br/>';
        }
    }

    if (empty($_POST['email'])) {
        $errors['email'] = 'Email is required <br/>';
    } else {
        $email = $_POST['email'];
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $errors['email'] = 'Email must be valid <br/>';
        }
    }

    if (empty($_POST['password'])) {
        $errors['password'] = 'Password is required <br/>';
    } else {
        $password = $_POST['password'];
        if (!preg_match('/^.{8,}$/', $password)) {
            $errors['password'] = 'Invalid Password <br/>';
        }
    }

    if (empty($_POST['confirm'])) {
        $errors['confirm'] = 'Confirm Password is required <br/>';
    } else {
        $confirm = $_POST['confirm'];
        if ($confirm != $_POST['password']) {
            $errors['confirm'] = 'Password did not match';
        }
    }

    if (array_filter($errors)) {

    } else {

        $name = mysqli_real_escape_string($conn, $_POST['name']);
        $email = mysqli_real_escape_string($conn, $_POST['email']);
        $password = md5(mysqli_real_escape_string($conn, $_POST['password']));

        $sql = "SELECT * FROM user WHERE email='$email'";

        if(mysqli_query($conn, $sql)){

            $num = mysqli_num_rows(mysqli_query($conn, $sql));

            if($num != 0){
                echo '<script>alert("Email already in use!")</script>';
            } else {

                $sql = "INSERT INTO user(`name`, `email`, `password`) VALUES('$name', '$email', '$password')";

                if (mysqli_query($conn, $sql)) {
                    header('Location: login.php');
                } else {
                    echo 'query error: ' . mysqli_error($conn);
                }
            }
        }
    }
}



?>

<!DOCTYPE html>
<html>

<?php include('templates/header.php'); ?>

<section class="container grey-text">

    <form class="white" action="register.php" method="POST">

        <label for="">Name</label>
        <input type="text" name="name" value="<?php echo htmlspecialchars($name); ?>">
        <div class="red-text"><small><?php echo $errors['name']; ?></small></div>

        <label for="">Email</label>
        <input type="email" name="email" value="<?php echo htmlspecialchars($email); ?>">
        <div class="red-text"><small><?php echo $errors['email']; ?></small></div>

        <label for="">Password (Must be at lease 8 characters long)</label>
        <input type="password" name="password" value="<?php echo htmlspecialchars($password); ?>">
        <div class="red-text"><small><?php echo $errors['password']; ?></small></div>

        <label for="">Confirm Password</label>
        <input type="password" name="confirm" value="<?php echo htmlspecialchars($confirm); ?>">
        <div class="red-text"><small><?php echo $errors['confirm']; ?></small></div>

        <div class="center" style="padding-top: 9px;">
            <input type="submit" name="submit" value="submit" class="btn brand z-depth-0">
        </div>

        <div>
            <p>Already A Member? <a href="login.php" class="right" style="color: #008B8B;">Login</a></p>
        </div>

    </form>

</section>


<?php include('templates/footer.php'); ?>

</html>