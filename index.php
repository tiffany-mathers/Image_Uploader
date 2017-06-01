<!DOCTYPE html>
<html>
    <head>
        <title>Image Upload</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="css/style.css">      
    </head>
    <body>
        <div class ="jumbotron">
            <div class="container">
                <table>
                    <form action="<?php echo htmlentities($_SERVER["PHP_SELF"], ENT_QUOTES, "utf-8") ?>" method="post" enctype="multipart/form-data">
                        <tr>
                            <td colspan="3"><h1><center>Image Upload<br></center></h1></td>
                        </tr>
                        <tr>
                            <td>Select image to upload:</td>
                            <td><input type="file" name="fileToUpload" id="fileToUpload"></td>
                            <td><input type="submit" value="Upload Image" name="submit"></td>
                    </form>
                    </tr>
                </table>
                <br>

                <?php
                // Check if image file is a actual image or fake image
                if (isset($_POST["submit"])) {
                    $target_dir = "C:\Users\Dave\Desktop\TiffanySchool\SDEV 325\uploads";
                    $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
                    $uploadOk = 1;
                    $imageFileType = pathinfo($target_file, PATHINFO_EXTENSION);
                    $errorMessage = "";
                    $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
                    if ($check !== false) {
                        $uploadOk = 1;
                    } else {
                        $errorMessage = "File is not an image.";
                        $uploadOk = 0;
                    }
                    // Check if file already exists
                    if (file_exists($target_file)) {
                        $errorMessage = "This file already exists in the directory.";
                        $uploadOk = 0;
                    }

                    //do not allow php files to be uploaded
                    $pos = strpos($target_file, 'php');
                    if (!($pos === false)) {
                        $uploadOk = 0;
                    }

                    // whitelist acceptable image file extensions 
                    $ext_type = array('gif', 'GIF', 'jpg', 'JPG', 'jpe', 'JPE', 'jpeg', 'JPEG', 'pgn', 'PGN');
                    if (!in_array($imageFileType, $ext_type)) {
                        $uploadOk = 0;
                    }

                    // Check if $uploadOk is set to 0 by an error
                    if ($uploadOk == 0) {
                        echo "Your file was not uploaded. ";
                        echo $errorMessage;

                        // if everything is ok, upload file
                    } else {
                        if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
                            /* @var $_FILES type */
                            echo " The file has been uploaded. ";
                        } else {
                            echo " Sorry, there was an error uploading your file.";
                        }
                    }
                }
                ?>
            </div>
        </div>
    </body>
</html>