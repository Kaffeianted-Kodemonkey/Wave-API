<?php

//  include '../includes/nav.php';

?>
<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    <title>Evaluate</title>
  </head>
  <body>
    <?php include '../includes/nav.php';?>

    <section id="main" role="main">
      <div class="row">
        <div class="col mt-5">
          <h1 class="text-center">Evaluate File</h1>
        </div>
      </div>

      <hr />

      <div class="container mt-5">
        <div class="row">
          <div class="col">
            <table class="table">
              <thead>
                <tr>
                  <th scope="col">File</th>
                  <th scope="col">Evaluate</th>
                </tr>
              </thead>
              <tbody>
              <?php
                //List all files for evalustion
                //$dir = "../upload/";
                $lists = glob('../upload/*');

                foreach($lists as $l){
                  if(is_file($l)){
              ?>
                  <tr>
                    <td scope="row"><?php echo $l; ?></td>
                    <td><button class="btn btm-sm btn-success" href="Evaluate.php">Evaluate</button></td>
                  </tr>
              <?php
                }
              } ?>
              </tbody>
            </table>
          </div>
        </div>

      </div>
    </section>
  </body>
</html>
