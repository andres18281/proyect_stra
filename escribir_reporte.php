<?php
session_start();
include_once "Controller/constante.php";
if(isset($_SESSION['tipo_user_'])){
 if($_SESSION['tipo_user_'] != sha1(empleados_stra)){
  header("location:login.php");
 }
}else{
	header("location:login.php");
}
?>


<!DOCTYPE html>
<!--[if IE 9 ]><html class="ie ie9" lang="en" class="no-js"> <![endif]-->
<!--[if !(IE)]><!-->
<html lang="en" class="no-js">
<!--<![endif]-->


<!-- Mirrored from demo.thedevelovers.com/dashboard/queenadmin-1.2/form-text-editor.html by HTTrack Website Copier/3.x [XR&CO'2014], Tue, 03 May 2016 15:34:53 GMT -->
<head>
	<title>Fancy Form Elements | QueenAdmin - Beautiful Admin Dashboard</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
	<meta name="description" content="QueenAdmin - Beautiful Bootstrap Admin Dashboard Theme">
	<meta name="author" content="The Develovers">
	<!-- CSS -->
	<link href="View/assets/css/bootstrap.css" rel="stylesheet" type="text/css">
	<link href="View/assets/css/ionicons.css" rel="stylesheet" type="text/css">
	<link href="View/assets/css/font-awesome.min.css" rel="stylesheet" type="text/css">
	<link href="View/assets/css/main.css" rel="stylesheet" type="text/css">
	<!-- Google Fonts -->
	<link href='../../../fonts.googleapis.com/css5e3b.css?family=Open+Sans:400italic,300,400,700' rel='stylesheet' type='text/css'>
	<!-- Fav and touch icons -->
	<link rel="apple-touch-icon-precomposed" type="image/png" sizes="144x144" href="View/assets/ico/queenadmin-favicon144x144.png">
	<link rel="apple-touch-icon-precomposed" type="image/png" sizes="114x114" href="View/assets/ico/queenadmin-favicon114x114.png">
	<link rel="apple-touch-icon-precomposed" type="image/png" sizes="72x72" href="View/assets/ico/queenadmin-favicon72x72.png">
	<link rel="apple-touch-icon-precomposed" type="image/png" sizes="57x57" href="View/assets/ico/queenadmin-favicon57x57.png">
	<link rel="shortcut icon" href="assets/ico/favicon.ico">
</head>

<body>
	<body class="fixed-top-active text-editor">
			<div class="container-fluid primary-content">
				<div class="widget">
					<div class="widget-header clearfix">
						<h3><i class="icon ion-compose"></i> <span>WYSIWYG Text Editor</span></h3>
						<div class="btn-group widget-header-toolbar visible-lg">
							<a href="#" title="Expand/Collapse" class="btn btn-link btn-toggle-expand"><i class="icon ion-ios-arrow-up"></i></a>
							<a href="#" title="Remove" class="btn btn-link btn-remove"><i class="icon ion-ios-close-empty"></i></a>
						</div>
					</div>
					<div class="widget-content no-padding">
						<div class="summernote">Hello there,
							<br/>
							<p>The toolbar can be customized and it also supports various callbacks such as <code>oninit</code>, <code>onfocus</code>, <code>onpaste</code> and many more.</p>
							<p>Please try <b>paste some texts</b> here</p>
						</div>
					</div>
					<div class="widget-footer">
						<button type="button" class="btn btn-primary"><i class="fa fa-floppy-o"></i> Save</button>
					</div>
				</div>
				<!-- END WYSIWYG EDITOR -->
				<!-- END MARKDOWN EDITOR -->
			</div>
	</body>
	<script src="View/assets/js/jquery/jquery-2.1.0.min.js"></script>
	<script src="View/assets/js/bootstrap/bootstrap.js"></script>
	<script src="View/assets/js/plugins/bootstrap-multiselect/bootstrap-multiselect.js"></script>
	<script src="View/assets/js/plugins/jquery-slimscroll/jquery.slimscroll.min.js"></script>
	<script src="View/assets/js/queen-common.js"></script>
	<script src="View/assets/js/plugins/summernote/summernote.min.js"></script>
	<script src="View/assets/js/plugins/markdown/markdown.js"></script>
	<script src="View/assets/js/plugins/markdown/to-markdown.js"></script>
	<script src="View/assets/js/plugins/markdown/bootstrap-markdown.js"></script>
	<script src="View/assets/js/queen-elements.js"></script>
</body>


<!-- Mirrored from demo.thedevelovers.com/dashboard/queenadmin-1.2/form-text-editor.html by HTTrack Website Copier/3.x [XR&CO'2014], Tue, 03 May 2016 15:35:02 GMT -->
</html>
