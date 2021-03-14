<?php include "lfms/include/connection.php";?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="title icon" type="image/png" href="images/logo.png">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css"
        integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css"
        integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
    <title>Amilex</title>
</head>

<body>

    <!-- navbar -->
    <nav class="mb-5 pb-5 navbar navbar-expand-md navbar-light fixed-top">
        <a href="#" class="navbar-brand">
            <img src="images/logo.png" width="100" height="60">
        </a>
        <a href="https://twitter.com/amilexchambers" target="_blank"
            style="color:#13060d;font-weight: bold;margin-left: 50px;">
            <img src="images/twitter3.png" width="30" height="30">
            follow us on twitter</a>
        <button type="button" class="navbar-toggler bg-light" data-toggle="collapse" data-target="#nav"><span
                class="navbar-toggler-icon"></span></button>
        <div class="collapse navbar-collapse justify-content-between" id="nav">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item"><a class="nav-link px-3" href="index.php">Home</a></li>
                <li class="nav-item"><a class="nav-link px-3" href="services.php">What we offer</a></li>
                <li class="nav-item"><a class="nav-link px-3" href="about.php">About Us</a></li>
                <li class="nav-item"><a class="nav-link px-3" href="blog.html">Blog</a></li>
                <li class="nav-item"><a class="nav-link px-3" href="contact.php">Contact Us</a></li>
            </ul>
        </div>
    </nav>
    <!-- blog -->
    <div class="container-fluid">
        <div class="mt-5 pt-5 ">
            <div>
                            <?php

$select_your_news = "SELECT * FROM news ORDER BY id DESC";

$result_by_your_news = mysqli_query($db, $select_your_news);

while ($row_by_your_news = mysqli_fetch_array($result_by_your_news)) {
    $id = $row_by_your_news['id'];
    $title = $row_by_your_news['title'];
    $content = $row_by_your_news['content'];
    $_avatar = $row_by_your_news['avatar'];

    $published_on = $row_by_your_news['published'];

    ?>
                <div>
                    <div class="d-flex justify-content-center">
                            <img style="
                            width: 400px;
                            height: 400px;
                            object-fit: cover;" class="blog-image" src="lfms/images/news/<?php echo $_avatar; ?>" alt="">
                    </div>
                </div><hr>
                <div style="
                            font-size: 22px;
                            color: #337ab7;
                            width: 90%;
                            margin-left: 6% !important;
                            "
                        class="mx-5 px-5 my-2">
                        <div style="font-size: 22px; color: #337ab7;" class="mx-5 px-5">
                         <?php echo $title; ?>
                        </div>
                </div>
                <div class="text-muted d-flex justify-content-center my-2">
                    <div>
                        <span>
                            <i class="fas fa-clock"></i>
                        </span>
                        <span>
                            <?php echo $published_on; ?>

                        </span>
                        <span class="mx-2" style="border-right: 2px solid #e2dcdc;"></span>
                    </div>
                    <div>
                        <span>
                            <i class="far fa-user"></i>
                        </span>
                        <span>
                            Admin
                        </span>
                        <!-- <span class="mx-2" style="border-right: 2px solid #e2dcdc;"></span> -->
                    </div>
                    <!-- <div>
                        <span>
                            <i class="fas fa-newspaper"></i>
                        </span>
                        <span>
                            News
                        </span>
                        <span class="mx-2" style="border-right: 2px solid #e2dcdc;"></span>
                    </div>
                    <div>
                        <span>
                            <i class="far fa-comments"></i>
                        </span>
                        <span>
                            No Comments
                        </span>
                        <span class="mx-2" style="border-right: 2px solid #e2dcdc;"></span>
                    </div> -->
                </div>
                <div style="width: 74%;
                            display: flex;
                            flex-direction: column;
                            margin-left: 13% !important;"
                            class="mx-5 px-5 my-4">
                    <p style="font-size: 15px;" class="text-muted">
                        <?php echo $content; ?>
                    </p>
                </div>

                <?php }?>
                <!-- <div class="mx-5 px-5 mt-5 pt-5">
                    <a href="blog-details.php">
                        <div class="ml-5 pl-5 ">
                            <button style="
                                background-color: #1b4279;
                                border-radius: 0px;
                                font-size: 14px;
                                color: #fff;" type="button" class="btn">Read More</button>
                        </div>
                    </a>
                </div> -->
                <div class="my-5 mx-5 px-5 ">
                    <div class="mx-5">
                        <div class="mx-5 px-5" style="border-bottom: 1px solid #e2dcdc;"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- end of blog -->


    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
        integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous">
        </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"
        integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous">
        </script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"
        integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous">
        </script>
    <script src="script.js"></script>
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>
    <script>

    </script>
</body>

</html>