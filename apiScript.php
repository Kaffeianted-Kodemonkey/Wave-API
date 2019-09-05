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

      <title>WAVE-API - Test</title>
  </head>
  <body>

    <!-- Script to run api request -->
    <?php
      if(isset($_POST['submit'])){
        // Set Variables
        $apikey = "iqt2JkJc1176";
        $reporttype = 3;
        $user = $_POST['username'];
        $pass = $_POST['password'];
        $client = $_POST['client'];

        //$pgcount = $_POST['num_pages'];
        $filename = $client . ".csv";

        // call function to upload file
        $sitemap = file_upload($_FILES['sitemap']);

        //Read file add convert to array
        if($sitemap['type'] == "text/csv"){
          $csv = array_map('str_getcsv', file("upload/" . $sitemap['name']));

          $set = 0; // This is set by an array length and need to start on 0
          $pgcount = sizeof($csv); // get number of items in array to loop through
        }


        ## Opening paragrapsh and How-To-Fix Report instructions ##
        $filetext  = "";

          ## Set Variables ##
        for($i=$set; $i<=$pgcount; $i++){
          $siteURL = $csv[$i][0];
        }

            ## Testing URLS ##
            //$url = "kkm.json";
            //$url = "reporttype1.json";
            //$url = "reporttype2.json";

            $url = "reporttype3.json";
            $data = file_get_contents($url);

          ## End Testing URLS ##

          ## WAVE-API URL ##
          //$url = "http://wave.webaim.org/api/request?";
          //$apiurl = $url . "key=" . $apikey ."&url=" . $siteURL ."&evaldelay=2000&reporttype=" . $reporttype . "&username=" .$user . "&password=" . $pass;

          ## GET Content form WAVE ##
          //$data = file_get_contents($apiurl);

          // Returns the value encoded in json in appropriate PHP type.
          $results = json_decode($data, true);

          // Set variables form WAVE API
          $success = $results['status']['success'];
          $httpcode = $results['status']['httpstatuscode'];
          //$pagetitle = $results['statistics']['pagetitle'];

          $pageurl = $results['statistics']['pageurl'];
          $allitemcount = $results['statistics']['allitemcount'];
          $totalelements = $results['statistics']['totalelements'];
          $credits = $results['statistics']['creditsremaining'];

          ## Check if status-success is true ##
          if($success = 1){
            $filetext .= "
              <p><stong>URL:</strong>" . $pageurl . "</p>
              <p><stong>URL:</strong>" . $allitemcount . "</p>
              <p><stong>URL:</strong>" . $totalelements . "</p>";

            ## Loop through categories ##
            foreach($results['categories'] as $cat){
              $filetext .= "
                <p><strong>" . $cat['description'] . "</strong>:" . $cat['count'] ."</p>
                <ul>";

              ## loop through category Items
              foreach ($cat['items'] as $items) {
                $filetext .= "
                    <li>" . $items['description'] . ":" . $items['count'] . "
                      <ul>";

                $details = get_details($items['id']);

                ## Loop through Xpath array ##
                foreach ($items['xpaths'] as $xpaths) {
                  $filetext .= "<li>" . $xpaths . "</li>";
                }//Close foreahc xpaths

                $filetext .= "</ul></li></ul>";

              }//Close Foreach cat-tiems

            }//close foreach cat

          }// Close if Success
          else{
            $filetext .= "There is an Error:" . $httpcode . "</p>";
          }//close else success
        }//Close for loop page count
      }//close if isset *****************
      else {
        $filetext .= "No I am not Set!</p>";
      }

      //$text = strip_tags($filetext, '<ul><li><a>');

      ## open file to write to ##
      $htfr = fopen("HTFR/".$filename, 'w') or die ("Unable to open file: /var/www/wave-api.com/public_html/HTFD/" .$filename);

      fwrite($htfr, $text);

      ## close file
      fclose($htfr);
    ?>
    <!-- end api request -->

    <section id="main" role="main">
      <div class="container mt-5">
        <?php echo $filetext; ?>
      </div>
    </section>


    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <script src="functions.js"></script>
  </body>
</html>
