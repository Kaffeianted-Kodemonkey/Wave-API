<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    <title>WAVE-API</title>
  </head>
  <body>
    <?php include 'includes/nav.php'; ?>
    <section id="main" role="main">
      <div class="row">
        <div class="col mt-5">
          <h1 class="text-center">Testing Site</h1>
        </div>
      </div>

      <hr />

      <div class="container mt-5">
        <div class="row mb-5">
          <div class="col">
            <h1>WAVE API</h1>
            <h2>Let's Evaluate your site!</h2>
          </div>
        </div>

        <div class="row">
          <div class="col">
            <form action="scripts/file_upload.php" method="post" enctype="multipart/form-data">
              <div class="form-group row">
                <label for="client" class="col-sm-3 col-form-label">Compan Name:</label>
                <div class="col-sm-6">
                  <input type="text" class="form-control" name="client" id="client" placeholder="Company or Client Name" required>
                </div>
              </div>

              <!-- <div class="form-group row">
                <label for="username" class="col-sm-3 col-form-label">Username:</label>
                <div class="col-sm-6">
                  <input type="text" class="form-control" id="username" name="username" placeholder="Enter Username">
                </div>
              </div>
              <div class="form-group row">
                <label for="password" class="col-sm-3 col-form-label">Password</label>
                <div class="col-sm-6">
                  <input type="password" class="form-control" id="password" name="password" placeholder="Enter Password">
                </div>
              </div> -->

              <!--  uploade sitmap.xml or csv for larger sites -->
              <div class="form-group row">
                <label for="fupload" class="col-sm-3 col-form-label mt-1">Upload Sitmap or CSV:</label>
                <div class="col-sm-6">
                  <input type="file" class="mt-2" name="fupload" id="fupload" required>
                </div>
              </div>
              <!-- end sitmpa upload -->

              <div class="form-group row">
                <div class="col-sm-10">
                  <button type="submit" name="submit" class="btn btn-primary">Sign in</button>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
    </section>
    <!-- Optional JavaScript -->
      <!-- jQuery first, then Popper.js, then Bootstrap JS -->
      <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
      <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
      <script src="url.js"></script>
  </body>
</html>
