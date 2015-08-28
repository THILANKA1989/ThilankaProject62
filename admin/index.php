<?php include '../core/init.php'; ?>
<?php include '../core/functions/checkadmin.php'; ?>
<?php if($admin == 0){
  header("location: ../home.php");
}else{?>
<head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="../assets/css/bootstrap.min.css" rel="stylesheet" media="screen">
        <link href='http://fonts.googleapis.com/css?family=Open+Sans:300,700,400,600' rel='stylesheet' type='text/css'>
        <link href="../assets/css/customized.css" rel="stylesheet" media="screen">
        <link href="../assets/css/animations.css" rel="stylesheet" media="screen">
        <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">
         <!-- AngularJs -->
        <script src="../assets/js/angular.min.js"></script>
        <script src="../assets/js/angular-resource.min.js"></script>
        <script src="../assets/js/angular-route.min.js"></script>
        <script src="../assets/js/app.js"></script>
</head>

<body ng-app="dash">

    <div id="wrapper">

        <!-- Sidebar -->
        <div id="sidebar-wrapper">

            <ul class="sidebar-nav">
                <li class="sidebar-brand">
                    <a href="#">
                        Administrator Account<br/>
                    </a>
                </li>
                <li>
                    <a href="#/"><i class="icon-dashboard icon-2"></i> Dashboard</a>
                </li>
                <li>
                    <a href="#/resources" class="resourceslinks">Resources</a>
                    <ul class="resourcelinks">
                        <li><a href="#">Books</a></li>
                        <li><a href="#">Newspapers</a></li>
                        <li><a href="#">Magazines</a></li>
                    </ul>
                </li>
                <li>
                    <a href="#/overview">Report</a>
                </li>
                <li>
                    <a href="#/lending">Lending</a>
                </li>
                <li>
                    <a href="#/members">Members</a>
                </li>
                <li>
                    <a href="#/payments">Returns & Payments</a>
                </li>

                <li>

                </li>
                <li>

                </li>
                <li>
                  <a href="../index.php">Go to Site</a>
                </li>
                <li>
                    <a href="../logout.php">LogOut</a>
                </li>
            </ul>
        </div>
        <!-- /#sidebar-wrapper -->

        <!-- Page Content -->
        <div id="page-content-wrapper">
            <div class="container-fluid" ng-view>

            </div>
        </div>
        <!-- /#page-content-wrapper -->

    </div>
    <!-- /#wrapper -->

    <!-- jQuery -->
    <script src="../assets/js/jquery.js"></script>
    <!-- Bootstrap Core JavaScript -->
    <!-- Menu Toggle Script -->
    <script>
    $("#menu-toggle").click(function(e) {
        e.preventDefault();
        $("#wrapper").toggleClass("toggled");
    });
    </script>
  <?php } ?>
</body>

</html>
