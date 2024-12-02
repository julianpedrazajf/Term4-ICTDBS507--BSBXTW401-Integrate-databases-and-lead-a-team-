
<?php
 include("PROCESSES/processConnectDb.php");

 if(isset($_REQUEST['SubcategoryID']))
 {
     $sql = "SELECT SubcategoryName 
               FROM Subcategory
              WHERE SubcategoryID = ".$_REQUEST['SubcategoryID'];

    if($resultSet=mysqli_query($conn, $sql)){
        while($record = mysqli_fetch_array($resultSet, MYSQLI_ASSOC)){
            $pageTitle = $record['SubcategoryName'];
        }//while($record = mysqli_fetch_array($resultSet, MYSQLI_ASSOC))
    }//if($resultSet=mysqli_query($conn, $sql))           

     echo "<h1>Subcategory: $pageTitle</h1>";
 }

 if(isset($_REQUEST['CategoryName']))
 {
     $sql = "SELECT CategoryName 
               FROM Category
              WHERE CategoryName = '".$_REQUEST['CategoryName']."'";

    if($resultSet=mysqli_query($conn, $sql)){
        while($record = mysqli_fetch_array($resultSet, MYSQLI_ASSOC)){
            $pageTitle = $record['CategoryName'];
        }//while($record = mysqli_fetch_array($resultSet, MYSQLI_ASSOC))
    }//if($resultSet=mysqli_query($conn, $sql))           

     echo "<h1>Category: $pageTitle</h1>";
 }
?>