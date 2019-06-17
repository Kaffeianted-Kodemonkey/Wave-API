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
        // Set Variables
        $apikey = "iqt2JkJc1176";
        $reporttype = "$_POST[reporttype]";
        $user = $_POST['username'];
        $pass = $_POST['password'];
        $client = $_POST['client'];
        //$pgcount = $_POST['num_pages'];
        $filename = $client . ".doc";

        // call function to upload file
        if(empty($_POST['num_pages'])){
          $sitemap = file_upload($_FILES['sitemap']);

          //Read file add convert to array
          if($sitemap['type'] == "text/csv"){
            $csv = array_map('str_getcsv', file("upload/" . $sitemap['name']));

            $set = 0; // This is set by an array length and need to start on 0
            $pgcount = sizeof($csv); // get number of items in array to loop through
            $mkr = 1;
          }
        }else{
          $pgcount = $_POST['num_pages'];
          $set = 1; // this base on a given number need to start count on 1
        }

        ## Opening paragrapsh and How-To-Fix Report instructions ##
        $filetext  = "
          <h1 class='text-center'>" . $client . " WCAG Evaluation</h1>

          <p>The How-To-Fix Report outlines issue found through a manual and automated evaluation.<p>

          <p>Do not be alarmed at the size of this document. As you review it the report you may notice that some of the
          issues are notated on multiple pages. If you designed the site using dynamic programming or a templates then once
          you resolve and issue all pages with notating that issue should be resolved.</p>

          <p>Through a Manual Evaluation, our Accessibility Expert will physically review the pages within the site to make
          sure they are <strong>Perceivable – Operable – Understandable & Robust</strong>.</p>

          <p>Through an automated Evaluation our Accessibility Expert will run each page through our accessibility script
          to analysis the structure of the pages. This will give a deeper analysis if each page and return the number of
          <strong>Errors – Alerts – Features – Structural Elements – HTML5 & Aria Constant Errors</strong>.</p>

          <p>Please review the instructions below and let our Accessibility Expert know your timeframe for resolution.
          If the timeframe is more than 90 days we can issue a partial Certification allowing you time to resolve issues and
          receive a full certification. </p>

          <h2>Instructions:</h2>

          <p>Each page that was evaluated is outlined in this document and depicts the following.</p>

          <ul>
            <li><span class='text-danger'><strong>Errors:</strong></span> indicate accessibility errors that need to be fixed in order to pass a WCAG Certification, there may be some exceptions.</li>
            <li><span class='text-warning'><strong>Alerts:</strong></span> Indicates warnings and should be looked at.</li>
            <li><span class='text-success'><strong>Features:</strong></span> indicate accessibility features - things that probably improve accessibility (though these should be verified).</li>
            <li><span class='text-info'><strong>Contrast Errors:</strong></span> Indicates issues with font color and or size against the background color  which can make it hard for some users to read.</li>
            <li><span class='tex-burgendy'><strong>Structural Elements:</strong></span> Outline the layout structure of the page</li>
          </ul>

          <p>Review the elements for each page and check them off as they are completed. At the bottom of each section is an area for your developer to make
          comments, timeframe notations, etc... if an element can not be resolved at this time.</p>

          <p>When you have completed the review return the How-To-Fix document to your Accessibility Expert they well look it over and be in touch with the next
          steps.</p>

          <p>The goal is to eliminate as may of the errors as you can. Alerts will require close scrutiny - they likely represent an end user issue. Other
          elements are to facilitate human analysis of accessibility and structure of the page. We include these so your developer can review them an check that
          they are returning the intended outcome.</p>";

        ## Manual Evaluation ##
        $filetext .= "
          <h1>Evaluation</h1>

          <h2>Manual Evaluation with Assisted Technology:</h2>

          <p>The following are issues we found through the use of Assisted Technology and human review. </p>
          <p>***********************************************************************************</p>
          <p>**&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
          &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <span class='text-center'>Accessibility Expert
          will enter notes here</span> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
          &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;  **</p>
          <p>***********************************************************************************</p>

          <h2>Evaluation Script:</h2>";

        ## Set Variables ##
        for($i=$set; $i<=$pgcount; $i++){
          $x = $x+1;

          if($mkr == 1){
            $siteURL = $csv[$i][0];
          }else {
            $siteURL = $_POST['url-'.$i];
          }

            ## Testing URLS ##
            //$url = "kkm.json";
            //$url = "reporttype1.json";
            //$url = "reporttype2.json";

            /*$url = "reporttype3.json";
            $data = file_get_contents($url);*/

          ## End Testing URLS ##

          ## WAVE-API URL ##
          $url = "http://wave.webaim.org/api/request?";
          $apiurl = $url . "key=" . $apikey ."&url=" . $siteURL ."&evaldelay=2000&reporttype=" . $reporttype . "&username=" .$user . "&password=" . $pass;

          ## GET Content form WAVE ##
          $data = file_get_contents($apiurl);

          // Returns the value encoded in json in appropriate PHP type.
          $results = json_decode($data, true);

          $filetext .= "<hr />";

          // Set variables form WAVE API
          $success = $results['status']['success'];
          $httpcode = $results['status']['httpstatuscode'];
          $pagetitle = $results['statistics']['pagetitle'];

          $pageurl = $results['statistics']['pageurl'];
          $allitemcount = $results['statistics']['allitemcount'];
          $totalelements = $results['statistics']['totalelements'];
          $credits = $results['statistics']['creditsremaining'];

          ## Check if status-success is true ##
          if($success = 1){
            $filetext .= "
              <p> [Web Page ". $x . " ] </p>

              <p>Title: " . $pagetitle . "</p>
              <p>URL: " . $pageurl . "</p>

              <table border='0' width='100%'>
                <tr>
                  <td align='left'>Total Issues Found:</strong> " . $allitemcount . "</td>
                  <td align='right'>Total Elements Evaluated:</strong> " . $totalelements . "</td>
                </tr>
              </table>

              <p class='text-danger'><strong>Credits Remaining:</strong>" . $credits . "</p>";

            $filetext .= "<hr />";

            ## Loop through categories ##
            foreach($results['categories'] as $cat){
              $filetext .= "
                <h2>" . $cat['description'] . "-" .$cat['count'] ."</h2>";

              ## loop through category Items
              foreach ($cat['items'] as $items) {
                $filetext .= "
                  <p><input class='form-check-input mt-2' type='checkbox' value='' id='defaultCheck1'></p>

                  <h3>" . $items['count'] . "-" . $items['description'] . "</h3>";

                $details = get_details($items['id']);

                $filetext .= "
                  <p><strong>What It Means:</strong></p>
                  <p>" . $details['summary'] . "</p>

                  <p><strong>Why It Matters:</strong></p>
                  <p>" . $details['purpose'] . "</p>

                  <p><strong>How to Fix It:</strong></p>
                  <p>" . $details['actions'] . "</p>

                  <strong>The Algorithm... in English:</strong></p>
                  <p>" . $details['details'] . "</p>

                  <p><strong>Standards and Guidelines:</strong></p>
                  <ul>";

                ## loop through Standards & Guidelines ##
                foreach ($details as $detail) {
                  foreach ($detail as $guidlines) {
                    $filetext .= "<li><a href=" . $guidlines['link'] . ">" . $guidlines['name'] . "</a></li>";
                  }//close foreach Guidelines
                }// close foreach detail
                $filetext .= "</ul>";

                ## Loop through Xpath array ##
                $filetext .= "<p><strong>Location:</strong> </p>";
                $filetext .= "<ul>";

                foreach ($items['xpaths'] as $xpaths) {
                  $filetext .= "<li>" . $xpaths . "</li>";
                }//Close foreahc xpaths

                $filetext .= "</ul>";

              }//Close Foreach cat-tiems

              $filetext .= "<p><textarea class='form-control mb-5' rows='5'></textarea></p>";
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

      $text = strip_tags($filetext, '<ul><li><a>');

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
