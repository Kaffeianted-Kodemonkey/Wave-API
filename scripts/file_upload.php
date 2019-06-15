<?php
  include 'functions.php';

  if(isset($_FILES['fupload'])){
    // Set Variables
    $client = $_POST['client'];
    //$user = $_POST['username'];
    //$pass = $_POST['password'];

    $file = $_FILES['fupload'];

    //echo "Client: " . $filename = $client . "<hr />";

    // call function to upload file
    $upload = file_upload($file, $client);

      //  echo $upload;

  }else{
    $e = 1;
    $error = "Please upload a file.";
  }

?>
<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    <title>File upload</title>
  </head>
  <body>
    <?php include '../includes/nav.php';?>

    <section id="main" role="main">
      <div class="row">
        <div class="col mt-5">
          <h1 class="text-center">File Upload</h1>
        </div>
      </div>

      <hr />

      <div class="container mt-5">
        <div class="row">
          <?php
            if($e == 1){
              echo "<div class='col text-center'>" . $error . "</div>";
            }else{
          ?>
          <div class="col-4 mt-2">
            <?php echo $upload; ?>
          </div>
          <div class="col">
            <button class="btn btm-sm btn-success" href="Evaluate.php">Evaluate</button>
          </div>
        <?php } ?>
        </div>
      </div>
    </section>
  </body>
</html>
