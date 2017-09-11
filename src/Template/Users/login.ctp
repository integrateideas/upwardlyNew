<div class="login-container">
    <div class="row">
        <div class="col-md-12">
            <div class="text-center m-b-md">
                <h3>Sign In</h3>
            </div>
            <div class="hpanel">
                <div class="panel-body">
					<?= $this->Form->create(null, ['class' => 'm-t']) ?>
                        <div class="form-group">
                            <label class="control-label" for="username">Username</label>
                            <?= $this->Form->Input('username', ['class' => 'form-control', 'label' => false, 'placeholder' => 'Username', 'required'=>'required']); ?>
                        </div>
                        <div class="form-group">
                            <label class="control-label" for="password">Password</label>
                            <?= $this->Form->Input('password', ['type' => 'password', 'class' => 'form-control', 'label' => false, 'placeholder' => 'Password', 'required'=>'required']) ?>
                        </div>
                        <?= $this->Form->button('Login', ['type' => 'submit', 'class' => 'btn btn-success btn-block']); ?>
                    <?= $this->Form->end() ?>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12 text-center">
            <strong>&copy;<?php echo ' '.date("Y").'-'.(date("Y")+1).' '?>Twinspark</strong> - LLC, All rights reserved. <br/> 
        </div>
    </div>
</div>