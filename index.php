
<?php
  include_once 'init/config.php'; 

  if(!empty($_GET['status'])){ 
    switch($_GET['status']){ 
        case 'Success': 
            $statusType = 'alert-success'; 
            $statusMsg = 'Member data has been imported successfully.'; 
            break; 
        case 'Fail': 
            $statusType = 'alert-danger'; 
            $statusMsg = 'Something went wrong, please try again.'; 
            break; 
        case 'Invalid_File': 
            $statusType = 'alert-danger'; 
            $statusMsg = 'Please upload a valid Excel file.'; 
            break; 
        case 'Wrong':
            $statusType = 'alert-danger'; 
            $statusMsg = 'Something wrong, please try again.'; 
            break; 
        default: 
            $statusType = ''; 
            $statusMsg = ''; 
    } 
} 
?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>ocp- Dashboard</title>
    <link rel="performance" type="png" href="img/logo_pakmaroc.png">

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">
    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.css" rel="stylesheet">

</head>

<body id="page-top">
   <?php
   $sqlDiStatut = "select distinct DI_Status from di;";
   $sqlDiValue = "SELECT
   COUNT(*) AS Total,
        (SUM(CASE WHEN DI_Status = 'Terminé' THEN 1 ELSE 0 END) / COUNT(*))*100  AS Termine,
        (SUM(CASE WHEN DI_Status = 'Sur ordre de travail' THEN 1 ELSE 0 END)/count(*))*100 AS Sur_ordre_de_travail,
        (SUM(CASE WHEN DI_Status = 'En attente d\'ordre de travail' THEN 1 ELSE 0 END)/count(*))*100 AS En_attente_ordre_de_travail,
        (SUM(CASE WHEN DI_Status = 'Ouverte' THEN 1 ELSE 0 END)/count(*))*100 AS Ouverte,
        (SUM(CASE WHEN DI_Status = 'Rejeté' THEN 1 ELSE 0 END)/count(*))*100 AS Rejete
    FROM di;";
   $resultDiStatus = $con->query($sqlDiStatut);
   $statusArray = array();
    while ($row = $resultDiStatus->fetch_assoc()) {
        $statusArray[] = $row['DI_Status'];       
    }
    /////////////////////////// values of di
    $resultDiValues = $con->query($sqlDiValue);
    $row = $resultDiValues->fetch_assoc();
    $statusValueArray = "[".$row["Termine"].", ".$row["Sur_ordre_de_travail"].",".$row["En_attente_ordre_de_travail"].",".$row["Rejete"].",".$row["Ouverte"]."]";
    echo json_encode($statusValueArray)
   ?>
 
    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.php">
                 <div class="sidebar-brand-icon rotate-n-15">
                   <!--<img src="img/logo_pakmaroc.png" alt="PAKMAROC"> --> 
                    <i class=></i>
                </div>
                <div class="sidebar-brand-text mx-3">PAKMAROC <sup></sup></div>
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <!-- Nav Item - Dashboard -->
            <li class="nav-item active">
                <a class="nav-link" href="index.php">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Dashboard</span></a>
            </li>
            <form action="ImportFileOt.php" enctype="multipart/form-data" method="post">
                <li class="nav-item active">
                    <input  type="file" id="InputExcel" name="InputExcel" value="" style="display:none"/>
                    <a  id="ImportBtn" name="ImportBtn" style="background-color: inherit; border: inherit;" class="nav-link" href="">
                        <i class="fas fa-fw fa-tachometer-alt"></i>
                        <span>Import OT</span>
                    </a>
                    <input type="submit" name="ImportBtnPhpOt" id="ImportBtnPhpOt" value="ImportBtnPhpOt" style="display: none;">
                </li>
            </form>
            <form action="ImportFileDi.php" enctype="multipart/form-data" method="post">
                <li class="nav-item active">
                    <input  type="file" id="InputExcelDi" name="InputExcelDi" value="" style="display:none"/>
                    <a  id="ImportBtnDi" name="ImportBtnDi" style="background-color: inherit; border: inherit;" class="nav-link" href="">
                        <i class="fas fa-fw fa-tachometer-alt"></i>
                        <span>Import Di</span>
                    </a>
                    <input type="submit" name="ImportBtnPhpDi" id="ImportBtnPhpDi" value="ImportBtnPhpDi" style="display: none;">
                </li>
            </form>
            

            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Heading -->
            <div class="sidebar-heading">
                Interface
            </div>

            <!-- Nav Item - Pages Collapse Menu -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo"
                    aria-expanded="true" aria-controls="collapseTwo">
                    <i class="fas fa-fw fa-cog"></i>
                    <span>RAPPORT</span>
                </a>
               <!-- <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Custom Components:</h6>
                        <a class="collapse-item" href="buttons.html">Buttons</a>
                        <a class="collapse-item" href="cards.html">Cards</a>
                    </div>
                </div>--> 
            </li>

            <!-- Nav Item - Utilities Collapse Menu -->
        

            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Heading -->
            <div class="sidebar-heading">
                Addons
            </div>

            <!-- Nav Item - Pages Collapse Menu -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePages"
                    aria-expanded="true" aria-controls="collapsePages">
                    <i class="fas fa-fw fa-folder"></i>
                    <span>account</span>
                </a>
                <div id="collapsePages" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Login Screens:</h6>
                        <a class="collapse-item" href="login.html">Login</a>
                        <a class="collapse-item" href="register.html">Register</a>
                        <a class="collapse-item" href="forgot-password.html">Forgot Password</a>
                        <div class="collapse-divider"></div>
                        
                    </div>
                </div>
            </li>

            <!-- Nav Item - Charts -->
            <li class="nav-item">
                <a class="nav-link" href="charts.html">
                    <i class="fas fa-fw fa-chart-area"></i>
                    <span>performance</span></a>
            </li>

            <!-- Nav Item - Tables -->
            <li class="nav-item">
                <a class="nav-link" href="tables.html">
                    <i class="fas fa-fw fa-table"></i>
                    <span>Tables</span></a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider d-none d-md-block">

            <!-- Sidebar Toggler (Sidebar) -->
            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>

            <!-- Sidebar Message -->
         

        </ul>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

                    <!-- Sidebar Toggle (Topbar) -->
                    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                        <i class="fa fa-bars"></i>
                    </button>

                    <!-- Topbar Search -->
                    <form
                        class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search">
                        <div class="input-group">
                            <input type="text" class="form-control bg-light border-0 small" placeholder="Search for..."
                                aria-label="Search" aria-describedby="basic-addon2">
                            <div class="input-group-append">
                                <button class="btn btn-primary" type="button">
                                    <i class="fas fa-search fa-sm"></i>
                                </button>
                            </div>
                        </div>
                    </form>

                    <!-- Topbar Navbar -->
                    <ul class="navbar-nav ml-auto">

                        <!-- Nav Item - Search Dropdown (Visible Only XS) -->
                        <li class="nav-item dropdown no-arrow d-sm-none">
                            <a class="nav-link dropdown-toggle" href="#" id="searchDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-search fa-fw"></i>
                            </a>
                            <!-- Dropdown - Messages -->
                            <div class="dropdown-menu dropdown-menu-right p-3 shadow animated--grow-in"
                                aria-labelledby="searchDropdown">
                                <form class="form-inline mr-auto w-100 navbar-search">
                                    <div class="input-group">
                                        <input type="text" class="form-control bg-light border-0 small"
                                            placeholder="Search for..." aria-label="Search"
                                            aria-describedby="basic-addon2">
                                        <div class="input-group-append">
                                            <button class="btn btn-primary" type="button">
                                                <i class="fas fa-search fa-sm"></i>
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </li>

                        <!-- Nav Item - Alerts -->
                        <li class="nav-item dropdown no-arrow mx-1">
                            <a class="nav-link dropdown-toggle" href="#" id="alertsDropdown" role="button"
                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> Reports </a>
                            <div class="dropdown-menu navbar-dropdown" aria-labelledby="reportDropdown">
                              <a class="dropdown-item" href="#">
                                <i class="mdi mdi-file-pdf me-2"></i>PDF </a>
                              <div class="dropdown-divider"></div>
                              <a class="dropdown-item" href="#">
                                <i class="mdi mdi-file-excel me-2"></i>Excel </a>
                              <div class="dropdown-divider"></div>
                              <a class="dropdown-item" href="#">
                                <i class="mdi mdi-file-word me-2"></i>doc </a>
                            </div>
                          </li>
                        <li class="nav-item dropdown no-arrow mx-1">
                            <a class="nav-link dropdown-toggle" href="#" id="alertsDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-bell fa-fw"></i>
                                <!-- Counter - Alerts -->
                                <span class="badge badge-danger badge-counter">3+</span>
                            </a>
                            <!-- Dropdown - Alerts -->
                            <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                aria-labelledby="alertsDropdown">
                                <h6 class="dropdown-header">
                                    Alerts Center
                                </h6>
                                <a class="dropdown-item d-flex align-items-center" href="#">
                                    <div class="mr-3">
                                        <div class="icon-circle bg-primary">
                                            <i class="fas fa-file-alt text-white"></i>
                                        </div>
                                    </div>
                                    <div>
                                        <div class="small text-gray-500">December 12, 2019</div>
                                        <span class="font-weight-bold">A new monthly report is ready to download!</span>
                                    </div>
                                </a>
                                <a class="dropdown-item d-flex align-items-center" href="#">
                                    <div class="mr-3">
                                        <div class="icon-circle bg-success">
                                            <i class="fas fa-donate text-white"></i>
                                        </div>
                                    </div>
                                    <div>
                                        <div class="small text-gray-500">December 7, 2019</div>
                                        $290.29 has been deposited into your account!
                                    </div>
                                </a>
                                <a class="dropdown-item d-flex align-items-center" href="#">
                                    <div class="mr-3">
                                        <div class="icon-circle bg-warning">
                                            <i class="fas fa-exclamation-triangle text-white"></i>
                                        </div>
                                    </div>
                                    <div>
                                        <div class="small text-gray-500">December 2, 2019</div>
                                        Spending Alert: We've noticed unusually high spending for your account.
                                    </div>
                                </a>
                                <a class="dropdown-item text-center small text-gray-500" href="#">Show All Alerts</a>
                            </div>
                        </li>

                        <!-- Nav Item - Messages -->
                        <li class="nav-item dropdown no-arrow mx-1">
                            <a class="nav-link dropdown-toggle" href="#" id="messagesDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-envelope fa-fw"></i>
                                <!-- Counter - Messages -->
                                <span class="badge badge-danger badge-counter">7</span>
                            </a>
                            <!-- Dropdown - Messages -->
                            <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                aria-labelledby="messagesDropdown">
                                <h6 class="dropdown-header">
                                    Message Center
                                </h6>
                                <a class="dropdown-item d-flex align-items-center" href="#">
                                    <div class="dropdown-list-image mr-3">
                                        <img class="rounded-circle" src="img/undraw_profile_1.svg"
                                            alt="...">
                                        <div class="status-indicator bg-success"></div>
                                    </div>
                                    <div class="font-weight-bold">
                                        <div class="text-truncate">Hi there! I am wondering if you can help me with a
                                            problem I've been having.</div>
                                        <div class="small text-gray-500">Emily Fowler · 58m</div>
                                    </div>
                                </a>
                                <a class="dropdown-item d-flex align-items-center" href="#">
                                    <div class="dropdown-list-image mr-3">
                                        <img class="rounded-circle" src="img/undraw_profile_2.svg"
                                            alt="...">
                                        <div class="status-indicator"></div>
                                    </div>
                                    <div>
                                        <div class="text-truncate">I have the photos that you ordered last month, how
                                            would you like them sent to you?</div>
                                        <div class="small text-gray-500">Jae Chun · 1d</div>
                                    </div>
                                </a>
                                <a class="dropdown-item d-flex align-items-center" href="#">
                                    <div class="dropdown-list-image mr-3">
                                        <img class="rounded-circle" src="img/undraw_profile_3.svg"
                                            alt="...">
                                        <div class="status-indicator bg-warning"></div>
                                    </div>
                                    <div>
                                        <div class="text-truncate">Last month's report looks great, I am very happy with
                                            the progress so far, keep up the good work!</div>
                                        <div class="small text-gray-500">Morgan Alvarez · 2d</div>
                                    </div>
                                </a>
                                <a class="dropdown-item d-flex align-items-center" href="#">
                                    <div class="dropdown-list-image mr-3">
                                        <img class="rounded-circle" src="https://source.unsplash.com/Mv9hjnEUHR4/60x60"
                                            alt="...">
                                        <div class="status-indicator bg-success"></div>
                                    </div>
                                    <div>
                                        <div class="text-truncate">Am I a good boy? The reason I ask is because someone
                                            told me that people say this to all dogs, even if they aren't good...</div>
                                        <div class="small text-gray-500">Chicken the Dog · 2w</div>
                                    </div>
                                </a>
                                <a class="dropdown-item text-center small text-gray-500" href="#">Read More Messages</a>
                            </div>
                        </li>

                        <div class="topbar-divider d-none d-sm-block"></div>

                        <!-- Nav Item - User Information -->
                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="mr-2 d-none d-lg-inline text-gray-600 small">shaymaa el KHADRAOUI</span>
                                <img class="img-profile rounded-circle"
                                    src="img/undraw_profile.svg">
                            </a>
                            <!-- Dropdown - User Information -->
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                aria-labelledby="userDropdown">
                                <a class="dropdown-item" href="#">
                                    <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Profile
                                </a>
                                <a class="dropdown-item" href="#">
                                    <i class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Settings
                                </a>
                                <a class="dropdown-item" href="#">
                                    <i class="fas fa-list fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Activity Log
                                </a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Logout
                                </a>
                            </div>
                        </li>

                    </ul>

                </nav>
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800">
                            <img src="img/logo_pakmaroc.png" alt="Description of the image" width="150" height="100"></h1>
                                                                
                            <div class="d-xl-flex justify-content-between align-items-start">
                                                      
                                <div class="d-sm-flex justify-content-xl-between align-items-center mb-2">
                                    
                                        <a class="nav-link dropdown-toggle" id="reportDropdown" role="button"
                                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <i class="fas fa"></i> section </a>
                                        <div class="dropdown-menu navbar-dropdown" aria-labelledby="reportDropdown">
                                          <a class="dropdown-item" href="#">
                                            <i class="mdi mdi-file-pdf me-2"></i>Mecanique Phosphorique </a>
                                          <div class="dropdown-divider"></div>
                                          <a class="dropdown-item" href="#">
                                            <i class="mdi mdi-file-excel me-2"></i>Mecanique Sulfurique</a>
                                          <div class="dropdown-divider"></div>
                                          <a class="dropdown-item" href="#">
                                            <i class="mdi mdi-file-word me-2"></i>Inspection Mecanique  Phosphorique  </a>
                                            <div class="dropdown-divider"></div>
                                          <a class="dropdown-item" href="#">
                                            <i class="mdi mdi-file-word me-2"></i>Genie Civil </a>
                                            <div class="dropdown-divider"></div>
                                          <a class="dropdown-item" href="#">
                                            <i class="mdi mdi-file-word me-2"></i>Instrumentation Sulfurique </a>
                                            <div class="dropdown-divider"></div>
                                          <a class="dropdown-item" href="#">
                                            <i class="mdi mdi-file-word me-2"></i>Instrumentation Phosphorique  </a>
                                            <div class="dropdown-divider"></div>
                                          <a class="dropdown-item" href="#">
                                            <i class="mdi mdi-file-word me-2"></i>Electrique Phosphorique  </a>
                                            <div class="dropdown-divider"></div>
                                          <a class="dropdown-item" href="#">
                                            <i class="mdi mdi-file-word me-2"></i> Electrique Sulfurique</a>
                                          
                                        </div>
                                  <div class="btn-group bg-white p-3" role="group" aria-label="Basic example">
                                    <button type="button" class="btn btn-link text-gray py-0 border-right">7 Days</button>
                                    <button type="button" class="btn btn-link text-dark py-0 border-right">1 Month</button>
                                    <button type="button" class="btn btn-link text-gray py-0">6 Month</button>
                                  </div>
                                  <div class="dropdown ms-0 ml-md-4 mt-2 mt-lg-0">
                                    <button class="btn bg-white dropdown-toggle p-3 d-flex align-items-center" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="mdi mdi-calendar me-1"></i>24 Mar 2019 - 24 Mar 2019 </button>
                                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuButton1">
                                      <h6 class="dropdown-header">Settings</h6>
                                      <a class="dropdown-item" href="#">Action</a>
                                      <a class="dropdown-item" href="#">Another action</a>
                                      <a class="dropdown-item" href="#">Something else here</a>
                                      <div class="dropdown-divider"></div>
                                      <a class="dropdown-item" href="#">Separated link</a>
                                    </div>
                                  </div>
                                  
                                </div>
                              </div>
                    </div>
                    <?php 
                    if(!empty($statusMsg)){ ?>
                            <div class="col-xs-12 p-3">
                                <div class="alert <?php echo $statusType; ?>"><?php echo $statusMsg; ?></div>
                            </div>
                            <?php } 
                            ?>
                    <!-- Content Row -->
                    <div class="row">

                        <!-- Earnings (Monthly) Card Example -->
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-primary shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                                <a class ="text-xs font-weight-bold text-primary text-uppercase mb-1" href="execution.php">Execution</a>
                                                  </div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800">70%</div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-calendar fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Earnings (Monthly) Card Example -->
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-success shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1" >
                                                <a class="text-xs font-weight-bold text-success text-uppercase mb-1" href="prepration.html">  Perparation </a>
                                               </div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800">60%</div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Earnings (Monthly) Card Example -->
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-info shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                                                <a class="text-xs font-weight-bold text-info text-uppercase mb-1" href="planfication.html">Planfication</a> 
                                            </div>
                                            <div class="row no-gutters align-items-center">
                                                <div class="col-auto">
                                                    <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">50%</div>
                                                </div>
                                                <div class="col">
                                                    <div class="progress progress-sm mr-2">
                                                        <div class="progress-bar bg-info" role="progressbar"
                                                            style="width: 50%" aria-valuenow="50" aria-valuemin="0"
                                                            aria-valuemax="100"></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Pending Requests Card Example -->
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-success shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1" >
                                                <a class="text-xs font-weight-bold text-success text-uppercase mb-1" href="inspction.html">  Inspection  </a>
                                               </div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800">60%</div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Content Row -->

                    <div class="row">

                        <!-- Area Chart -->
                        <div class="col-xl-12 col-lg-12">
                            <div class="card shadow mb-4">
                                <!-- Card Header - Dropdown -->
                                <div
                                    class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                    <h6 class="m-0 font-weight-bold text-primary">Evolution DI/OT </h6>
                                    <div class="dropdown no-arrow">
                                        <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink"
                                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                                        </a>
                                        <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in"
                                            aria-labelledby="dropdownMenuLink">
                                            <div class="dropdown-header">Dropdown Header:</div>
                                            <a class="dropdown-item" href="#">Action</a>
                                            <a class="dropdown-item" href="#">Another action</a>
                                            <div class="dropdown-divider"></div>
                                            <a class="dropdown-item" href="#">Something else here</a>
                                        </div>
                                    </div>
                                </div>
                                <!-- Card Body -->
                                <div class="card-body">
                                    <div class="chart-area">
                                        <canvas id="myAreaChart"></canvas>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Pie Chart -->
                    <div class="row">
                        <div class="col-xl-6 col-lg-6">
                            <div class="card shadow mb-4">
                                <!-- Card Header - Dropdown -->
                                <div
                                    class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                    <h6 class="m-0 font-weight-bold text-primary">Statut des DI </h6>
                                    <div class="dropdown no-arrow">
                                        <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink"
                                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                                        </a>
                                        <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in"
                                            aria-labelledby="dropdownMenuLink">
                                            <form action="" method="post">
                                            <div class="dropdown-header">Dropdown Header:</div>
                                            <a class="dropdown-item" href="#">Action</a>
                                            <a class="dropdown-item" href="#">Another action</a>
                                            <div class="dropdown-divider"></div>
                                            <a class="dropdown-item" href="#">Something else here</a>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                <!-- Card Body Of DI -->
                                <div class="card-body row">
                                    <div class="chart-pie pt-4 pb-2 col-md-7">
                                        <canvas class="DI" id="DiChart"></canvas>
                                    </div>
                                    <div class="mt-5 text-left small col-md-5">
                                        <h5 class="flot-auto">Status DI</h5>
                                        <span class="mr-2 d-block py-1">
                                            <i class="fas fa-circle text-info "></i> Terminé
                                        </span>
                                       <span class="mr-2 d-block py-1">
                                            <i class="fas fa-circle text-primary "></i> Sur Ordre de trav...
                                        </span>
                                        <span class="mr-2 d-block py-1">
                                            <i class="fas fa-circle" style="color:rgb(199, 131, 4)"></i> En Attente d'ord...
                                        </span>
                                        <span class="mr-2 d-block py-1">
                                            <i class="fas fa-circle"  style="color:purple"></i> ouverte
                                        </span>
                                        <span class="mr-2 d-block py-1">
                                            <i class="fas fa-circle" style="color:rgb(253, 64, 95)"></i> Rejecté
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-6 col-lg-6">
                            <div class="card shadow mb-4">
                                <!-- Card Header - Dropdown -->
                                <div
                                    class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                    <h6 class="m-0 font-weight-bold text-primary"> Statut des OT</h6>
                                    <div class="dropdown no-arrow">
                                        <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink"
                                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                                        </a>
                                        <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in"
                                            aria-labelledby="dropdownMenuLink">
                                            <div class="dropdown-header">Dropdown Header:</div>
                                            <a class="dropdown-item" href="#">Action</a>
                                            <a class="dropdown-item" href="#">Another action</a>
                                            <div class="dropdown-divider"></div>
                                            <a class="dropdown-item" href="#">Something else here</a>
                                        </div>
                                    </div>
                                </div>
                                <!-- Card Body -->
                                <div class="card-body row">
                                    <div class="chart-pie pt-4 pb-2 col-md-7">
                                        <canvas id="ChartOt"></canvas>
                                    </div>
                                    <div class="mt-5 text-left small col-md-5">
                                        <h6 class="flot-auto">Cause de non réalisa...</h6>
                                        <span class="mr-2 d-block py-1">
                                            <i class="fas fa-circle text-info "></i> Indisponsabilité...
                                        </span>
                                       <span class="mr-2 d-block py-1">
                                            <i class="fas fa-circle text-primary "></i> Indisponsabilité...
                                        </span>
                                        <span class="mr-2 d-block py-1">
                                            <i class="fas fa-circle" style="color:rgb(199, 131, 4)"></i> Nécessite arrêt...
                                        </span>
                                        <span class="mr-2 d-block py-1">
                                            <i class="fas fa-circle"  style="color:purple"></i> Nécessite arrêt...
                                        </span>
                                        <span class="mr-2 d-block py-1">
                                            <i class="fas fa-circle" style="color:rgb(253, 64, 95)"></i> Non mentionné
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-xl-6 col-lg-6">
                            <div class="card shadow mb-4">
                                <!-- Card Header - Dropdown -->
                                <div
                                    class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                    <h6 class="m-0 font-weight-bold text-primary">Taux du préventif</h6>
                                    <div class="dropdown no-arrow">
                                        <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink"
                                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                                        </a>
                                        <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in"
                                            aria-labelledby="dropdownMenuLink">
                                            <div class="dropdown-header">Dropdown Header:</div>
                                            <a class="dropdown-item" href="#">Action</a>
                                            <a class="dropdown-item" href="#">Another action</a>
                                            <div class="dropdown-divider"></div>
                                            <a class="dropdown-item" href="#">Something else here</a>
                                        </div>
                                    </div>
                                </div>
                                <!-- Card Body -->
                                <div class="card-body row">
                                    <div class="chart-pie pt-4 pb-2 col-md-7">
                                        <canvas id="ChartTauxPreventif"></canvas>
                                    </div>
                                    <div class="mt-5 text-left small col-md-5">
                                        <h5 class="flot-auto">Status </h5>
                            
                                        <span class="mr-2 d-block py-1">
                                            <i class="fas fa-circle"  style="color:#055255"></i> Total TO (preventif)
                                        </span>
                                        <span class="mr-2 d-block py-1">
                                            <i class="fas fa-circle" style="color:#ADC2AD"></i> Total OT 
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-6 col-lg-6">
                            <div class="card shadow mb-4">
                                <!-- Card Header - Dropdown -->
                                <div
                                    class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                    <h6 class="m-0 font-weight-bold text-primary"> Taux d'imprévus</h6>
                                    <div class="dropdown no-arrow">
                                        <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink"
                                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                                        </a>
                                        <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in"
                                            aria-labelledby="dropdownMenuLink">
                                            <div class="dropdown-header">Dropdown Header:</div>
                                            <a class="dropdown-item" href="#">Action</a>
                                            <a class="dropdown-item" href="#">Another action</a>
                                            <div class="dropdown-divider"></div>
                                            <a class="dropdown-item" href="#">Something else here</a>
                                        </div>
                                    </div>
                                </div>
                                <!-- Card Body -->
                                <div class="card-body row">
                                    <div class="chart-pie pt-4 pb-2 col-md-7">
                                        <canvas id="ChartTauxImprevus"></canvas>
                                    </div>
                                    <div class="mt-5 text-left small col-md-5">
                                        <h6 class="flot-auto">Statut</h6>
                                    
                                        <span class="mr-2 d-block py-1">
                                            <i class="fas fa-circle"  style="color:#8E3258"></i> OT non planifies 
                                        <span class="mr-2 d-block py-1">
                                            <i class="fas fa-circle" style="color:#CEA26B"></i> Total OT 
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Content Row -->
                    <div class="row">
                        
                                <!-- Card Header - Dropdown -->
                         
                                <!-- Card Body -->
                             
                         

                        <!-- Content Column -->
                        <div class="col-lg-6 mb-4">

                            <!-- Project Card Example -->
                           <!-- <div class="card shadow mb-4">
                                <div class="card-header py-3">
                                    <h6 class="m-0 font-weight-bold text-primary">Taux de Realisation Travaeu Planifie par section </h6>
                                </div>
                                <div class="card-body">
                                    <h4 class="small font-weight-bold">Mecanique Phosphorique<span
                                        class="float-right">20%</span></h4>
                                <div class="progress mb-4">
                                    <div class="progress-bar bg-danger" role="progressbar" style="width: 20%"
                                        aria-valuenow="20" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                                <h4 class="small font-weight-bold">Mecanique Sulfurique<span
                                    class="float-right">20%</span></h4>
                            <div class="progress mb-4">
                                <div class="progress-bar bg-danger" role="progressbar" style="width: 20%"
                                    aria-valuenow="20" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                                <h4 class="small font-weight-bold">Inspection Mecanique  Sulfurique  <span
                                        class="float-right">40%</span></h4>
                                <div class="progress mb-4">
                                    <div class="progress-bar bg-warning" role="progressbar" style="width: 40%"
                                        aria-valuenow="40" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                                <h4 class="small font-weight-bold">Inspection Mecanique  Phosphorique  <span
                                    class="float-right">60%</span></h4>
                            <div class="progress mb-4">
                                <div class="progress-bar" role="progressbar" style="width: 60%"
                                    aria-valuenow="60" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                            <h4 class="small font-weight-bold">Genie Civil <span
                                class="float-right">60%</span></h4>
                        <div class="progress mb-4">
                            <div class="progress-bar" role="progressbar" style="width: 60%"
                                aria-valuenow="60" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                            <h4 class="small font-weight-bold">Instrumentation Sulfurique  <span
                                class="float-right">60%</span></h4>
                        <div class="progress mb-4">
                            <div class="progress-bar" role="progressbar" style="width: 60%"
                                aria-valuenow="60" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                                <h4 class="small font-weight-bold">Instrumentation Phosphorique  <span
                                        class="float-right">60%</span></h4>
                                <div class="progress mb-4">
                                    <div class="progress-bar" role="progressbar" style="width: 60%"
                                        aria-valuenow="60" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                                <h4 class="small font-weight-bold">Electrique Phosphorique <span
                                        class="float-right">80%</span></h4>
                                <div class="progress mb-4">
                                    <div class="progress-bar bg-info" role="progressbar" style="width: 80%"
                                        aria-valuenow="80" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                                <h4 class="small font-weight-bold">Electrique Sulfurique <span
                                        class="float-right">Complete!</span></h4>
                                <div class="progress">
                                    <div class="progress-bar bg-success" role="progressbar" style="width: 100%"
                                        aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                                </div>
                                
                            </div>-->
               

                            <!-- Color System -->
                           
                        <!----------------------------------------------------------------------------------------->
          

                        <div class="col-lg-6 mb-4">

                            <!-- Illustrations -->
                            
                               <!-- </div>
                                <div class="card-body">
                                    <div class="text-center">
                                        <img class="img-fluid px-3 px-sm-4 mt-3 mb-4" style="width: 25rem;"
                                            src="img/undraw_posting_photo.svg" alt="...">
                                    </div>
                                    <p>Add some quality, svg illustrations to your project courtesy of <a
                                            target="_blank" rel="nofollow" href="https://undraw.co/">unDraw</a>, a
                                        constantly updated collection of beautiful svg images that you can use
                                        completely free and without attribution!</p>
                                    <a target="_blank" rel="nofollow" href="https://undraw.co/">Browse Illustrations on
                                        unDraw &rarr;</a>
                                </div> 
                            </div>

                            <! Approach -->
                           <!-- <div class="card shadow mb-4">
                                <div class="card-header py-3">
                                    <h6 class="m-0 font-weight-bold text-primary">Development Approach</h6>
                                </div>
                                <div class="card-body">
                                    <p>SB Admin 2 makes extensive use of Bootstrap 4 utility classes in order to reduce
                                        CSS bloat and poor page performance. Custom CSS classes are used to create
                                        custom components and custom utility classes.</p>
                                    <p class="mb-0">Before working with this theme, you should become familiar with the
                                        Bootstrap framework, especially the utility classes.</p>
                                </div> -->
                            </div>

                        </div>
                    </div>

                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

            <!-- Footer -->
            <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>BY SHAYMAA EL KHADRAOUI  &copy; Your Website 2023</span>
                    </div>
                </div>
            </footer>
            <!-- End of Footer -->

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
                <div clas;s="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <a class="btn btn-primary" href="login.html">Logout</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin-2.min.js"></script>

    <!-- Page level plugins -->
    <script src="vendor/chart.js/Chart.min.js"></script>

    <!-- Page level custom scripts -->
    <script src="js/demo/chart-area-demo.js"></script>
    <script src="js/demo/chart-pie-demo.js"></script>
    <script src="js/demo/chart-bar-demo.js"></script>
    <script>
        // Import Ot
        const fileInput = document.getElementById('InputExcel');
        const uploadButton = document.getElementById('ImportBtn');
        let ImportBtnPhpOt =document.getElementById("ImportBtnPhpOt");
        uploadButton.addEventListener('click', (e) => {
            e.preventDefault();
            fileInput.click();
        });
        fileInput.addEventListener('change', (e) => {
           e.preventDefault();
           
            const fileName = fileInput.files[0].name;
            if(!fileName.toLowerCase().includes("ot")){
                window.alert("The file is not OT !!!!!!!");
                console.log("the form not submited")
                return;
            }else{
                console.log("the form is submited : "+fileName)
                ImportBtnPhpOt.click();
            }
            
        });
        // ------------------------------
        // Import DI
        // Import Ot
        const fileInputDi = document.getElementById('InputExcelDi');
        const uploadButtonDi = document.getElementById('ImportBtnDi');
        let ImportBtnPhpDi =document.getElementById("ImportBtnPhpDi");
        uploadButtonDi.addEventListener('click', (e) => {
            e.preventDefault();
            fileInputDi.click();
        });
        fileInputDi.addEventListener('change', (e) => {
           e.preventDefault();
           
            const fileName = fileInputDi.files[0].name;
            console.log(fileName)
            if(!fileName.toLowerCase().includes("di")){
                window.alert("The file is not DI !!!!!!!!!!");
                console.log("The form not submited")
                return;
            }else{
                console.log("the form is submited : "+fileName)
                ImportBtnPhpDi.click();
            }
            
        });
        // DiChart 
        var ctx = document.getElementById("DiChart");
        var myPieChart = new Chart(ctx, {
        type: 'doughnut',
        data: {
            labels: ["Terminé","Sur ordre de travail","En attente d\'ordre de travail","Rejeté","Ouverte"],
            datasets: [{
            data: <?php echo $statusValueArray ?> ,
            borderWidth: 0,
            backgroundColor: ['#36b9cc', 'blue', 'orange','purple','rgb(253, 64, 95)'],
            hoverBackgroundColor: ['#36b9cc', 'blue', 'orange','purple','rgb(253, 64, 95)'],
            hoverBorderColor: "rgba(234, 236, 244, 1)",
            }],
        },
        options: {
            maintainAspectRatio: false,
            tooltips: {
            backgroundColor: "rgb(255,255,255)",
            bodyFontColor: "#858796",
            
            displayColors: false,
            caretPadding: 10,
            },
            legend: {
            display: false
            },
            cutoutPercentage: 70,
        },
        });

        
//----------------------- Chart Ot

var ctx = document.getElementById("ChartOt");
var myPieChart = new Chart(ctx, {
  type: 'doughnut',
  data: {
    labels: ["Indesponsibilité...", "Indesponsibilité...", "Nécessite arrêtée", "Nécessite arrêtte...","Non mentionné"],
    datasets: [{
      data: [75,25],
      backgroundColor: ['rgb(253, 64, 95)','blue'],
      hoverBackgroundColor: ['pink','blue'],
      borderWidth:0
    }],
  },
  options: {
    maintainAspectRatio: false,
    tooltips: {
      backgroundColor: "rgb(255,255,255)",
      bodyFontColor: "#858796",
      borderWidth: 0,
      //displayColors: false,
      caretPadding: 10,
    },
    legend: {
      display: false
    },
    cutoutPercentage: 70,
  },
});

// Chart Taux du préventif

var ctx = document.getElementById("ChartTauxPreventif");
var myPieChart = new Chart(ctx, {
  type: 'doughnut',
  data: {
    labels: ["Total OT (peventif)", "TOTal OT "],
    datasets: [{
      data: [60,40],
      backgroundColor: ['#055255','#ADC2AD'],
      hoverBackgroundColor: ['pink','blue'],
      borderWidth:0
    }],
  },
  options: {
    maintainAspectRatio: false,
    tooltips: {
      backgroundColor: "rgb(255,255,255)",
      bodyFontColor: "#858796",
      borderWidth: 0,
      //displayColors: false,
      caretPadding: 10,
    },
    legend: {
      display: false
    },
    cutoutPercentage: 70,
  },
});


////////////////////////////// Chart Taux d'imprévus

var ctx = document.getElementById("ChartTauxImprevus");
var myPieChart = new Chart(ctx, {
  type: 'doughnut',
  data: {
    labels: ["OT non planifies", "TOTal OT "],
    datasets: [{
      data: [55,45],
      backgroundColor: ['#8E3258','#CEA26B'],
      hoverBackgroundColor: ['pink','blue'],
      borderWidth:0
    }],
  },
  options: {
    maintainAspectRatio: false,
    tooltips: {
      backgroundColor: "rgb(255,255,255)",
      bodyFontColor: "#858796",
      borderWidth: 0,
      //displayColors: false,
      caretPadding: 10,
    },
    legend: {
      display: false
    },
    cutoutPercentage: 70,
  },
});
</script>

</body>

</html>