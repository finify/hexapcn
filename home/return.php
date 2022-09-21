<?php
require('../includes/dbconnect.php');//DBCONNECTION
$useremail = $_SESSION['useremail'];


if($useractivestat == 0){
    $sql = mysqli_query($con, "SELECT * FROM `fx_investment` WHERE userid='$userid'");
    $rows = mysqli_num_rows($sql) ;
    if($rows >= 1){
        while($row1 = mysqli_fetch_array($sql)){
            $planid =$row1["ID"];
            $plan_name =$row1["plan_name"];
            $plan_min =$row1["plan_min"];
            $plan_max =$row1["plan_max"];
            $plan_roi =$row1["plan_roi"];
            $plan_roi_type =$row1["plan_roi_type"];
            $plan_duration =$row1["plan_duration"];
            $plan_status =$row1["plan_status"];
            $plan_returns =$row1["plan_returns"];
            $amountinvested =$row1["amountinvested"];
            $amount_earned =$row1["amount_earned"];
            $endingdate =$row1["endingdate"];

            $endingdate1    = strtotime($endingdate);

            $todaydate = date("d-m-Y");
            // $todaydate = "17-08-2022";
            $currentdate    = strtotime($todaydate);


            if($plan_status == 0){//check if plan is still active
                if($plan_roi_type == 'daily'){ //check for roi type if daily or others
                    //return for return dates
                    $return_dates = explode (",", $plan_returns);
                    foreach ($return_dates as $dates) { 
                        if($dates != ""){
                            $dates1  = strtotime($dates);

                            $sql = mysqli_query($con, "SELECT * FROM `fx_earnings` WHERE userid='$userid' AND plan='$plan_name' AND created='$dates' AND plan_id='$planid'");
                            $rows = mysqli_num_rows($sql) ;
                            if($rows < 1){//check if earnings have not be returned
                                if($currentdate >= $dates1){ //if date is current
                                    $amountearned = ($plan_roi / 100)* $amountinvested;

                                    //insert to fx earnings
                                    $query2 = mysqli_query($con, "INSERT INTO fx_earnings (userid,plan_id,plan,amountearned,created) VALUES ('$userid','$planid','$plan_name','$amountearned','$todaydate')");

                                    $newamountearned = $amount_earned + $amountearned;
                                    //update plan amount earned
                                    $sqlquery1 = "UPDATE fx_investment 
                                    SET amount_earned='$newamountearned'
                                    WHERE ID='$planid' " ;
                                    $sqlresult1 = mysqli_query($con,$sqlquery1) ;
                                }
                            }
                        }
                    }

                    //return for ending date
                    $sql = mysqli_query($con, "SELECT * FROM `fx_total_earned` WHERE userid='$userid' AND plan='$plan_name' AND created='$endingdate' AND plan_id='$planid'");
                    $rows = mysqli_num_rows($sql) ;
                    if($rows < 1){//check if earnings have not be returned
                        
                        if($currentdate >= $endingdate1){ //if date is current
                            $amountearned = ($plan_roi / 100)* $amountinvested;
                            $totalamountearned = ($amountearned*$plan_duration) + $amountinvested;

                            //insert to fx total earned
                            $query2 = mysqli_query($con, "INSERT INTO fx_total_earned (userid,plan,plan_id,amount_earned,created) VALUES ('$userid','$plan_name','$planid','$totalamountearned','$todaydate')");

                            $newamountearned = $amount_earned + $amountearned;

                            $newwithdraw_bal = $totalamountearned + $withdraw_balance;
                            //update fx userprofile withdrawable balance
                            $sqlquery1 = "UPDATE fx_userprofile 
                            SET withdraw_balance='$newwithdraw_bal'
                            WHERE ID='$userid' ";
                            $sqlresult1 = mysqli_query($con,$sqlquery1) ;

                            //update plan amount earned
                            $sqlquery1 = "UPDATE fx_investment 
                            SET plan_status='1'
                            WHERE ID='$planid' " ;
                            $sqlresult1 = mysqli_query($con,$sqlquery1) ;
                        }
                    }

                }elseif($plan_roi_type == 'after'){
                    //return for ending date
                    $sql = mysqli_query($con, "SELECT * FROM `fx_total_earned` WHERE userid='$userid' AND plan='$plan_name' AND created='$endingdate' AND plan_id='$planid'");
                    $rows = mysqli_num_rows($sql) ;
                    if($rows < 1){//check if earnings have not be returned
                        if($currentdate >= $endingdate1){ //if date is current
                            $amountearned = ($plan_roi / 100)* $amountinvested;
                            $totalamountearned = ($amountearned*$plan_duration) + $amountinvested;

                            //insert to fx total earned
                            $query2 = mysqli_query($con, "INSERT INTO fx_total_earned (userid,plan,plan_id,amount_earned,created) VALUES ('$userid','$plan_name','$plan_id','$totalamountearned','$todaydate')");

                             //insert to fx earnings
                             $query2 = mysqli_query($con, "INSERT INTO fx_earnings (userid,plan_id,plan,amountearned,created) VALUES ('$userid','$planid','$plan_name','$amountearned','$todaydate')");

                            $newamountearned = $amount_earned + $amountearned;

                            $newwithdraw_bal = $totalamountearned + $withdraw_balance;
                            //update fx userprofile withdrawable balance
                            $sqlquery1 = "UPDATE fx_userprofile 
                            SET withdraw_balance='$newwithdraw_bal'
                            WHERE ID='$userid' ";
                            $sqlresult1 = mysqli_query($con,$sqlquery1) ;

                            //update plan amount earned
                            $sqlquery1 = "UPDATE fx_investment 
                            SET plan_status='1'
                            WHERE ID='$planid' " ;
                            $sqlresult1 = mysqli_query($con,$sqlquery1) ;
                        }
                    }
                }
            }
        }
    }

}

?>