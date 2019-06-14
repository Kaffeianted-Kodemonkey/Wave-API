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
    echo "Please upload a file.";
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
    <section id="main" role="main">
      <div class="row">
        <div class="col mt-5">
          <h1 class="text-center">File Upload</h1>
        </div>
      </div>

      <hr />

      <div class="container mt-5">
        <div class="row">
          <div class="col">
            <?php echo $upload; ?> <button class="btn btm-sm btn-success">Evaluate</button>
          </div>
        </div>
      </div>
    </section>
  </body>
</html>
