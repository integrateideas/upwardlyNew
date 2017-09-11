<?php 

//Inflecting the names of the controller
$underscore = \Cake\Utility\Inflector::underscore($this->request->params['controller']);
$humanize = \Cake\Utility\Inflector::humanize($underscore);

$underscoreAction = \Cake\Utility\Inflector::underscore($this->request->params['action']);
$humanizeAction = \Cake\Utility\Inflector::humanize($underscoreAction);
                
?>
<div class="normalheader transition animated fadeIn">
    <div class="hpanel">
        <div class="panel-body">
            <a class="small-header-action" href="">
                <div class="clip-header">
                    <i class="fa fa-arrow-up"></i>
                </div>
            </a>
            <div id="hbreadcrumb" class="pull-right m-t-lg">
                <ol class="hbreadcrumb breadcrumb">
                    <li>Dashboard</li>
                    <li class="active">
                        <span><?= $this->Html->link($humanize,"/".$this->request->params['controller']); ?></span>
                    </li>
                </ol>
            </div>
            <h2 class="font-light m-b-xs">
                <?= $humanize ?>
            </h2>
        </div>
    </div>
</div>
