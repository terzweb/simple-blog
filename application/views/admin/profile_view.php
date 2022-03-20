<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        <i class="fa fa-user"></i> プロフィール管理
        <small>Edit Profile</small>
      </h1>
    </section>
    
    <section class="content">

               

        <div class="row">
            <!-- left column -->
            <div class="col-md-12">

                 <?php
                    $this->load->helper('form');
                    $error = $this->session->flashdata('error');
                    if($error)
                    {
                ?>
                <div class="alert alert-danger alert-dismissable">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    <?php echo $this->session->flashdata('error'); ?>                    
                </div>
                <?php } ?>
                <?php  
                    $success = $this->session->flashdata('success');
                    if($success)
                    {
                ?>
                <div class="alert alert-success alert-dismissable">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    <?php echo $this->session->flashdata('success'); ?>
                </div>
                <?php } ?>
            

                <?php echo validation_errors('<div class="alert alert-danger alert-dismissable">', ' <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button></div>'); ?>


              <!-- general form elements -->
                <div class="box box-primary">
                    <div class="box-header">
                        <h3 class="box-title">プロフィール編集</h3>
                    </div><!-- /.box-header -->

                    <!-- form start -->
                    <?php
                        echo form_open(base_url(ADMINURL.'/profile/editPost'),array('class'=>'','id'=>'editPost'));
                    ?>
                    
                        <div class="box-body">
                            <div class="row">
                                <div class="col-md-12"> 
                 
                                    <div class="form-group">
                                        <label for="fname">名前</label>
                                        <input type="text" class="form-control" value="<?php echo set_value('name',$profile[0]->name); ?>" id="fname" name="name" maxlength="128">
                                        
                                    </div>
                                    
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="url">*E-メール ID</label>
                                        <input type="text" class="form-control" value="<?php echo set_value('email',$profile[0]->email); ?>" name="email">
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="imgurl">*現パスワード   </label><small>半角英数字のみ</small>
                                        <input type="text" class="form-control" value="" name="password">
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="imgurl">パスワード変更</label><small>変更する場合は記載　半角英数字のみ</small>
                                        <input type="text" class="form-control" value="" name="passwordNew">
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="imgurl">パスワード変更 確認</label><small>変更する場合は記載　半角英数字のみ</small>
                                        <input type="text" class="form-control" value="" name="passwordRe">
                                    </div>
                                </div>
                            </div>

                           
                        </div>
                        <div class="box-footer">
                            <input type="submit" class="btn btn-primary" value=" 更 新 " />
                        </div>
                    </form>
                </div>
            </div>

        </div>    
    </section>
</div>

<script>
$(document).ready(function(){
	
	var addUserForm = $("#editPost");
	
	var validator = addUserForm.validate({
		
		rules:{
            title :{ required : true },
			password : { required : true },
			opendate : { required : true},
		},
		messages:{
            title :{ required : "入力必須です" },
			password : { required : "入力必須です" },
			opendate : { required : "入力必須です" },
		}
	});


});
</script>
