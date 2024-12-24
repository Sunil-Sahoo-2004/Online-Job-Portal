<?php require "../config/config.php"; ?>
<?php require "../includes/header.php"; ?>

<?php 
    if(isset($_SESSION['id'])) {
        header("location: ".APPURL."");
        exit();
    }

    if(isset($_POST['submit'])) {
        if(empty($_POST['email']) OR empty($_POST['password'])) {
            echo "<script>alert('Some inputs are empty')</script>";
        } else {
            $email = $_POST['email'];
            $password = $_POST['password'];

            $login = $conn->query("SELECT * FROM users WHERE email = '$email'");
            $login->execute();

            $select = $login->fetch(PDO::FETCH_ASSOC);

            if($login->rowCount() > 0) {

                if(password_verify($password, $select['mypassword'])) {
                 
                    $_SESSION['username'] = $select['username'];
                    $_SESSION['id'] = $select['id']; 
                    $_SESSION['type'] = $select['type'];
                    $_SESSION['email'] = $select['email'];
                    $_SESSION['image'] = $select['img'];
                    $_SESSION['cv'] = $select['cv'];

                    // Redirect to the homepage or dashboard after successful login
                    header("location: ".APPURL."");
                    exit();
                } else {
                    // Invalid password
                    echo "<script>alert('Invalid user credentials')</script>";
                }
            } else {
                // No user found with that email
                echo "<script>alert('Invalid user credentials')</script>";
            }
        }
    }
?>

<!-- HOME Section -->
<section class="section-hero overlay inner-page bg-image" style="background-image: url('<?php echo APPURL; ?>/images/hero_1.jpg');" id="home-section">
    <div class="container">
        <div class="row">
            <div class="col-md-7">
                <h1 class="text-white font-weight-bold">Log In</h1>
                <div class="custom-breadcrumbs">
                    <a href="<?php echo APPURL; ?>">Home</a> <span class="mx-2 slash">/</span>
                    <span class="text-white"><strong>Log In</strong></span>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Login Form Section -->
<section class="site-section">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <form action="login.php" class="p-4 border rounded" method="POST">
                    <div class="row form-group">
                        <div class="col-md-12 mb-3 mb-md-0">
                            <label class="text-black" for="email">Email</label>
                            <input type="email" id="email" class="form-control" placeholder="Email address" name="email" required>
                        </div>
                    </div>
                    <div class="row form-group mb-4">
                        <div class="col-md-12 mb-3 mb-md-0">
                            <label class="text-black" for="password">Password</label>
                            <input type="password" id="password" class="form-control" placeholder="Password" name="password" required>
                        </div>
                    </div>
                    <div class="row form-group">
                        <div class="col-md-12">
                            <input type="submit" name="submit" value="Log In" class="btn px-4 btn-primary text-white">
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>

<?php require "../includes/footer.php"; ?>
