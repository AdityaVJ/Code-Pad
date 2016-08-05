<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="robots" content="all,follow">
    <meta name="googlebot" content="index,follow,snippet,archive">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Code Pad | Compiler</title>

    <meta name="keywords" content="">

    <link href='http://fonts.googleapis.com/css?family=Roboto:400,100,100italic,300,300italic,500,700,800' rel='stylesheet' type='text/css'>

    <!-- Bootstrap and Font Awesome css -->
    <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap.min.css">

    <!-- Css animations  -->
    <link href="{{!! assest('frontend/css/animate.css') !!}" rel="stylesheet">

    <!-- Theme stylesheet, if possible do not edit this stylesheet -->
    <link href="css/style.default.css" rel="stylesheet" id="theme-stylesheet">

    <!-- Custom stylesheet - for your changes -->
    <link href="css/custom.css" rel="stylesheet">
    <link rel="stylesheet" href="css/login.css">

    <!-- Responsivity for older IE -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
<![endif]-->

    <!-- Favicon and apple touch icons-->
    <link rel="shortcut icon" href="img/favicon.ico" type="image/x-icon" />
    <link rel="apple-touch-icon" href="img/apple-touch-icon.png" />
    <link rel="apple-touch-icon" sizes="57x57" href="{{ URL::asset('img/apple-touch-icon-57x57.png') }}" />
    <link rel="apple-touch-icon" sizes="72x72" href="{{ URL::asset('img/apple-touch-icon-72x72.png') }}" />
    <link rel="apple-touch-icon" sizes="76x76" href="{{ URL::asset('img/apple-touch-icon-76x76.png') }}" />
    <link rel="apple-touch-icon" sizes="114x114" href="{{ URL::asset('img/apple-touch-icon-114x114.png') }}" />
    <link rel="apple-touch-icon" sizes="120x120" href="{{ URL::asset('img/apple-touch-icon-120x120.png') }}" />
    <link rel="apple-touch-icon" sizes="144x144" href="{{ URL::asset('img/apple-touch-icon-144x144.png') }}" />
    <link rel="apple-touch-icon" sizes="152x152" href="{{ URL::asset('img/apple-touch-icon-152x152.png') }}" />
    <!-- owl carousel css -->

    <link href="css/owl.carousel.css" rel="stylesheet">
    <link href="css/owl.theme.css" rel="stylesheet">
</head>

<body>

    <div id="all">

        <header>

            <!-- *** NAVBAR ***
    _________________________________________________________ -->

            <div class="navbar-affixed-top" data-spy="affix" data-offset-top="200">

                <div class="navbar navbar-default yamm" role="navigation" id="navbar">

                    <div class="container">
                        <div class="navbar-header">

                            <a class="navbar-brand home" href="index.html">
                                <img src="img/logo.png" alt="Universal logo" class="hidden-xs hidden-sm">
                                <img src="{!! asset('../frontend/img/logo-small.png') !!}" alt="Universal logo" class="visible-xs visible-sm"><span class="sr-only">Universal - go to homepage</span>
                            </a>
                            <div class="navbar-buttons">
                                <button type="button" class="navbar-toggle btn-template-main" data-toggle="collapse" data-target="#navigation">
                                    <span class="sr-only">Toggle navigation</span>
                                    <i class="fa fa-align-justify"></i>
                                </button>
                            </div>
                        </div>
                        <!--/.navbar-header -->

                        <div class="navbar-collapse collapse" id="navigation">

                            <ul class="nav navbar-nav navbar-right">
                                <li class="">
                                    <a href="#"> Home </a>
                                </li>
                                <li class="">
                                    <a href="#"> Dashboard </a>
                                </li>
                                <li class="">
                                    <a href="#"> Services </a>
                                </li>
                                <li class="">
                                    <a href="#"> Blog </a>
                                </li>
                                <li class="">
                                    <a href="#"> Contact </a>
                                </li>
                                <li class="">
                                    <a id="login-btn" href="login.html"> Login </a>
                                </li>
                            </ul>

                        </div>

                        <!--/.nav-collapse -->
                    </div>
                </div>
                <!-- /#navbar -->
            </div>
            <!-- *** NAVBAR END *** -->
        </header>


        <section class="no-mb">
            <!-- *** HOMEPAGE CAROUSEL *** -->
            <div class="home-carousel">

                <div class="dark-mask"></div>

                <div class="container">
                    <div class="homepage owl-carousel">
                        <div class="item">
                            <div class="row">
                                <div class="col-sm-7">
                                    <img class="img-responsive" src="img/template-easy-code.png" alt="">
                                </div>
                                <div class="col-sm-5">
                                   <center>
                                    <h1>
                                      CODE <br>
                                      COMPETE <br>
                                      COLLABORATE
                                    </h1>
                                    <ul class="list-style-none">
                                        <li>Code Battles</li>
                                        <li>Submit Assignments</li>
                                        <li>All in one place</li>
                                    </ul>
                                    </center>
                                </div>
                            </div>
                        </div>
                        <div class="item">
                            <div class="row">
                                <div class="col-sm-7">
                                    <img class="img-responsive" src="img/template-easy-code.png" alt="">
                                </div>
                                <div class="col-sm-5">
                                   <center>
                                    <h1>
                                      CODE <br>
                                      COMPETE <br>
                                      COLLABORATE
                                    </h1>
                                    <ul class="list-style-none">
                                        <li>Code Battles</li>
                                        <li>Submit Assignments</li>
                                        <li>All in one place</li>
                                    </ul>
                                    </center>
                                </div>
                            </div>
                        </div>
                        <div class="item">
                            <div class="row">
                                <div class="col-sm-7">
                                    <img class="img-responsive" src="img/template-easy-code.png" alt="">
                                </div>
                                <div class="col-sm-5">
                                   <center>
                                    <h1>
                                      CODE <br>
                                      COMPETE <br>
                                      COLLABORATE
                                    </h1>
                                    <ul class="list-style-none">
                                        <li>Code Battles</li>
                                        <li>Submit Assignments</li>
                                        <li>All in one place</li>
                                    </ul>
                                    </center>
                                </div>
                            </div>
                        </div>

                    </div>
                    <!-- /.project owl-slider -->
                </div>
            </div>

            <!-- *** HOMEPAGE CAROUSEL END *** -->
        </section>

        <section class="home bar color-white text-center">
            <div class="dark-mask"></div>
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <h1> &lt;&#47;i&gt;  Can Code</h1>

                        <p class="lead">Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas.</p>

                    </div>
                </div>
            </div>
        </section>

        <section class="bar background-white">
            <div class="container">
                <div class="col-md-12">


                    <div class="row">
                        <div class="col-xs-6 col-sm-3">
                            <div class="home box-simple">
                              <div class="border">
                                <div class="icon">
                                    <i class="fa fa-globe fa-2x"></i>
                                </div>
                              </div>
                                <h3>Research</h3>
                                <p>Fifth abundantly made Give sixth hath. Cattle creature i be don't them behold green moved fowl Moved life us beast good yielding. Have bring.</p>
                            </div>
                        </div>
                        <div class="col-xs-6 col-sm-3">
                            <div class="home box-simple">
                              <div class="border">
                                <div class="icon">
                                    <i class="fa fa-laptop fa-2x"></i>
                                </div>
                              </div>
                                <h3>Code</h3>
                                <p>Fifth abundantly made Give sixth hath. Cattle creature i be don't them behold green moved fowl Moved life us beast good yielding. Have bring.</p>
                            </div>
                        </div>
                        <div class="col-xs-6 col-sm-3">
                            <div class="home box-simple">
                              <div class="border">
                                <div class="icon">
                                    <i class="fa fa-comments-o fa-2x"></i>
                                </div>
                              </div>
                                <h3>Coordinate</h3>
                                <p>Fifth abundantly made Give sixth hath. Cattle creature i be don't them behold green moved fowl Moved life us beast good yielding. Have bring.</p>
                            </div>
                        </div>
                        <div class="col-xs-6 col-sm-3">
                            <div class="home box-simple">
                              <div class="border">
                                <div class="icon">
                                    <i class="fa fa-cogs fa-2x"></i>
                                </div>
                              </div>
                                <h3>Test</h3>
                                <p>Fifth abundantly made Give sixth hath. Cattle creature i be don't them behold green moved fowl Moved life us beast good yielding. Have bring.</p>
                            </div>
                        </div>

                    </div>

                </div>
            </div>
        </section>

        <section class="bar background-white no-mb">
            <div class="container">

                <div class="col-md-12  text-center">
                    <div class=" text-center">
                        <h3>Let them know why youre the best!</h3>
                    </div>

                    <p class="lead">Share it. Enjoy It. <span class="accent"> Start Here!</span>
                    </p>


                    <div class="row">
                        <div class="col-md-3 col-sm-6">
                            <div class="box-image-text blog">
                                <div class="top">
                                    <div class="image">
                                        <img src="img/portfolio-4.jpg" alt="" class="img-responsive">
                                    </div>
                                    <div class="bg"></div>
                                    <div class="text">
                                        <p class="buttons">
                                            <a href="blog-post.html" class="btn btn-template-transparent-primary"><i class="fa fa-plus-circle"></i></a>
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <!-- /.box-image-text -->

                        </div>
                        <div class="col-md-3 col-sm-6">
                            <div class="box-image-text blog">
                                <div class="top">
                                    <div class="image">
                                        <img src="img/portfolio-4.jpg" alt="" class="img-responsive">
                                    </div>
                                    <div class="bg"></div>
                                    <div class="text">
                                        <p class="buttons">
                                            <a href="blog-post.html" class="btn btn-template-transparent-primary"><i class="fa fa-plus-circle"></i></a>
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <!-- /.box-image-text -->

                        </div>
                        <div class="col-md-3 col-sm-6">
                            <div class="box-image-text blog">
                                <div class="top">
                                    <div class="image">
                                        <img src="img/portfolio-4.jpg" alt="" class="img-responsive">
                                    </div>
                                    <div class="bg"></div>
                                    <div class="text">
                                        <p class="buttons">
                                            <a href="blog-post.html" class="btn btn-template-transparent-primary"><i class="fa fa-plus-circle"></i></a>
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <!-- /.box-image-text -->

                        </div>
                        <div class="col-md-3 col-sm-6">
                            <div class="box-image-text blog">
                                <div class="top">
                                    <div class="image">
                                        <img src="img/portfolio-4.jpg" alt="" class="img-responsive">
                                    </div>
                                    <div class="bg"></div>
                                    <div class="text">
                                        <p class="buttons">
                                            <a href="blog-post.html" class="btn btn-template-transparent-primary"><i class="fa fa-plus-circle"></i></a>
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <!-- /.box-image-text -->

                        </div>


                    </div>
                    <!-- /.row -->

                    <!-- *** BLOG HOMEPAGE END *** -->

                </div>

            </div>
            <!-- /.container -->
        </section>
        <!-- /.bar -->

          <section class="no-mb">
            <div class='container-fluid team-wrapper'>
              <div class="row">
                  <div class="col-xs-6 col-sm-3">
                      <div class="team-member" data-animate="fadeInDown">
                          <div class="image">
                              <a href="team-member.html">
                                  <img src="img/person.jpg" alt="" class="img-responsive img-circle">
                              </a>
                          </div>
                          <h3><a href="team-member.html">Team Member</a></h3>
                          <p class="role">Founder</p>
                      </div>
                      <!-- /.team-member -->
                  </div>
                  <div class="col-xs-6 col-sm-3" data-animate="fadeInDown">
                      <div class="team-member">
                          <div class="image">
                              <a href="team-member.html">
                                  <img src="img/person.jpg" alt="" class="img-responsive img-circle">
                              </a>
                          </div>
                          <h3><a href="team-member.html">Team Member</a></h3>
                          <p class="role">CTO</p>
                      </div>
                      <!-- /.team-member -->
                  </div>
                  <div class="col-xs-6 col-sm-3" data-animate="fadeInDown">
                      <div class="team-member">
                          <div class="image">
                              <a href="team-member.html">
                                  <img src="img/person.jpg" alt="" class="img-responsive img-circle">
                              </a>
                          </div>
                          <h3><a href="team-member.html">Team Member</a></h3>
                          <p class="role">Team Leader</p>
                      </div>
                      <!-- /.team-member -->
                  </div>
                  <div class="col-xs-6 col-sm-3" data-animate="fadeInDown">
                      <div class="team-member">
                          <div class="image">
                              <a href="team-member.html">
                                  <img src="img/person.jpg" alt="" class="img-responsive img-circle">
                              </a>
                          </div>
                          <h3><a href="team-member.html">Team Member</a></h3>
                          <p class="role">Lead Developer</p>
                      </div>
                      <!-- /.team-member -->
                  </div>
              </div>
              <!-- /.row -->
            </div>
          </section>

          <section class="home bar no-mb color-white">
              <div class="container">
                  <div class="row">
                      <div class="col-xs-12 col-sm-6">
                        <div class="embed-responsive embed-responsive-16by9">
                          <iframe src="https://www.youtube.com/embed/rwy50QEpAsA"> </iframe>
                        </div>
                      </div>
                      <div class="col-xs-12 col-sm-6">
                          <h2>What Are You Waiting For?</h2>
                          <h2>Start It Today!</h2>

                          <p class="lead">
                            Explore the best in you, coz the time has arrivedto lift up yourselfat the epitome of ambitions. <br>
                            Happy Coding! <br><br>
                            <button type="button" class="btn btn-template-transparent-primary">Find Out More</button>
                          </p>

                      </div>
                  </div>
              </div>
          </section>

          <section class="no-mb color-white">
              <div class="container">
                  <div class="row">
                      <div class="col-xs-12 col-sm-4">
                        <h2>EXTRAS</h2>

                        <p class="lead">
                          Lorem ipsum dolor sit amet, consectetur adipisicing elit. Soluta ex accusamus qui ipsa nisi eligendi aliquam omnis voluptatem veniam vero deserunt amet, incidunt harum debitis ullam ratione necessitatibus dignissimos minus.
                        </p>
                      </div>
                      <div class="col-sm-8">

                          <h2>Events</h2>

                          <div class="photostream">
                            <div class="row">
                              <div class="col-xs-3 col-sm-3">
                                  <a href="#">
                                    <img src="img/detailsquare.jpg" class="img-responsive" alt="#">

                                  </a>
                              </div>
                              <div  class="col-xs-3 col-sm-3">
                                  <a href="#">
                                      <img src="img/detailsquare.jpg" class="img-responsive" alt="#">
                                  </a>
                              </div>
                              <div  class="col-xs-3 col-sm-3">
                                  <a href="#">
                                      <img src="img/detailsquare.jpg" class="img-responsive" alt="#">
                                  </a>
                              </div>
                              <div class="col-xs-3 col-sm-3">
                                  <a href="#">
                                      <img src="img/detailsquare.jpg" class="img-responsive" alt="#">
                                  </a>
                              </div>

                            </div>
                          </div>

                      </div>
                      <!-- /.col-md-3 -->
                  </div>
              </div>
          </section>
        <!-- *** FOOTER ***
_________________________________________________________ -->

        <footer id="footer">
            <div class="container">

                <div class="col-sm-4">

                    <h4>Links</h4>

                    <div class="blog-entries">
                        <div class="item same-height-row clearfix">
                            <div class="image same-height-always">
                                <a href="#">
                                    <img class="img-responsive" src="img/detailsquare.jpg" alt="">
                                </a>
                            </div>
                            <div class="name same-height-always">
                                <h5><a href="#">link</a></h5>
                            </div>
                        </div>

                        <div class="item same-height-row clearfix">
                            <div class="image same-height-always">
                                <a href="#">
                                    <img class="img-responsive" src="img/detailsquare.jpg" alt="">
                                </a>
                            </div>
                            <div class="name same-height-always">
                                <h5><a href="#">new link</a></h5>
                            </div>
                        </div>

                        <div class="item same-height-row clearfix">
                            <div class="image same-height-always">
                                <a href="#">
                                    <img class="img-responsive" src="img/detailsquare.jpg" alt="">
                                </a>
                            </div>
                            <div class="name same-height-always">
                                <h5><a href="#">another link </a></h5>
                            </div>
                        </div>
                    </div>

                    <hr class="hidden-md hidden-lg hidden-sm">

                </div>
                <!-- /.col-md-3 -->

                <div class="col-sm-4">

                    <h4>Contact Us</h4>

                    <p><strong>JSS Academy Of Technical Education</strong>
                        <br><br>
                        <strong>Address: </strong>
                        <br> C-20/1
                        <br>Sector 62, Noida
                        <br>Uttar Pradesh
                        <br>201301
                        <br>
                        India
                        <br><br>
                        <strong>Phone:</strong> 0120 240 0104
                    </p>

                    <hr class="hidden-md hidden-lg hidden-sm">

                </div>
                <!-- /.col-md-3 -->

                <div class="col-sm-4">

                  <h4>Social Media</h4>
                  <br>
                  <p>Connect with us here.</p>
                  <br>
                  <div class="social">
                      <a href="#" class="external youtube" data-animate-hover="pulse" style="opacity: 1;"><i class="fa fa-youtube"></i></a>
                      <a href="#" class="external facebook" data-animate-hover="pulse" style="opacity: 1;"><i class="fa fa-facebook"></i></a>
                      <a href="#" class="external gplus" data-animate-hover="pulse" style="opacity: 1;"><i class="fa fa-google-plus"></i></a>
                      <a href="#" class="external twitter" data-animate-hover="pulse"><i class="fa fa-twitter"></i></a>
                      <a href="#" class="external instagram" data-animate-hover="pulse"><i class="fa fa-instagram"></i></a>
                  </div>
                  <br><br>
                  <p> Copyright &copy; 2015 <strong><a href="http://www.hackncs.com">Nibble Computer Society</a></strong></p>
                </div>
                <!-- /.col-md-3 -->
            </div>
            <!-- /.container -->
        </footer>
        <!-- /#footer -->

        <!-- *** FOOTER END *** -->


    </div>
    <!-- /#all -->

    <!-- #### JAVASCRIPT FILES ### -->

    <script src="https://code.jquery.com/jquery-2.2.4.min.js"></script>
    <script>
        window.jQuery || document.write('<script src="js/jquery-1.11.0.min.js"><\/script>')
    </script>
    <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/js/bootstrap.min.js"></script>
    <script src="js/jquery.cookie.js"></script>
    <script src="js/waypoints.min.js"></script>
    <script src="js/jquery.counterup.min.js"></script>
    <script src="js/jquery.parallax-1.1.3.js"></script>
    <script src="js/front.js"></script>
    <script src="js/login.js"></script>


    <!-- owl carousel -->
    <script src="js/owl.carousel.min.js"></script>



</body>

</html>
