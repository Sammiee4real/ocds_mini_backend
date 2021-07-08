<?php require_once('config/instantiated_files.php');
       include('inc/header.php'); 

        $get_lgas = get_lgas();
        $count_uploads = get_row_count_one_param('upload_cleaned_data','user_id',$uid);

        if(isset($_POST['cmd_sb'])){
              // print_r($_POST['coveraget']);
            foreach ($_POST['coveraget'] as $key => $value) {
                 echo $key.'=>'.$value.'<br>';
            }
        }


       if(isset($_POST['cmd_upload'])){
            //var_dump($_POST);
            $file_name = $_FILES['file']['name'];
            $size = $_FILES['file']['size'];
            $tmpName = $_FILES['file']['tmp_name'];
            $type = $_FILES['file']['type'];
            $title = $_POST['title'];
            $description = $_POST['description'];
            $coverage = $_POST['coverage']; //this is an array
            $version = $_POST['version'];
       

          $add_cleaned_data =  add_cleaned_data($uid,$file_name,$size,$tmpName,$type,$title,$description,$coverage,$version);
          $add_cleaned_data_dec = json_decode($add_cleaned_data,true);
          if($add_cleaned_data_dec['status'] == 111){
              $msg = "<div class='alert alert-success' >".$add_cleaned_data_dec['msg']."</div><br>";
            // $msg = "success";
          }else{
                $msg = "<div class='alert alert-danger' >".$add_cleaned_data_dec['msg']."</div><br>";
            // $msg = "failed";
          }
       }



        if(isset($_POST['cmd_delete'])){
             $unique_id = $_POST['unique_id'];
           
            $delete_upload =  delete_upload($unique_id);
            $delete_upload_dec = json_decode($delete_upload,true);
            if($delete_upload_dec['status'] == 111){
            $msg = "<div class='alert alert-success' >".$delete_upload_dec['msg'].". Redirecting shortly...</div><br>";
            // $msg = "success";
            header('Refresh: 3; url=home.php');
            }else{
            $msg = "<div class='alert alert-danger' >".$delete_upload_dec['msg']."</div><br>";
            // $msg = "failed";
            }
       }

?>
<body id="page-top">

  <!-- Page Wrapper -->
  <div id="wrapper">
  <?php include('inc/sidebar.php'); ?>
    <!-- Sidebar -->
    
    <!-- End of Sidebar -->

    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">

      <!-- Main Content -->
      <div id="content">

        <!-- Topbar -->
       
          <?php include('inc/top_nav.php'); ?>

        <!-- End of Topbar -->

        <!-- Begin Page Content -->
        <div class="container-fluid">

          <!-- Page Heading -->
          <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
            <a href="#" data-toggle='modal' data-target = '#upload_cleaned_data' class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-download fa-sm text-white-50"></i>Upload Cleaned Data</a>
          </div>
       

        <!-- Upload Cleaned Data -->
        <div class="modal fade" id="upload_cleaned_data" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
        <div class="modal-content">
        <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Uploading a Cleaned Data</h5>
        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">×</span>
        </button>
        </div>
        
      

        <div class="row">
          <!-- <div class="col-lg-5 d-none d-lg-block bg-register-image"></div> -->
          <div class="col-lg-12">
            <div class="p-3">
              <div class="text-center">
                <h1 class="h4 text-gray-900 mb-4">Upload Cleaned Data</h1>
              </div>
              <form method="post" enctype="multipart/form-data" class="user" action="">
                <div class="form-group">
                    <label>Title</label>                                
                    <input type="text" required="" class="form-control form-control-sm" id="title" name="title">      
                </div>
                <div class="form-group"> 
                    <label>Description</label>                 
                    <textarea name="description" id="description" required="" class="form-control form-control"></textarea>  
                </div>
                <div class="form-group">
                    <div class="row">
                         <div class="col-md-12">
                            <label>Select a Coverage</label><br>
                            <select required="" style="width: 100%;" multiple="multiple" name="coverage[]" id="coverage" class="form-control form-control-sm form-control-sm js-example-tokenizer">
                            <!-- <option value="">Select Coverage</option> -->
                            
                            <?php foreach($get_lgas as $lga){?>

                            <option value="<?php echo $lga['local_govt']; ?>"><?php echo $lga['local_govt']; ?></option>
                            
                          <?php } ?>

                            </select>
                         </div>
                </div>
                </div>
                  <div class="form-group">
                    <div class="row">   
                         <div class="col-md-12">
                            <label>Select Version</label>
                            <select required=""  name="version" id="version"  class="form-control form-control-sm form-control-sm">
                            <option>Select Version</option>
                            <option value="First Submission">First Submission</option>
                            <option value="No Objection Data">No Objection Data</option>     
                            </select>
                         </div>
                    </div>      
                </div>
                <div class="form-group"> 
                    <label>Upload a file (Excel): Max 300MB</label>  <br>               
                    <input required="" type="file" name="file">  
                </div>

                <input type="submit" value="Upload Now" name="cmd_upload" class="btn btn-primary btn-sm btn-block"/>
                </a>
                
              </form>
              
           
            </div>
            </div>
          </div>

        
        <div class="modal-footer">
        <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
       
        </div>
       

        </div>
        </div>
        </div>



        <div class="row">
        <div class="col-md-12">
        <?php if(!empty($msg)){

        echo $msg;

        }?>
        </div>
        </div>


          <!-- Content Row -->
          <div class="row">


            <!-- Pending Requests Card Example -->
            <div class="col-xl-6 col-md-6 mb-4">
              <div class="card border-left-warning shadow h-100 py-2">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">Total Entries</div>
                      <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo number_format($count_uploads); ?></div>
                    </div>
                    <div class="col-auto">
                      <i class="fas fa-comments fa-2x text-gray-300"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <!-- Earnings (Monthly) Card Example -->
  <!--           <div class="col-xl-4 col-md-6 mb-4">
              <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Total Amount Paid</div>
                      <div class="h5 mb-0 font-weight-bold text-gray-800">&#8358;400,000</div>
                    </div>
                    <div class="col-auto">
                      <i class="fas fa-calendar fa-2x text-gray-300"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div> -->

            <!-- Earnings (Monthly) Card Example -->
      <!--       <div class="col-xl-4 col-md-6 mb-4">
              <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Current Value</div>
                      <div class="h5 mb-0 font-weight-bold text-gray-800">&#8358;515,000</div>
                    </div>
                    <div class="col-auto">
                      <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>
 -->
     
          </div>


          <hr>

          <h6 class="m-0 font-weight-bold text-primary">Recent Uploads</h6>
          <p class="mb-4">Below is a list of recently uploaded cleaned data | <a href="all_my_uploads.php">View All Uploads</a><!--  <a target="_blank" href="https://datatables.net">official DataTables documentation</a>. --></p>

            <div class="card shadow mb-4">
            <!-- <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary">DataTables Example</h6>
            </div> -->
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-bordered example" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <th>SN </th>
                      <th>Title</th>
                      <th>Coverage</th>
                      <th>Version</th>
                      <th>Data Path</th>
                      <th>Date Uploaded</th>
                    </tr>
                  </thead>
                
                  <tbody>
                   
                    <?php
                     $sn = 1; 
                     $view_recent_uploads =  view_recent_uploads($uid,'8');
                    foreach($view_recent_uploads as $rupload){?>
                    <tr>
                      <td><?php echo $sn; ?></td>
                      <td><?php echo $rupload['title']; ?></td>
                      <td><?php
                            echo "<ul>";
                            $ruploadd = json_decode($rupload['coverage'],true);
                            for($i=0; $i < count($ruploadd); $i++){
                              echo '<li>'.$ruploadd[$i].'</li>';   
                            }
                            echo "</ul>";


                      ?></td>
                      <td><?php echo $rupload['version']; ?></td>
                       <td><a href="<?php echo $rupload['data_path']; ?>"><?php echo $rupload['data_path']; ?></a>

                        <hr>
                        <a href="#" class="btn btn-sm btn-danger" data-toggle="modal" data-target="#exampleModal<?php echo $rupload['id']; ?>" >Delete Upload Link</a>
                     

                    <div class="modal fade" id="exampleModal<?php echo $rupload['id']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                    <div class="modal-content">
                    <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Delete Record for <strong><?php echo $rupload['title'];?></strong></h5>
                    <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                         <form method="post">
                                <input type="hidden" value="<?php echo $rupload['unique_id']; ?>" id="unique_id"  name="unique_id">
                                Are you sure you want to delete this record? 
                               <hr>
                                <input class="btn btn-sm btn-danger" type="submit" name="cmd_delete" id="cmd_delete" value="Confirm Deletion">  &nbsp;&nbsp; | &nbsp;&nbsp;  
                     <button type="button" class="btn btn-sm btn-secondary" data-dismiss="modal">Cancel</button>


                         </form>
                         
                    </div>
                    <div class="modal-footer">
                    <!-- <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button> -->
                    <!-- <button type="button" class="btn btn-primary">Update changes</button> -->
                    </div>
                    </div>
                    </div>
                    </div>


                       </td>
                      <td><?php echo date('F-d-Y',strtotime($rupload['upload_time'])); ?></td>
                     
                    </tr>
                  <?php  $sn++;  } ?>
                 
                </tbody>
                </table>
              </div>
            </div>
          </div>



          <!-- Content Row -->


          <!-- Content Row -->
         

        </div>
        <!-- /.container-fluid -->

      </div>
      <!-- End of Main Content -->

      <!-- Footer -->
    <?php include('inc/footer.php'); ?>
      <!-- End of Footer -->

    </div>
    <!-- End of Content Wrapper -->

  </div>
  <!-- End of Page Wrapper -->

  <!-- Scroll to Top Button-->
  <a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
  </a>

 <?php include('inc/scripts.php'); ?>
