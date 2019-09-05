<?php

// upload sitemap.xml to loop through pages of a large sites
function file_upload($sitemap){
  if ($sitemap["type"] == "text/csv"){
    if ($sitemap["error"] > 0){
      echo "Return Code: " . $sitemap["error"] . "<br />";
    }
    else{
      $sitemap["name"];
      $sitemap["type"];
      $sitemap["size"] / 1024;
      $sitemap["tmp_name"];

      if (file_exists("upload/" . $sitemap["name"])){
        echo "File: " .$sitemap["name"] . " already exists. <br />";
      }
      else{
        move_uploaded_file($sitemap["tmp_name"],
        "upload/" . $sitemap["name"]);
        echo "Stored in: " . "upload/" . $sitemap["name"];
      }
    }
  }
  else{
    echo "Invalid file";
  }

  return $sitemap;
}

// get WAVE detail for issue
function get_details($id){

  $url = "http://wave.webaim.org/api/docs?id=" . $id;

  $results = file_get_contents($url);
  $results = json_decode($results, true);

  /*foreach ($results as $res) {
    $details "helloworld!";
  }*/

  return $results;

}

?>
