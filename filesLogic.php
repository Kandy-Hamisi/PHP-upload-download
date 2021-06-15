<?php

// connection to the database
$mysqli = mysqli_connect("localhost", "root", "", "uploads");


// selecting from the files table
$sql = "SELECT * FROM files";
$result = mysqli_query($mysqli, $sql);

$files = mysqli_fetch_all($result, MYSQLI_ASSOC);

// Upload Files

if (isset($_POST['save'])) { //if save button is clicked on submit

    //name of the uploaded file
    $filename = $_FILES['myfile']['name'];
    if (empty($filename)) {
        echo "You must upload a file";
    }

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
                echo "Success";
            }
        }else{
            echo "Failed to upload file";
        }
    }
}


// Downloading the files

if (isset($_GET['file_id'])) {
    $id = $_GET['file_id'];


    //fetch file to download from database
    $sql = "SELECT * FROM files WHERE file_id=$id";
    $result = mysqli_query($mysqli, $sql);

    $file = mysqli_fetch_assoc($result);
    
    $filepath = 'uploads' . $file['name'];

    if (file_exists($filepath)) {
        header('Content-Description: File Transfer');
        header('Content-Type: aplication/octet-stream');
        header('Content-Disposition:attachment; filename=' . basename($filepath));
        header('Expires: 0');
        header('Cache-Control: must-revalidate');
        header('Pragma: public');
        header('Content-Length: ' . filesize('uploads/' . $file['name']));
        readfile('uploads/' . $file['name']);
        

        //Updating dowloads count
        $newcount = $file['downloads'] + 1;
        $updateQuery = "UPDATE files SET downloads=$newcount WHERE file_id=$id";
        mysqli_query($mysqli, $updateQuery);
        echo "Success";
    }else{
        
        echo "Could not download the file";
    }
}
?>