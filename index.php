<?php include "filesLogic.php"; ?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <link rel="stylesheet" href="style.css">
    <title>Files Upload and Download</title>
    <link rel="stylesheet" href="style.css">
  </head>
  <body>
    <div class="container">
      <div class="row">
        <section class="myform">
          <form method="POST" enctype="multipart/form-data">
            <h3>Upload File</h3>
            <div class="error-success-text">
              
            </div>
            <input type="file" name="myfile"> <br>
            <!-- <button class="btn" type="submit" name="save">upload</button> -->
            <div class="button">
              <input type="submit" name="save" value="Upload">
            </div>
          </form>
        </section>
      </div>
    </div>
    <script src="Javascript/upload.js"></script>
  </body>
</html>