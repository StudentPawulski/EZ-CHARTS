<?php
require('./php/authenticate.php');
require('./php/connect.php');

$userId = $_SESSION['userid'];

require('./vendor/gumlet/php-image-resize/lib/ImageResize.php');

use Gumlet\ImageResize;
use Gumlet\ImageResizeException;

function imageSize($original_image, $size, $new_filename)
{
    $image = new ImageResize($original_image);
    $image->resizeToWidth($size);
    $image->save('uploads/' . $new_filename);
}

    // file_upload_path() - Safely build a path String that uses slashes appropriate for our OS.
    // Default upload path is an 'uploads' sub-folder in the current folder.
function file_upload_path($original_filename, $upload_subfolder_name = 'uploads')
{
    $current_folder = dirname(__FILE__);
       
       // Build an array of paths segment names to be joins using OS specific slashes.
    $path_segments = [$current_folder, $upload_subfolder_name, basename($original_filename)];
       
       // The DIRECTORY_SEPARATOR constant is OS specific.
    return join(DIRECTORY_SEPARATOR, $path_segments);
}

// file_is_an_image() - Checks the mime-type & extension of the uploaded file for "image-ness".
function file_is_an_image($temporary_path, $new_path)
{
    $allowed_mime_types = ['image/gif', 'image/jpeg', 'image/png', 'application/pdf'];
    $allowed_file_extensions = ['gif', 'jpg', 'jpeg', 'png', 'pdf'];

    $actual_file_extension = pathinfo($new_path, PATHINFO_EXTENSION);
    $actual_mime_type = getimagesize($temporary_path)['mime'];

    $file_extension_is_valid = in_array($actual_file_extension, $allowed_file_extensions);
    $mime_type_is_valid = in_array($actual_mime_type, $allowed_mime_types);

    return $file_extension_is_valid && $mime_type_is_valid;
}


$image_upload_detected = isset($_FILES['image']) && ($_FILES['image']['error'] === 0);
$upload_error_detected = isset($_FILES['image']) && ($_FILES['image']['error'] > 0);

if ($image_upload_detected) {
    $image_filename = $_FILES['image']['name'];
    $temporary_image_path = $_FILES['image']['tmp_name'];
    $new_image_path = file_upload_path($image_filename);
    if (file_is_an_image($temporary_image_path, $new_image_path)) {
        move_uploaded_file($temporary_image_path, $new_image_path);

        if ($_FILES['image']['type'] !== 'application/pdf') {
            $file = explode(".", $image_filename);
            imageSize($new_image_path, 400, $file[0] . '_medium.' . $file[1]);
            imageSize($new_image_path, 50, $file[0] . '_thumbnail.' . $file[1]);
            imageSize($new_image_path, 20, $file[0] . '_fa.' . $file[1]);

            //$new_image_path = str_replace('.' . $file[1], '', $new_image_path);

            //$new_image_path = $new_image_path . '_thumbnail.' . $file[1];
            $photo = './uploads/' . $file[0] . '_thumbnail.' . $file[1];
            //$photo = $new_image_path;

            $photo = str_replace("\\", "/", $photo);


            //$photo = $image_filename;//$file[1];//$new_image_path;// . '_medium.' . $file[1];
            $photo1 = $new_image_path;
            $photo2 = $file[0];
            $photo3 = $file[1];


            $query = "UPDATE userdata 
                        SET photo = :photo
                        WHERE userId = :userId";
            $statement = $db->prepare($query);
            $statement->bindValue(':userId', $userId);
            $statement->bindValue(':photo', $photo);
    // Execute the INSERT.
            $statement->execute();

            //direct();
        }
    }
}

function direct()
{
    header('Location: profile.php');
    exit;
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>EZ-CHARTS Profile Page</title>
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">
    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <!-- Material Design Bootstrap -->
    <link href="css/mdb.min.css" rel="stylesheet">
    <!-- Your custom styles (optional) -->
    <link href="css/style.min.css" rel="stylesheet">
    <STYLE type="text/css">
        a:not([href]):not([tabindex]), a:not([href]):not([tabindex]):focus, a:not([href]):not([tabindex]):hover {
            color: inherit;
            text-decoration: none;
            margin-left: 30px;
        }
        ul.viewul {
            list-style-type: none;
            margin: 0 auto;
            padding: 0;
            overflow: hidden;
        }

        li.viewli {
            float: left;
        }

        li a.button {
            display: block;
            padding: 8px;            
        }
    </STYLE>
</head>

<body class="grey lighten-3">

    <!--Main Navigation-->
    <?php include('./php/header.php') ?>
    <!--Main Navigation-->

    <!--Main layout-->
    <main class="pt-5 mx-lg-5">
        <div class="container-fluid mt-5">

           <div class="card">
                <!-- Card content -->
                <div class="card-body">

                <form name="photoupload" method='post' enctype='multipart/form-data'>
                    <h3 class="dark-grey-text text-center">
                      <strong>Upload Profile Photo</strong>
                    </h3>

                    <h3 class="dark-grey-text text-center">
                      <strong><?= $photo ?></strong>
                    </h3>
                    <h3 class="dark-grey-text text-center">
                      <strong><?= $photo1 ?></strong>
                    </h3>
                    <h3 class="dark-grey-text text-center">
                      <strong><?= $photo2 ?></strong>
                    </h3>
                    <h3 class="dark-grey-text text-center">
                      <strong><?= $photo3 ?></strong>
                    </h3>


                    <label for='image'>Image Filename:</label>
                    <input type='file' name='image' id='image'>
                    <input type='submit' name='submit' value='Upload Image'>
                </form>
                
                <?php if ($upload_error_detected) : ?>

                    <p>Error Number: <?= $_FILES['image']['error'] ?></p>

                <?php elseif ($image_upload_detected) : ?>

                    <p>Client-Side Filename: <?= $_FILES['image']['name'] ?></p>
                    <p>Apparent Mime Type:   <?= $_FILES['image']['type'] ?></p>
                    <p>Size in Bytes:        <?= $_FILES['image']['size'] ?></p>
                    <p>Temporary Path:       <?= $_FILES['image']['tmp_name'] ?></p>

                <?php endif ?>
                  
              </div>
            </div>
        </div>
    </main>
    <!--Main layout-->

    <?php include('./php/footer.php') ?>

    <!-- SCRIPTS -->
    <!-- JQuery -->
    <script type="text/javascript" src="js/jquery-3.3.1.min.js"></script>
    <!-- Bootstrap tooltips -->
    <script type="text/javascript" src="js/popper.min.js"></script>
    <!-- Bootstrap core JavaScript -->
    <script type="text/javascript" src="js/bootstrap.min.js"></script>
    <!-- MDB core JavaScript -->
    <script type="text/javascript" src="js/mdb.min.js"></script>
    <!-- Initializations -->
    <script type="text/javascript">
        // Animations initialization
        new WOW().init();
    </script>

</body>

</html>