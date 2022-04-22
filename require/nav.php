<!-- Navbar -->
<nav class="navbar navbar-sticky navbar-expand-lg navbar-light bg-light">
  <!-- Container wrapper -->
  <div class="container">
    <!-- Navbar brand -->
    <a class="navbar-brand me-2" href="/student/index">Cloud Coding</a>

    <!-- Toggle button -->
    <button
      class="navbar-toggler"
      type="button"
      data-mdb-toggle="collapse"
      data-mdb-target="#navbarButtonsExample"
      aria-controls="navbarButtonsExample"
      aria-expanded="false"
      aria-label="Toggle navigation"
    >
      <i class="fas fa-bars"></i>
    </button>

    <div class="collapse navbar-collapse" id="navbarButtonsExample">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0"> </ul>
      <div class="d-flex align-items-center">
        <a href="/<?php echo $_SESSION['type']; ?>/profile" class="btn-primary btn-sm px-3 me-2">
          Profile
        </a>
        <a href="../actions/logout.php" class="btn-danger btn-sm px-3 me-2">
          Sign Out
        </a>
      </div>
    </div>
  </div>
</nav>