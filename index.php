<?php

session_start();

include("includes/db.php");
include("includes/header.php");
include("functions/functions.php");
include("includes/main.php");

?>


  <!-- Cover -->
  
    
    <!-- Main -->
    <div class="wrapper">
            <h1>Best Collection<h1>
            
      </div>



    <div id="content" class="container"><!-- container Starts -->

    <div class="row"><!-- row Starts -->

    <?php

    getPro();

    ?>

    </div><!-- row Ends -->

    </div><!-- container Ends -->
    <!-- FOOTER -->
    <footer class="page-footer">

      <div class="footer-nav">
        <div class="container clearfix">
          <div class="footer-nav__col footer-nav__col--contacts">
            <div class="footer-nav__heading">Contact details</div>
            <address class="address">
            Head Office: Clone Clothes.<br>
            infocity gandhingar, gujarat.
          </address>
            <div class="phone">
              Mobile Number:
              <a class="phone__number" href="tel:0123456789">6354540406</a>
            </div>
            <div class="email">
              Email:
              <a href="mailto:support@yourwebsite.com" class="email__addr">support@CloneClothes.com</a>
            </div>
          </div>

        </div>
      </div>

      <!-- <div class="banners">
        <div class="container clearfix">

          <div class="banner-award">
            <span>Award winner</span><br> Fashion awards 2016
          </div>

          <div class="banner-social">
            <a href="#" class="banner-social__link">
            <i class="icon-facebook"></i>
          </a>
            <a href="#" class="banner-social__link">
            <i class="icon-twitter"></i>
          </a>
            <a href="#" class="banner-social__link">
            <i class="icon-instagram"></i>
          </a>
            <a href="#" class="banner-social__link">
            <i class="icon-pinterest-circled"></i>
          </a>
          </div>

        </div>
      </div> -->

      <div class="page-footer__subline">
        <div class="container clearfix">

          <div class="copyright">
            &copy; <?php echo date("Y");?> Ecommerce Website-PHP&trade;
          </div>

         

        </div>
      </div>
    </footer>
</body>

</html>
