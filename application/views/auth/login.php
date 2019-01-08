<?php echo form_open('auth/login', 'id="sign-in"'); ?>
<div class="msg"><?php echo lang('login_subheading'); ?></div>
  <div class="input-group">
      <span class="input-group-addon">
          <i class="material-icons">person</i>
      </span>
      <div class="form-line">
          <?php echo form_input($identity); ?>
      </div>
  </div>
  <div class="input-group">
      <span class="input-group-addon">
          <i class="material-icons">lock</i>
      </span>
      <div class="form-line">        
        <?php echo form_input($password); ?>
      </div>
  </div>
  <div class="row">
      <div class="col-xs-8 p-t-5">          
          <?php echo form_checkbox('remember', '1', false, 'id="remember" class="filled-in chk-col-teal"'); ?>
          <?php echo lang('login_remember_label', 'remember'); ?>
      </div>
      <div class="col-xs-4">
      <?php echo form_submit('submit', lang('login_submit_btn'), 'class="btn btn-block bg-teal waves-effect"'); ?>
      </div>
  </div>
  <div class="row m-t-20 m-b--5 align-center">
    <a href="forgot_password"><?php echo lang('login_forgot_password'); ?></a>
  </div>  
</div>
<?php echo form_close(); ?>
