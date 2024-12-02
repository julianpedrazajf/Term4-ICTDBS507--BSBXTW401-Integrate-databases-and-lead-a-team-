<?php
include('processConnectDb.php');
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $titleTopic = $_POST['titleTopic'];
    $stmt3 = $conn->prepare("INSERT INTO category (CategoryName) VALUES (?)");
    $stmt3->bind_param('s', $titleTopic);
    $stmt3->execute();
     $result3 = $stmt3->get_result();
    if (!$result3) {
        echo "
        <script type=\"text/javascript\">
            Swal.fire({
            title: 'Alert!',
            text: 'Topic created succesfuly!',
            icon: 'success'
            });
        </script>";
    header('Location: ../index.php?nav=forum'); // Redirect to products page
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