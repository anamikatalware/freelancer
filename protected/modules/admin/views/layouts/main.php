<?php
header('Content-Type: text/html; charset=utf-8');

Yii::app()->clientScript->registerCss('maincss', '');
Yii::app()->clientScript->registerScript('mainjs', '');

Yii::app()->clientScript->registerCssFile($this->module->assetsUrl . '/bootstrap/css/bootstrap.min.css');
Yii::app()->clientScript->registerCssFile($this->module->assetsUrl . '/font-awesome/css/font-awesome.min.css');
Yii::app()->clientScript->registerCssFile($this->module->assetsUrl . '/dist/css/AdminLTE.min.css');
Yii::app()->clientScript->registerCssFile($this->module->assetsUrl . '/dist/css/skins/_all-skins.min.css');
Yii::app()->clientScript->registerCssFile($this->module->assetsUrl . '/css/custom.css');

Yii::app()->clientScript->registerScriptFile($this->module->assetsUrl . '/plugins/jQuery/jQuery-2.1.4.min.js');
Yii::app()->clientScript->registerScriptFile($this->module->assetsUrl . '/bootstrap/js/bootstrap.min.js');
Yii::app()->clientScript->registerScriptFile($this->module->assetsUrl . '/plugins/fastclick/fastclick.min.js');
Yii::app()->clientScript->registerScriptFile($this->module->assetsUrl . '/dist/js/app.min.js');
Yii::app()->clientScript->registerScriptFile($this->module->assetsUrl . '/plugins/slimScroll/jquery.slimscroll.min.js');
//Yii::app()->clientScript->registerScriptFile($this->module->assetsUrl . '/dist/js/pages/dashboard2.js');
Yii::app()->clientScript->registerScriptFile($this->module->assetsUrl . '/dist/js/demo.js');

$cs = Yii::app()->clientScript;
$cs->scriptMap = array(
    'jquery.js' => $this->module->assetsUrl . '/plugins/jQuery/jQuery-2.1.4.min.js',
);
$cs->registerCoreScript('jquery');
$cs->coreScriptPosition = CClientScript::POS_END;

$user = User::model()->getUserProfile();
$user_fullname = '';
$user_since = '';
if (!empty($user)) {
    $user_fullname = ucwords($user->user_firstname . ' ' . $user->user_lastname);
    $user_since = date('M, Y', strtotime($user->user_created));
}
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Administrator Dashboard | Freelancer</title>
        <!-- Tell the browser to be responsive to screen width -->
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">             

        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
            <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
            <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->
    </head>
    <body class="hold-transition skin-blue sidebar-mini">

        <div class="wrapper">
            <header class="main-header">

                <!-- Logo -->
                <a href="/admin/site/index" class="logo">
                    <!-- mini logo for sidebar mini 50x50 pixels -->
                    <span class="logo-mini"><b>F</b></span>
                    <!-- logo for regular state and mobile devices -->
                    <span class="logo-lg"><b>Admin</b> Freelancer</span>
                </a>

                <!-- Header Navbar: style can be found in header.less -->
                <nav class="navbar navbar-static-top" role="navigation">
                    <!-- Sidebar toggle button-->
                    <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
                        <span class="sr-only">Toggle navigation</span>
                    </a>
                    <!-- Navbar Right Menu -->
                    <div class="navbar-custom-menu">
                        <ul class="nav navbar-nav">
                            <li><?= CHtml::link('Go to Frontend', array('/'), array('target' => '_blank')); ?></li>
                            <!-- User Account: style can be found in dropdown.less -->
                            <li class="dropdown user user-menu">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                    <img src="<?php echo $this->module->assetsUrl; ?>/dist/img/user2-160x160.jpg" class="user-image" alt="User Image">
                                    <span class="hidden-xs">
                                        <?php if (!Yii::app()->user->isGuest): ?>
                                            Welcome  <?= $user_fullname ?>
                                        <?php endif; ?>
                                    </span>
                                </a>
                                <ul class="dropdown-menu">
                                    <!-- User image -->
                                    <li class="user-header">
                                        <img src="<?php echo $this->module->assetsUrl; ?>/dist/img/user2-160x160.jpg" class="img-circle" alt="User Image">
                                        <p>
                                            <?php if (!Yii::app()->user->isGuest): ?>
                                                <?= $user_fullname ?>
                                            <?php endif; ?>
                                            <small>Member since <?= $user_since ?></small>
                                        </p>
                                    </li>
                                    <!-- Menu Body -->
                                    <!--li class="user-body">
                                        <div class="col-xs-4 text-center">
                                            <a href="#">Followers</a>
                                        </div>
                                        <div class="col-xs-4 text-center">
                                            <a href="#">Sales</a>
                                        </div>
                                        <div class="col-xs-4 text-center">
                                            <a href="#">Friends</a>
                                        </div>
                                    </li-->
                                    <!-- Menu Footer-->
                                    <li class="user-footer">
                                        <div class="pull-left">
                                            <a href="/admin/site/profile" class="btn btn-default btn-flat">Profile</a>
                                        </div>
                                        <div class="pull-right">
                                            <?php if (!Yii::app()->user->isGuest): ?>
                                                <?= CHtml::link('Log out', array('site/logout'), array('class' => 'btn btn-default btn-flat')); ?>
                                            <?php endif; ?>
                                        </div>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                    </div>

                </nav>
            </header>

            <!-- Left side column. contains the logo and sidebar -->
            <aside class="main-sidebar">
                <!-- sidebar: style can be found in sidebar.less -->
                <section class="sidebar">
                    <ul class="sidebar-menu">
                        <li style="text-align: center; font-size: 16px; background: rgb(255, 255, 255) none repeat scroll 0% 0%;" class="header">Main Navigation</li>
                        <li class="treeview" data-controller="site" data-action="index">
                            <?= CHtml::link('<i class="fa fa-dashboard"></i> <span>Dashboard</span>', array('site/index')); ?>
                        </li>
                        <li class="treeview" data-controller="category" data-action="index">
                            <a href="#">
                                <i class="fa fa-pie-chart"></i>
                                <span>Category</span>
                                <i class="fa fa-angle-left pull-right"></i>
                            </a>
                            <ul class="treeview-menu">
                                <li>
                                    <?= CHtml::link('<i class="fa fa-circle-o text-aqua"></i> Manage Categories', array('category/index')); ?>
                                </li>
                                <li>
                                    <?= CHtml::link('<i class="fa fa-circle-o text-aqua"></i> Add Category', array('category/create')); ?>
                                </li>
                                <li>
                                    <?= CHtml::link('<i class="fa fa-circle-o text-aqua"></i> Manage Order', array('category/order')); ?>
                                </li>
                            </ul>
                        </li>
                        <li class="treeview" data-controller="subCategory" data-action="index">
                            <a href="#">
                                <i class="fa fa-pie-chart"></i>
                                <span>Sub Category</span>
                                <i class="fa fa-angle-left pull-right"></i>
                            </a>
                            <ul class="treeview-menu">
                                <li>
                                    <?= CHtml::link('<i class="fa fa-circle-o text-aqua"></i> Manage Sub Categories', array('subCategory/index')); ?>
                                </li>
                                <li>
                                    <?= CHtml::link('<i class="fa fa-circle-o text-aqua"></i> Add Sub Category', array('subCategory/create')); ?>
                                </li>
                            </ul>
                        </li>
                        <li class="treeview" data-controller="page" data-action="index">
                            <a href="#">
                                <i class="fa fa-pie-chart"></i>
                                <span>Pages</span>
                                <i class="fa fa-angle-left pull-right"></i>
                            </a>
                            <ul class="treeview-menu">
                                <li>
                                    <?= CHtml::link('<i class="fa fa-circle-o text-aqua"></i> Manage Pages', array('page/index')); ?>
                                </li>
                                <li>
                                    <?= CHtml::link('<i class="fa fa-circle-o text-aqua"></i> Add Page', array('page/create')); ?>
                                </li>
                            </ul>
                        </li>
                        <li class="treeview" data-controller="template" data-action="index">
                            <a href="#">
                                <i class="fa fa-pie-chart"></i>
                                <span>Email Templates</span>
                                <i class="fa fa-angle-left pull-right"></i>
                            </a>
                            <ul class="treeview-menu">
                                <li>
                                    <?= CHtml::link('<i class="fa fa-circle-o text-aqua"></i> Manage Email Templates', array('template/index')); ?>
                                </li>
                                <li>
                                    <?= CHtml::link('<i class="fa fa-circle-o text-aqua"></i> Add Email Template', array('template/create')); ?>
                                </li>
                            </ul>
                        </li>
                        <li class="treeview" data-controller="currency" data-action="index">
                            <a href="#">
                                <i class="fa fa-pie-chart"></i>
                                <span>Currencies</span>
                                <i class="fa fa-angle-left pull-right"></i>
                            </a>
                            <ul class="treeview-menu">
                                <li>
                                    <?= CHtml::link('<i class="fa fa-circle-o text-aqua"></i> Manage Currencies', array('currency/index')); ?>
                                </li>
                                <li>
                                    <?= CHtml::link('<i class="fa fa-circle-o text-aqua"></i> Add Currency', array('currency/create')); ?>
                                </li>
                                <li>
                                    <?= CHtml::link('<i class="fa fa-circle-o text-aqua"></i> Manage Order', array('currency/order')); ?>
                                </li>
                            </ul>
                        </li>
                        <li class="treeview" data-controller="budgettype" data-action="index">
                            <a href="#">
                                <i class="fa fa-pie-chart"></i>
                                <span>Budget Type</span>
                                <i class="fa fa-angle-left pull-right"></i>
                            </a>
                            <ul class="treeview-menu">
                                <li>
                                    <?= CHtml::link('<i class="fa fa-circle-o text-aqua"></i> Manage Budget Type', array('budgetType/index')); ?>
                                </li>
                                <li>
                                    <?= CHtml::link('<i class="fa fa-circle-o text-aqua"></i> Add Budget Type', array('budgetType/create')); ?>
                                </li>
                            </ul>
                        </li>
                        <li class="treeview" data-controller="budget" data-action="index">
                            <a href="#">
                                <i class="fa fa-pie-chart"></i>
                                <span>Budgets</span>
                                <i class="fa fa-angle-left pull-right"></i>
                            </a>
                            <ul class="treeview-menu">
                                <li>
                                    <?= CHtml::link('<i class="fa fa-circle-o text-aqua"></i> Manage Budgets', array('budget/index')); ?>
                                </li>
                                <li>
                                    <?= CHtml::link('<i class="fa fa-circle-o text-aqua"></i> Add Budget', array('budget/create')); ?>
                                </li>
                            </ul>
                        </li>
                        <li class="treeview" data-controller="continent" data-action="index">
                            <a href="#">
                                <i class="fa fa-pie-chart"></i>
                                <span>Continents</span>
                                <i class="fa fa-angle-left pull-right"></i>
                            </a>
                            <ul class="treeview-menu">
                                <li>
                                    <?= CHtml::link('<i class="fa fa-circle-o text-aqua"></i> Manage Continents', array('continent/index')); ?>
                                </li>
                                <li>
                                    <?= CHtml::link('<i class="fa fa-circle-o text-aqua"></i> Add Continent', array('continent/create')); ?>
                                </li>
                            </ul>
                        </li>
                        <li class="treeview mylocation" data-controller="country" data-action="index">
                            <a href="#">
                                <i class="fa fa-pie-chart"></i>
                                <span>Locations</span>
                                <i class="fa fa-angle-left pull-right"></i>
                            </a>
                            <ul class="treeview-menu">
                                <li>
                                    <?= CHtml::link('<i class="fa fa-circle-o text-aqua"></i> Manage Countries', array('country/index')); ?>
                                </li>
                                <li>
                                    <?= CHtml::link('<i class="fa fa-circle-o text-aqua"></i> Manage States', array('state/index')); ?>
                                </li>
                                <li>
                                    <?= CHtml::link('<i class="fa fa-circle-o text-aqua"></i> Manage Cities', array('city/index')); ?>
                                </li>
                            </ul>
                        </li>
                        <li class="treeview" data-controller="package" data-action="index">
                            <a href="#">
                                <i class="fa fa-pie-chart"></i>
                                <span>Packages</span>
                                <i class="fa fa-angle-left pull-right"></i>
                            </a>
                            <ul class="treeview-menu">
                                <li>
                                    <?= CHtml::link('<i class="fa fa-circle-o text-aqua"></i> Manage Packages', array('package/index')); ?>
                                </li>
                                <li>
                                    <?= CHtml::link('<i class="fa fa-circle-o text-aqua"></i> Add Package', array('package/create')); ?>
                                </li>
                            </ul>
                        </li>
                        <li class="treeview" data-controller="feature" data-action="index">
                            <a href="#">
                                <i class="fa fa-pie-chart"></i>
                                <span>Package Features</span>
                                <i class="fa fa-angle-left pull-right"></i>
                            </a>
                            <ul class="treeview-menu">
                                <li>
                                    <?= CHtml::link('<i class="fa fa-circle-o text-aqua"></i> Manage Package Features', array('feature/index')); ?>
                                </li>
                                <li>
                                    <?= CHtml::link('<i class="fa fa-circle-o text-aqua"></i> Add Package Feature', array('feature/create')); ?>
                                </li>
                            </ul>
                        </li>
                        <li class="treeview" data-controller="faqCategory" data-action="index">
                            <a href="#">
                                <i class="fa fa-pie-chart"></i>
                                <span>FAQ Category</span>
                                <i class="fa fa-angle-left pull-right"></i>
                            </a>
                            <ul class="treeview-menu">
                                <li>
                                    <?= CHtml::link('<i class="fa fa-circle-o text-aqua"></i> Manage Categories', array('faqCategory/index')); ?>
                                </li>
                                <li>
                                    <?= CHtml::link('<i class="fa fa-circle-o text-aqua"></i> Add FAQ Category', array('faqCategory/create')); ?>
                                </li>
                                <li>
                                    <?= CHtml::link('<i class="fa fa-circle-o text-aqua"></i> Manage Order', array('faqCategory/order')); ?>
                                </li>
                            </ul>
                        </li>
                        <li class="treeview" data-controller="faq" data-action="index">
                            <a href="#">
                                <i class="fa fa-pie-chart"></i>
                                <span>FAQs</span>
                                <i class="fa fa-angle-left pull-right"></i>
                            </a>
                            <ul class="treeview-menu">
                                <li>
                                    <?= CHtml::link('<i class="fa fa-circle-o text-aqua"></i> Manage FAQs', array('faq/index')); ?>
                                </li>
                                <li>
                                    <?= CHtml::link('<i class="fa fa-circle-o text-aqua"></i> Add FAQ', array('faq/create')); ?>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </section>
                <!-- /.sidebar -->
            </aside>

            <!-- Content Wrapper. Contains page content -->
            <div class="content-wrapper">
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <h1>
                        <?php echo $this->pageTitle; ?>
                    </h1>
                    <!--ol class="breadcrumb">
                        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                        <li class="active">Dashboard</li>
                    </ol-->
                </section>
                <!-- Main content -->
                <section class="content">
                    <?php echo $content; ?>      
                </section><!-- /.content -->
            </div><!-- /.content-wrapper -->

            <footer class="main-footer">
                <strong>Copyright &copy; <?php echo date('Y'); ?> <a href="http://www.canries.co.in" target="_blank">Canries</a>.</strong> All rights reserved.
            </footer>

        </div>       

        <script type="text/javascript">
            $(function () {
                var controller = '<?php echo Yii::app()->controller->id; ?>';
                var action = ['index', 'create', 'update', 'delete', 'view'];

                $('.treeview').each(function () {
                    if ($(this).attr('data-controller') === controller) {
                        $(this).addClass('active');
                    }

                    if (controller == 'country' || controller == 'state' || controller == 'city') {
                        $('.mylocation').addClass('active');
                    }
                });
            });
        </script>

    </body>
</html>