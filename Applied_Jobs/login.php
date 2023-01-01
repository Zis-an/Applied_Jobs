<?php

    include('config/db_connect.php');

$email = $password = '';
$errors = array('email' => '', 'password' => '');

if (isset($_POST['submit'])) {

    if (empty($_POST['email'])) {
        $errors['email'] = 'Email is required <br/>';
    } else {
        // $email = $_POST['email'];
        // echo $email;
    }

    if (empty($_POST['password'])) {
        $errors['password'] = 'Password is required <br/>';
    } else {
        // $password = $_POST['password'];
        // echo $password;
    }


    if (array_filter($errors)) {

    } else {

        $email = mysqli_real_escape_string($conn, $_POST['email']);

        $password = md5(mysqli_real_escape_string($conn, $_POST['password']));

        $sql = "SELECT * FROM user WHERE email='$email' AND password='$password'";

        if(mysqli_num_rows(mysqli_query($conn, $sql)) == 1){

            $row = mysqli_fetch_assoc(mysqli_query($conn, $sql));

            session_start();

                $_SESSION['id'] = $row['id'];
                $_SESSION['name'] = $row['name'];

            // while($row = mysqli_fetch_assoc(mysqli_query($conn, $sql))){

            //     session_start();
            //     $id = $_SESSION['id'];

            //     $_SESSION['id'] = $row['id'];
            //     $_SESSION['name'] = $row['name'];

            // }

            header('Location: index.php');

        } else {
            echo '<script>alert("Invalid Email or Password!")</script>';
        }
        

        // $result = mysqli_query($conn, $sql);

        // $user = mysqli_fetch_assoc($result);

        // $f_email = $user['email'];
        // $f_pass = $user['pass'];

        // echo $user['email'];
        // echo $user['password'];

        // if(mysqli_query($conn, $sql)){
        //     header('Location: add.php');
        // } else {
        //     echo 'Wrong email or password';
        // }

        // if(mysqli_query($conn, $sql)){
        //     header('Location: add.php');
        // } else {
        //     echo 'Wrong email or password';
        // }

        // if (mysqli_query($conn, $sql)) {
        //     header('Location: login.php');
        //     // echo "inserted";
        // } else {
        //     echo 'query error: ' . mysqli_error($conn);
        // }
    }
}

?>

<!DOCTYPE html>
<html>

<?php include('templates/header.php'); ?>

<section class="container grey-text">

    <form class="white" action="login.php" method="POST">

        <label for="">Email</label>
        <input type="email" name="email" value="<?php echo htmlspecialchars($email); ?>">
        <div class="red-text"><small><?php echo $errors['email']; ?></small></div>

        <label for="">Password</label>
        <input type="password" name="password" value="<?php echo htmlspecialchars($password); ?>">
        <div class="red-text"><small><?php echo $errors['password']; ?></small></div>

        <div class="center" style="padding-top: 9px;">
            <input type="submit" name="submit" value="submit" class="btn brand z-depth-0">
        </div>

        <div>
            <p>Not A Member yet? <a href="register.php" class="right" style="color: #008B8B;">Register Now</a></p>
        </div>

    </form>

</section>


<?php include('templates/footer.php'); ?>

</html>