<?php
include 'functions.php'; ?>

<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

      <title>WAVE-API - Live</title>
  </head>
  <body>

    <!-- Script to run api request -->
    <?php

      if(isset($_POST['submit'])){
        // set global variables
        $client = $_POST['client'];
        $reporttype = $_POST['reporttype'];
        $user = $_POST['username'];
        $pass = $_POST['password'];

        ## Check for Testing ##
        if(isset($_POST['testing'])){
          // set test url
          $level = $_POST['test_level']. ".json";
          $page =  array($level);

          $output = "<h1 class='p-3'>Testing - " . $level ."</h1>
          <hr />";
        }
        ## check it runing single url or csv file ##
        elseif(isset($_POST['url_page'])){
          // set variable
          $page = array($_POST['url_page']);
        }
        ##  CSV File was uploaded ##
        else{
          // call function to upload file
          $sitemap = file_upload($_FILES['sitemap']);

          //Read file add convert to array
          if($sitemap['type'] == "text/csv"){
            $page = array_map('str_getcsv', file("upload/" . $sitemap['name']));
          }
          else{
            $error_message = "Invalid File Type. Select another file.";
          }
        }

        // Run Script for API
        // Loop through number of pages or URLS
        foreach ($page as $key => $value) {
          ## Testing API URL
          if(isset($_POST['testing'])){
            $apiurl = $value;
          }
          else{
            ## Live URL ##
          $apiurl = "https://wave.webaim.org/api/request?key=iqt2JkJc1176&url=" . $value ."&evaldelay=5000&reporttype=" . $reporttype . "&username=" .$user . "&password=" . $pass;
          }

          ## GET Content form API ##
          $data = file_get_contents($apiurl);

          // Returns the value encoded in json in appropriate PHP type.
          $results = json_decode($data, true);

          // variables returned form WAVE API reporttype 1
          $success        = $results['status']['success'];
          $httpcode       = $results['status']['httpstatuscode'];

          $error          = $results['status']['error'];

          $categories     = $results['categories'];

          $credits        = $results['statistics']['creditsremaining'];

          $pageurl        = $results['statistics']['pageurl'];
          $pagetitle      = $results['statistics']['pagetitle'];

          $waveurl        = $results['statistics']['waveurl'];
          $time           = $results['statistics']['time'];

          $allitemcount   = $results['statistics']['allitemcount'];
          $totalelements  = $results['statistics']['totalelements'];

          if ($key== 0 && $success == true){
            // Convert results to output
            $output .= "<!-- Header Row -->
            <div class='row'>
              <div class='col table-responsive'>
                <table class='table table-bordered table-striped'>
                  <tr class='text-center'>
                    <th>Page Title</th>
                    <th>URI</th>
                    <td># Issues Found</td>
                    <td># of Elements Analyzed</td>";

                    foreach ($categories as $cat)  {
                      $output .= "<td>". $cat['description'] ."</td>";
                    }

                  $output .= "
                  </tr>
                  <!-- Page Rows -->
                  <tr>
                    <th class='align-middle text-center' width='10%'><a href='" . $pageurl ."' target='_blank'>" . $pagetitle ."</a></th>
                    <th class='align-middle text-center'><a href='". $waveurl ."' target='_blank'>" . $pageurl ."</a></th>
                    <td class='align-middle text-center'>" . $allitemcount . "</td>
                    <td class='align-middle text-center'>" . $totalelements . "</td>";

                    foreach ($categories as $cat){
                      $output .= "<td class='align-middle'>";
                      foreach ($cat['items'] as $items) {
                        $output .= $items['count'] . "-" . $items['description'] ."<br />";
                      }
                      $output .= "</td>";
                    }
                  $output .= "
                  </tr>";
          }
          elseif ($key > 0 && $success == true) {
            $output .= "<!-- Page Rows -->
            <tr>
              <th class='align-middle text-center'><a href='". $pageurl ." '>" . $pagetitle ."</a></th>
              <th class='align-middle text-center'><a href='". $waveurl ." '>" . "/" . $pageurl ."</a></th>
              <td class='align-middle text-center'>" . $allitemcount . "</td>
              <td class='align-middle text-center'>" . $totalelements . "</td>";

              foreach ($categories as $cat){
                $output .= "<td class='align-middle'>";
                foreach ($cat['items'] as $items) {
                  $output .= $items['count'] . "-" . $items['description'] ."<br />";
                }
                $output .= "</td>";
              }
            $output .= "
            </tr>";
          }
          else{
            $error_message = "There was and error processing the request.<br />". $error['code'] ." = ". $error['description'];
          }
        }
      }
      else{
        $error_message = "internal error - form was not completed.";
      }

      // Return output or error messsage
      if (empty($error_message)){
        echo $output .= "
            </table>
          </div>
        </div>";
      }
      else{
        echo $error_message;
      }

    ?>


    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <script src="functions.js"></script>
  </body>
</html>
