<?php require_once('config/instantiated_files.php');
       include('inc/header.php'); 
        $get_contractors = get_contractors();
        $get_mdas = mdas();

      
       if(isset($_POST['cmd_add_record'])){
         
            $mdas = $_POST['mdas'];
            $contractor = $_POST['contractor'];
            $date11 = $_POST['date11'];
            // $buyer_id = $_POST['buyer_id'];
            // $buyer_name = $_POST['buyer_name'];
            $tender_title = $_POST['tender_title'];
            $tender_description = $_POST['tender_description'];
            $tender_value_amount = $_POST['tender_value_amount'];
            $tender_award_value = $_POST['tender_award_value'];
            $tender_award_period_startdate = $_POST['tender_award_period_startdate'];
            $parties_address_street_address = $_POST['parties_address_street_address'];

            //inside the function lies other paramerters
            $add_new_record =  add_new_record($mdas,$contractor,$date11,$tender_title,$tender_description,$tender_value_amount,$tender_award_value,$tender_award_period_startdate,$parties_address_street_address);
            $add_new_record_dec = json_decode($add_new_record,true);
         if($add_new_record_dec['status'] == 111){
              $msg = "<div class='alert alert-success' >".$add_new_record_dec['msg']."</div><br>";
            // $msg = "success";
          }else{
                $msg = "<div class='alert alert-danger' >".$add_new_record_dec['msg']."</div><br>";
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
            <h1 class="h3 mb-0 text-gray-800">Add a New Record</h1>
            <!-- <a href="records.php"  class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-download fa-sm text-white-50"></i>See All Entries</a> -->
          </div>

        



        <div class="row">
        <div class="col-md-12">
        <?php if(!empty($msg)){

        echo $msg;

        }?>
        </div>
        </div>


        

          <h6 class="m-0 font-weight-bold text-primary">New Record</h6>
          <p class="mb-4">Add a new record here</p>

          <div class="card shadow mb-4">
                      
          <div class="row">
          <!-- <div class="col-lg-5 d-none d-lg-block bg-register-image"></div> -->
            <div class="col-lg-2"></div>
          

          <div class="col-lg-8">
            <div class="p-3">
             <!--  <div class="text-center">
                <h1 class="h4 text-gray-900 mb-4">Upload Cleaned Data</h1>
              </div> -->
              <form method="post" enctype="multipart/form-data" class="user" action="">
                <div class="form-group">
                    <label>MDAs<?php //echo generate_new_ocds_id(); ?></label>                                
                     <div class="row">
                         <div class="col-md-12">
                            <!-- <label>Select a Ministry</label><br> -->
                            <select required="" style="width: 100%;"  name="mdas" id="mdas" class="form-control form-control-sm form-control-sm js-example-basic-single">
                            <option value="">Select an MDA</option>
                            
                            <?php foreach($get_mdas as $get_mda){?>

                            <option value="<?php echo $get_mda['parties_name']; ?>"><?php echo $get_mda['parties_name']; ?></option>
                            
                          <?php } ?>

                            </select>
                         </div>
                    </div>     
                </div>


                  <!-- <div class="form-group"> -->
                  <!--   <label>Contractors</label>                                
                     <div class="row">
                         <div class="col-md-12">
                        
                            <select required="" style="width: 100%;" name="contractors" id="contractors" class="form-control form-control-sm form-control-sm js-example-tokenizer">
                            <option value="">Select a Contractor</option>
                            
                            <?php //foreach($get_contractors as $contractor){?>

                            <option value="<?php //echo $contractor['parties_name']; ?>"><?php //echo $contractor['parties_name']; ?></option>
                            
                          <?php } ?>

                            </select>
                         </div>
                    </div>   -->  
                <!-- </div> -->

              <div class="form-group">
                    <label>Contactor Name</label>                                
                     <div class="row">
                         <div class="col-md-12">
                        
                            <input type="text" required="" id="contractor" name="contractor" class="form-control form-control-sm form-control-sm">
                           
                         </div>
                    </div>    
              </div>

                <div class="form-group">
                    <label>Date</label>                                
                     <div class="row">
                         <div class="col-md-12">
                        
                            <input type="date" required="" id="date11" name="date11" class="form-control form-control-sm form-control-sm">
                           
                         </div>
                    </div>    
              </div>


<!-- 
                    <div class="form-group">
                    <label>Buyer ID</label>                                
                     <div class="row">
                         <div class="col-md-12">
                        
                            <input type="text" required="" id="buyer_id" name="buyer_id" class="form-control form-control-sm form-control-sm">
                           
                         </div>
                    </div>    
                </div>

                    <div class="form-group">
                    <label>Buyer Name</label>                                
                     <div class="row">
                         <div class="col-md-12">
                        
                            <input type="text" required="" id="buyer_name" name="buyer_name" class="form-control form-control-sm form-control-sm">
                           
                         </div>
                    </div>    
                </div> -->


                    <div class="form-group">
                    <label>Tender Title</label>                                
                     <div class="row">
                         <div class="col-md-12">
                        
                            <input type="text" required="" id="tender_title" name="tender_title" class="form-control form-control-sm form-control-sm">
                           
                         </div>
                    </div>    
                </div>

                <div class="form-group">
                <label>Tender Description</label>                                
                 <div class="row">
                     <div class="col-md-12">
                    
                        <input type="text" required="" id="tender_description" name="tender_description" class="form-control form-control-sm form-control-sm">
                       
                     </div>
                </div>    
            </div>


                    <div class="form-group">
                <label>Tender Value Amount</label>                                
                 <div class="row">
                     <div class="col-md-12">
                    
                        <input type="number" required="" id="tender_value_amount" name="tender_value_amount" class="form-control form-control-sm form-control-sm">
                       
                     </div>
                </div>    
            </div>


             <div class="form-group">
                    <label>Tender Award Value</label>                                
                     <div class="row">
                         <div class="col-md-12">
                        
                            <input type="number" required="" id="tender_award_value" name="tender_award_value" class="form-control form-control-sm form-control-sm">
                           
                         </div>
                    </div>    
                </div>

                <div class="form-group">
                    <label>Tender Award Period Start Date</label>                                
                     <div class="row">
                         <div class="col-md-12">
                        
                            <input type="date" required="" id="tender_award_period_startdate" name="tender_award_period_startdate" class="form-control form-control-sm form-control-sm">
                           
                         </div>
                    </div>    
                </div>

                    <div class="form-group">
                    <label>Parties Street Address</label>                                
                     <div class="row">
                         <div class="col-md-12">
                        
                            <input type="text"  id="parties_address_street_address" name="parties_address_street_address" class="form-control form-control-sm form-control-sm">
                           
                         </div>
                    </div>    
                </div>

                <input type="submit" value="Add Record Now" name="cmd_add_record" class="btn btn-primary btn-sm btn-block"/>
                </a>
                <hr>
                
              </form>
              
           
            </div>
            </div>

            <div class="col-lg-2"></div>

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
