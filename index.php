<?php
if (isset($_GET['nav'])) {
  $pageContent = "contentPages/". $_GET['nav'] .".php";
  // runMyFunction($_GET['nav']);
}
else {
  $pageContent = "contentPages/contentHome.php";
}
include("template.php");
?>

<script type="text/javascript">
  const thisContainer = document.querySelector(".container");
  document.querySelector(".pageTitle").textContent = "Home";

  <?php
     if(isset($_SESSION['USERNAME']))
        echo "document.querySelector('#askOrSearchQuestions').style.display='none';";
  ?>
</script>