<?php
include('processes/processConnectDb.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = md5($_POST['password']);

    $stmt = $conn->prepare("SELECT * FROM member WHERE username = ? AND password = ?");
    $stmt->bind_param('ss', $username, $password);
    $stmt->execute();

    $result = $stmt->get_result();
    if ($user = $result->fetch_assoc()) {
        $_SESSION['userId'] =  $user['MemberId'];
        $_SESSION['userName'] =$user['FirstName']. " " .$user['LastName'];
        ob_start();
        header('Location: index.php?nav=forum');
        exit;
        ob_end_flush();
        echo "<script type='text/javascript'>$pageContent = 'contentPages/forum.php';</script>";
    } else {
        echo "
            <script type=\"text/javascript\">
                Swal.fire({
                    title: 'Alert!',
                    text: 'User or password wrong!',
                    icon: 'info'
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
                        <h1 class="text-center">Login</h1>
                        <img src="images/home/question.png" alt="About" style="width: 100px;">
                    </div>
                    <div class="col-12 p-3">
                        <form method="POST">
                            <div class="mb-3">
                                <label for="username" class="form-label">Username</label>
                                <input type="text" class="form-control" id="username" name="username" required>
                            </div>
                            <div class="mb-3">
                                <label for="password" class="form-label">Password</label>
                                <input type="password" class="form-control" id="password" name="password" required>
                            </div>
                            <input type="submit" class="btn btn-primary btn-lg" style="background-color: #004aad; color: #FFF!important;" value="Login">
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12 col-md-3"></div>
    </div>
</div>