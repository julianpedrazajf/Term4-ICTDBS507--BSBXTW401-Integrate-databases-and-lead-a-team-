<?php
session_start();
include('processConnectDb.php');
// Check if the 'name' parameter is set
if (isset($_SESSION['userId'])) {
    if (isset($_GET['answerSend'])) {
        $answer = $_GET['answerSend'];
        $answerStatus = '1';
        $answerDate = date("Y-m-d H:i:s");
        $categoryId = $_GET['categoryId'];
        $memberId = $_SESSION['userId'];
    
        $stmt3 = $conn->prepare("INSERT INTO question (QuestionDetails, QuestionDate, QuestionStatus, CategoryId, MemberId) VALUES (?, ?, ?, ?, ?)");
        $stmt3->bind_param('sssss', $answer, $answerDate, $answerStatus, $categoryId, $memberId);
        $stmt3->execute();
         $result3 = $stmt3->get_result();
        if (!$result3) {
            echo "
            <script type=\"text/javascript\">
                Swal.fire({
                title: 'Alert!',
                text: 'Answer sent succesfuly!',
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
    } else {
        echo "No name provided.";
        echo "<script>alert('¡You must login before!');</script>";
    }
} else {
    echo "asdfasdfasdf"
    echo "<script>alert('¡You must login before!');</script>";
    echo "<script>console.log('¡You must login before!');</script>";
}
?>