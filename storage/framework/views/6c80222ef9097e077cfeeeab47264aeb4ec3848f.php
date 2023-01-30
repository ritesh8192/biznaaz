<?php $__env->startSection('content'); ?>
<script type="text/javascript">
    $(document).ready(function () {
        $.validator.addMethod("alphanumeric", function(value, element) {
            return this.optional(element) || /^[\w.]+$/i.test(value);
        }, "Only letters, numbers and underscore allowed.");
        $.validator.addMethod("passworreq", function (input) {
            var reg = /[0-9]/; //at least one number
            var reg2 = /[a-z]/; //at least one small character
            var reg3 = /[A-Z]/; //at least one capital character
            //var reg4 = /[\W_]/; //at least one special character
            return reg.test(input) && reg2.test(input) && reg3.test(input);
        }, "Password must be a combination of Numbers, Uppercase & Lowercase Letters.");
        $("#adminForm").validate();
    });
     function setImageDimension(val){
            if(val == 'logged_user'){
                $('.help-text').text(' Supported File Types: jpg, jpeg, png (Max. <?php echo e(MAX_BANNER_UPLOAD_SIZE_DISPLAY); ?>) (best resolution :988 x 233px).');
            } else if(val == 'visitor'){
                $('.help-text').text(' Supported File Types: jpg, jpeg, png (Max. <?php echo e(MAX_BANNER_UPLOAD_SIZE_DISPLAY); ?>) (best resolution :1920 x 659px).');
            } else {
                $('.help-text').text(' Supported File Types: jpg, jpeg, png (Max. <?php echo e(MAX_BANNER_UPLOAD_SIZE_DISPLAY); ?>).');
            }
            //alert(val);
            
        }
 </script>
 
<div class="content-wrapper">
    <section class="content-header">
        <h1>Edit Banner</h1>
        <ol class="breadcrumb">
            <li><a href="<?php echo e(URL::to('admin/admins/dashboard')); ?>"><i class="fa fa-dashboard"></i> <span>Dashboard</span></a></li>
            <li><a href="<?php echo e(URL::to('admin/banners')); ?>"><i class="fa fa-photo"></i> <span>Manage Banners</span></a></li>
            <li class="active"> Edit Banner</li>
        </ol>
    </section>
    <section class="content">
        <div class="box box-info">
            <div class="box-header with-border">
                <h3 class="box-title">&nbsp;</h3>
            </div>
            <div class="ersu_message"><?php echo $__env->make('elements.admin.errorSuccessMessage', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?></div>
            <?php echo e(Form::model($recordInfo, ['method' => 'post', 'id' => 'adminForm', 'enctype' => "multipart/form-data"])); ?>            
            <div class="form-horizontal">
                <div class="box-body">
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Select Banner Type <span class="require">*</span></label>
                        <div class="col-sm-10">
                            <?php $banner_type  = array('visitor'=>'Visitor', 'logged_user'=>'Logged User')?>
                            <?php echo e(Form::select('type', $banner_type,null, ['class' => 'form-control required','onchange' => 'setImageDimension(this.value)','placeholder' => 'Select Banner Type'])); ?>

                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Banner Title <span class="require"></span></label>
                        <div class="col-sm-10">
                            <?php echo e(Form::text('title', null, ['class'=>'form-control', 'placeholder'=>'Banner Title', 'autocomplete' => 'off'])); ?>

                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Banner Sub Title <span class="require"></span></label>
                        <div class="col-sm-10">
                            <?php echo e(Form::text('subtitle', null, ['class'=>'form-control', 'placeholder'=>'Banner Sub Title', 'autocomplete' => 'off'])); ?>

                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Banner Image <span class="require"></span></label>
                        <div class="col-sm-10">
                            <?php echo e(Form::file('name', ['class'=>'form-control', 'accept'=>IMAGE_EXT])); ?>

                            <span class="help-text"> Supported File Types: jpg, jpeg, png (Max. <?php echo e(MAX_BANNER_UPLOAD_SIZE_DISPLAY); ?>) (best resolution :1920 x 659px).</span>
                             <?php if($recordInfo->name != ''): ?>
                                <div class="showeditimage"><?php echo e(HTML::image(BANNER_DISPLAY_PATH.$recordInfo->name, SITE_TITLE,['style'=>"max-width: 200px"])); ?></div>
                             <?php endif; ?>
                        </div>
                    </div>         
                    
                    
                    <div class="box-footer">
                        <label class="col-sm-2 control-label" for="inputPassword3">&nbsp;</label>
                        <?php echo e(Form::submit('Submit', ['class' => 'btn btn-info'])); ?>

                        <a href="<?php echo e(URL::to( 'admin/banners')); ?>" title="Cancel" class="btn btn-default canlcel_le">Cancel</a>
                    </div>
                </div>
            </div>
            <?php echo e(Form::close()); ?>

        </div>
    </section>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.admin', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>