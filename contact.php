<?php require "includes/header.php"; ?>
<?php require "config/config.php"; ?>

<?php


if (isset($_POST['submit'])) {
  if (!isset($_SESSION['id']) || $_SESSION['id'] == '') {
    header("Location: " . APPURL . "/auth/login.php");
    exit();
  }

  if (empty($_POST['fname']) or empty($_POST['lname']) or empty($_POST['email']) or empty($_POST['subject']) or empty($_POST['message'])) {
    echo "<script>alert('some inputs are empty')</script>";
  } else {

    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $email = $_POST['email'];
    $subj = $_POST['subject'];
    $mess = $_POST['message'];

    //checking for password match
    if (strlen($email) > 50 or strlen($fname) > 50) {

      echo "<script>alert('email or username is too big')</script>";
    } else {

      $insert = $conn->prepare("INSERT INTO contacts (first_name, last_name, email, subject, message) 
              VALUES (:first_name, :last_name, :email, :subject, :message)");

      $insert->execute([
        ':first_name' => $fname,
        ':last_name' => $lname,
        ':email' => $email,
        ':subject' => $subj,
        ':message' => $mess,
      ]);

      echo "<script>alert('Message sent successfully')</script>";
    }

  }


}
?>



<!-- HOME -->
<!-- <section class="section-hero overlay inner-page bg-image" style="background-image: url('images/hero_1.jpg');"
  id="home-section">
  <div class="container">
    <div class="row">
      <div class="col-md-7">
        <h1 class="text-white font-weight-bold">Contact Us</h1>
        <div class="custom-breadcrumbs">
          <a href="#">Home</a> <span class="mx-2 slash">/</span>
          <span class="text-white"><strong>Contact Us</strong></span>
        </div>
      </div>
    </div>
  </div>
</section>

<section class="site-section" id="next-section">
  <div class="container">
    <div class="row">
      <div class="col-lg-6 mb-5 mb-lg-0">

        <form action="contact.php" method="POST">

          <div class="row form-group">
            <div class="col-md-6 mb-3 mb-md-0">
              <label class="text-black" for="fname">First Name</label>
              <input type="text" id="fname" name="fname" class="form-control" required>
            </div>
            <div class="col-md-6">
              <label class="text-black" for="lname">Last Name</label>
              <input type="text" id="lname" name="lname" class="form-control" required>
            </div>
          </div>

          <div class="row form-group">
            <div class="col-md-12">
              <label class="text-black" for="email">Email</label>
              <input type="email" id="email" name="email" class="form-control" required>
            </div>
          </div>

          <div class="row form-group">
            <div class="col-md-12">
              <label class="text-black" for="subject">Subject</label>
              <input type="text" id="subject" name="subject" class="form-control" required>
            </div>
          </div>

          <div class="row form-group">
            <div class="col-md-12">
              <label class="text-black" for="message">Message</label>
              <textarea name="message" id="message" cols="30" rows="7" class="form-control"
                placeholder="Write your notes or questions here..." required></textarea>
            </div>
          </div>

          <div class="row form-group">
            <div class="col-md-12">
              <input type="submit" name="submit" value="Send Message" class="btn btn-primary btn-md text-white">
            </div>
          </div>

        </form>
      </div>

    </div>

  </div>
</section> -->


<section class="section-hero overlay inner-page bg-image" style="background-image: url('images/hero_1.jpg');"
  id="home-section">
  <div class="container">
    <div class="row">
      <div class="col-md-7">
        <h1 class="text-white font-weight-bold">Contact Us</h1>
        <div class="custom-breadcrumbs">
          <a href="#">Home</a> <span class="mx-2 slash">/</span>
          <span class="text-white"><strong>Contact Us</strong></span>
        </div>
      </div>
    </div>
  </div>
</section>

<section class="site-section" id="next-section">
  <div class="container">
    <div class="row">
      <!-- Form Section -->
      <div class="col-lg-6 mb-5 mb-lg-0" style="padding-right: 20px;">
        <form action="contact.php" method="POST">
          <!-- Form Fields -->
          <div class="row form-group">
            <div class="col-md-6 mb-3 mb-md-0">
              <label class="text-black" for="fname">First Name</label>
              <input type="text" id="fname" name="fname" class="form-control" required>
            </div>
            <div class="col-md-6">
              <label class="text-black" for="lname">Last Name</label>
              <input type="text" id="lname" name="lname" class="form-control" required>
            </div>
          </div>
          <div class="row form-group">
            <div class="col-md-12">
              <label class="text-black" for="email">Email</label>
              <input type="email" id="email" name="email" class="form-control" required>
            </div>
          </div>
          <div class="row form-group">
            <div class="col-md-12">
              <label class="text-black" for="subject">Subject</label>
              <input type="text" id="subject" name="subject" class="form-control" required>
            </div>
          </div>
          <div class="row form-group">
            <div class="col-md-12">
              <label class="text-black" for="message">Message</label>
              <textarea name="message" id="message" cols="30" rows="7" class="form-control"
                placeholder="Write your notes or questions here..." required></textarea>
            </div>
          </div>
          <div class="row form-group">
            <div class="col-md-12">
              <input type="submit" name="submit" value="Send Message" class="btn btn-primary btn-md text-white">
            </div>
          </div>
        </form>
      </div>

      <!-- Map Section -->
      <div class="col-lg-6 mb-lg-0" style="padding-left: 20px;">
        <!-- Map Section -->
        <div class="embed-responsive embed-responsive-16by9"
          style="border-radius: 15px; overflow: hidden; box-shadow: 0 4px 8px rgba(0,0,0,0.2);">
          <iframe
            src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d5635.818178325761!2d76.8734976!3d30.878419!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x390ff55d9e0ed113%3A0x34a6cadf9a13d341!2sCHITKARA%20UNIVERSITY%2C%20BADDI!5e1!3m2!1sen!2sau!4v1733168742696!5m2!1sen!2sau"
            width="100%" height="400" style="border:0;" allowfullscreen="" loading="lazy" class="embed-responsive-item">
          </iframe>
        </div>

        <!-- Contact Details Section -->
        <div class="contact-details mt-4"
          style="background-color: #f8f9fa; padding: 15px; border-radius: 10px; box-shadow: 0 2px 6px rgba(0,0,0,0.1);">
          <h5>Contact Details</h5>
          <p><strong>Address:</strong> Chitkara University, Baddi, Himachal Pradesh, India</p>
          <p><strong>Phone:</strong> <a href="tel:+917029003642">+91 7029003642</a></p>
          <p><strong>Email:</strong> <a
              href="mailto:info@chitkara.edu.in">rahamatulla6040.bca22@chitkrauniversity.edu.in</a></p>
          <p><strong>Office Hours:</strong> Mon - Fri: 9:00 AM - 5:00 PM</p>
        </div>
      </div>

    </div>

  </div>
</section>

<?php require "includes/footer.php"; ?>