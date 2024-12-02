<?php
include('processConnectDb.php');
session_start();

$categoryList = array();
$subcategoryList = array();
$currentCategoryName = '';   //name of current category being processed
$categoryListItem = '';      //associative array (categoryName=>arrayOfSubcategories)
$subcategoryListItem = '';   //associative array (subcategoryID=>subcategoryName)
$recordProcessedCount = 0;

$sql = "SELECT category.CategoryName
             , subcategory.SubcategoryID
             , subcategory.SubcategoryName
          FROM category
         LEFT JOIN subcategory
            ON category.categoryID = subcategory.categoryID";
//echo $sql;

if($resultSet = mysqli_query($conn, $sql)){
    while($record = mysqli_fetch_array($resultSet, MYSQLI_ASSOC)){                
        if($currentCategoryName != $record['CategoryName']) //either first record or next category
        {    
            if(empty($currentCategoryName))
            {
                //If first record is being processed                
                $currentCategoryName = $record['CategoryName'];
                $subcategoryListItem = array($record['SubcategoryID'] => $record['SubcategoryName']);
                array_push($subcategoryList, $subcategoryListItem);

                //If last record is a new category
                if($recordProcessedCount==mysqli_num_rows($resultSet)-1)
                {
                    $categoryListItem = array($currentCategoryName => $subcategoryList);
                    array_push($categoryList, $categoryListItem);
                }
            }
            else
            {
                //add the previous category and subcategories to the categoryList array      
                $categoryListItem = array($currentCategoryName => $subcategoryList);
                array_push($categoryList, $categoryListItem);

                //clear the subcategory array for the next category
                $subcategoryList = array();

                //change the category name to the next category          
                $currentCategoryName = $record['CategoryName'];
                $subcategoryListItem = array($record['SubcategoryID'] => $record['SubcategoryName']);
                array_push($subcategoryList, $subcategoryListItem);

                //If last record is a new category
                if($recordProcessedCount==mysqli_num_rows($resultSet)-1)
                {
                    $categoryListItem = array($currentCategoryName => $subcategoryList);
                    array_push($categoryList, $categoryListItem);
                }
            }
        }//if($categoryName != $record['CategoryName'])
        else
        {
            $subcategoryListItem = array($record['SubcategoryID'] => $record['SubcategoryName']);
            array_push($subcategoryList, $subcategoryListItem);

            //If last record
            if($recordProcessedCount==mysqli_num_rows($resultSet)-1)
            {
                $categoryListItem = array($currentCategoryName => $subcategoryList);
                array_push($categoryList, $categoryListItem);
            }
        }
        $recordProcessedCount++;
    }//while($record = mysqli_fetch_array($resultSet, MYSQLI_ASSOC))
  }//if($resultSet = mysqli_query($conn, $sql))

echo json_encode($categoryList);
 ?>