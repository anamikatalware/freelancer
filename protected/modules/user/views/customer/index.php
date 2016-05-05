<?php
$this->pageTitle = Yii::app()->name . ' - My Account';
$current_user = Yii::app()->user->id;
?>

<div class="page-header two">
    <div class="container">
        <div class="col-md-6 left-padd0">
            <h3 class="font30 nomargin white uppercase">My Account</h3>
            <h4 class="font18 white font-thin">You profile page</h4>
        </div>
        <div class="col-md-6">
            <div class="pagenation"><a href="index.html">Dashboard</a> <i>/</i> My Account</div>
        </div>
    </div>
</div>
<!-- end page header -->

<div class="section-lg one">
    <div class="container">
        <div class="row">
            <div class="col-md-3">
                <div class="c-post one profile-image-box">
                    <div class="c-post-img">
                        <img src="https://placeholdit.imgix.net/~text?txtsize=50&amp;txt=68%C3%9772&amp;w=68&amp;h=72" alt="" class="img-responsive" />
                    </div>
                    <div class="clearfix"></div>
                </div>
                <!--div class="widget m-bottom4" id="profile_details">
                    <div class="c-post one">
                        <div class="c-post-content">
                            <h4 class="c-post-title text-center">@canries</h4>
                            <div class="form-group text-center">
                                <ul class="my-profile-notice">
                                    <li><a href="javascript:void(0);"><i class="fa fa-dollar fa-2x"></i></a></li>
                                    <li><a href="javascript:void(0);"><i class="fa fa-envelope fa-2x"></i></a></li>
                                    <li><a href="javascript:void(0);"><i class="fa fa-user fa-2x"></i></a></li>
                                    <li><a href="javascript:void(0);"><i class="fa fa-phone fa-2x"></i></a></li>
                                    <li><a href="javascript:void(0);"><i class="fa fa-money fa-2x"></i></a></li>
                                </ul>
                            </div>
                        </div>                        
                    </div>
                </div-->
            </div>
            <div class="col-md-6">
                <div class="widget m-bottom4" id="profile_details">
                    <div class="c-post-content">
                        <blockquote>
                            Canries
                            <small>Mobile App Development, CMS, Frameworks, Database</small>
                        </blockquote>
                        <p>Our main emphasis is to deliver quality work and wants to gain reputation more than money. We mainly works on below technologies for Mobile Platform and Web Development: iPhone, Android, Web Services, Restful, YII, Laravel, PHP, Wordpress, NodeJS, AngularJS, Socket, jQuery, Bootstrap, Paypal, 3rd Party APIs, Mapbox, Google Maps and many more...</p>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="button text-center">
                    <a class="btn boxed-color-xs uppercase btn-block" title="Edit Profile" id="btnEditProfile" href="javascript:void(0);" style="margin-bottom: 20px;"><i class="fa fa-edit"></i> Edit Profile</a>
                </div>
                <div class="button" style="text-align: center; font-weight: bold; font-size: 26px;">
                    $ <span>5</span> USD/hr
                </div>
            </div>
        </div>
    </div>
</div>
<!-- end features section 1 -->

<?php echo $this->renderPartial('profile/portfolio', array('current_user' => $current_user)); ?>

<div class="section-lg one">
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <?php echo $this->renderPartial('profile/reviews', array('current_user' => $current_user)); ?>
                <?php echo $this->renderPartial('profile/education', array('current_user' => $current_user)); ?>
                <?php echo $this->renderPartial('profile/experience', array('current_user' => $current_user)); ?>
                <?php echo $this->renderPartial('profile/certification', array('current_user' => $current_user)); ?>
                <?php echo $this->renderPartial('profile/publication', array('current_user' => $current_user)); ?>
            </div>
            <div class="col-md-4">
                <?php echo $this->renderPartial('profile/verification', array('current_user' => $current_user)); ?>
                <?php echo $this->renderPartial('profile/skills', array('current_user' => $current_user)); ?>
            </div>
        </div>
    </div>
</div>
<!-- end features section 1 -->

<div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="gridSystemModalLabel">Select your skills and expertise</h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-8">
                        <input type="text" class="form-control" placeholder="Search for relevant Skills" />
                        <div class="row">
                            <div class="col-md-4"></div>
                            <div class="col-md-4"></div>
                            <div class="col-md-4"></div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <h3>13300</h3>
                        Jobs matching your skills
                        23 of 86 Selected skills
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Save</button>
            </div>
        </div><!-- /.modal-content -->
    </div>
</div>


<script>
    $('#btnAddExperienceBlock').hide();
    $('#btnAddCertificationBlock').hide();
    $('#btnAddPublicationBlock').hide();
    $('#btnAddEducationBlock').hide();
    $('#btnEditPortfolio').hide();

    $(function () {
        $('.my-profile-portfolio a').mouseenter(function () {
            $('.my-profile-portfolio a .description').show();
        });

        $('.my-profile-portfolio a').mouseout(function () {
            $(this).find('.description').hide();
        });

        $('#btnAddEducationBlock').click(function () {
            $('.education-add').toggle();
            $('.education-add').find("button[type='reset']").click();
        });

        $('#btnAddExperienceBlock').click(function () {
            $('.experience-add').toggle();
            $('.experience-add').find("button[type='reset']").click();
        });

        $('#btnAddCertificationBlock').click(function () {
            $('.certification-add').toggle();
            $('.certification-add').find("button[type='reset']").click();
        });

        $('#btnAddPublicationBlock').click(function () {
            $('.publication-add').toggle();
            $('.publication-add').find("button[type='reset']").click();
        });

        $("button[type='reset']").click(function () {
            $("input[type='hidden']").val(0);
            $("#endtime").show();
        })

        var i = 0;
        $('#btnEditProfile').click(function () {
            if (i == 0) {
                $('#btnAddExperienceBlock').show();
                $('#btnAddCertificationBlock').show();
                $('#btnAddPublicationBlock').show();
                $('#btnAddEducationBlock').show();
                $('#btnEditPortfolio').show();
                i = 1;
            } else {
                $('#btnAddExperienceBlock').hide();
                $('#btnAddCertificationBlock').hide();
                $('#btnAddPublicationBlock').hide();
                $('#btnAddEducationBlock').hide();
                $('#btnEditPortfolio').hide();
                i = 0;
            }
        });

    });
</script>

<style type="text/css">
    #verifications .c-post.one {margin: 10px 0 0;}
    #verifications .c-post.one a {margin: 0;}
    #verifications .c-post.one .c-post-content {padding-left: 250px;}
    #verifications .c-post.one .c-post-img {width: 250px;height: auto;line-height: 32px;}
    #verifications .c-post.one .button a.boxed-color-xs{padding: 6px 10px;}
    #verifications .c-post.one .c-post-title {margin: 0;line-height: 32px;}

    #my_top_skills .c-post.one {margin-bottom: 10px;margin-top: 15px;padding-bottom: 5px;}
    #my_top_skills .c-post-content {padding-left: 10px;}

    #reviews .c-post.one {margin: 10px 0;}

    #education .c-post.one {margin: 10px 0;}
    #education .button {text-align: right;margin-top: 10px;}
    #education .button a {margin: 0;}
    #education .sky-form .button {float: left;margin: 0;}

    #experience .c-post.one {margin: 10px 0;}
    #experience .button {text-align: right;margin-top: 10px;}
    #experience .button a {margin: 0;}
    #experience .sky-form .button {float: left;margin: 0;}

    #certifications .c-post.one {margin: 10px 0;}
    #certifications .button {text-align: right;margin-top: 10px;}
    #certifications .button a {margin: 0;}
    #certifications .sky-form .button {float: left;margin: 0;}

    #publications .c-post.one {margin: 10px 0;}
    #publications .button {text-align: right;margin-top: 10px;}
    #publications .button a {margin: 0;}
    #publications .sky-form .button {float: left;margin: 0;}

    #profile_details .c-post.one {margin: 0;}   
    #profile_details .c-post-img {display: block;float: none;width: 100%;}
    #profile_details .img-responsive {border: 1px solid #ccc;border-radius: 5px;margin: 0 auto;padding: 5px;width: 100%;}
    #profile_details .c-post-content {padding: 0;}

    .profile-image-box {
        margin: 0 !important;
    }
    .profile-image-box .c-post-img {
        border: 1px solid #cccccc;
        height: 260px;
        padding: 4px;
        width: 100%;
    }
    .img-responsive {
        height: 100%;
        width: 100%;
    }
    .my-profile-notice {
        margin: 0;
        padding: 0;
    }
    .my-profile-notice li {
        border: 1px solid #cccccc;
        border-radius: 50%;
        display: inline-block;
        height: 40px;
        padding: 5px;
        width: 40px;
        position: relative;
    }
    .fa-2x {
  font-size: 1.5em;
}
.my-profile-notice a {
  left: 9px;
  position: absolute;
  top: 8px;
}
</style>