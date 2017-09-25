<?php $this->start('nav');?>
<!-- Navigation -->
<aside id="menu">
    <div id="navigation">
        <div class="profile-picture">
            <a href="javascript:void(0)">
            <?= $this->Html->image('a9.jpg',['width' =>'80px','height' => '80px', 'class' => 'img-circle m-b','alt' => 'logo'])?>
            </a>

            <div class="stats-label text-color">
                <span class="font-extra-bold font-uppercase"><?php echo $sideNavData['first_name']." ".$sideNavData['last_name']?></span>

                <div class="dropdown">
                    <a class="dropdown-toggle" href="#" data-toggle="dropdown">
                        <small class="text-muted">User Settings <b class="caret"></b></small>
                    </a>
                    <ul class="dropdown-menu animated flipInX m-t-xs">
                        <li><?= $this->Html->link(__('Profile'), ['controller' => 'Users', 'action' => 'edit', $sideNavData['id']]) ?></li>
                        <li class="divider"></li>
                        <li><?= $this->Html->link(__('Add User'), ['controller' => 'Users', 'action' => 'add']) ?></li>
                        <li class="divider"></li>
                        <li><?= $this->Html->link(__('Logout'), ['controller' => 'Users', 'action' => 'logout']) ?></li>

                    </ul>
                </div>
            </div>
        </div>
        <?php 
        $controller = $this->request->params['controller'];
        $action = $this->request->params['action'];
        $mnu_dash = $mnu_setting = $mnu_report ='';

        $action;
        if ($controller == 'Users' && $action == 'dashboard') {
        $mnu_dash= "active";
        }
        else if (($controller == 'VendorLevels') || ($controller == 'VendorActions') || ($controller == 'VendorBadges') || ($controller == 'Vendors') || ($controller == 'Users') || ($controller == 'Roles') || ($controller == 'VendorPlayers')  ) {
        $mnu_setting = "active";
        }

        ?>
        <ul class="nav" id="side-menu">
            <li class="<?php echo $mnu_dash; ?>">
                <a href="<?php echo $this->Url->build(["controller" => "users","action" => "dashboard"]);?>"> <span class="nav-label">Dashboard</span></a>
            </li>
            <li class="<?php echo $mnu_setting;?>">
                <a href="#"><span class="nav-label">Interface</span><span class="fa arrow"></span> </a>
                <ul class="nav nav-second-level">
                    
                    <li class="">
                        <a href="#">Vendors<span class="fa arrow"></span></a>
                        <ul class="nav nav-third-level">
                          <li><?= $this->Html->link(__('View All'), ['controller'=>'Vendors','action' => 'index']) ?></li>
                          <li><?= $this->Html->link(__('Add Vendor'), ['controller'=>'Vendors','action' => 'add']) ?></li>

                        </ul>
                    </li>
                    <li class="">
                        <a href="#">Users<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                            <li><?= $this->Html->link(__('View All'), ['controller'=>'Users','action' => 'index']) ?></li>
                            <li><?= $this->Html->link(__('Add User'), ['controller'=>'Users','action' => 'add']) ?></li>
                            </ul>
                    </li>
                    <li class="">
                        <a href="<?php echo $this->Url->build(["controller" => "roles","action" => "index"]);?>"> <span class="nav nav-label">Roles</span></a>
                    </li>
                    
                    <li class="">
                        <a href="<?php echo $this->Url->build(["controller" => "vendor-players","action" => "index"]);?>"> <span class="nav nav-label">Players</span></a>
                    </li>
                    <li class="">
                        <a href="#">Vendor Levels<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                            <li><?= $this->Html->link(__('View All'), ['controller'=>'VendorLevels','action' => 'index']) ?></li>
                            <li><?= $this->Html->link(__('Add Level'), ['controller'=>'VendorLevels','action' => 'add']) ?></li>
                            </ul>
                    </li>
                    <li class="">
                        <a href="#">Vendor Actions<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                            <li><?= $this->Html->link(__('View All'), ['controller'=>'VendorActions','action' => 'index']) ?></li>
                            <li><?= $this->Html->link(__('Add Action'), ['controller'=>'VendorActions','action' => 'add']) ?></li>
                            </ul>
                    </li>
                    <li class="">
                        <a href="#">Vendor Badges<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                            <li><?= $this->Html->link(__('View All'), ['controller'=>'VendorBadges','action' => 'index']) ?></li>
                            <li><?= $this->Html->link(__('Add Badge'), ['controller'=>'VendorBadges','action' => 'add']) ?></li>
                            </ul>
                    </li>
                </ul>
            </li>
        </ul>
    </div>
</aside>
<?php $this->end();?>