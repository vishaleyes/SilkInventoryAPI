<!DOCTYPE html>

<html lang="en" class="no-js">
<!--<![endif]-->
<!-- BEGIN HEAD -->
<head>
<meta charset="utf-8"/>
<title>Cloth App</title>
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta content="width=device-width, initial-scale=1.0" name="viewport"/>
<meta content="" name="description"/>
<meta content="" name="author"/>
<!-- BEGIN GLOBAL MANDATORY STYLES -->

<link href="http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700&subset=all" rel="stylesheet" type="text/css"/>
<link href="<?php echo Yii::app()->params->base_url ; ?>themefiles/assets/global/plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css"/>
<link href="<?php echo Yii::app()->params->base_url ; ?>themefiles/assets/global/plugins/simple-line-icons/simple-line-icons.min.css" rel="stylesheet" type="text/css"/>
<link href="<?php echo Yii::app()->params->base_url ; ?>themefiles/assets/global/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
<link href="<?php echo Yii::app()->params->base_url ; ?>themefiles/assets/global/plugins/uniform/css/uniform.default.css" rel="stylesheet" type="text/css"/>
<!-- END GLOBAL MANDATORY STYLES -->

<!-- BEGIN THEME STYLES -->
<link href="<?php echo Yii::app()->params->base_url ; ?>themefiles/assets/global/css/components.css" rel="stylesheet" type="text/css"/>
<link href="<?php echo Yii::app()->params->base_url ; ?>themefiles/assets/global/css/plugins.css" rel="stylesheet" type="text/css"/>
<link href="<?php echo Yii::app()->params->base_url ; ?>themefiles/assets/admin/layout/css/layout.css" rel="stylesheet" type="text/css"/>
<link id="style_color" href="<?php echo Yii::app()->params->base_url ; ?>themefiles/assets/admin/layout/css/themes/default.css" rel="stylesheet" type="text/css"/>
<link href="<?php echo Yii::app()->params->base_url ; ?>themefiles/assets/admin/layout/css/custom.css" rel="stylesheet" type="text/css"/>

<link rel="icon" href="<?php echo Yii::app()->params->base_url ; ?>themefiles/assets/admin/layout/img/logo_dashboard_whole.png" type="image/x-icon"/>

<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->params->base_url ; ?>themefiles/assets/global/plugins/select2/select2.css"/>
<link rel="stylesheet" href="<?php echo Yii::app()->params->base_url ; ?>themefiles/assets/global/plugins/data-tables/DT_bootstrap.css"/>


<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->params->base_url ; ?>themefiles/assets/global/plugins/bootstrap-wysihtml5/bootstrap-wysihtml5.css"/>
<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->params->base_url ; ?>themefiles/assets/global/plugins/bootstrap-markdown/css/bootstrap-markdown.min.css">
<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->params->base_url ; ?>themefiles/assets/global/plugins/bootstrap-datepicker/css/datepicker.css"/>

<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->params->base_url ; ?>themefiles/assets/global/plugins/bootstrap-datepicker/css/datepicker3.css"/>



<!-- END COPYRIGHT -->
<!-- BEGIN JAVASCRIPTS(Load javascripts at bottom, this will reduce page load time) -->
<!-- BEGIN CORE PLUGINS -->
<!--[if lt IE 9]>
	<script src="../../assets/global/plugins/respond.min.js"></script>
	<script src="../../assets/global/plugins/excanvas.min.js"></script> 
	<![endif]-->
<script src="<?php echo Yii::app()->params->base_url ; ?>themefiles/assets/global/plugins/jquery-1.11.0.min.js" type="text/javascript"></script>
<script src="<?php echo Yii::app()->params->base_url ; ?>themefiles/assets/global/plugins/jquery-migrate-1.2.1.min.js" type="text/javascript"></script>
<script src="<?php echo Yii::app()->params->base_url ; ?>themefiles/assets/global/plugins/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
<script src="<?php echo Yii::app()->params->base_url ; ?>themefiles/assets/global/plugins/bootstrap-hover-dropdown/bootstrap-hover-dropdown.min.js" type="text/javascript"></script>
<script src="<?php echo Yii::app()->params->base_url ; ?>themefiles/assets/global/plugins/jquery-slimscroll/jquery.slimscroll.min.js" type="text/javascript"></script>
<script src="<?php echo Yii::app()->params->base_url ; ?>themefiles/assets/global/plugins/jquery.blockui.min.js" type="text/javascript"></script>
<script src="<?php echo Yii::app()->params->base_url ; ?>themefiles/assets/global/plugins/jquery.cokie.min.js" type="text/javascript"></script>
<script src="<?php echo Yii::app()->params->base_url ; ?>themefiles/assets/global/plugins/uniform/jquery.uniform.min.js" type="text/javascript"></script>
<!-- END CORE PLUGINS -->



<script src="<?php echo Yii::app()->params->base_url ; ?>themefiles/assets/global/scripts/metronic.js" type="text/javascript"></script>
<script src="<?php echo Yii::app()->params->base_url ; ?>themefiles/assets/admin/layout/scripts/layout.js" type="text/javascript"></script>
<script src="<?php echo Yii::app()->params->base_url ; ?>themefiles/assets/admin/pages/scripts/index.js" type="text/javascript"></script>
<script src="<?php echo Yii::app()->params->base_url ; ?>themefiles/assets/admin/pages/scripts/tasks.js" type="text/javascript"></script>

<script type="text/javascript" src="<?php echo Yii::app()->params->base_url ; ?>themefiles/assets/global/plugins/select2/select2.min.js"></script>
<script type="text/javascript" src="<?php echo Yii::app()->params->base_url ; ?>themefiles/assets/global/plugins/data-tables/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="<?php echo Yii::app()->params->base_url ; ?>themefiles/assets/global/plugins/data-tables/DT_bootstrap.js"></script>
<script type="text/javascript" src="<?php echo Yii::app()->params->base_url ; ?>themefiles/assets/global/plugins/data-tables/tabletools/js/dataTables.tableTools.min.js"></script>
<script src="<?php echo Yii::app()->params->base_url ; ?>themefiles/assets/admin/pages/scripts/table-advanced.js">
</script>



<script type="text/javascript" src="<?php echo Yii::app()->params->base_url ; ?>themefiles/assets/global/plugins/jquery-validation/js/jquery.validate.min.js"></script>
<script type="text/javascript" src="<?php echo Yii::app()->params->base_url ; ?>themefiles/assets/global/plugins/jquery-validation/js/additional-methods.min.js"></script>


<script type="text/javascript" src="<?php echo Yii::app()->params->base_url ; ?>themefiles/assets/global/plugins/bootstrap-wysihtml5/wysihtml5-0.3.0.js"></script>
<script type="text/javascript" src="<?php echo Yii::app()->params->base_url ; ?>themefiles/assets/global/plugins/bootstrap-wysihtml5/bootstrap-wysihtml5.js"></script>
<script type="text/javascript" src="<?php echo Yii::app()->params->base_url ; ?>themefiles/assets/global/plugins/ckeditor/ckeditor.js"></script>
<script type="text/javascript" src="<?php echo Yii::app()->params->base_url ; ?>themefiles/assets/global/plugins/bootstrap-markdown/js/bootstrap-markdown.js"></script>
<script type="text/javascript" src="<?php echo Yii::app()->params->base_url ; ?>themefiles/assets/global/plugins/bootstrap-markdown/lib/markdown.js"></script>
<script src="<?php echo Yii::app()->params->base_url ; ?>themefiles/assets/admin/pages/scripts/form-validation.js"></script>

<script type="text/javascript" src="<?php echo Yii::app()->params->base_url ; ?>themefiles/assets/global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>
<script type="text/javascript" src="<?php echo Yii::app()->params->base_url ; ?>themefiles/assets/global/plugins/bootstrap-datetimepicker/js/bootstrap-datetimepicker.min.js"></script>
<script src="<?php echo Yii::app()->params->base_url ; ?>themefiles/assets/admin/pages/scripts/components-pickers.js"></script>


<script src="<?php echo Yii::app()->params->base_url ; ?>themefiles/assets/global/plugins/bootbox/bootbox.min.js" type="text/javascript"></script>

<script>
jQuery(document).ready(function() {    
   Metronic.init(); // init metronic core componets
   Layout.init(); // init layout
   Index.init(); 
    TableAdvanced.init();
   FormValidation.init();
    ComponentsPickers.init();
});
</script>

</head>



<?php if(isset(Yii::app()->session['pincab_admin']) && Yii::app()->session['pincab_admin']!='') { ?>
    <body class="page-header-fixed page-sidebar-fixed page-sidebar-closed-hide-logo">
        <!-- BEGIN HEADER -->
        <div class="page-header navbar navbar-fixed-top">
            <!-- BEGIN HEADER INNER -->
            <div class="page-header-inner">
                <!-- BEGIN LOGO -->
                <div class="page-logo" align="center" style="padding-left:0px !important;">
                    <a href="<?php echo Yii::app()->params->base_path ; ?>admin">
                    <img src="<?php echo Yii::app()->params->base_url ; ?>themefiles/assets/admin/layout/img/logo_dashboard.png" alt="logo" class="logo-default" style="margin-top:10px;"/>
                    </a>
                   <div class="menu-toggler sidebar-toggler">
				<!-- DOC: Remove the above "hide" to enable the sidebar toggler button on header -->
			</div>
		</div>
		<!-- END LOGO -->
		<!-- BEGIN RESPONSIVE MENU TOGGLER -->
		<div class="menu-toggler responsive-toggler" data-toggle="collapse" data-target=".navbar-collapse">
		</div>
		<!-- END RESPONSIVE MENU TOGGLER -->
                <!-- BEGIN TOP NAVIGATION MENU -->
                <div class="top-menu">
                    <ul class="nav navbar-nav pull-right">
                        <!-- BEGIN admin LOGIN DROPDOWN -->
                        <li class="dropdown dropdown-user">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
                <?php $url = "../api/pincab_profile/".Yii::app()->session['profile_image'];
				?>
               <img alt="" class="img-circle" height="28px" width="28px" src="assets/upload/avatar/admin/default.png"/>
                            
<!--                            echo Yii::app()->session['picture'];-->
                            <span class="username">
                            <?php echo Yii::app()->session['name'] ; ?> </span>
                            <i class="fa fa-angle-down"></i>
                            </a>
                            <ul class="dropdown-menu">
                                <li>
                                    <a href="<?php echo Yii::app()->params->base_path ; ?>admin/profile">
                                    <i class="fa fa-user"></i> My Profile </a>
                                </li>
                                <li>
                       <?php 
							if(isset(Yii::app()->session['logoutUrl']) && Yii::app()->session['logoutUrl'] != "")
							{
								$logoutUrl = Yii::app()->session['logoutUrl'];	
							}else{
								$logoutUrl = Yii::app()->params->base_path."admin/logout";
							}
						?>
                                    <a href="<?php echo $logoutUrl; ?>">
                                    <i class="fa fa-key"></i> Log Out </a>
                                </li>
                            </ul>
                        </li>
                        <!-- END admin LOGIN DROPDOWN -->
                        <!-- END admin LOGIN DROPDOWN -->
                    </ul>
                </div>
                <!-- END TOP NAVIGATION MENU -->
            </div>
            <!-- END HEADER INNER -->
        </div>
        <!-- END HEADER -->
        <div class="clearfix">
        </div>
        <!-- BEGIN CONTAINER -->
        <div class="page-container">
            <!-- BEGIN SIDEBAR -->
            <div class="page-sidebar-wrapper">
                <!-- DOC: Set data-auto-scroll="false" to disable the sidebar from auto scrolling/focusing -->
                <!-- DOC: Change data-auto-speed="200" to adjust the sub menu slide up/down speed -->
                <div class="page-sidebar navbar-collapse collapse">
                    <!-- BEGIN SIDEBAR MENU -->
                    <ul class="page-sidebar-menu" data-auto-scroll="false" data-auto-speed="200">
                        <!-- DOC: To remove the sidebar toggler from the sidebar you just need to completely remove the below "sidebar-toggler-wrapper" LI element -->
                       
                        <!-- DOC: To remove the search box from the sidebar you just need to completely remove the below "sidebar-search-wrapper" LI element -->
                        
                       
                        <li <?php if(isset(Yii::app()->session['active_tab']) && Yii::app()->session['active_tab'] == "Home") { ?> class="start active" <?php } ?> >
                            <a href="<?php echo Yii::app()->params->base_path ; ?>admin/adminHome">
                           <i class="fa fa-home"></i>
                            <span class="title">Home</span>
                            <span <?php if(isset(Yii::app()->session['active_tab']) && Yii::app()->session['active_tab'] == "Home") { ?> class="selected <?php } ?>"></span>
                            </a>
                        </li>
                       
                          <li <?php if(isset(Yii::app()->session['active_tab']) && Yii::app()->session['active_tab'] == "Profile") { ?> class="start active" <?php } ?> >
                            <a href="<?php echo Yii::app()->params->base_path ; ?>admin/profile">
                           <i class="fa fa-user"></i>
                            <span class="title">Profile</span>
                            <span <?php if(isset(Yii::app()->session['active_tab']) && Yii::app()->session['active_tab'] == "Profile") { ?> class="selected <?php } ?>"></span>
                            </a>
                        </li>
                  
                        <li <?php if(isset(Yii::app()->session['active_tab']) && Yii::app()->session['active_tab'] == "Patient") { ?> class="start active" <?php } ?> >
                            <a href="<?php echo Yii::app()->params->base_path ; ?>admin/patientListing">
                           <i class="fa fa-user"></i>
                            <span class="title">Patient</span>
                            <span <?php if(isset(Yii::app()->session['active_tab']) && Yii::app()->session['active_tab'] == "Patient") { ?> class="selected <?php } ?>"></span>
                            </a>
                        </li>
                        
                        
                        <li <?php if(isset(Yii::app()->session['active_tab']) && Yii::app()->session['active_tab'] == "Doctor") { ?> class="start active" <?php } ?> >
                            <a href="<?php echo Yii::app()->params->base_path ; ?>admin/doctorListing">
                           <i class="fa fa-user"></i>
                            <span class="title">Doctor</span>
                            <span <?php if(isset(Yii::app()->session['active_tab']) && Yii::app()->session['active_tab'] == "Doctor") { ?> class="selected <?php } ?>"></span>
                            </a>
                        </li>
                      
                        
                        <!-- BEGIN FRONTEND THEME LINKS -->
                        <!-- END FRONTEND THEME LINKS -->
                    </ul>
                    <!-- END SIDEBAR MENU -->
                </div>
            </div>
	<!-- END SIDEBAR -->
    <div class="page-content-wrapper">
    <div class="page-content">
 <?php } else { ?>   
 <body style="background-color:#FFF">
 <?php } ?>   	
		<div> 
      		<?php //echo Yii::app()->admin->setFlash('error', "adsfasdfasfsadf");?>
            <?php if(Yii::app()->user->hasFlash('success')): ?>	
          	<div class="alert alert-success">
			<button class="close" data-close="alert"></button>
                <span>
               <?php echo Yii::app()->user->getFlash('success'); ?> </span>
            </div>
            <div class="clear"></div>
            <?php endif; ?>
            <?php if(Yii::app()->user->hasFlash('error')): ?>
            <div class="alert alert-danger">
			<button class="close" data-close="alert"></button>
                <span>
               <?php echo Yii::app()->user->getFlash('error'); ?> </span>
            </div>
            <?php endif; ?>
         </div>
     

 <?php echo $content; ?>
 
 <div class="clearfix"></div>
 <?php if(isset(Yii::app()->session['pincab_admin']) && 
 Yii::app()->session['pincab_admin'] != "") { ?>
 </div>
    </div>
 	<!-- BEGIN FOOTER -->
    <div class="page-footer">
        <div class="page-footer-inner">
             <?php echo date("Y"); ?> &copy; Cloth APP.
            
        </div>
        <div class="page-footer-tools">
            <span class="go-top">
            <i class="fa fa-angle-up"></i>
            </span>
        </div>
        
    </div>
    <!-- END FOOTER -->
    
 <?php }else{ ?>
 	<!-- BEGIN COPYRIGHT -->
    <div class="copyright" style="text-align:center">
         <?php echo date("Y"); ?> &copy; Cloth APP.<br>
          
    </div>
 
    
    <!-- END JAVASCRIPTS -->    
 <?php } ?>
 </div>
 
 
</body>
</html>