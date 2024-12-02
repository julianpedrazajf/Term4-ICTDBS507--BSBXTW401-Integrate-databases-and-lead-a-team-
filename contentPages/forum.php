<?php
    include('processes/processConnectDb.php');
    function SentAnswer($answer) {
              echo "Hello, " . $name . "!";
              echo "<script type='text/javascript'>alert('Hello from PHP!');</script>";
          }
          
          // Check if the form is submitted and call the function
          if ($_SERVER['REQUEST_METHOD'] == 'POST') {
              // Get the name from the form input and pass it to the function
             if (isset($_POST['answer'])) {
                  $answer = $_POST['answer'];
              } else {
                  $answer = '';  // Or set a default value if the 'answer' is not set
              }
              if (isset($name)) {
                  SentAnswer($name);
              } else {
                  $name = '';  // Or set a default value if the 'answer' is not set
              }  
       }
?>
<div class="container">
    <!-- Titulo del Foro -->
    <h1 class="text-center mb-4">Welcome to the Forum</h1>
    <!-- Lista de Temas -->
    <div id="temas">
        <div class="accordion" id="accordionExample">
            <?php
                include('processes/processConnectDb.php');

                $stmt = $conn->prepare("SELECT * FROM `category` ORDER BY CategoryId DESC");
                $stmt->execute();
                $result = $stmt->get_result();

                if ($result->num_rows > 0) {
                    echo "<option>Select a topic</option>"; // Default option
                    while ($row = $result->fetch_assoc()) {
                        echo "
                        <div class='accordion-item'>
                            <h2 class='accordion-header'>
                            <button class='accordion-button' type='button' data-bs-toggle='collapse' data-bs-target='#collapseO".$row['CategoryId']."' aria-expanded='true' aria-controls='collapse".$row['CategoryId']."'>
                                ".$row['CategoryName']."
                            </button>
                            </h2>
                            <div id='collapseO".$row['CategoryId']."' class='accordion-collapse collapse' data-bs-parent='#accordionExample'>
                            <div class='accordion-body'>
                            <div id='respuestas'>
                            <h4>Answers</h4>";

                            $stmt2 = $conn->prepare("SELECT * FROM `question` INNER JOIN member ON member.MemberId = question.MemberId WHERE CategoryId = ? ORDER BY QuestionId DESC;");
                            $stmt2->bind_param('s', $row['CategoryId']);
                            $stmt2->execute();
                            $result2 = $stmt2->get_result();

                            if ($result2->num_rows > 0) {
                                while ($row2 = $result2->fetch_assoc()) {
                                    echo "
                                    <div class='card'>
                                        <div class='card-body'>
                                            <h5 class='card-title'>".$row2['LastName']." ".$row2['FirstName']."</h5>
                                            <p class='card-text'>".$row2['QuestionDetails']."</p>
                                            <p class='card-text'>".$row2['QuestionDate']."</p>
                                        </div>
                                    </div>
                                    ";
                                }
                            }
                        echo "
                                    <h4 class='mt-4'>Reply</h4>
                                    
                                        <div class='form-group'>
                                            <textarea class='form-control' id='answerSend".$row['CategoryId']."' name'answerSend".$row['CategoryId']."' rows='3' placeholder='Write your answer...' required></textarea>
                                        </div>
                                        <button class='btn mt-2' style='background-color: #004aad; color: #FFF!important;' onclick='sendData(".$row['CategoryId'].")'>Submit</button>
                                </div>
                            </div>
                        </div>
                        ";
                    }
                }
            ?>
        </div>
    </div>
    </div>
    </div>
    <div id="nuevo-tema" class="mt-5">
        <h3>Create a new topic</h3>
        <form action="Processes/createTopic.php" method="POST">
            <div class="form-group">
                <label for="titleTopic">Title of the topic</label>
                <textarea class="form-control" id="titleTopic" name="titleTopic" rows="3" placeholder="Write..." required></textarea>
            </div>
            <button type="submit" class="btn mt-2" style='background-color: #004aad; color: #FFF!important;'">Create Topic</button>
        </form>
    </div>
</div>