<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Ecobizz - Login Page</title>

    <!-- Bootstrap Core CSS -->
    <link href="css/bootstrap.css" rel="stylesheet">

     <!-- Plugin CSS -->
    <link href="css/magnific-popup.css" rel="stylesheet">

    <!-- Theme CSS -->
    <link rel="stylesheet" type="text/css" href="css/creative.css">
    <link rel="stylesheet" type="text/css" href="css/style.css">
</head>
<body>

    <nav id="mainNav" class="navbar navbar-default navbar-fixed-top">
        <div class="container-fluid">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <a class="navbar-brand page-scroll" href="/">
                    <img src="assets/ecobiz_putih.png" width="35%">
                </a>
            </div>

            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav navbar-right">
                    <li>
                        <a class="page-scroll" href="#about">Forum</a>
                    </li>
                    <li>
                        <a class="page-scroll" href="#services">Apa itu Ecobiz?</a>
                    </li>
                    <li>
                        <a href="/login">
                            <button class="button1" style="float:right">LOGIN</button>
                        </a>
                    </li>
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container-fluid -->
    </nav>

    <header>
        <div class="header-content">
            <div class="header-content-inner">
                <p1>Get in to Your Account </p1> </br> </br> </br>
                <form action='/login' method='post'>
                    <input type="text" id="fname" name="firstname" placeholder="E-mail"> </br>
                    <input type="text" id="paswod" name="password" placeholder="Password"></br></br>
                    <input type="submit" value="Login">
                </form>
                </br></br></br></br>
                <p1>Don't have account yet?
                    <a class="linkregister" href="/register">
                        Register </br>
                    </a>
                </p1>

            </div>
        </div>
    </header>

    <section class="section4">
        <img src = "assets/ecobiz_putih.png" height="40" vspace="30px" style="margin-top: 50px">
        <br>
        <button><img src="assets/fb.png" height="25"></button>
        <button><img src="assets/twitter.png" height="25"></button>
        <button><img src="assets/linkedin.png" height="25"></button>
        <button><img src="assets/gplus.png" height="25"></button>
        <br>
        <div class = "container3">
            <div id="footer-sect">Site Map
                <br>
                <a href="">Home</a><br>
                <a href="">Tentang</a><br>
                <a href="">Forum</a><br>
                <a href="">Daftar</a><br>
                <a href="">Login</a>
            </div>
            <div id="footer-sect-center">Kontak
                <br>
                <div class="footer">
                    Ecobiz KUKM Jawa Barat<br>
                    Jalan Ganesha No. 12<br>
                    Bandung, Jawa Barat<br>
                    40135<br>
                    ☎ 022 - 11111
                </div>
            </div>
            <div id="footer-sect">Fitur Utama
                <br>
                <div class="footer">
                    Profil Pelaku Bisnis<br>
                    Interaksi Ekosistem Bisnis<br>
                    Forum<br>
                    Menyerupai Facebook<br>
                    & Kaskus
                </div>
            </div>
        </div>
        <div style="clear: both;">
        <br><br>
        Copyright © 2017 Ecobiz KUKM Jabar
        </div>
    </section>



</body>
</html>
