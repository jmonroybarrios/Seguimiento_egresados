<?php
session_start();
//error_reporting(0);
include('includes/dbconnection.php');
if (strlen($_SESSION['sturecmsstuid']==0)) {
  header('location:logout.php');
  } else{
   
  ?>
<!DOCTYPE html>
<html lang="en">
  <head>
   
    <title>Sistema de Seguimiento de Egresados|| Ver perfil de los egresados</title>
    <!-- plugins:css -->
    <link rel="stylesheet" href="vendors/simple-line-icons/css/simple-line-icons.css">
    <link rel="stylesheet" href="vendors/flag-icon-css/css/flag-icon.min.css">
    <link rel="stylesheet" href="vendors/css/vendor.bundle.base.css">
    <!-- endinject -->
    <!-- Plugin css for this page -->
    <link rel="stylesheet" href="vendors/select2/select2.min.css">
    <link rel="stylesheet" href="vendors/select2-bootstrap-theme/select2-bootstrap.min.css">
    <!-- End plugin css for this page -->
    <!-- inject:css -->
    <!-- endinject -->
    <!-- Layout styles -->
    <link rel="stylesheet" href="css/style.css" />
    
  </head>
  <body>
    <div class="container-scroller">
      <!-- partial:partials/_navbar.html -->
     <?php include_once('includes/header.php');?>
      <!-- partial -->
      <div class="container-fluid page-body-wrapper">
        <!-- partial:partials/_sidebar.html -->
      <?php include_once('includes/sidebar.php');?>
        <!-- partial -->
        <div class="main-panel">
          <div class="content-wrapper">
            <div class="page-header">
              <h3 class="page-title"> Ver perfil de los Egresados </h3>
              <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                  <li class="breadcrumb-item"><a href="dashboard.php">Dashboard</a></li>
                  <li class="breadcrumb-item active" aria-current="page"> Ver perfil de los Egresados</li>
                </ol>
              </nav>
            </div>
            <div class="row">
          
              <div class="col-12 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                    
                    <table border="1" class="table table-bordered mg-b-0">
                      <?php
$sid=$_SESSION['sturecmsstuid'];
$sql="SELECT tblstudent.StudentName,tblstudent.StudentEmail,tblstudent.StudentClass,tblstudent.Gender,tblstudent.DOB,tblstudent.StuID,tblstudent.FatherName,tblstudent.MotherName,tblstudent.ContactNumber,tblstudent.AltenateNumber,tblstudent.Address,tblstudent.UserName,tblstudent.Password,tblstudent.Image,tblstudent.DateofAdmission,tblclass.ClassName,tblclass.Section from tblstudent join tblclass on tblclass.ID=tblstudent.StudentClass where tblstudent.StuID=:sid";
$query = $dbh -> prepare($sql);
$query->bindParam(':sid',$sid,PDO::PARAM_STR);
$query->execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);
$cnt=1;
if($query->rowCount() > 0)
{
foreach($results as $row)
{               ?>
 <tr align="center" class="table-warning">
<td colspan="4" style="font-size:20px;color:blue">
Detalles de los egresados</td></tr>

    <tr class="table-info">
    <th>Nombre del Egresado</th>
    <td><?php  echo $row->StudentName;?></td>
     <th>Correo electrónico del egresados</th>
    <td><?php  echo $row->StudentEmail;?></td>
  </tr>
  <tr class="table-warning">
     <th>Clase de Egresado</th>
    <td><?php  echo $row->ClassName;?> <?php  echo $row->Section;?></td>
     <th>Genero</th>
    <td><?php  echo $row->Gender;?></td>
  </tr>
  <tr class="table-danger">
    <th>Fecha de nacimiento</th>
    <td><?php  echo $row->DOB;?></td>
    <th>Id del Egresado</th>
    <td><?php  echo $row->StuID;?></td>
  </tr>
  <tr class="table-success">
    <th>Nombre del Padre</th>
    <td><?php  echo $row->FatherName;?></td>
    <th>Nombre de la madre</th>
    <td><?php  echo $row->MotherName;?></td>
  </tr>
  <tr class="table-primary">
    <th>Número de contacto</th>
    <td><?php  echo $row->ContactNumber;?></td>
    <th>Número Alternativo</th>
    <td><?php  echo $row->AltenateNumber;?></td>
  </tr>
  <tr class="table-progress">
    <th>Dirección</th>
    <td><?php  echo $row->Address;?></td>
    <th>Nombre de Usuario</th>
    <td><?php  echo $row->UserName;?></td>
  </tr>
   <tr class="table-info">
    <th>Foto de perfil</th>
    <td><img src="../admin/images/<?php echo $row->Image;?>"></td>
    <th>Fecha de admisión</th>
    <td><?php  echo $row->DateofAdmission;?></td>
  </tr>
  <?php $cnt=$cnt+1;}} ?>
</table>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <!-- content-wrapper ends -->
          <!-- partial:partials/_footer.html -->
         <?php include_once('includes/footer.php');?>
          <!-- partial -->
        </div>
        <!-- main-panel ends -->
      </div>
      <!-- page-body-wrapper ends -->
    </div>
    <!-- container-scroller -->
    <!-- plugins:js -->
    <script src="vendors/js/vendor.bundle.base.js"></script>
    <!-- endinject -->
    <!-- Plugin js for this page -->
    <script src="vendors/select2/select2.min.js"></script>
    <script src="vendors/typeahead.js/typeahead.bundle.min.js"></script>
    <!-- End plugin js for this page -->
    <!-- inject:js -->
    <script src="js/off-canvas.js"></script>
    <script src="js/misc.js"></script>
    <!-- endinject -->
    <!-- Custom js for this page -->
    <script src="js/typeahead.js"></script>
    <script src="js/select2.js"></script>
    <!-- End custom js for this page -->
  </body>
</html><?php }  ?>