
<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <a class="navbar-brand" href="#">Wave-API Test</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarNav">
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link <?php if ($CURRENT_PAGE == "WAVE-API") {?>active<?php }?>" href="../index.php">Home</a>
      </li>
      <!-- <li class="nav-item">
        <a class="nav-link <?php if ($CURRENT_PAGE == "Fiel Upload") {?>active<?php }?>" href="/scripts/file_upload.php">File Upload</a>
      </li> -->
      <li class="nav-item">
        <a class="nav-link <?php if ($CURRENT_PAGE == "Evaluate") {?>active<?php }?>" href="/scripts/Evaluate.php">Evaluate</a>
      </li>
      <li class="nav-item">
        <a class="nav-link disabled" href="#" tabindex="-1" aria-disabled="true">Disabled</a>
      </li>
    </ul>
  </div>
</nav>
