<?php
$lang = Yii::app()->language;

header('Content-Type: text/html; charset=utf-8');

Yii::app()->clientScript->registerCss('maincss', '');
Yii::app()->clientScript->registerScript('mainjs', '');

Yii::app()->clientScript->registerCssFile($this->module->assetsUrl . '/bootstrap/css/bootstrap.min.css');
Yii::app()->clientScript->registerCssFile($this->module->assetsUrl . '/font-awesome/css/font-awesome.min.css');
Yii::app()->clientScript->registerCssFile($this->module->assetsUrl . '/dist/css/AdminLTE.min.css');
Yii::app()->clientScript->registerCssFile($this->module->assetsUrl . '/css/custom.css');

Yii::app()->clientScript->registerScriptFile($this->module->assetsUrl . '/plugins/jQuery/jQuery-2.1.4.min.js');
Yii::app()->clientScript->registerScriptFile($this->module->assetsUrl . '/bootstrap/js/bootstrap.min.js');

$cs = Yii::app()->clientScript;
$cs->scriptMap = array(
    'jquery.js' => $this->module->assetsUrl . '/plugins/jQuery/jQuery-2.1.4.min.js',
);
$cs->registerCoreScript('jquery');
$cs->coreScriptPosition = CClientScript::POS_END;
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Administrator Dashboard | LogIn</title>
        
        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
            <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
            <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->
    </head>
    <body class="hold-transition login-page">
        <div class="login-box">
            <div class="login-logo">
                <a href="javascript:void(0);"><b>Freelancer</b></a>
            </div><!-- /.login-logo -->
            <div class="login-box-body">
                <p class="login-box-msg">Administrator Dashboard</p>
                <?php echo $content; ?>
            </div><!-- /.login-box-body -->
        </div><!-- /.login-box -->
    </body>
</html>
