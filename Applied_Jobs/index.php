<?php

    include('config/db_connect.php');

    $id = '';

    session_start();

    if(!empty($_SESSION['id'])) {

        $id = $_SESSION['id'];
    }

    $sql = ("SELECT id, company, post FROM jobs WHERE user_id='$id' ORDER BY deadline");

    $result = mysqli_query($conn, $sql);

    $jobs = mysqli_fetch_all($result, MYSQLI_ASSOC);

    mysqli_free_result($result);

    mysqli_close($conn);

?>

<!DOCTYPE html>
<html>

<?php include('templates/header.php'); ?>

<h4 class="center grey-text">Jobs</h4>

<div class="container">
    <div class="row">
        <?php foreach($jobs as $job): ?>

        <div class="col s6 md3">
            <div class="card z-depth-0">
                <img src="img/job.svg" class="job" alt="">
                <div class="card-content center">
                    <h6><?php echo htmlspecialchars($job['company']); ?></h6>
                    <div><?php echo htmlspecialchars($job['post']); ?></div>
                </div>
                <div class="card-action right-align">
                    <a href="details.php?id=<?php echo $job['id']?>" class="brand-text">More info</a>
                </div>
            </div>
        </div>

        <?php endforeach; ?>
    </div>
</div>

<?php include('templates/footer.php'); ?>


</html>