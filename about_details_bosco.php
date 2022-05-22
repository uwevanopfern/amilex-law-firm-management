<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="title icon" type="image/png" href="images/logo.png">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/css/bootstrap.min.css"
        integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css"
        integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet">
    <!-- <link rel="stylesheet" href="style.css"> -->
    <style>
    .details-img {
        width: 161px;
        height: 190px;
        object-fit: cover;
    }

    .nav-tabs-color {
        background: #eaedf0;

    }

    .nav-tabs .nav-item.show .nav-link,
    .nav-tabs .nav-link.active {
        border-bottom: 2px solid;
        background-color: #eaedf0 !important;
        border-color: #eaedf0 #eaedf0 #260081 !important;
    }


    .visual {
        background: url(images/team.jpg);
        background-size: cover;
        background-position: center;
        background-repeat: no-repeat;
        margin-bottom: 5.15625rem;
        padding-bottom: 45%;
        width: 100%;
        z-index: 10;
    }


    @media (min-width: 60em) {
        .visual {
            height: 100vh;
            left: 1.5rem;
            margin-bottom: 3.4375rem;
            position: fixed;
            padding: 0;
            width: 32.2%;
        }

    }


    @media (min-width: 60em) {
        .logo-alt {
            margin-left: -2.625rem;
        }
    }

    @media (min-width: 60em) {
        .logo {
            margin-left: -1.125rem;
            position: fixed;
            top: 8rem;
            -ms-transform: translateX(0);
            transform: translateX(0);
            width: 11rem;
        }
    }

    .logo {
        margin-left: -2.3rem;
        position: absolute;
        top: 50%;
        -ms-transform: translateY(-50%);
        transform: translateY(-50%);
        transition: transform 0.2s;
        width: 8rem;
        z-index: 30;
    }

    .logo {
        display: inline-block;
    }

    .o-layout-sub ol li:before {
        content: counter(customCounter);
        background-color: #260081;
        font-family: 'brown', Arial, sans-serif;
        color: #fff;
        border-radius: 50%;
        width: 26px;
        height: 26px;
        display: -ms-inline-flexbox;
        display: inline-flex;
        -ms-flex-pack: center;
        justify-content: center;
        -ms-flex-align: center;
        align-items: center;
        font-size: 14px;
        font-weight: bold;
        position: absolute;
        left: 0;
    }

    @media (min-width: 60em) {
        .o-layout-sub ol {
            -moz-column-count: 2;
            column-count: 2;
            display: block;
        }
    }

    .o-layout-sub ol {
        counter-reset: customCounter;
        margin-top: 23px;
    }

    @media (min-width: 60em) {

        .o-layout-sub ol,
        .o-layout-sub ul {
            display: -ms-flexbox;
            display: flex;
            -ms-flex-wrap: wrap;
            flex-wrap: wrap;
            -ms-flex-pack: justify;
            justify-content: space-between;
        }
    }

    .o-layout-sub ol,
    .o-layout-sub ul {
        list-style: none;
        padding: 0;
        max-width: 720px;
    }

    .o-layout-sub ol li {
        counter-increment: customCounter;
        padding-left: 20px;
    }

    @media (min-width: 60em) {
        .o-layout-sub ol li {
            width: calc(100% - 20px);
        }
    }

    .o-layout-sub ol li,
    .o-layout-sub ul li {
        margin-bottom: 16px;
        /* line-height: 1.7; */
        font-size: 15px;
    }
    </style>
    <title>Amilex</title>
</head>

<body>
    <div class="visual">
        <a class="logo logo-alt" href="index.php">
            <img src="images/logo.png" width="150">
        </a>
    </div>
    <!-- navbar -->
    <nav class="navbar navbar-expand-md navbar-light">
        <div class="collapse navbar-collapse" id="myNavbar">
            <div class="container-fluid">
                <div class="row">
                    <!-- sidebar -->
                    <div class="col-xl-4 col-lg-3 col-md-4 sidebar fixed-top"></div>
                    <!-- end of sidebar -->
                </div>
            </div>
        </div>
    </nav>
    <section class="mx-5">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-8 col-md-8 ml-auto">
                    <div class="my-4">
                        <ul style="font-weight: 600;" class="nav justify-content-end">
                            <li class="nav-item"><a class="nav-link px-3 text-dark" href="index.php">Home</a></li>
                            <li class="nav-item"><a class="nav-link px-3 text-dark" href="services.php">What we
                                    offer</a></li>
                            <li class="nav-item"><a class="nav-link px-3 text-dark" href="about.php">About Us</a></li>
                            <li class="nav-item"><a class="nav-link px-3 text-dark" href="blog.php">Blog</a></li>
                            <li class="nav-item"><a class="nav-link px-3 text-dark" href="contact.php">Contact Us</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
    </section>
    <section style=" background: #f5f6f8; mx-5">
        <div class="">
            <div class="col-lg-8 col-md-12 ml-auto">
                <div class="d-flex py-4">
                    <div class="col-lg-2 mr-5">
                        <img style="" src="images/Bosco.jpg" class="details-img">
                    </div>
                    <div class="col-lg-6">
                        <h4 class="text-capitalize font-weight-bold">
                            Mr Bosco IYAKAREMYE
                        </h4>
                        <div>
                            Legal Assistant
                        </div>
                        <div>
                            <span>
                                <a href="" style="text-decoration:none;">
                                    iyakaremye@amilex.rw
                                </a>
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- tabs section -->
    <section>
        <div class=" container-fluid">
            <div class="col-lg-8 col-md-12 ml-auto">
                <nav style="font-size: 13px; width: 888px;
                        margin-left: -2%;" class="nav-tabs-color">
                    <div class="d-flex">
                        <div class="nav nav-tabs" id="nav-tab" role="tablist">
                            <a class="nav-item nav-link active text-muted" id="nav-overview-tab" data-toggle="tab"
                                href="#nav-overview" role="tab" aria-controls="nav-overview" aria-selected="true">
                                Overview
                            </a>
                            <a class="nav-item nav-link text-muted" id="nav-academic-tab" data-toggle="tab"
                                href="#nav-academic" role="tab" aria-controls="nav-academic"
                                aria-selected="true">Academic
                                qualifications
                            </a>
                            <a class="nav-item nav-link text-muted" id="nav-areas-tab" data-toggle="tab"
                                href="#nav-areas" role="tab" aria-controls="nav-areas" aria-selected="false">Areas
                                of
                                expertise</a>
                            <a class="nav-item nav-link text-muted" id="nav-member-tab" data-toggle="tab"
                                href="#nav-member" role="tab" aria-controls="nav-member"
                                aria-selected="false">Professional membership</a>
                            <a class="nav-item nav-link text-muted" id="nav-pub-tab" data-toggle="tab" href="#nav-pub"
                                role="tab" aria-controls="nav-pub" aria-selected="false">Publications</a>
                            <a class="nav-item nav-link text-muted" id="nav-experience-tab" data-toggle="tab"
                                href="#nav-experience" role="tab" aria-controls="nav-experience"
                                aria-selected="false">Experience</a>
                        </div>
                    </div>
                </nav>
                <div style="width: 94%; !important;" class="tab-content mx-5 my-5" id="nav-tabContent">
                    <div class="tab-pane fade show active" id="nav-overview" role="tabpanel"
                        aria-labelledby="nav-overview-tab">
                        <p>Mr Bosco Iyakaremye joined Amilex Chambers in April 2022 as a Legal Assistant. He has a law
                            degree from the University of Rwanda and is currently a candidate for a Postgraduate diploma
                            in legal practice.<br><br> Bosco Iyakaremye is a young, very dynamic person, with
                            interpersonal
                            skills, efficient and focused on achieving personal and institutional development.<br><br>
                            He is a
                            fellow at DLA Piper. Bosco is fluent in English and has a good knowledge of French and
                            Kinyarwanda, his mother tongue. He is a very good user of IT and internet-based research.
                        </p>
                    </div>
                    <div class="tab-pane fade" id="nav-academic" role="tabpanel" aria-labelledby="nav-academic-tab">
                        <div class="o-layout-sub">
                            <ol>
                                <div class="col-lg-12">
                                    <li>LLB Law (University of Rwanda, 2022)</li>
                                    <li>PGD Legal Practice (ILPD, ongoing)</li>
                                </div>
                            </ol>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="nav-areas" role="tabpanel" aria-labelledby="nav-areas-tab">
                        <div class="o-layout-sub">
                            <ol>
                                <div class="col-lg-12">
                                    <li>Business legal support </li>
                                    <li>Contract law </li>
                                    <li>Labour law </li>
                                </div>
                            </ol>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="nav-member" role="tabpanel" aria-labelledby="nav-member-tab">
                        <div class="o-layout-sub">
                            <ol>
                                <div class="col-lg-12">
                                </div>
                            </ol>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="nav-pub" role="tabpanel" aria-labelledby="nav-pub-tab">
                        <div class="o-layout-sub">
                            <ol>
                                <div class="col-lg-12">

                                </div>
                            </ol>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="nav-experience" role="tabpanel" aria-labelledby="nav-experience-tab">
                        <div class="o-layout-sub">
                            <ol>
                                <div class="col-lg-12">
                                </div>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
            <div style="margin-left: 1%; !important;">
                <?php include 'footer.php'?>
            </div>
        </div>
    </section>

    <script src=" https://code.jquery.com/jquery-3.3.1.slim.min.js"
        integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous">
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"
        integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous">
    </script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"
        integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous">
    </script>
    <script src="script.js"></script>
</body>

</html>