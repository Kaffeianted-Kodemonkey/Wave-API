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
    <section id="main" role="main">
      <div class="row">
        <div class="col mt-5">
          <h1 class="text-center">Production/Live Site</h1>
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
            <form action="api_script.php" method="post" enctype="multipart/form-data">
              <div class="border border-danger rounded-sm p-2 mb-3">
                <div class="custom-control custom-checkbox mb-3">
                  <input type="checkbox" class="custom-control-input" name="testing" id="testing">
                  <label class="custom-control-label" for="testing">Check for Testing</label>
                </div>
                <div class="form-group row">
                  <label for="test_url" class="col-sm-2 col-form-label">Testing Level:</label>
                  <div class="col-sm-6">
                    <select class="custom-select custom-select-md mb-3" name="test_level">
                      <option value=""selected>Select Testing Level</option>
                      <option value="reporttype1">Level 1</option>
                      <option value="reporttype2">Level 2</option>
                      <option value="reporttype3">Level 3</option>
                    </select>
                  </div>
                </div>
              </div>

              <div class="form-group row">
                <label for="client" class="col-sm-2 col-form-label">Compan Name:</label>
                <div class="col-sm-6">
                  <input type="text" class="form-control" name="client" id="client" placeholder="Company or Client Name">
                </div>
              </div>

              <!-- enter url/pages -->

              <div class="form-group row">
                <label for="pages" class="col-sm-2 col-form-label">URL/Page:</label>
                <div class="col-sm-6">
                  <input type="text" class="form-control" name="url_page" id="url_page" placeholder="URL of Page to evaluate">
                </div>
              </div>

              <!-- <div id="URLList"></div> -->

              <!-- or uploade sitmap.xml for larger sites -->
              <div class="form-group row">
                <label for="sitemap" class="col-sm-2 col-form-label">Upload sitmap:</label>
                <div class="col-sm-6">
                  <input type="file" class="form-control" name="sitemap" id="sitemap" placeholder="upload sitemap.xml">
                </div>
              </div>
              <!-- end sitmpa upload -->

              <div class="form-group row">
                <label for="reporttype" class="col-sm-2 col-form-label">Reprot Type:</label>
                <div class="col-sm-6">
                  <select class="custom-select custom-select-md mb-3" name="reporttype">
                    <option value="3"selected>Select Leve</option>
                    <option value="1">One</option>
                    <option value="2">Two</option>
                    <option value="3">Three</option>
                  </select>
                </div>
              </div>
              <div class="form-group row">
                <label for="username" class="col-sm-2 col-form-label">Username:</label>
                <div class="col-sm-6">
                  <input type="text" class="form-control" id="username" name="username" placeholder="Enter Username">
                </div>
              </div>
              <div class="form-group row">
                <label for="password" class="col-sm-2 col-form-label">Password</label>
                <div class="col-sm-6">
                  <input type="password" class="form-control" id="password" name="password" placeholder="Enter Password">
                </div>
              </div>

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
