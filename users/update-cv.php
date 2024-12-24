<?php
ob_start();
require "../includes/header.php";
require "../config/config.php";


if (!isset($_SESSION['username'])) {
    header("Location: " . APPURL . "");
    exit();
}

if (isset($_POST['submit'])) {
    if (isset($_FILES['cv-file'])) {
        $file = $_FILES['cv-file'];
        $fileName = $file['name'];
        $fileTmpName = $file['tmp_name'];
        $fileSize = $file['size'];
        $fileError = $file['error'];
        $fileType = $file['type'];

        $allowed = array('pdf', 'doc', 'docx');

        $fileExt = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));

        if (in_array($fileExt, $allowed)) {

            if ($fileError === 0) {

                if ($fileSize < 10000000) {
                    $fileNewName = uniqid('', true) . '.' . $fileExt;
                    $fileDestination = 'user-cvs/' . $fileNewName;

                    if (move_uploaded_file($fileTmpName, $fileDestination)) {
                        $userId = $_SESSION['id'];

                        $updateCvQuery = $conn->prepare("UPDATE users SET cv = :cv WHERE id = :id");
                        $updateCvQuery->execute([
                            ':cv' => $fileNewName,
                            ':id' => $userId
                        ]);

                        echo "<script>alert('CV updated successfully'); window.location.href='" . APPURL . "';</script>";
                    } else {
                        echo "<script>alert('Error moving the file');</script>";
                    }
                } else {
                    echo "<script>alert('File size exceeds the limit');</script>";
                }
            } else {
                echo "<script>alert('Error uploading file');</script>";
            }
        } else {
            echo "<script>alert('Invalid file type');</script>";
        }
    } else {
        echo "<script>alert('No file uploaded');</script>";
    }
}
ob_end_flush();
?>

<section class="section-hero overlay inner-page bg-image" style="background-image: url('../images/hero_1.jpg');"
    id="home-section">
    <div class="container">
        <div class="row">
            <div class="col-md-7">
                <h1 class="text-white font-weight-bold">Update CV</h1>
                <div class="custom-breadcrumbs">
                    <a href="<?php echo APPURL; ?>">Home</a> <span class="mx-2 slash">/</span>
                    <span class="text-white"><strong>Update CV</strong></span>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="site-section" id="next-section">
    <div class="container">
        <h2 class="section-title">Update Your CV</h2>
        <form action="" method="POST" enctype="multipart/form-data">
            <div class="form-group">
                <label for="cv-upload" class="form-label">Upload Your CV (PDF, DOC, DOCX)</label>
                <input type="file" id="cv-upload" name="cv-file" class="form-control" accept=".pdf, .doc, .docx"
                    required>
            </div>
            <div class="form-group">
                <button name="submit" type="submit" class="btn btn-primary">Upload CV</button>
            </div>
        </form>
    </div>
</section>

<?php require "../includes/footer.php"; ?>