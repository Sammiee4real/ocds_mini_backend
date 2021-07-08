<?php session_start();
     include('database_functions.php');
     if(!isset($_SESSION['uid'])){
        header('location: index.php');
      }
     $uid = $_SESSION['uid'];
     $user_details = get_one_row_from_one_table_by_id('users','unique_id',$uid,'date_created');
     $first_name = $user_details['fname'];
     $last_name = $user_details['lname'];
     $fullname = $first_name.' '.$last_name;
     $email = $user_details['email'];
     $username = $user_details['username'];
     $address = $user_details['address'];
     $consultor = $user_details['consultor'];
     $phone = $user_details['phone'];
     $gender = $user_details['gender'];
     $date_created = $user_details['date_created'];
     $bank_name = $user_details['bank_name'];
     $account_name = $user_details['account_name'];
     $account_no = $user_details['account_no'];
     $bank_code = $user_details['bank_code'];
     $bvn = $user_details['bvn'];
     $img_url = $user_details['img_url'];
     

     //////////pagination script starts
		if (isset($_GET['pageno'])) {
		$pageno = $_GET['pageno'];
		} else {
		$pageno = 1;
		}
		$no_per_page = 10;
		$offset = ($pageno-1) * $no_per_page; 
		/////////pagination script ends
?>