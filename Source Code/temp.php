<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/fontawesome/css/all.css">
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/style.css?v=<?php echo time(); ?>">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,700&display=swap" rel="stylesheet" />
    <title>ReachMe - New Post</title>
    <link rel="shortcut icon" type="image/x-icon" href="rm.ico" />


    <style>

    </style>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

</head>

<body>

    <script src="assets/bootstrap/js/bootstrap.bundle.min.js"></script>


    <div class="card-main">

        <a title="View User Profile" class="unformatted-link homepage-poster-name" href="view_user.php?uid=
    ' . $class_row['authorid'] . '"><img class="profile-pic-home-post" src="' . $propic_link . '">&nbsp' . $authorname . '
            <p class="timestamp-home" title="Timestamp">' . $time . '</p>
        </a>


        <div class="dropdown" style="float: right; margin-top: -60px;">
            <button style="display:visible;" class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                <i class="fas fa-bars"></i>
            </button>
            <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                <li><a class="dropdown-item" href="' . $menulink . '&operation=edit"><i class="fas fa-edit"></i> Edit Post</a></li>
                <li><a class="dropdown-item" href="' . $menulink . '&operation=del"><i class="fas fa-trash-alt"></i> Delete Post</a></li>
            </ul>
        </div>

        <div class="post-text">
            <span>' . $class_row['content'] . '</span>
        </div>
    </div>

</body>

</html>