<?php
    $pagetitle = "Home"; 
    include("includes/header.php");
?>
<div class="body-content outer-top-xs" id="top-banner-and-menu">  
    <div class="container">
        <div class="row"> 
            <!-- ============================================== SIDEBAR ============================================== -->
            <div class="col-xs-12 col-sm-12 col-md-3 sidebar"> 
            <!-- ================================== TOP NAVIGATION ================================== -->
            <?php 
               // include("includes/category-sidebar.php"); 

                include("includes/side-bar.php"); 

                include("includes/content.php"); 

                include "includes/footer.php"; 
            ?>