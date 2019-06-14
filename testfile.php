<html>
<title>Ignored Title</title>
<body>

<?php
  include 'functions.php';

  $filename = "DogsRule.txt";

  $filetext = "<h1>Hello, World!</h1>
    <p>This is some e-mail content.
    Even though it has whitespace and newlines, the e-mail converter
    will handle it correctly.</p>

    <p>Even mismatched tags.</p>

    <div>A div</div>
    <div>Another div</div>
    <div>A div<div>within a div</div></div>

    <a href='http://foo.com'>A link</a>";

  ## Convert html to plain text  ##
  $text = strip_tags($filetext, '<p><a>');

  ## open file to write to ##
  $htfr = fopen("HTFR/".$filename, 'w') or die ("Unable to open file: /var/www/wave-api.com/public_html/HTFD/" .$filename);

  fwrite($htfr, $text);

  ## close file
  fclose($htfr);

  echo $text;

  ?>

</body>
</html>
