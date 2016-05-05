<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
        <?php
        $cs = Yii::app()->clientScript;
        $cs->scriptMap = array(
            'jquery.js' => Yii::app()->baseUrl . '/bootstrap/frontend/js/jquery.min.js',
        );
        $cs->registerCoreScript('jquery');
        $cs->coreScriptPosition = CClientScript::POS_HEAD;

        $module = '';
        if (!empty(Yii::app()->controller->module->id)) {
            $module = Yii::app()->controller->module->id;
        }

        $controller = Yii::app()->controller->id;
        $action = Yii::app()->controller->action->id;
        ?>

        <title><?php echo CHtml::encode($this->pageTitle); ?></title>

        <!-- Favicon -->
        <link rel="icon" type="image/png" sizes="16x16" href="<?php echo Yii::app()->baseUrl; ?>/bootstrap/frontend/images/favicon-16x16.png">

        <!-- Google fonts - witch you want to use - (rest you can just remove) -->
        <link href='http://fonts.googleapis.com/css?family=Roboto:400,100,100italic,300,500,400italic,500italic,700,900' rel='stylesheet' type='text/css'>

        <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
              <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
              <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->

        <!-- Bootstrap -->
        <link href="<?php echo Yii::app()->baseUrl; ?>/bootstrap/frontend/css/bootstrap.min.css" rel="stylesheet">

        <!-- Custom Stylesheet -->
        <link rel="stylesheet" media="screen" href="<?php echo Yii::app()->baseUrl; ?>/bootstrap/frontend/css/style.css" type="text/css" />
        <link rel="stylesheet" media="screen" href="<?php echo Yii::app()->baseUrl; ?>/bootstrap/frontend/css/reset.css" type="text/css" />
        <link rel="stylesheet" href="<?php echo Yii::app()->baseUrl; ?>/bootstrap/frontend/css/font-awesome/css/font-awesome.min.css">
        <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->baseUrl; ?>/bootstrap/frontend/css/simple-line-icons.css"/>
        <link rel="stylesheet" href="<?php echo Yii::app()->baseUrl; ?>/bootstrap/frontend/css/et-line-font/et-line-font.css">

        <!-- Responsive Devices Styles -->
        <link rel="stylesheet" media="screen" href="<?php echo Yii::app()->baseUrl; ?>/bootstrap/frontend/css/responsive-leyouts.css" type="text/css" />

        <!-- Yamm Mega Menu -->
        <link href="<?php echo Yii::app()->baseUrl; ?>/bootstrap/frontend/js/yamm/yamm.css" rel="stylesheet">
        <link href="<?php echo Yii::app()->baseUrl; ?>/bootstrap/frontend/js/yamm/menu.css" rel="stylesheet">

        <!-- Base MasterSlider style sheet -->
        <link rel="stylesheet" href="<?php echo Yii::app()->baseUrl; ?>/bootstrap/frontend/js/masterslider/style/masterslider.css" />
        <link rel="stylesheet" href="<?php echo Yii::app()->baseUrl; ?>/bootstrap/frontend/js/masterslider/skins/default/style.css" />
        <link rel="stylesheet" href="<?php echo Yii::app()->baseUrl; ?>/bootstrap/frontend/js/masterslider/style/style.css" />

        <!-- load css for cubeportfolio -->
        <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->baseUrl; ?>/bootstrap/frontend/js/cubeportfolio/css/cubeportfolio.min.css">

        <!-- Animations -->
        <link href="<?php echo Yii::app()->baseUrl; ?>/bootstrap/frontend/js/animations/css/animations.min.css" rel="stylesheet" type="text/css" media="all" />       

        <!-- forms -->
        <link rel="stylesheet" href="<?php echo Yii::app()->baseUrl; ?>/bootstrap/frontend/js/form/css/sky-forms.css" type="text/css" media="all">

        <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->baseUrl; ?>/bootstrap/frontend/css/custom.css">

    </head>

    <body>
        <div class="site-wrapper"> 
            <!-- topnav -->
            <div class="col-topbar black-bg">
                <div class="container">
                    <div class="col-md-4 nopadding">
                        <ul class="social-icons style-two">
                            <li class="left-padd0"><a href="#"><i class="fa fa-facebook"></i></a></li>
                            <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                            <li><a href="#"><i class="fa fa-google-plus"></i></a></li>
                            <li><a href="#"><i class="fa fa-linkedin"></i></a></li>
                        </ul>
                    </div>
                    <div class="col-md-8 nopadding">
                        <ul class="col-top-menu">
                            <?php if (Yii::app()->user->isGuest) { ?>
                                <li><a href="/log-in"><i class="fa fa-lock"></i> Login</a></li>
                                <li><a href="/register"><i class="fa fa-user"></i> Register</a></li>
                            <?php } else { ?>
                                <!-- Messages: style can be found in dropdown.less-->
                                <li class="dropdown messages-menu">
                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                        <i class="fa fa-envelope-o"></i>
                                    </a>
                                    <ul class="dropdown-menu">
                                        <li class="header-messages">Messages</li>
                                        <li>
                                            <!-- inner menu: contains the actual data -->
                                            <ul class="menu">
                                                <li><!-- start message -->
                                                    <a href="#">
                                                        <div class="pull-left">
                                                            <img alt="" class="img-circle" src="https://www.york.ac.uk/media/it-services/images/icons/64x64/user.png">
                                                        </div>
                                                        <h4>
                                                            John Kim
                                                            <small><i class="fa fa-clock-o"></i> 5 mins</small>
                                                        </h4>
                                                        <p>Why not buy a new awesome theme?</p>
                                                    </a>
                                                </li><!-- end message -->
                                                <li>
                                                    <a href="#">
                                                        <div class="pull-left">
                                                            <img alt="" class="img-circle" src="https://www.york.ac.uk/media/it-services/images/icons/64x64/user.png">
                                                        </div>
                                                        <h4>
                                                            Shre Kim
                                                            <small><i class="fa fa-clock-o"></i> 2 hours</small>
                                                        </h4>
                                                        <p>Why not buy a new awesome theme?</p>
                                                    </a>
                                                </li>
                                                <li>
                                                    <a href="#">
                                                        <div class="pull-left">
                                                            <img alt="" class="img-circle" src="https://www.york.ac.uk/media/it-services/images/icons/64x64/user.png">
                                                        </div>
                                                        <h4>
                                                            Hounson
                                                            <small><i class="fa fa-clock-o"></i> Today</small>
                                                        </h4>
                                                        <p>Why not buy a new awesome theme?</p>
                                                    </a>
                                                </li>
                                                <li>
                                                    <a href="#">
                                                        <div class="pull-left">
                                                            <img alt="" class="img-circle" src="https://www.york.ac.uk/media/it-services/images/icons/64x64/user.png">
                                                        </div>
                                                        <h4>
                                                            Johnson
                                                            <small><i class="fa fa-clock-o"></i> Yesterday</small>
                                                        </h4>
                                                        <p>Why not buy a new awesome theme?</p>
                                                    </a>
                                                </li>
                                                <li>
                                                    <a href="#">
                                                        <div class="pull-left">
                                                            <img alt="" class="img-circle" src="https://www.york.ac.uk/media/it-services/images/icons/64x64/user.png">
                                                        </div>
                                                        <h4>
                                                            Sukan
                                                            <small><i class="fa fa-clock-o"></i> 2 days</small>
                                                        </h4>
                                                        <p>Why not buy a new awesome theme?</p>
                                                    </a>
                                                </li>
                                            </ul>
                                        </li>
                                        <li class="footer-messages"><a href="#">See All Messages</a></li>
                                    </ul>
                                </li>
    <!--                                <li><a href="/dashboard"><i class="fa fa-lock"></i> Dashboard</a></li>
                                <li><a href="/log-out"><i class="fa fa-user"></i> Logout</a></li>-->
                            <?php } ?>
                            <li><a href="/live-chat"><i class="fa fa-comments"></i> Live Chat</a></li>
                            <li><a href="mailto:support@freelancer.com"><i class="fa fa-envelope"></i> E-mail Us</a></li>
<!--                            <li><a href="tel:+1234567890"><i class="fa fa-phone"></i> (123) 456 7890</a></li>-->
                        </ul>
                    </div>
                </div>
            </div>
            <!-- topnav end -->

            <header class="header whitebg headr-style-1">
                <div class="container"> 
                    <!-- Menu -->
                    <div class="navbar yamm navbar-default">
                        <div class="container">
                            <div class="navbar-header">
                                <button type="button" data-toggle="collapse" data-target="#navbar-collapse-1" class="navbar-toggle"><span class="icon-bar"></span><span class="icon-bar"></span><span class="icon-bar"></span></button>
                                <a href="/" class="navbar-brand logo"></a> </div>
                            <div id="navbar-collapse-1" class="navbar-collapse collapse pull-right">
                                <nav>
                                    <ul class="nav navbar-nav">
                                        <!-- Classic list -->
                                        <li class="dropdown yamm-fw"><a href="/">Home</a></li>
                                        <?php if (Yii::app()->user->isGuest) { ?>
                                            <li class="dropdown yamm-fw"><a href="/about">About</a></li>
                                            <li class="dropdown yamm-fw"><a href="/how-it-works">How it Works</a></li>
                                        <?php } ?>
                                        <!--                                        <li class="dropdown yamm-fw"><a href="/blog">Blog</a></li>-->
                                        <?php if (Yii::app()->user->isGuest) { ?>
                                            <!--li class="dropdown yamm-fw"><a href="/post-a-project">Post a Project</a></li-->
                                        <?php } else { ?>
                                            <li class="dropdown">
                                                <a href="javascript:void(0);" class="dropdown-toggle">Find Work <i class="fa fa-angle-down"></i></a>
                                                <ul role="menu" class="dropdown-menu right-margin">
                                                    <li><a href="/projects-with-my-skills"> Projects with My Skills</a> </li>
                                                    <li><a href="javascript:void(0);"> Browse Categories</a> </li>
                                                    <li><a href="javascript:void(0);"> Bookmarked Projects</a> </li>
                                                    <li><a href="javascript:void(0);"> Local Jobs</a> </li>
                                                </ul>
                                            </li>
                                            <li class="dropdown">
                                                <a href="javascript:void(0);" class="dropdown-toggle">My Projects <i class="fa fa-angle-down"></i></a>
                                                <ul role="menu" class="dropdown-menu right-margin">
                                                    <li><a href="/my-projects"> My Projects</a> </li>
                                                    <li><a href="/inbox"> Inbox</a> </li>
                                                    <li><a href="/feedback"> Feedback</a> </li>
                                                </ul>
                                            </li>
                                            <li class="dropdown">
                                                <a href="/dashboard" class="dropdown-toggle">My Account <i class="fa fa-angle-down"></i></a>
                                                <ul role="menu" class="dropdown-menu right-margin">
                                                    <li><a href="/profile"> Profile</a> </li>
                                                    <li><a href="/membership"> Membership</a> </li>
                                                    <li><a href="/settings"> Settings</a> </li>
                                                    <li><a href="/post-a-project"> Start a Project</a> </li>
                                                    <li><a href="/log-out"> Log Out</a> </li>
                                                </ul>
                                            </li>
                                        <?php } ?>
                                        <?php if (Yii::app()->user->isGuest) { ?>
                                            <li class="dropdown yamm-fw"><a href="/contact">Contact</a></li>
                                        <?php } ?>

                                        <li>                                            
                                            <div class="input-group input-group-lg searchbox">
                                                <input type="email" placeholder="Enter your keyword..." class="form-control one required email" name="form-email" aria-required="true">
                                                <span>
                                                    <button type="submit" class=" fa fa-search form-button"></button>
                                                </span> 
                                            </div>
                                        </li>
                                    </ul>
                                </nav>
                            </div>
                        </div>
                    </div>
                </div>
            </header>
            <!-- end Header --> 

            <?php echo $content; ?>

            <?php if ($module == '' && $controller == 'site' && $action == 'index') { ?>
                <div class="section-lg-1 m-top6">
                    <div class="col-sm-2 nopadding">
                        <div class="fa-social-icons facebook-icon"><a href="#"><i class="fa fa-facebook"></i></a></div>
                    </div>
                    <div class="col-sm-2 nopadding">
                        <div class="fa-social-icons twitter-icon"><a href="#"><i class="fa fa-twitter"></i></a></div>
                    </div>
                    <div class="col-sm-2 nopadding">
                        <div class="fa-social-icons google-icon"><a href="#"><i class="fa fa-google-plus"></i></a></div>
                    </div>
                    <div class="col-sm-2 nopadding">
                        <div class="fa-social-icons linkedin-icon"><a href="#"><i class="fa fa-linkedin"></i></a></div>
                    </div>
                    <div class="col-sm-2 nopadding">
                        <div class="fa-social-icons instagram-icon"><a href="#"><i class="fa fa-instagram"></i></a></div>
                    </div>
                    <div class="col-sm-2 nopadding">
                        <div class="fa-social-icons vimeo-icon"><a href="#"><i class="fa fa-vimeo-square"></i></a></div>
                    </div>
                </div>
                <!-- end features section 12 -->
            <?php } else { ?>
                <div class="section-lg-1 bg-texture">
                    <div class="container">
                        <div class="row">
                            <div class="col-sm-3 text-center m-bottom4"> <img alt="" src="<?php echo Yii::app()->baseUrl; ?>/bootstrap/frontend/images/client1.png"> </div>
                            <div class="col-sm-3 text-center m-bottom4"> <img alt="" src="<?php echo Yii::app()->baseUrl; ?>/bootstrap/frontend/images/client2.png"> </div>
                            <div class="col-sm-3 text-center m-bottom4"> <img alt="" src="<?php echo Yii::app()->baseUrl; ?>/bootstrap/frontend/images/client3.png"> </div>
                            <div class="col-sm-3 text-center m-bottom4"> <img alt="" src="<?php echo Yii::app()->baseUrl; ?>/bootstrap/frontend/images/client4.png"> </div>
                        </div>
                    </div>
                </div>
                <!-- end features section 5 -->
            <?php } ?>

            <footer class="footer-bg m-top0">
                <div class="container">
                    <div class="row">
                        <div class="col-md-3 col-sm-12 m-bottom3">
                            <h4 class="white font20 font-thin">About Company</h4>
                            <div class="title-line"></div>
                            <p class="m-bottom3">Pellentesque mi purus, eleifend sedt commodo vel, sagittis elts vestibulum dui sagittis mlste sagittis elts.</p>
                            <ul class="address-info map">
                                <li><i class="fa fa-map-marker"></i> 15 Barnes Wallis Way, 358744, USA</li>
                                <li><i class="fa fa-phone"></i> +1 (012) 345 6789</li>
                                <li><i class="fa fa-envelope"></i> info@yourdomain.com</li>
                            </ul>
                        </div>
                        <div class="col-md-3 col-sm-12 m-bottom3">
                            <h4 class="white font20 font-thin">Usefull Links</h4>
                            <div class="title-line"></div>
                            <ul class="list-info one">
                                <li><a href="#"><i class="fa fa-angle-right"></i> Customer Support</a></li>
                                <li><a href="#"><i class="fa fa-angle-right"></i> Documentation</a></li>
                                <li><a href="#"><i class="fa fa-angle-right"></i> Resources</a></li>
                                <li><a href="#"><i class="fa fa-angle-right"></i> General FAQs</a></li>
                                <li><a href="#"><i class="fa fa-angle-right"></i> Rackspace Community</a></li>
                                <li><a href="#"><i class="fa fa-angle-right"></i> Developer Center</a></li>
                            </ul>
                        </div>
                        <div class="col-md-3 col-sm-12 m-bottom3">
                            <h4 class="white font20 font-thin">Recent Posts</h4>
                            <div class="title-line"></div>
                            <div class="c-post">
                                <div class="c-post-img"><img class="img-responsive" alt="" src="https://placeholdit.imgix.net/~text?txtsize=80&txt=68%C3%9772&w=68&h=72"></div>
                                <div class="c-post-content">
                                    <h4 class="c-post-title"><a href="#">Quisque convallis nec</a></h4>
                                    <p class="c-text">Lorem ipsum dolor sit<br>
                                        <span>By <a href="#">John Deo</a> / Feb 15</span></p>
                                </div>
                            </div>
                            <div class="c-post c-post-last m-bottom3">
                                <div class="c-post-img"><img class="img-responsive" alt="" src="https://placeholdit.imgix.net/~text?txtsize=80&txt=68%C3%9772&w=68&h=72"></div>
                                <div class="c-post-content">
                                    <h4 class="c-post-title"><a href="#">Quisque convallis nec</a></h4>
                                    <p class="c-text">Lorem ipsum dolor sit<br>
                                        <span>By <a href="#">John Deo</a> / Feb 15</span></p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3 col-sm-12 m-bottom3">
                            <h4 class="white font20 font-thin">Flickr Photos</h4>
                            <div class="title-line"></div>
                            <!--div class="flickr-widget">
                                <script type="text/javascript" src="http://www.flickr.com/badge_code_v2.gne?count=8&amp;display=latest&amp;size=s&amp;layout=h&amp;source=user&amp;user=120958634@N07"></script>
                            </div-->
                        </div>
                    </div>
                </div>
            </footer>
            <div class="copyrights">
                <div class="container">
                    <div class="row">
                        <div class="col-md-6 m-top1"> Copyright &copy; <?php echo date('Y') ?> Freelancer. All rights reserved. </div>
                        <div class="col-md-6">
                            <ul class="social-icons style-three">
                                <li><a href="#"><i class="fa fa-facebook"></i></a></li>
                                <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                                <li><a href="#"><i class="fa fa-google-plus"></i></a></li>
                                <li><a href="#"><i class="fa fa-linkedin"></i></a></li>
                                <li><a href="#"><i class="fa fa-flickr"></i></a></li>
                                <li><a href="#"><i class="fa fa-youtube"></i></a></li>
                                <li><a href="#"><i class="fa fa-vimeo-square"></i></a></li>
                                <li><a href="#"><i class="fa fa-rss"></i></a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <!-- end footer --> 
        </div> <!-- /container -->

        <!-- end site wrapper -->
        <a href="#" class="scrollup"></a> 
        <!-- end scroll to top of the page--> 

        <!-- jQuery (necessary for Bootstrap's JavaScript plugins) --> 
<!--        <script src="<?php echo Yii::app()->baseUrl; ?>/bootstrap/frontend/js/jquery.min.js"></script> -->

        <!-- Include all compiled plugins (below), or include individual files as needed --> 
<!--        <script src="<?php echo Yii::app()->baseUrl; ?>/bootstrap/frontend/js/jquery.js"></script> -->
        <script src="<?php echo Yii::app()->baseUrl; ?>/bootstrap/frontend/js/bootstrap.min.js"></script> 

        <!-- Yamm Mega Menu --> 
        <script>
            (function ($) {
                "use strict";
                $(function () {
                    window.prettyPrint && prettyPrint()
                    $(document).on('click', '.yamm .dropdown-menu', function (e) {
                        e.stopPropagation()
                    })
                })
            })(jQuery);
        </script> 

        <!-- MasterSlider --> 
        <script src="<?php echo Yii::app()->baseUrl; ?>/bootstrap/frontend/js/masterslider/jquery.easing.min.js"></script> 
        <script src="<?php echo Yii::app()->baseUrl; ?>/bootstrap/frontend/js/masterslider/masterslider.min.js"></script> 
        <script type="text/javascript">
            (function ($) {
                "use strict";
                var slider = new MasterSlider();

                // adds Arrows navigation control to the slider.
                slider.control('arrows');
                slider.control('timebar', {insertTo: '#masterslider'});
                slider.control('bullets');

                slider.setup('masterslider', {
                    width: 1400, // slider standard width
                    height: 650, // slider standard height
                    space: 1,
                    layout: 'fullwidth',
                    loop: true,
                    preload: 0,
                    instantStartLayers: true,
                    autoplay: true
                });
            })(jQuery);

//            $(function () {
//                $('.dropdown.messages-menu').mouseover(function () {
//                    $(this).addClass('open');
//                    $(this).find('.dropdown-toggle').attr('aria-expanded', 'true');
//                });
//                $('.dropdown.messages-menu').mouseout(function () {
//                    $(this).removeClass('open');
//                    $(this).find('.dropdown-toggle').attr('aria-expanded', 'false');
//                });
//            });

        </script> 

        <!-- load cubeportfolio --> 
<!--        <script type="text/javascript" src="<?php echo Yii::app()->baseUrl; ?>/bootstrap/frontend/js/cubeportfolio/jquery-latest.min.js"></script> -->
        <script type="text/javascript" src="<?php echo Yii::app()->baseUrl; ?>/bootstrap/frontend/js/cubeportfolio/jquery.cubeportfolio.min.js"></script> 

        <!-- init cubeportfolio --> 
        <script type="text/javascript" src="<?php echo Yii::app()->baseUrl; ?>/bootstrap/frontend/js/cubeportfolio/main3.js"></script> 

        <!-- Animations --> 
        <script src="<?php echo Yii::app()->baseUrl; ?>/bootstrap/frontend/js/animations/animations.min.js" type="text/javascript"></script> 
        <script src="<?php echo Yii::app()->baseUrl; ?>/bootstrap/frontend/js/animations/appear.min.js" type="text/javascript"></script> 

        <!-- Scroll to Fixied Sticky --> 
        <script src="<?php echo Yii::app()->baseUrl; ?>/bootstrap/frontend/js/yamm/sticky.js" type="text/javascript"></script> 

        <!-- Scroll Up --> 
        <script src="<?php echo Yii::app()->baseUrl; ?>/bootstrap/frontend/js/scrolltotop/totop.js" type="text/javascript"></script>

        <!-- counters --> 
        <script src="<?php echo Yii::app()->baseUrl; ?>/bootstrap/frontend/js/aninum/jquery.animateNumber.min.js"></script>

        <style type="text/css">
            .searchbox {bottom: -15px;float: right;right: 15%;width: 80%;}
        </style>

    </body>
</html>
