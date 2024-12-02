<?php
//session_start();


//----------------PREVIOUS CODE--------------------
function enrolStudentToClass($studNo, $classNo, $startDate){
  include("processConnectDb.php");
  $endDate = runSQLFunction("SELECT DATE_ADD(CURDATE(), INTERVAL 1 YEAR) AS endDate");
  $sql = "INSERT INTO ENROLMENTLINE(StudNo, ClassNo, StartDate, EndDate) "
       . "VALUES($studNo, $classNo, '$startDate', '$endDate')";
  if($resultSet=mysqli_query($conn, $sql)){
    return true;
  }//if($resultSet=mysqli_query($conn, $sql))
  else{
    return false;
  }  
}//function enrolStudentToClass($studNo, $classNo, $startDate)
