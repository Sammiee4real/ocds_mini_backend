<?php
$table = "";
$app_name = 'ocds_admin';
require_once("db_connect.php");
require_once("config.php");
global $dbc;

function generate_new_ocds_id(){
        global $dbc;
        $time = time();
        $last4_time_digits = substr($time, -4);
        $another6randomdigits = rand(111111,999999);
        $new_generated_10_digits = $last4_time_digits.$another6randomdigits;
        $new_ocds_id = 'ocds-'.$new_generated_10_digits;
        // return $new_ocid;
        return $new_ocds_id;

} 

function generate_new_ocds_idOLD(){
         global $dbc;
        $sql = "SELECT incremental_id,ocid FROM `releases1_re`  ORDER BY `incremental_id` DESC LIMIT 1";
        $query = mysqli_query($dbc, $sql);
        $row = mysqli_fetch_array($query);
        $last_ocid =  $row['ocid'];
        $last4 = substr($last_ocid, -4);
        $first5char = substr($last_ocid, 0, 5);
        // $new4 = intval($last4);
        $uniquely_generated = rand(111111111,999999999);
        $new_ocid = $first5char.$uniquely_generated;
          // echo $last_ocid.'--------'.$first14char.'------'.$last4.'--------'.$new4.'------<br>'.$new_ocid;
        return $new_ocid;

} 




function get_contractors(){
         global $dbc;
        $sql = "SELECT DISTINCT `parties_name` FROM `parties1_re` WHERE `parties_roles` IS NULL ORDER BY `incremental_id`";
        $query = mysqli_query($dbc, $sql);
        $num = mysqli_num_rows($query);
       if($num > 0){
             while($row = mysqli_fetch_array($query)){
                $display[] = $row;
             }              
             return $display;
          }
          else{
             return null;
          }
}



function mdas(){
         global $dbc;
        $sql = "SELECT DISTINCT `parties_name` FROM `parties1_re` WHERE `parties_roles`='buyer' ORDER BY `incremental_id`";
        $query = mysqli_query($dbc, $sql);
        $num = mysqli_num_rows($query);
       if($num > 0){
             while($row = mysqli_fetch_array($query)){
                $display[] = $row;
             }              
             return $display;
          }
          else{
             return null;
          }
}


function  add_new_record($mdas,$contractors,$award_date,$tender_title,$tender_description,$tender_value_amount,$tender_award_value,$parties_address_street_address){
       global $dbc;
       ///////for releases default ::::::
       $ocid_new =  generate_new_ocds_id();

       return json_encode(array( "status"=>111, "msg"=>$ocid_new ));

       // $tender_main_procurement_category = "works";
       // $tender_minvalue_currency = "NGN";
       // $tender_value_currency = "NGN";
       // $tender_procurement_method = "open";


       // //for parties default
       // $parties_identifier_scheme = 'OY-MDA';
       // $parties_contact_point_url = 'https://oyostate.gov.ng';
       // // $parties_address_street_address = 'Oyo State Secretariat'; ////should this be optional or not
       // $parties_address_street_address = $parties_address_street_address != "" ? $parties_address_street_address: NULL;


       // //this is the mda name to get ID::: name 
       // $get_mdaparties_id = "SELECT parties_id,parties_name FROM `parties1_re` WHERE `parties_name`='$mdas' LIMIT 1"; 
       // $qry_mdaparties_id = mysqli_query($dbc,$get_mdaparties_id);
       // $row_mdaparties_id = mysqli_fetch_array($qry_mdaparties_id);
       // $mdaparties_id = $row_mdaparties_id['parties_id'];
       

       // // $check_exist = check_record_by_one_param('releases1_re','ocid',$ocid_new);
       // // if($check_exist){
       // //  return json_encode(array( "status"=>102, "msg"=>"exists" ));
       // // }else{

       //    //insert into releases
       //    $insert_releas = "INSERT INTO `releases1_re` SET
       //      `ocid`='$ocid_new',
       //      `date`='$award_date',
       //      `buyer_id`='$mdaparties_id',
       //      `buyer_name`='$mdas',
       //      `tender_title`='$tender_title',
       //      `tender_description`='$tender_description',
       //      `tender_value_amount`='$tender_value_amount',
       //      `tender_award_value`='$tender_award_value',
       //      `tender_award_period_startdate`='$award_date',
       //      `tender_main_procurement_category`='$tender_main_procurement_category',
       //      `tender_minvalue_currency`='$tender_minvalue_currency',
       //      `tender_value_currency`='$tender_value_currency',
       //      `tender_procurement_method`='$tender_procurement_method'
       //    ";
       //    $qry_releas = mysqli_query($dbc,$insert_releas);



       //    //insert into parties for mdas
       //     $insert_parties1 = "INSERT INTO `parties1_re` SET
       //      `ocid`='$ocid_new',
       //      `parties_id`='$mdaparties_id',
       //      `parties_roles`='buyer',
       //      `parties_name`='$mdas',
       //      `parties_identifier_scheme`='$parties_identifier_scheme',
       //      `parties_address_street_address`='$parties_address_street_address',  
       //      `parties_contact_point_url`='$parties_contact_point_url'
       //    ";
       //    $qry_parties1 = mysqli_query($dbc,$insert_parties1);

       //       //insert into parties for contractors
       //      $insert_parties2 = "INSERT INTO `parties1_re` SET
       //      `ocid`='$ocid_new',
       //      `parties_name`='$contractors',
       //      `parties_address_street_address`='$parties_address_street_address',  
       //      `parties_contact_point_url`='$parties_contact_point_url'
       //    ";
       //    $qry_parties2 = mysqli_query($dbc,$insert_parties2);

       //    return json_encode(array( "status"=>111, "msg"=>"Record was successfully Entered" ));



      // }




     

}

function get_rows_from_one_table_by_id($table,$param,$value,$order_option){
         global $dbc;
        $table = secure_database($table);
        $sql = "SELECT * FROM `$table` WHERE `$param`='$value' ORDER BY `$order_option` DESC";
        $query = mysqli_query($dbc, $sql);
        $num = mysqli_num_rows($query);
       if($num > 0){
             while($row = mysqli_fetch_array($query)){
                $display[] = $row;
             }              
             return $display;
          }
          else{
             return null;
          }
}




function check_record_by_one_param($table,$param,$value){
    global $dbc;
    $sql = "SELECT incremental_id FROM `$table` WHERE `$param`='$value'";
    $query = mysqli_query($dbc, $sql);
    $count = mysqli_num_rows($query);
    if($count > 0){
      return true; ///exists
    }else{
      return false; //does not exist
    }
    
}  

function secure_database($value){
    global $dbc;
    $new_value = mysqli_real_escape_string($dbc,$value);
    return $new_value;
}

function get_one_row_from_one_table_by_id($table,$param,$value,$order_option){
         global $dbc;
        $table = secure_database($table);
        $sql = "SELECT * FROM `$table` WHERE `$param`='$value' ORDER BY `$order_option` DESC";
        $query = mysqli_query($dbc, $sql);
        $num = mysqli_num_rows($query);
       if($num > 0){
             $row = mysqli_fetch_array($query);              
             return $row;
          }
          else{
             return null;
        }
    }

function user_login($email,$password){
   global $dbc;
   $email = secure_database($email);
   $password = secure_database($password);
   $hashpassword = md5($password);

   $sql = "SELECT * FROM `users` WHERE `email`='$email' AND `password`='$hashpassword' AND `role`=2";
   $query = mysqli_query($dbc,$sql);
   $count = mysqli_num_rows($query);
   if($count === 1){
      $row = mysqli_fetch_array($query);
      $fname = $row['fname'];
      $lname = $row['lname'];
      $phone = $row['phone'];
      $email = $row['email'];
      $unique_id = $row['unique_id'];
      $access_status = $row['access_status'];

      if($access_status != 1){
                return json_encode(array( "status"=>101, "msg"=>"Sorry, you currently do not have access. Contact Admin!" ));
      }else{
                return json_encode(array( 
                    "status"=>111, 
                    "user_id"=>$unique_id, 
                    "fname"=>$fname, 
                    "lname"=>$lname, 
                    "phone"=>$phone, 
                    "email"=>$email 
                  )
                 );

      }
    
   }else{
                return json_encode(array( "status"=>102, "msg"=>"Wrong username or password!" ));

   }
 

}