<?php
include('../../Model/ConfigGoogle.php');
include('../../Core/AddUserGoogle.php');
include('../../Core/Reclamation.php');
include('../../core/pub.php');
$pub2 = new pub();
$pubss=$pub2->readpublicite();
$random=$pub2->get_random_image();
if(isset($_POST['submit-reclamation']))
{
    $topic=$_POST['reclamationTopic'];
    $description=$_POST['reclamationDescription'];
    $currentDateTime = date('Y-m-d H:i:s');
    $newReclamation=new Reclamation('','',$topic,$description,$currentDateTime,'');
    CrudReclamation::insert($newReclamation);
}

?>
<!doctype html>
<html lang="en">

<head>
    <!--
    /   Multipurpose: Free Template by FreeHTML5.co
    /   Author: https://freehtml5.co
    /   Facebook: https://facebook.com/fh5co
    /   Twitter: https://twitter.com/fh5co
    -->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Document title -->
    <title>Multipurpose</title>
    <!-- Stylesheets & Fonts -->
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,400i,700,700i%7CRajdhani:400,600,700" rel="stylesheet">
    <!-- Plugins Stylesheets -->
    <link rel="stylesheet" href="assets/css/loader/loaders.css">
    <link rel="stylesheet" href="assets/css/font-awesome/font-awesome.css">
    <link rel="stylesheet" href="assets/css/bootstrap.css">
    <link rel="stylesheet" href="assets/css/aos/aos.css">
    <link rel="stylesheet" href="assets/css/swiper/swiper.css">

    <link rel="stylesheet" href="assets/css/lightgallery.min.css">
    <!-- Template Stylesheet -->
    <link rel="stylesheet" href="assets/css/style.css">
    <!-- Responsive Stylesheet -->
    <link rel="stylesheet" href="assets/css/responsive.css">
    <style>

    </style>
    <link rel="stylesheet" href="pub.css">
</head>
<script src="./script.js" defer></script>

<?php
$usergoogleEmail = "";
if (isset($_GET['code'])) {
    $token = $client->fetchAccessTokenWithAuthCode($_GET['code']);
    if (isset($token)) {
        $client->setAccessToken($token['access_token']);
        $google_oauth = new Google_Service_Oauth2($client);
        $google_account_info = $google_oauth->userinfo->get();
        $usergoogleEmail = $google_account_info['email'];
        $usergoogleGendre = $google_account_info['gendre'];
        $usergoogle = new UserGoogle('', $usergoogleEmail, $usergoogleGendre, $google_account_info['familyName'], $google_account_info['givenName'], $google_account_info['name'], $google_account_info['picture'], $google_account_info['verifiedEmail'], $google_account_info['id']);
        $userController = new CrudUserGoogle();
        $try=$userController->verifie($usergoogle);
        $_SESSION['idUserGoogle']=$try['id'];
        if($userController->verifie($usergoogle)==NULL)
        {
            $userController->insert($usergoogle);
        }
        
        //print_r($google_account_info);
    }
}
?>

<body>
    <!-- Loader Start -->
    <div class="css-loader">
        <div class="loader-inner line-scale d-flex align-items-center justify-content-center"></div>
    </div>
    <!-- Loader End -->
    <!-- Header Start -->
    <div id="img">
      <button id="cancel" name="cancel" class="cancel">X</button>
      <img src="<?php echo "./src/".$random ?>" alt="" width="900" height="500">
   </div>
    <header style="background-color: black;">

        <div class="container">

            <div class="top-header d-none d-sm-flex justify-content-between align-items-center">
                <div class="contact">
                    <a href="tel:+1234567890" class="tel"><i class="fa fa-phone" aria-hidden="true"></i>+1234567890</a>
                    <a href="mailto:info@yourmail.com"><i class="fa fa-envelope" aria-hidden="true"></i><?php if(isset($_GET['code'])) {echo $try['email'];}else echo $_SESSION['idUser'];?></a>
                </div>
                <nav class="d-flex aic">
                    <a href="http://localhost/projet/view/LoginPage.php" class="login"><i class="fa fa-user" aria-hidden="true"></i>Login</a>
                    <ul class="nav social d-none d-md-flex">
                        <li><a href="https://www.facebook.com/fh5co" target="_blank"><i class="fa fa-facebook"></i></a></li>
                        <li><a href="#"><i class="fa fa-google-plus"></i></a></li>
                        <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                    </ul>
                </nav>
            </div>
            <nav class="navbar navbar-expand-md navbar-light">
                <a class="navbar-brand" href="index.php"><img src="assets/images/LOGO4.png" alt="Multipurpose"></a>
                <div class="group d-flex align-items-center">
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
                    <a class="login-icon d-sm-none" href="#"><i class="fa fa-user"></i></a>
                    <a class="cart" href="panier.php"><i class="fa fa-shopping-cart"></i></a>

                </div>
                <style>
                    .modal-backdrop {
                        display: none;
                    }
                </style>
                <div class="group d-flex align-items-center mx-2 px-4">
                    <a class="exclamtion d-none d-md-block" style="font-size: 16px;" href="#myModal" data-toggle="modal"><i class="fa fa-exclamation"></i></a>
                    <div class="modal fade" id="myModal">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <<div class="modal-header">
                                    <h5 class="modal-title justify-content-center align-center text-center text-danger">Reclamation</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">

                                    </button>
                                    <span id="close-modal" class="close" data-dismiss="modal" style="cursor:pointer;float:right;">&times;</span>
                            </div>
                            <script>
                                $(document).ready(function() {
                                    $('#close-modal').click(function() {
                                        $('#myModal').modal('hide');
                                    });
                                });
                            </script>
                            <form method="post">
                                <div class="modal-body">

                                    <label for="dropdown-menu " class="justify-content-center align-center text-center text-danger">Enter your Reclamation Topic please:</label>
                                    <select class="form-select-sm w-100 border-0" style="color:black; border:none; outline:none;" id="dropdown-menu" name="reclamationTopic">
                                        <option value="User Management">User Management</option>
                                        <option value="Livraison Management">Livraison Management</option>
                                        <option value="Product Management">Product Management</option>
                                        <option value="Event Management">Event Management</option>
                                        <option value="Promotion Management">Promotion Management</option>
                                    </select>
                                    <textarea class="field form-control mt-2" style="color:black; border:none; outline:none;" id="s" name="reclamationDescription" type="text" placeholder="Can you Provide us with more informations about your probleme pelase ..."></textarea>
                                </div>
                                <div class="modal-footer">
                                    <button type="submit" name="submit-reclamation" class="btn btn-primary">Send Reclamation</button>
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
        </div>

        <a class="search-icon d-none d-md-block" href="#"><i class="fa fa-search"></i></a>
        <div class="collapse navbar-collapse justify-content-end" id="navbarSupportedContent">
            <ul class="navbar-nav">
                <li class="nav-item"><a class="nav-link" href="index.php">Home</a></li>
                <li class="nav-item"><a class="nav-link" href="aboutus.php">About Us</a></li>
                <li class="nav-item"><a class="nav-link" href="services.php">Services</a></li>
                <!-- Condition of Connection is nesseary -->
                <li class="nav-item"><a class="nav-link" href="wishlist.php">Wish list</a></li>
                <li class="nav-item"><a class="nav-link" href="shop.php">Shop</a></li>
                <li class="nav-item"><a class="nav-link" href="events.php">events</a></li>
                <li class="nav-item"><a class="nav-link" href="contactus.php">Contact Us</a></li>
            </ul>

            <form class="bg-white search-form" method="get" id="searchform">
                <div class="input-group">
                    <input class="field form-control" id="s" name="s" type="text" placeholder="Search">
                    <span class="input-group-btn">
                        <input class="submit btn btn-primary" id="searchsubmit" name="submit" type="submit" value="Search">
                    </span>
                </div>
            </form>
        </div>

        </nav>

        </div>
    </header>

    <!-- Header End -->
    <!-- Hero Start slinding part -->
    <section class="hero">
        <div class="container">
            <div class="row">
                <div class="col-12 offset-md-1 col-md-11">
                    <div class="swiper-container hero-slider">
                        <div class="swiper-wrapper">
                            <div class="swiper-slide slide-content d-flex align-items-center">
                                <div class="single-slide">
                                    <h1 data-aos="fade-right" data-aos-delay="200">Creative<br> Multipurpose websites
                                    </h1>
                                    <p data-aos="fade-right" data-aos-delay="600">Crafted by innovative creators for
                                        Expecting
                                        Peoples’s predefined dummy text<br> chunks as necessary, making this the first.
                                    </p>
                                    <a data-aos="fade-right" data-aos-delay="900" href="#" class="btn btn-primary">See
                                        More</a>
                                    <a data-aos="fade-right" data-aos-delay="900" href="#" class="btn btn-primary">Get
                                        Now</a>
                                </div>
                            </div>
                            <div class="swiper-slide slide-content d-flex align-items-center">
                                <div class="single-slide">
                                    <h1 data-aos="fade-right" data-aos-delay="200">Creative<br> Multipurpose websites
                                    </h1>
                                    <p data-aos="fade-right" data-aos-delay="600">Crafted by innovative creators for
                                        Expecting
                                        Peoples’s predefined dummy text<br> chunks as necessary, making this the first.
                                    </p>
                                    <a data-aos="fade-right" data-aos-delay="900" href="#" class="btn btn-primary">See
                                        More</a>
                                    <a data-aos="fade-right" data-aos-delay="900" href="#" class="btn btn-primary">Get
                                        Now</a>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
            <!-- Add Control -->
            <span class="arr-left"><i class="fa fa-angle-left"></i></span>
            <span class="arr-right"><i class="fa fa-angle-right"></i></span>
        </div>
        <div class="texture"></div>
        <div class="diag-bg"></div>
    </section>
    <!-- Hero End -->
    <!-- Call To Action Start -->
    <section class="cta" data-aos="fade-up" data-aos-delay="0">
        <div class="container">
            <div class="cta-content d-xl-flex align-items-center justify-content-around text-center text-xl-left">
                <div class="content" data-aos="fade-right" data-aos-delay="200">
                    <h2>FOR BUILDING THE MODERN WEBSITE</h2>
                    <p>Packed with all the goodies you can get, Kallyas is our flagship premium template.</p>
                </div>
                <div class="subscribe-btn" data-aos="fade-left" data-aos-delay="400" data-aos-offset="0">
                    <a href="#" class="btn btn-primary">Join Newsletter</a>
                </div>
            </div>
        </div>
    </section>
    <!-- Call To Action End -->
    <!-- Services Start -->
    <section class="services">
        <div class="container">
            <div class="title text-center">
                <h6>Our Speakers</h6>
                <h1 class="title-blue">Why Choose Us</h1>
            </div>
            <div class="container">
                <div class="row">
                    <div class="col-sm-6 col-lg-4">
                        <div class="media" data-aos="fade-up" data-aos-delay="200" data-aos-duration="400">
                            <img class="mr-4" src="assets/images/service1.png" alt="Web Development">
                            <div class="media-body">
                                <h5>Web Development</h5>
                                Donec volutpat tincidunt neque, vitae lobortis libero mattis sed tempus.
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-lg-4">
                        <div class="media" data-aos="fade-up" data-aos-delay="400" data-aos-duration="600">
                            <img class="mr-4" src="assets/images/service2.png" alt="Web Development">
                            <div class="media-body">
                                <h5>Testing for perfection</h5>
                                Donec volutpat tincidunt neque, vitae lobortis libero mattis sed tempus.
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-lg-4">
                        <div class="media" data-aos="fade-up" data-aos-delay="600" data-aos-duration="800">
                            <img class="mr-4" src="assets/images/service3.png" alt="Web Development">
                            <div class="media-body">
                                <h5>Discussion of the idea</h5>
                                Donec volutpat tincidunt neque, vitae lobortis libero mattis sed tempus.
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-lg-4">
                        <div class="media" data-aos="fade-up" data-aos-delay="200" data-aos-duration="400">
                            <img class="mr-4" src="assets/images/service4.png" alt="Web Development">
                            <div class="media-body">
                                <h5>Modern style</h5>
                                Donec volutpat tincidunt neque, vitae lobortis libero mattis sed tempus.
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-lg-4">
                        <div class="media" data-aos="fade-up" data-aos-delay="400" data-aos-duration="600">
                            <img class="mr-4" src="assets/images/service1.png" alt="Web Development">
                            <div class="media-body">
                                <h5>Web Development</h5>
                                Donec volutpat tincidunt neque, vitae lobortis libero mattis sed tempus.
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-lg-4">
                        <div class="media" data-aos="fade-up" data-aos-delay="600" data-aos-duration="800">
                            <img class="mr-4" src="assets/images/service5.png" alt="Web Development">
                            <div class="media-body">
                                <h5>Elaboration of the core</h5>
                                Donec volutpat tincidunt neque, vitae lobortis libero mattis sed tempus.
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Services End -->
    <!-- Featured Start -->
    <section class="featured">
        <div class="container">
            <div class="row">
                <div class="col-md-6" data-aos="fade-right" data-aos-delay="400" data-aos-duration="800">
                    <div class="title">
                        <h6 class="title-primary">about Tamplate</h6>
                        <h1 class="title-blue">a rich featured, epic & premium work.</h1>
                    </div>
                    <p>There are many variations of passages of available but the majority have suffered alteration in
                        some form, by injected humour, or randomised words which don't look even slightly believable. If
                        you are going to use a passage of you need to be sure there isn't anything embarrassing hidden
                        in the middle of text. All the generators on the Internet.</p>
                    <div class="media-element d-flex justify-content-between">
                        <div class="media">
                            <i class="fa fa-magic mr-4"></i>
                            <div class="media-body">
                                <h5>any offer</h5>
                                New York, United States
                            </div>
                        </div>
                        <div class="media">
                            <i class="fa fa-magic mr-4"></i>
                            <div class="media-body">
                                <h5>any offer</h5>
                                New York, United States
                            </div>
                        </div>
                    </div>
                    <a href="#" class="btn btn-primary">See More</a>
                </div>
                <div class="col-md-6" data-aos="fade-left" data-aos-delay="400" data-aos-duration="800">
                    <div class="featured-img">
                        <img class="featured-big" src="assets/images/men-Book.png" alt="Featured 1">
                        <img class="featured-small" src="assets/images/min-book.png" alt="Featured 2">
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Featured End -->
    <!-- Recent Posts Start -->
    <section class="recent-posts">
        <div class="container">
            <div class="row">
                <div class="col-lg-6">
                    <div class="single-rpost d-sm-flex align-items-center" data-aos="fade-right" data-aos-duration="800">
                        <div class="post-content text-sm-right">
                            <time datetime="2019-04-06T13:53">15 Oct, 2019</time>
                            <h3><a href="#">Proudly for us to build stylish</a></h3>
                            <p><a href="#">Seanding</a>, <a href="#">Website</a>, <a href="#">E-commerce</a></p>
                            <a class="post-btn" href="#"><i class="fa fa-arrow-right"></i></a>
                        </div>
                        <div class="post-thumb">
                            <img class="img-fluid" src="assets/images/post1.png" alt="Post 1">
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="single-rpost d-sm-flex align-items-center" data-aos="fade-left" data-aos-duration="800">
                        <div class="post-thumb">
                            <img class="img-fluid" src="assets/images/post2.png" alt="Post 1">
                        </div>
                        <div class="post-content">
                            <time datetime="2019-04-06T13:53">15 Oct, 2019</time>
                            <h3><a href="#">Remind me to water the plants</a></h3>
                            <p><a href="#">Seanding</a>, <a href="#">Website</a>, <a href="#">E-commerce</a></p>
                            <a class="post-btn" href="#"><i class="fa fa-arrow-right"></i></a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="single-rpost d-sm-flex align-items-center" data-aos="fade-right" data-aos-delay="200" data-aos-duration="800">
                        <div class="post-content text-sm-right">
                            <time datetime="2019-04-06T13:53">15 Oct, 2019</time>
                            <h3><a href="#">Add apples to the grocery list</a></h3>
                            <p><a href="#">Seanding</a>, <a href="#">Website</a>, <a href="#">E-commerce</a></p>
                            <a class="post-btn" href="#"><i class="fa fa-arrow-right"></i></a>
                        </div>
                        <div class="post-thumb">
                            <img class="img-fluid" src="assets/images/post3.png" alt="Post 1">
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="single-rpost d-sm-flex align-items-center" data-aos="fade-left" data-aos-delay="200" data-aos-duration="800">
                        <div class="post-thumb">
                            <img class="img-fluid" src="assets/images/post4.png" alt="Post 1">
                        </div>
                        <div class="post-content">
                            <time datetime="2019-04-06T13:53">15 Oct, 2019</time>
                            <h3><a href="#">Make it warmer downstairs</a></h3>
                            <p><a href="#">Seanding</a>, <a href="#">Website</a>, <a href="#">E-commerce</a></p>
                            <a class="post-btn" href="#"><i class="fa fa-arrow-right"></i></a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="text-center">
                <a href="#" class="btn btn-primary">See More</a>
            </div>
        </div>
    </section>
    <!-- Recent Posts End -->
    <!-- Trust Start -->
    <section class="trust">
        <div class="container">
            <div class="row">
                <div class="offset-xl-1 col-xl-6" data-aos="fade-right" data-aos-delay="200" data-aos-duration="800">
                    <div class="title">
                        <h6 class="title-primary">about Tamplate</h6>
                        <h1>a rich featured, epic & premium work.</h1>
                    </div>
                    <p>Suspendisse facilisis commodo lobortis. Nullam mollis lobortis ex vel faucibus. Proin nec viverra
                        turpis. Nulla eget justo scelerisque, pretium purus vel, congue libero. Suspendisse potenti.
                    </p>
                    <h5>Web Design & Development</h5>
                    <ul class="list-unstyled">
                        <li>Web Content</li>
                        <li>Website other</li>
                        <li>Fashion</li>
                        <li>Moblie & Tablette</li>
                    </ul>
                </div>
                <div class="col-xl-5 gallery">
                    <div class="row no-gutters h-100" id="lightgallery">
                        <a href="https://lorempixel.com/600/400/" class="w-50 h-100 gal-img" data-aos="fade-up" data-aos-delay="200" data-aos-duration="400">
                            <img class="img-fluid" src="assets/images/gallery1.png" alt="Gallery Image">
                            <i class="fa fa-caret-right"></i>
                        </a>
                        <a href="https://lorempixel.com/600/400/" class="w-50 h-50 gal-img" data-aos="fade-up" data-aos-delay="400" data-aos-duration="600">
                            <img class="img-fluid" src="assets/images/gallery2.png" alt="Gallery Image">
                            <i class="fa fa-caret-right"></i>
                        </a>
                        <a href="https://lorempixel.com/600/400/" class="w-50 h-50 gal-img gal-img3" data-aos="fade-up" data-aos-delay="0" data-aos-duration="600">
                            <img class="img-fluid" src="assets/images/gallery3.png" alt="Gallery Image">
                            <i class="fa fa-caret-right"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Trust End -->
    <!-- Pricing Start -->
    <section class="pricing-table">
        <div class="container">
            <div class="title text-center">
                <h6 class="title-primary">Our prices</h6>
                <h1 class="title-blue">Price Table List</h1>
            </div>
            <div class="row no-gutters">
                <div class="col-md-4">
                    <div class="single-pricing text-center" data-aos="fade-up" data-aos-delay="0" data-aos-duration="600">
                        <span>Monthly</span>
                        <h2>Starter</h2>
                        <p class="desc">Here goes some description</p>
                        <p class="price">$39.00</p>
                        <p>Create excepteur sint occaecat cupidatat non proident</p>
                        <a href="#" class="btn btn-primary">Buy Now</a>
                        <svg viewBox="0 0 170 193">
                            <path fill-rule="evenodd" fill="rgb(238, 21, 21)" d="M39.000,31.999 C39.000,31.999 -21.000,86.500 9.000,121.999 C39.000,157.500 91.000,128.500 104.000,160.999 C117.000,193.500 141.000,201.000 150.000,183.000 C159.000,165.000 172.000,99.000 167.000,87.000 C162.000,75.000 170.000,63.000 152.000,45.000 C134.000,27.000 128.000,15.999 116.000,11.000 C104.000,6.000 89.000,-0.001 89.000,-0.001 L39.000,31.999 Z" />
                        </svg>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="single-pricing text-center" data-aos="fade-up" data-aos-delay="300" data-aos-duration="600">
                        <span>Monthly</span>
                        <h2>Starter</h2>
                        <p class="desc">Here goes some description</p>
                        <p class="price">$39.00</p>
                        <p>5GB Storage Space</p>
                        <p>20GB Monthly Bandwidth</p>
                        <p>My SQL Databases</p>
                        <p>100 Email Account</p>
                        <a href="#" class="btn btn-primary">Buy Now</a>
                        <svg viewBox="0 0 170 193">
                            <path fill-rule="evenodd" fill="rgb(238, 21, 21)" d="M39.000,31.999 C39.000,31.999 -21.000,86.500 9.000,121.999 C39.000,157.500 91.000,128.500 104.000,160.999 C117.000,193.500 141.000,201.000 150.000,183.000 C159.000,165.000 172.000,99.000 167.000,87.000 C162.000,75.000 170.000,63.000 152.000,45.000 C134.000,27.000 128.000,15.999 116.000,11.000 C104.000,6.000 89.000,-0.001 89.000,-0.001 L39.000,31.999 Z" />
                        </svg>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="single-pricing text-center" data-aos="fade-up" data-aos-delay="600" data-aos-duration="600">
                        <span>Monthly</span>
                        <h2>Starter</h2>
                        <p class="desc">Here goes some description</p>
                        <p class="price">$39.00</p>
                        <p>Create excepteur sint occaecat cupidatat non proident</p>
                        <a href="#" class="btn btn-primary">Buy Now</a>
                        <svg viewBox="0 0 170 193">
                            <path fill-rule="evenodd" fill="rgb(238, 21, 21)" d="M39.000,31.999 C39.000,31.999 -21.000,86.500 9.000,121.999 C39.000,157.500 91.000,128.500 104.000,160.999 C117.000,193.500 141.000,201.000 150.000,183.000 C159.000,165.000 172.000,99.000 167.000,87.000 C162.000,75.000 170.000,63.000 152.000,45.000 C134.000,27.000 128.000,15.999 116.000,11.000 C104.000,6.000 89.000,-0.001 89.000,-0.001 L39.000,31.999 Z" />
                        </svg>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Pricing End -->
    <!-- Testimonial and Clients Start -->
    <section class="testimonial-and-clients">
        <div class="container">
            <div class="testimonials">
                <div class="swiper-container test-slider">
                    <div class="swiper-wrapper">
                        <div class="swiper-slide text-center">
                            <div class="row">
                                <div class="offset-lg-1 col-lg-10">
                                    <div class="test-img" data-aos="fade-up" data-aos-delay="0" data-aos-offset="0"><img src="assets/images/test1.png" alt="Testimonial 1"></div>
                                    <h5 data-aos="fade-up" data-aos-delay="200" data-aos-duration="600" data-aos-offset="0">John</h5>
                                    <span data-aos="fade-up" data-aos-delay="400" data-aos-duration="600" data-aos-offset="0">UI/UX
                                        Designer</span>
                                    <p data-aos="fade-up" data-aos-delay="600" data-aos-duration="600" data-aos-offset="0">Ash's tactics &
                                        books have helped me a lot in my understanding on how social
                                        media
                                        advertising works.I can say that he is one of the best development professionals
                                        i have
                                        dealt with so far. His experience is great & he is such a great & pleasant
                                        person to
                                        work with as he understands what you are</p>
                                </div>
                            </div>
                        </div>
                        <div class="swiper-slide text-center">
                            <div class="row">
                                <div class="offset-lg-1 col-lg-10">
                                    <div class="test-img" data-aos="fade-up" data-aos-delay="0" data-aos-offset="0"><img src="assets/images/test1.png" alt="Testimonial 1"></div>
                                    <h5 data-aos="fade-up" data-aos-delay="200" data-aos-duration="600" data-aos-offset="0">John</h5>
                                    <span data-aos="fade-up" data-aos-delay="400" data-aos-duration="600" data-aos-offset="0">UI/UX
                                        Designer</span>
                                    <p data-aos="fade-up" data-aos-delay="600" data-aos-duration="600" data-aos-offset="0">Ash's tactics &
                                        books have helped me a lot in my understanding on how social
                                        media
                                        advertising works.I can say that he is one of the best development professionals
                                        i have
                                        dealt with so far. His experience is great & he is such a great & pleasant
                                        person to
                                        work with as he understands what you are</p>
                                </div>
                            </div>
                        </div>
                        <div class="swiper-slide text-center">
                            <div class="row">
                                <div class="offset-lg-1 col-lg-10">
                                    <div class="test-img" data-aos="fade-up" data-aos-delay="0" data-aos-offset="0"><img src="assets/images/test1.png" alt="Testimonial 1"></div>
                                    <h5 data-aos="fade-up" data-aos-delay="200" data-aos-duration="600" data-aos-offset="0">John</h5>
                                    <span data-aos="fade-up" data-aos-delay="400" data-aos-duration="600" data-aos-offset="0">UI/UX
                                        Designer</span>
                                    <p data-aos="fade-up" data-aos-delay="600" data-aos-duration="600" data-aos-offset="0">Ash's tactics &
                                        books have helped me a lot in my understanding on how social
                                        media
                                        advertising works.I can say that he is one of the best development professionals
                                        i have
                                        dealt with so far. His experience is great & he is such a great & pleasant
                                        person to
                                        work with as he understands what you are</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="test-pagination"></div>
                </div>
            </div>
            <div class="clients" data-aos="fade-up" data-aos-delay="200" data-aos-duration="600">
                <div class="swiper-container clients-slider">
                    <div class="swiper-wrapper">
                        <div class="swiper-slide">
                            <img src="assets/images/client1.png" alt="Client 1">
                        </div>
                        <div class="swiper-slide">
                            <img src="assets/images/client2.png" alt="Client 2">
                        </div>
                        <div class="swiper-slide">
                            <img src="assets/images/client3.png" alt="Client 3">
                        </div>
                        <div class="swiper-slide">
                            <img src="assets/images/client4.png" alt="Client 4">
                        </div>
                        <div class="swiper-slide">
                            <img src="assets/images/client5.png" alt="Client 5">
                        </div>
                    </div>
                    <div class="test-pagination"></div>
                </div>
            </div>
        </div>
    </section>
    <!-- Testimonial and Clients End -->
    <!-- Call To Action 2 Start -->
    <section class="cta cta2" data-aos="fade-up" data-aos-delay="0">
        <div class="container">
            <div class="cta-content d-xl-flex align-items-center justify-content-around text-center text-xl-left">
                <div class="content" data-aos="fade-right" data-aos-delay="200">
                    <h2>FOR BUILDING THE MODERN WEBSITE</h2>
                    <p>Packed with all the goodies you can get, Kallyas is our flagship premium template.</p>
                </div>
                <div class="subscribe-btn" data-aos="fade-left" data-aos-delay="400" data-aos-offset="0">
                    <a href="#" class="btn btn-primary">Join Newsletter</a>
                </div>
            </div>
        </div>
    </section>
    <!-- Call To Action 2 End -->
    <!-- Footer Start -->
    <footer>
        <!-- Widgets Start -->
        <div class="footer-widgets">
            <div class="container">
                <div class="row">
                    <div class="col-md-6 col-xl-3">
                        <div class="single-widget contact-widget" data-aos="fade-up" data-aos-delay="0">
                            <h6 class="widget-tiltle">&nbsp;</h6>
                            <p>By subscribing to our mailing list you will always be update with the latest news from
                                us.
                            </p>
                            <div class="media">
                                <i class="fa fa-map-marker"></i>
                                <div class="media-body ml-3">
                                    <h6>Address</h6>
                                    Level 13, 2 Elizabeth St,<br>
                                    Melbourne, Victoria 3000 Australia
                                </div>
                            </div>
                            <div class="media">
                                <i class="fa fa-envelope-o"></i>
                                <div class="media-body ml-3">
                                    <h6>Have any questions?</h6>
                                    <a href="mailto:support@steelthemes.com">Support@Steelthemes.com</a>
                                </div>
                            </div>
                            <div class="media">
                                <i class="fa fa-phone"></i>
                                <div class="media-body ml-3">
                                    <h6>Call us & Hire us</h6>
                                    <a href="tel:+610791803458"> +61 (0) 7 9180 3458</a>
                                </div>
                            </div>
                            <div class="media">
                                <i class="fa fa-fax"></i>
                                <div class="media-body ml-3">
                                    <h6>Fax</h6>
                                    <a href="fax:911889047521432">(91) 188904752 1432</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-xl-3">
                        <div class="single-widget twitter-widget" data-aos="fade-up" data-aos-delay="200">
                            <h6 class="widget-tiltle">Fresh Tweets</h6>
                            <div class="media">
                                <i class="fa fa-twitter"></i>
                                <div class="media-body ml-3">
                                    <h6><a href="#">@Themes,</a> Html Version Out Now</h6>
                                    <span>10 Mins Ago</span>
                                </div>
                            </div>
                            <div class="media">
                                <i class="fa fa-twitter"></i>
                                <div class="media-body ml-3">
                                    <h6><a href="#">@Envato,</a> the best selling item of the day!</h6>
                                    <span>20 Mins Ago</span>
                                </div>
                            </div>
                            <div class="media">
                                <i class="fa fa-twitter"></i>
                                <div class="media-body ml-3">
                                    <h6><a href="#">@Collis,</a> We Planned to Update the Enavto Author Payment Method
                                        Soon!</h6>
                                    <span>10 Mins Ago</span>
                                </div>
                            </div>
                            <div class="media">
                                <i class="fa fa-twitter"></i>
                                <div class="media-body ml-3">
                                    <h6><a href="#">@SteelThemes,</a> Html Version Out Now</h6>
                                    <span>15 Mins Ago</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-xl-3">
                        <div class="single-widget recent-post-widget" data-aos="fade-up" data-aos-delay="400">
                            <h6 class="widget-tiltle">Latest Updates</h6>
                            <div class="media">
                                <a class="rcnt-img" href="#"><img src="assets/images/rcnt-post1.png" alt="Recent Post"></a>
                                <div class="media-body ml-3">
                                    <h6><a href="#">An engaging</a></h6>
                                    <p><i class="fa fa-user"></i>Mano <i class="fa fa-eye"></i> 202 Views</p>
                                </div>
                            </div>
                            <div class="media">
                                <a class="rcnt-img" href="#"><img src="assets/images/rcnt-post2.png" alt="Recent Post"></a>
                                <div class="media-body ml-3">
                                    <h6><a href="#">Statistics and analysis. The key to succes.</a></h6>
                                    <p><i class="fa fa-user"></i>Rosias <i class="fa fa-eye"></i> 20 Views</p>
                                </div>
                            </div>
                            <div class="media">
                                <a class="rcnt-img" href="#"><img src="assets/images/rcnt-post3.png" alt="Recent Post"></a>
                                <div class="media-body ml-3">
                                    <h6><a href="#">Envato Meeting turns into a photoshooting.</a></h6>
                                    <p><i class="fa fa-user"></i>Kien <i class="fa fa-eye"></i> 74 Views</p>
                                </div>
                            </div>
                            <div class="media">
                                <a class="rcnt-img" href="#"><img src="assets/images/rcnt-post4.png" alt="Recent Post"></a>
                                <div class="media-body ml-3">
                                    <h6><a href="#">An engaging embedded the video posts</a></h6>
                                    <p><i class="fa fa-user"></i>Robert <i class="fa fa-eye"></i> 48 Views</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-xl-3">
                        <div class="single-widget tags-widget" data-aos="fade-up" data-aos-delay="800">
                            <h6 class="widget-tiltle">Popular Tags</h6>
                            <a href="#">Amazing</a>
                            <a href="#">Design</a>
                            <a href="#">Photoshop</a>
                            <a href="#">Art</a>
                            <a href="#">Wordpress</a>
                            <a href="#">jQuery</a>
                        </div>
                        <div class="single-widget subscribe-widget" data-aos="fade-up" data-aos-delay="800">
                            <h6 class="widget-tiltle">Subscribe us</h6>
                            <p>Sign up for our mailing list to get latest updates and offers</p>
                            <form class="" method="get">
                                <div class="input-group">
                                    <input class="field form-control" name="subscribe" type="email" placeholder="Email Address">
                                    <span class="input-group-btn">
                                        <button type="submit" name="submit-mail"><i class="fa fa-check"></i></button>
                                    </span>
                                </div>
                            </form>
                            <p>We respect your privacy</p>
                            <ul class="nav social-nav">
                                <li><a href="https://www.facebook.com/fh5co" target="_blank"><i class="fa fa-facebook"></i></a></li>
                                <li><a href="#"><i class="fa fa-google-plus"></i></a></li>
                                <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                                <li><a href="#"><i class="fa fa-google-plus"></i></a></li>
                                <li><a href="#"><i class="fa fa-linkedin"></i></a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Widgets End -->
        <!-- Foot Note Start -->
        <div class="foot-note">
            <div class="container">
                <div class="footer-content text-center text-lg-left d-lg-flex justify-content-between align-items-center">
                    <p class="mb-0" data-aos="fade-right" data-aos-offset="0">&copy; 2019 All Rights Reserved. Design by <a href="https://freehtml5.co/multipurpose" target="_blank" class="fh5-link">FreeHTML5.co</a>.</p>
                    <p class="mb-0" data-aos="fade-left" data-aos-offset="0"><a href="#">Terms Of Use</a><a href="#">Privacy & Security
                            Statement</a></p>
                </div>
            </div>
        </div>
        <!-- Foot Note End -->
    </footer>
    <!-- Footer Endt -->
    <!--jQuery-->
    <script src="assets/js/jquery-3.3.1.js"></script>
    <!--Plugins-->
    <script src="assets/js/bootstrap.bundle.js"></script>
    <script src="assets/js/loaders.css.js"></script>
    <script src="assets/js/aos.js"></script>
    <script src="assets/js/swiper.min.js"></script>
    <script src="assets/js/lightgallery-all.min.js"></script>
    <!--Template Script-->
    <script src="assets/js/main.js"></script>
</body>

</html>