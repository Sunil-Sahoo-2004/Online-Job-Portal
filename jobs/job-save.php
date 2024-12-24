<?php
ob_start(); // Start output buffering
require "../includes/header.php";
require "../config/config.php";

if (isset($_GET['job_id']) && isset($_GET['worker_id']) && isset($_GET['status'])) {

    $job_id = $_GET['job_id'];
    $worker_id = $_GET['worker_id'];
    $status = $_GET['status'];

    if ($status == 'save') {
        $insert = $conn->prepare("INSERT INTO saved_jobs(job_id, worker_id) VALUES(:job_id, :worker_id)");
        $insert->execute([
            ':job_id' => $job_id,
            ':worker_id' => $worker_id,
        ]);

        header("Location: " . APPURL . "/jobs/job-single.php?id=" . $job_id);
        exit(); // Stop script after redirect
    } else {
        $delete = $conn->prepare("DELETE FROM saved_jobs WHERE job_id = :job_id AND worker_id = :worker_id");
        $delete->execute([
            ':job_id' => $job_id,
            ':worker_id' => $worker_id,
        ]);

        header("Location: " . APPURL . "/jobs/job-single.php?id=" . $job_id);
        exit();
    }
}

ob_end_flush(); // Flush output buffer
?>
<?php require "../includes/footer.php"; ?>