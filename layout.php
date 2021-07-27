<?php
include "config/dbConfig.php"
?>
<header>
  <section id="desktop-menu" class="desktop-menu">
    <nav class="sidebar ">
      <a class="sidebar__logo" href="#">
        <abbr style="font-size: 20px !important;" class="logo">MechaBook</abbr>
      </a>
      <div style="margin-top: 200px">

      </div>
      <div>
        <div class="side-nav-icon-column">
          <a style="color:white" href="#">Book <br>A Mechanic</a>
        </div>

        <div class="side-nav-email-column">
          <div><a style="color: #18ffff">Where Expectation Meets Skill</a></div>
            <i style="font-size: 80px" class="fas fa-car"></i>


        </div>
      </div>
    </nav>
  </section>
  <nav class="navbar">
    <a class="logo">Mechabook Dashboard</a>
    <ul class="main-nav">

      <li>
        <a href="#" class="nav-links">User</a>
      </li>
        <li>
            <?php
            $session = $_SESSION['logged_in'];
            if($session){
                ?>
                <a href="logout.php" class="nav-links">Logout</a>

            <?php
            }else{
                ?>
                <a href="admin" class="nav-links">Admin</a>
            <?php

            }

            ?>

        </li>

      <li style="font-size:16px">
        <i style="color: #CC9F7C" class="fas fa-phone"></i> +880 1994335868
      </li>
    </ul>
    <div class="nav-toggle">
      <span>+</span>
    </div>
  </nav>
</header>












</body>
</html>