<?php
session_start();
error_reporting(0);
include('includes/dbconnection.php');
$json=array();
$search='';
if (isset($_GET['searchdata']))
{

    $search = $_GET['searchdata'];
    
    
    $data = file_get_contents('https://api-manager.universia.net/empleo/offers/v2/boards/82a63648-7e60-46f9-9aed-8c1985ef4c0b/job_postings/public/?jobOrCompany=' . $search . '&page=1&limit=10');

   # echo '<pre>';

    $json = json_decode($data, true);

   # print_r($json);
   # echo '</pre>';

}
?>
<!DOCTYPE html>
<html lang="en">
  <head>
   
    <title>Sistema de Seguimiento de Egresados|||Buscar Egresado</title>
    <!-- plugins:css -->
    <link rel="stylesheet" href="vendors/simple-line-icons/css/simple-line-icons.css">
    <link rel="stylesheet" href="vendors/flag-icon-css/css/flag-icon.min.css">
    <link rel="stylesheet" href="vendors/css/vendor.bundle.base.css">
    <!-- endinject -->
    <!-- Plugin css for this page -->
    <link rel="stylesheet" href="./vendors/daterangepicker/daterangepicker.css">
    <link rel="stylesheet" href="./vendors/chartist/chartist.min.css">
    <!-- End plugin css for this page -->
    <!-- inject:css -->
    <!-- endinject -->
    <!-- Layout styles -->
    <link rel="stylesheet" href="./css/style.css">
    <!-- End layout styles -->
   
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
              <h3 class="page-title"> Busca ofertas</h3>
              <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                  <li class="breadcrumb-item"><a href="dashboard.php">Dashboard</a></li>
                  <li class="breadcrumb-item active" aria-current="page"> Puesto o empresa</li>
                </ol>
              </nav>
            </div>
            <div class="row">
              <div class="col-md-12 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                    <form method="get">
                                <div class="form-group">
                                   <strong>Empleos:</strong>
                                   
                                    <input id="searchdata" type="text" name="searchdata" required="true" class="form-control" placeholder="Puesto o empresa"></div>
                               
                                <button type="submit" class="btn btn-primary" name="search" id="submit">Buscar</button>
                            </form>
                    <div class="d-sm-flex align-items-center mb-4">


                       <?php
if (!empty($json))
{ 


  ?>
  <h4 align="center">Result against "<?php echo $search;?>" keyword </h4>
                    </div>
                    <div class="table-responsive border rounded p-1">
                      
                      <table class="table">
                        <thead>
                          <tr>
                            <th class="font-weight-bold">Titulo</th>
                            <th class="font-weight-bold">Empresa</th>
                            <th class="font-weight-bold">Ubicacion</th>
                            <th class="font-weight-bold">Experiencia</th>
                                                      
                          </tr>
                        </thead>
                        <tbody>
                           <?php
                           

foreach($json['_embedded']['results'] as $row)

{               ?>   
                          <tr>
                           
                            <td><?php 
                            $url='https://www.universia.net/pe/empleo/';
                            $url.=$row ['identifier'].'/';
                            $url.=$row ['name'].'.html';
                          
                            

                         ?>
                          <a target='_blank' href=" <?php echo $url ?>"><?php echo htmlentities($row['title']);?></a>. 
                        </td>
                            
                            <td><?php  echo htmlentities($row ['hiringOrganization']['legalName'] );?></td>
                            <td><?php  echo htmlentities($row ['hiringOrganization']['location']['address']['streetAddress']  );?></td>
                            <td><?php  echo htmlentities($row ['experienceRequirements']);?></td>
                            
                           
                          </tr><?php 

} ?>
 
 
                        </tbody>
                      </table>
                    </div>
                    <div align="left">
   
</div>
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
    <script src="./vendors/chart.js/Chart.min.js"></script>
    <script src="./vendors/moment/moment.min.js"></script>
    <script src="./vendors/daterangepicker/daterangepicker.js"></script>
    <script src="./vendors/chartist/chartist.min.js"></script>
    <!-- End plugin js for this page -->
    <!-- inject:js -->
    <script src="js/off-canvas.js"></script>
    <script src="js/misc.js"></script>
    <!-- endinject -->
    <!-- Custom js for this page -->
    <script src="./js/dashboard.js"></script>
    <!-- End custom js for this page -->
  </body>
</html><?php }  ?>