<?php

## save file info to database ##
function file_info_db($client, $file, $user, $pass){
  $servername = "localhost";
  $username = "wave";
  $password = "Girlz4x42!";
  $dbname = "Wave-API";

  // Create connection
  $conn = mysqli_connect($servername, $username, $password, $dbname);
  // Check connection
  if (!$conn) {
      die("Connection failed: " . mysqli_connect_error());
  }

  $sql = "INSERT INTO ClientFile (client, filename, username, password)
  VALUES ($client, $file, $user, PASSWORD($pass))";

  if (mysqli_query($conn, $sql)) {
    $results = "New record created successfully";
  } else {
      $results = "Error: " . $sql . "<br>" . mysqli_error($conn);
  }

  mysqli_close($conn);

  return $results;

}

## upload file ##
function file_upload($file){
  if (($file["type"] == "text/xml") || ($file["type"] == "text/doc") | ($file["type"] == "text/csv")){
    if ($file["error"] > 0){
      $results = "Return Code: " . $file["error"] . "<br />";
    }else{
      ## Set Directory ##
      $dir = "../upload";

      //check if file exists
      if (file_exists($dir ."/" . $file["name"])){
        $results = "File: " . $file["name"] . " already exists. <br />";
      }else{
        ## check dir exists if not create ##
        /*if(is_dir($dir) === false){
          mkdir($dir);
        }*/

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

## Evauate file ##
function evaluate($file){

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



   /*$file["name"];
      $file["type"];
      $file["size"] / 1024;
      $file["tmp_name"];*/

?>
