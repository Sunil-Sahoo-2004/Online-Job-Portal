<?php
ob_start();
require "../includes/header.php";
require "../config/config.php";

if (!isset($_SESSION['username'])) {
  header("location: " . APPURL . "");
  exit(); // Stop further execution after redirect.
}

if (isset($_GET['upd_id'])) {
  $id = $_GET['upd_id'];

  if ($_SESSION['id'] != $id) {
    header("location: " . APPURL . "");
    exit();
  }

  $select = $conn->prepare("SELECT * FROM users WHERE id=:id");
  $select->execute([':id' => $id]);

  $row = $select->fetch(PDO::FETCH_OBJ);

  if (isset($_POST['submit'])) {
    if (empty($_POST['username']) || empty($_POST['email'])) {
      echo "<script>alert('Username or email cannot be empty')</script>";
    } else {
      $username = $_POST['username'];
      $email = $_POST['email'];
      $title = $_POST['title'];
      $bio = $_POST['bio'];
      $facebook = $_POST['facebook'];
      $twitter = $_POST['twitter'];
      $linkedin = $_POST['linkedin'];

      // Handle image upload
      $img = !empty($_FILES['img']['name']) ? $_FILES['img']['name'] : $row->img;
      $dir_img = !empty($_FILES['img']['name']) ? 'user-images/' . basename($img) : null;

      // Handle CV upload (only for "Worker" type)
      $cv = ($row->type == "Worker" && !empty($_FILES['cv']['name'])) ? $_FILES['cv']['name'] : $row->cv;
      $dir_cv = ($row->type == "Worker" && !empty($_FILES['cv']['name'])) ? 'user-cvs/' . basename($cv) : null;

      // Update the database
      $update = $conn->prepare(
        "UPDATE users SET username = :username, email = :email, title = :title,
                 bio = :bio, facebook = :facebook, twitter = :twitter, linkedin = :linkedin, img = :img, cv = :cv 
                 WHERE id = :id"
      );

      // If new files are uploaded, delete old ones
      if ($dir_img && file_exists("user-images/" . $row->img)) {
        unlink("user-images/" . $row->img);
      }
      if ($dir_cv && file_exists("user-cvs/" . $row->cv)) {
        unlink("user-cvs/" . $row->cv);
      }

      // Move uploaded files
      if ($dir_img) {
        move_uploaded_file($_FILES['img']['tmp_name'], $dir_img);
      }
      if ($dir_cv) {
        move_uploaded_file($_FILES['cv']['tmp_name'], $dir_cv);
      }

      // Execute update query
      $update->execute([
        ':username' => $username,
        ':email' => $email,
        ':title' => $title,
        ':bio' => $bio,
        ':facebook' => $facebook,
        ':twitter' => $twitter,
        ':linkedin' => $linkedin,
        ':img' => $img,
        ':cv' => $cv,
        ':id' => $id,
      ]);

      header("location: " . APPURL . "");
      exit();
    }
  }
} else {
  echo "404";
}

ob_end_flush();
?>

<section class="section-hero overlay inner-page bg-image" style="background-image: url('../images/hero_1.jpg');"
  id="home-section">
  <div class="container">
    <div class="row">
      <div class="col-md-7">
        <h1 class="text-white font-weight-bold">Update Profile</h1>
        <div class="custom-breadcrumbs">
          <a href="<?php echo APPURL; ?>">Home</a> <span class="mx-2 slash">/</span>
          <span class="text-white"><strong>Update Profile</strong></span>
        </div>
      </div>
    </div>
  </div>
</section>

<section class="site-section" id="next-section">
  <div class="container">
    <div class="row">
      <div class="col-lg-6 mb-5 mb-lg-0">
        <form action="update-profile.php?upd_id=<?php echo $id; ?>" method="POST" enctype="multipart/form-data">
          <div class="row form-group">
            <div class="col-md-6 mb-3 mb-md-0">
              <label class="text-black" for="fname">Username</label>
              <input type="text" id="fname" value="<?php echo $row->username; ?>" name="username" class="form-control">
            </div>
            <div class="col-md-6">
              <label class="text-black" for="lname">Email</label>
              <input type="text" id="lname" value="<?php echo $row->email; ?>" name="email" class="form-control">
            </div>
          </div>

          <?php if ($row->type == "Worker"): ?>
            <div class="row form-group">
              <div class="col-md-12">
                <label class="text-black" for="email">Title</label>
                <input type="text" id="" value="<?php echo $row->title; ?>" name="title" class="form-control">
              </div>
            </div>
          <?php else: ?>
            <input type="hidden" id="" value="NULL" name="title" class="form-control">
          <?php endif; ?>

          <div class="row form-group">
            <div class="col-md-12">
              <label class="text-black" for="message">Bio</label>
              <textarea name="bio" cols="30" rows="7" class="form-control"><?php echo $row->bio; ?></textarea>
            </div>
          </div>

          <div class="row form-group">
            <div class="col-md-12">
              <label class="text-black" for="subject">Facebook</label>
              <input type="subject" name="facebook" value="<?php echo $row->facebook; ?>" class="form-control">
            </div>
          </div>

          <div class="row form-group">
            <div class="col-md-12">
              <label class="text-black" for="subject">Twitter</label>
              <input type="subject" name="twitter" value="<?php echo $row->twitter; ?>" class="form-control">
            </div>
          </div>

          <div class="row form-group">
            <div class="col-md-12">
              <label class="text-black" for="subject">LinkedIn</label>
              <input type="subject" name="linkedin" value="<?php echo $row->linkedin; ?>" class="form-control">
            </div>
          </div>

          <div class="row form-group">
            <div class="col-md-12">
              <label class="text-black" for="subject">Image</label>
              <input type="file" name="img" class="form-control">
            </div>
          </div>

          <?php if ($row->type == "Worker"): ?>
            <div class="row form-group">
              <div class="col-md-12">
                <label class="text-black" for="subject">CV</label>
                <input type="file" name="cv" class="form-control">
              </div>
            </div>
          <?php endif; ?>

          <div class="row form-group">
            <div class="col-md-12">
              <input type="submit" name="submit" value="Update" class="btn btn-primary btn-md text-white">
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
</section>

<?php require "../includes/footer.php"; ?>