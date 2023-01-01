<?php

include('config/db_connect.php');

session_start();

if(isset($_POST['delete'])){

    $id_to_delete = mysqli_real_escape_string($conn, $_POST['id_to_delete']);

    $sql = "DELETE FROM jobs WHERE id = $id_to_delete";

    if(mysqli_query($conn, $sql)){
        header('Location: index.php');
    } else {
        echo 'query erro:' . mysqli_error($conn);
    }
}

if (isset($_GET['id'])) {

    $id = mysqli_real_escape_string($conn, $_GET['id']);

    $sql = "SELECT * FROM jobs WHERE id = $id";

    $result = mysqli_query($conn, $sql);

    $job = mysqli_fetch_assoc($result);

    mysqli_free_result(($result));

    mysqli_close($conn);
}

?>
<!DOCTYPE html>
<html>

<?php include('templates/header.php'); ?>

<div class="container center">
    <?php if ($job) : ?>

        <h4>Company Name: <?php echo htmlspecialchars($job['company']); ?></h4>
        <h5>Post: <?php echo htmlspecialchars($job['post']); ?></h5>
        <h5>Employer's Mail Address: <?php echo htmlspecialchars($job['mail']); ?></h5>
        <h5>Employer's Contact No: <?php echo htmlspecialchars($job['contact']); ?></h5>
        <h5>Office Address: <?php echo htmlspecialchars($job['addr']); ?></h5>
        <h5>Salary: <?php echo htmlspecialchars($job['salary']); ?>/-</h5>
        <h4>Deadline: <?php echo htmlspecialchars($job['deadline']); ?></h4>

        <form action="details.php" method="POST">
            <input type="hidden" name="id_to_delete" value="<?php echo $job['id'] ?>">
            <input type="submit"name="delete" value="Delete" class="btn brand z-depth-0">
        </form>

    <?php else : ?>

        <h5>No such Job exists!</h5>

    <?php endif; ?>
</div>

<?php include('templates/footer.php'); ?>

</html>