<?php session_start(); ?>
<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title class="pageTitle">Todf</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="stylesheet" href="template.css">
    <script src="todf.js"></script>
    <script>
    var $jq = jQuery.noConflict(); // Ensure no conflict with other libraries

    // Function that will be called on button click
    function sendData(categoryId) {
        var answerString = '#answerSend' + categoryId;
        var answerSend = $jq(answerString).val(); // Get value from input field with ID 'name'

        // Send the AJAX request to PHP
        $jq.ajax({
            url: 'Processes/createAnswer.php', // PHP file to handle the request
            type: 'GET', // Use GET method
            data: {
                answerSend: answerSend,
                categoryId: categoryId
            },
            success: function(response) {
                // Handle the response from PHP
                // alert(response);  // Display the response (could be any data returned from PHP)
            },
            error: function() {
                alert('An error occurred.');
            }
        });
    }
    </script>
</head>

<body>
    <?php
    function runMyFunction($nav) {
      $pageContent = "contentPages/". $nav .".php";
    }

    if (isset($_GET['nav'])) {
      runMyFunction($_GET['nav']);
    }
  ?>
    <div class="container-fluid p-0">
        <nav class="navbar navbar-expand-lg navbar-dark" style="background-color: #000">
            <div class="container-fluid">
                <a class="navbar-brand" href="index.php">
                    <img src="./images/home/logo.png" alt="logo" style="width: 80px;">
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                    aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <li class="nav-item dropdown">
                            <a class="nav-link mx-2" href="index.php?nav=forum">Forum</a>
                        </li><!-- <li class="nav-item dropdown"> -->
                        <li class="nav-item">
                            <a class="nav-link mx-2" href='index.php?nav=contact'>Contact</a>
                        </li>
                        <li class="nav-item" id="login">
                            <a class="nav-link mx-2" href='index.php?nav=login'>Log in</a>
                        </li>
                        <li class="nav-item" id="register">
                            <a class="nav-link mx-2" href='index.php?nav=register'>Register</a>
                        </li>
                    </ul>
                    <form class="d-flex">
                        <?php
                          if (isset($_SESSION['userId'])) {
                            echo "<div class='dropstart'>
                              <img src='images/userAvatar/defaultUser.png' alt='user' style='width: 50px; cursor: pointer;' class='dropdown-toggle' data-bs-toggle='dropdown'
                              aria-expanded='false'>
                                <ul class='dropdown-menu dropdown-menu-dark'>
                                    <li>
                                      <a class='navbar-brand' href='Processes/logout.php'>Logout</a>
                                    </li>
                                </ul>
                            </div>";
                          }
                        ?>
                    </form>
                </div>
            </div>
        </nav>
        <main class="p-2">
            <?php include($pageContent); ?>
        </main>
        <footer class="p-2 d-flex flex-column justify-content-end align-items-center"
            style="background-color: #0b1927;">
            <p class="text-light text-center mb-0">Copyright &copy; <span id="currentYear"></span> Digital Aus Solutions
                Pty Ltd. All rights reserved.</p>
            <a href="privacyPolicy.php" class="text-decoration-none text-light fs-6" target="_blank">Privacy Policy</a>
        </footer>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous">
    </script>

    <script type="text/javascript">
    //BEGIN: DO NOT MODIFY THIS PART AND ALL THE FUNCTIONS CALLED IN THIS PART
    document.querySelector("#currentYear").textContent = getCurrentYear();

    //All 'withSubcategory' classes becomes dropend in screens wider than mobile phones
    const MOBILE_PHONE_WIDTH_PORTRAIT = "(max-width: 768px)";
    const isScreenWidthMobilePhonePortrait = window.matchMedia(MOBILE_PHONE_WIDTH_PORTRAIT);
    const forumDropDownMenu = document.querySelector("#forumDropdown");
    const serverFileForCategoryAndSubcat = "Processes/processGetAllCategoriesAndSubcategories.php";
    const thisNavbarNav = document.querySelector(".navbar-nav");
    const thisNavbar = document.querySelector("#navbarSupportedContent");
    let arrayCategoriesAndSubCategories = "";

    //Enable submenus as these are not supported in this version of Bootstrap.    
    enableSubmenu(document.querySelectorAll('.dropdown-toggle'), document.querySelectorAll(".submenu"));
    ajaxGetDataFromServer(serverFileForCategoryAndSubcat, function(arrayCategoriesAndSubCategories) {
        for (let index = 0; index < arrayCategoriesAndSubCategories.length; index++) {
            for (category in arrayCategoriesAndSubCategories[index]) {
                forumDropDownMenu.appendChild(createForumDropdown(category, arrayCategoriesAndSubCategories[
                        index][category] //subcategories
                ));
            }
        }
        //call listener function at runtime
        selectBetweenDropDownAndDropEnd(isScreenWidthMobilePhonePortrait);

        //Select between dropdown or dropend in category menu depending on the screen width
        isScreenWidthMobilePhonePortrait.addListener(selectBetweenDropDownAndDropEnd);
    }); //ajaxGetDataFromServer   
    //END:DO NOT MODIFY THIS PART AND ALL THE FUNCTIONS CALLED IN THIS PART

    <?php
         if(isset($_SESSION['USERNAME']))
         {
           $member_ID = $_SESSION['MEMBER_ID'];
           $member_Image = $_SESSION['MEMBER_IMAGE'];
           echo "thisNavbarNav.insertBefore(createMenuItem('My Answers', 'nav-link mx-2', 'answersList.php?MemberID=$member_ID'), thisNavbarNav.childNodes[0]);";
           echo "thisNavbarNav.insertBefore(createMenuItem('My Questions', 'nav-link mx-2', 'questionsList.php?MemberID=$member_ID'), thisNavbarNav.childNodes[0]);";
           echo "document.querySelector('#login').style.display='none';";
           echo "document.querySelector('#register').style.display='none';";
           echo "thisNavbar.appendChild(createLoggedInUserDropdown('$member_Image', $member_ID));";
         }
      ?>
    </script>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.1/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>