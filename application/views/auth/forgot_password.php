<?php echo form_open('auth/forgot_password', 'id="forgot_password"'); ?>
<div class="msg">
<?php echo sprintf(lang('forgot_password_subheading'), $identity_label); ?>
  </div>
  <div class="input-group">
      <span class="input-group-addon">
          <i class="material-icons">email</i>
      </span>
      <div class="form-line">
      	<?php echo form_input($identity); ?>    
      </div>
  </div>
  <?php echo form_submit('submit', lang('forgot_password_submit_btn'), 'class="btn btn-block btn-lg bg-teal waves-effect"'); ?>

  <div class="row m-t-20 m-b--5 align-center">
      <a href="login">Login!</a>
  </div>      
<?php echo form_close(); ?>
