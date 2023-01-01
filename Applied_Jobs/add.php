<?php

include('config/db_connect.php');

$company = $post_name = $email = $address = $dead = $contact = $salary = '';
$errors = array('company' => '', 'postname' => '', 'em_mail' => '', 'dead' => '');

if (isset($_POST['submit'])) {

    if (empty($_POST['company'])) {
        $errors['company'] = 'Company Name is required <br/>';
    } else {
        $company = $_POST['company'];
        if (!preg_match('/^[a-zA-Z0-9\s]+$/', $company)) {
            $errors['company'] = 'Company names must be letters, numbers and spaces only <br/>';
        }
    }

    if (empty($_POST['postname'])) {
        $errors['postname'] = 'Post Name is required <br/>';
    } else {
        $post_name = $_POST['postname'];
        if (!preg_match('/^[a-zA-Z\s]+$/', $post_name)) {
            $errors['postname'] = 'Post name must be letters and spaces only';
        }
    }

    if (empty($_POST['em_mail'])) {
        $errors['em_mail'] = "Employer's Mail Address is required <br/>";
    } else {
        $email = $_POST['em_mail'];
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $errors['em_mail'] = 'Email must be a valid Email Address';
        }
    }

    if (empty($_POST['address'])) {
        // echo "Company Address is required <br/>";
    } else {
        $address = $_POST['address'];
        // echo htmlspecialchars($_POST['address']);
    }

    if (empty($_POST['dead'])) {
        $errors['dead'] = "Deadline is required <br/>";
    } else {
        $dead = $_POST['dead'];
        // echo htmlspecialchars($_POST['dead']);
    }

    $contact = $_POST['contact'];
    $salary = $_POST['salary'];

    // echo htmlspecialchars($_POST['contact']);
    // echo htmlspecialchars($_POST['salary']);

    if (array_filter($errors)) {

        // echo 'Error in the Form.';
        
    } elseif(empty($_SESSION['id'])) {

        header('Location: login.php');

    } else {
        $company = mysqli_real_escape_string($conn, $_POST['company']);
        $post_name = mysqli_real_escape_string($conn, $_POST['postname']);
        $email = mysqli_real_escape_string($conn, $_POST['em_mail']);
        $address = mysqli_real_escape_string($conn, $_POST['address']);
        $dead = mysqli_real_escape_string($conn, $_POST['dead']);
        $contact = mysqli_real_escape_string($conn, $_POST['contact']);
        $salary = mysqli_real_escape_string($conn, $_POST['salary']);
        
        session_start();
        $user_id = $_SESSION['id'];

        $sql = "INSERT INTO jobs(company, post, mail, contact, addr, salary, deadline, user_id) VALUES('$company', '$post_name', '$email', '$contact', '$address', '$salary', '$dead', '$user_id')";

        if(mysqli_query($conn, $sql)){
            header('Location: index.php');
        } else {
            echo 'query error:' . mysqli_error($conn);
        }
    }
}
?>

<!DOCTYPE html>
<html>

<?php include('templates/header.php'); ?>

<section class="container grey-text">
    <h4 class="center">Add a Job</h4>
    <form class="white" action="add.php" method="POST">

        <label for="">Company Name</label>
        <input type="text" name="company" value="<?php echo htmlspecialchars($company); ?>">
        <div class="red-text"><small><?php echo $errors['company']; ?></small></div>

        <label for="">Post Name</label>
        <input type="text" name="postname" value="<?php echo htmlspecialchars($post_name); ?>">
        <div class="red-text"><small><?php echo $errors['postname']; ?></small></div>

        <label for="">Employer's Email</label>
        <input type="email" name="em_mail" value="<?php echo htmlspecialchars($email); ?>">
        <div class="red-text"><small><?php echo $errors['em_mail']; ?></small></div>

        <label for="">Company's Contact Number</label>
        <input type="tel" name="contact" value="<?php echo htmlspecialchars($contact); ?>">

        <label for="">Company's Address</label>
        <input type="text" name="address" value="<?php echo htmlspecialchars($address); ?>">

        <label for="">Salary</label>
        <input type="number" name="salary" value="<?php echo htmlspecialchars($salary); ?>">

        <label for="">Deadline</label>
        <input type="date" id="inputdate" name="dead" value="<?php echo htmlspecialchars($dead); ?>">
        <div class="red-text"><small><?php echo $errors['dead']; ?></small></div>


        <div class="center" style="padding-top: 9px;">
            <input type="submit" name="submit" value="submit" class="btn brand z-depth-0">
        </div>


    </form>
</section>


<?php include('templates/footer.php'); ?>

<script type="text/javascript">
    $(function() {
        var dtToday = new Date();

        var month = dtToday.getMonth() + 1;
        var day = dtToday.getDate();
        var year = dtToday.getFullYear();
        if (month < 10)
            month = '0' + month.toString();
        if (day < 10)
            day = '0' + day.toString();
        var maxDate = year + '-' + month + '-' + day;
        $('#inputdate').attr('min', maxDate);
    });
</script>


</html>