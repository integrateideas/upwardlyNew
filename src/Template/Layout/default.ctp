<?php
/**
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @since         0.10.0
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */

$cakeDescription = 'Upwardly';
?>
<!DOCTYPE html>
<html>
<head>
    <?= $this->Html->charset() ?>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>
        <?= $cakeDescription ?>:
        <?= $this->fetch('title') ?>
    </title>
    <?= $this->Html->meta('icon') ?>

    <?= $this->Html->css([
                            'plugins/bootstrap/dist/css/bootstrap',
                            'plugins/fontawesome/css/font-awesome',
                            'fonts/pe-icon-7-stroke/css/pe-icon-7-stroke',
                            'style',
                            //'plugins/metisMenu/dist/metisMenu',
                            //'plugins/animate.css/animate',
                        ]) ?>
    <?= $this->Html->script([
                                'plugins/jquery/dist/jquery.min',
                                'plugins/jquery-ui/jquery-ui.min',
                                //'plugins/slimScroll/jquery.slimscroll.min',
                                'plugins/bootstrap/dist/js/bootstrap.min',
                                //'plugins/jquery-flot/jquery.flot',
                                //'plugins/jquery-flot/jquery.flot.resize',
                                //'plugins/jquery-flot/jquery.flot.pie',
                                //'plugins/flot.curvedlines/curvedLines',
                                //'plugins/jquery.flot.spline/index',
                                'plugins/metisMenu/dist/metisMenu.min',
                                'plugins/iCheck/icheck.min',
                                //'plugins/peity/jquery.peity.min',
                                //'plugins/sparkline/index',
                                'homer',
                                //'charts',
                                'super_admin'
                            ])?>
    

    <?= $this->fetch('meta') ?>
    <?= $this->fetch('css') ?>
    <?= $this->fetch('script') ?>
</head>
<body class="fixed-navbar fixed-sidebar">
<!-- Simple splash screen-->
<div class="splash"> <div class="color-line"></div><div class="splash-title"><h1>Upwardly - Admin Section</h1><p>Please wait while we are loading </p><div class="spinner"> <div class="rect1"></div> <div class="rect2"></div> <div class="rect3"></div> <div class="rect4"></div> <div class="rect5"></div> </div> </div> </div>
<!--[if lt IE 7]>
<p class="alert alert-danger">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
<![endif]-->


<?= $this->element('Navigation/topnav'); ?>

<?php echo $this->element('Navigation/sidenav');?>
<?= $this->fetch('nav') ?>
<?=  $this->Form->hidden('baseUrl',['id'=>'baseUrl','value'=>$this->Url->build('/', true)]); ?>
<!-- Main Wrapper -->
<div id="wrapper">
    <!--  Breadcum sidebar -->
    <?= $this->element('titleband')?>
    <div class="content animate-panel">
        <?= $this->Flash->render('auth', ['element' => 'Flash/error']) ?>
        <?= $this->Flash->render() ?>
        <?= $this->fetch('content') ?>
    </div>

    <?= $this->element('footer'); ?>

</div>


</body>
</html>
