<?php

// upload file
function file_upload($file, $client){
  if (($file["type"] == "text/xml") || ($file["type"] == "text/doc") | ($file["type"] == "text/csv")){
    if ($file["error"] > 0){
      $results = "Return Code: " . $file["error"] . "<br />";
    }else{
      //check for client dir
      $dir = "../upload/" . $client;

      //check if file exists
      if (file_exists($dir ."/" . $file["name"])){
        $results = "File: " . $file["name"] . " already exists. <br />";
      }else{
        //check dir exists if not create
        if(is_dir($dir) === false){
          mkdir($dir);
        }

        //Move file to client dir
        move_uploaded_file($file["tmp_name"], $dir . "/" . $file["name"]);
        $results = "Stored in: " . $dir ."/" . $file["name"];
      }
    }
  }else{
    $results = "Invalid file";
  }
  return $results;
}



      /*$file["name"];
      $file["type"];
      $file["size"] / 1024;
      $file["tmp_name"];*/

?>
