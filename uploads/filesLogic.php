<?php

// connection to the database
$mysqli = mysqli_connect("localhost", "root", "", "uploads");


// Upload Files

if (isset($_POS['save'])) { //if save button is clicked on submit

    //name of the uploaded file
    $filename = $_FILES['myfile']['name'];

    //destination of the file on the server
    $destination = "uploads/". $filename;

    // get the file extension
    $extension = pathinfo($filename, PATHINFO_EXTENSION);

    //the physical file on the temporary uploads directory on the server
    $file = $_FILES['myfile']['tmp_name'];
    $size = $_FILES['myfile']['size'];

    if (!in_array($extension, ['zip', 'pdf', 'docx'])) {
        echo "Your file extension must be .zip, .pdf or .docx";
    }elseif ($_FILES['myfile']['size'] > 1000000) { //files shouldn't be larger than 1MB
        echo "File too large!";
    }else{
        //move the uploaded(temporary) file to the specified desination
        if (move_uploaded_file($file, $destination)) {
            $sql = "INSERT INTO files(name, size, downloads) VALUES('$filename', $size, 0)";
            if (mysqli_query($mysqli, $sql)) {
                echo "File uploaded successfully";
            }
        }else{
            echo "Failed to upload file";
        }
    }
}

?>