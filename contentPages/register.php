<?php
include('processes/processConnectDb.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $lastname = $_POST['lastname'];
    $firstname = $_POST['firstname'];
    $email = $_POST['email'];
    $username = $_POST['username'];
    $password = md5($_POST['password']);
    $memberImageFilename = "defaultUser.png";

    $stmt = $conn->prepare("INSERT INTO member (LastName, FirstName, EmailAddress, UserName, Password, memberImageFilename) 
                            VALUES (?, ?, ?, ?, ?, ?)");
    $stmt->bind_param('ssssss', $lastname, $firstname, $email, $username, $password, $memberImageFilename);
    $stmt->execute();

    $result = $stmt->get_result();
    echo $result;
    if (!$result) {
        echo "
        <script type=\"text/javascript\">
            Swal.fire({
            title: 'Alert!',
            text: 'User created succesfuly!',
            icon: 'success'
            });
        </script>";
            // header('Location: index.php'); // Redirect to products page
    } else {
        echo "
            <script type=\"text/javascript\">
                Swal.fire({
                    title: 'Alert!',
                    text: 'something wrong!',
                    icon: 'error'
                    });
            </script>";
    }
}
?>

<div class="container p-0">
    <div class="row">
        <div class="col-12 col-md-3"></div>
        <div class="col-12 col-md-6">
            <div class="container p-0 text-center">
                <div class="row p-2" id="askOrSearchQuestions" style="background-color: #0b1927; color: #FFF;">
                    <div class="col-12">
                        <h1 class="text-center">Register</h1>
                    </div>
                    <div class="col-12 p-3">
                        <form method="POST">
                            <div class="mb-3">
                                <label for="lastname" class="form-label">Last Name</label>
                                <input type="text" class="form-control" id="lastname" name="lastname" required>
                            </div>
                            <div class="mb-3">
                                <label for="firstname" class="form-label">First Name</label>
                                <input type="text" class="form-control" id="firstname" name="firstname" required>
                            </div>
                            <div class="mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" class="form-control" id="email" name="email" required>
                            </div>
                            <div class="mb-3">
                                <label for="username" class="form-label">Username</label>
                                <input type="text" class="form-control" id="username" name="username" required>
                            </div>
                            <div class="mb-3">
                                <label for="password" class="form-label">Password</label>
                                <input type="password" class="form-control" id="password" name="password" required>
                            </div>
                            <input type="submit" class="btn btn-primary btn-lg" style="background-color: #004aad; color: #FFF!important;"  value="Register">
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12 col-md-3"></div>
    </div>
</div>