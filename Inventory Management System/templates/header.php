<nav class="navbar navbar-expand-lg navbar-dark bg-primary sticky-top">
  <a class="navbar-brand" href="#">Electronics Inventory</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarNav">
    <ul class="navbar-nav">
      <li class="nav-item active">
        <a class="nav-link" href="dashboard.php"><i class="fa fa-home">&nbsp;</i>Home <span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item active">
    <?php
      if(isset($_SESSION["userid"]))
      {
    ?>   
        <a class="nav-link" href="logout.php"><i class="fa fa-user">&nbsp;</i>Log Out</a>
        <?php
       } 
       ?>
      </li>
    </ul>
  </div>
</nav> 