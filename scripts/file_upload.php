<?php
  include 'functions.php';

  if(isset($_FILES['fupload'])){
    // Set Variables
    $client = $_POST['client'];
    $user = $_POST['username'];
    $pass = $_POST['password'];
    $file = $_FILES['fupload'];

    //save to db
    $save_db = file_info_db($client, $file['name'], $user, $pass);

    // call function to upload file
    $upload = file_upload($file);
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
      <form action="api.php" method="post">
        <div class="container mt-5">
          <div class="row">
            <div class="col">
              <h2><?php echo $save_db;?></h2>
            </div>
          </div>
          <hr />
          <div class="row text-center">
          <?php if($e == 1){ ?>
            <div class='col text-center'><?php echo $error;?></div>
          <?php }else{ ?>
            <div class="col">
              <h2><?php echo $file['name']; ?></h2>
              <input type="hidden" name="file" value="<?php echo $file['name']; ?>">
            </div>
            <div class="col">
              <button type="submit" class="btn btm-sm btn-success">Evaluate File</button>
            </div>
          <?php } ?>
          </div>
        </div>
      </form>
    </section>
  </body>
</html>
