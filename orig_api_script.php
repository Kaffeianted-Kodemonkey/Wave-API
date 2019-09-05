
        // Set Variables
      #  $apikey = "iqt2JkJc1176";
      #  $reporttype = "$_POST[reporttype]";
      #  $user = $_POST['username'];
      #  $pass = $_POST['password'];
      #  $client = $_POST['client'];

        //$pgcount = $_POST['num_pages'];
      #  $filename = $client . ".html";

        // call function to upload file
      #  $sitemap = file_upload($_FILES['sitemap']);

        //Read file add convert to array
      #  if($sitemap['type'] == "text/csv"){
      #    $csv = array_map('str_getcsv', file("upload/" . $sitemap['name']));

      #    $set = 0; // This is set by an array length and need to start on 0
      #    $pgcount = sizeof($csv); // get number of items in array to loop through

      #  }


        ## Opening paragrapsh and How-To-Fix Report instructions ##
    /*    $filetext  = "";

        $filetext  .= "
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
          they are returning the intended outcome.</p>"; */

        ## Manual Evaluation ##
    /*    $filetext .= "
          <h1>Evaluation</h1>

          <h2>Manual Evaluation with Assisted Technology:</h2>

          <p>The following are issues we found through the use of Assisted Technology and human review. </p>
          <p>***********************************************************************************</p>
          <p>**&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
          &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <span class='text-center'>Accessibility Expert
          will enter notes here</span> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
          &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;  **</p>
          <p>***********************************************************************************</p>

          <h2>Evaluation Script:</h2>"; */

        ## Set Variables ##
        for($i=$set; $i<=$pgcount; $i++){

          $siteURL = $csv[$i][0];
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
              <p><strong>URL:</strong> " . $pageurl . "</p>

              <p><strong>Total Issues Found:</strong> " . $allitemcount . "</p>
              <p><strong>Total Elements Evaluated:</strong> " . $totalelements . "</p>";

            $filetext .= "<hr />";

            ## Loop through categories ##
            foreach($results['categories'] as $cat){
              $filetext .= "
                <h2>" . $cat['description'] . "-" .$cat['count'] ."</h2>";

              ## loop through category Items
              foreach ($cat['items'] as $items) {
                $filetext .= "
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

      $text = strip_tags($filetext, '<h2><h3><p><ul><li><a>');

      ## open file to write to ##
      $htfr = fopen("HTFR/".$filename, 'w') or die ("Unable to open file: /var/www/wave-api.com/public_html/HTFR/" .$filename);

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
