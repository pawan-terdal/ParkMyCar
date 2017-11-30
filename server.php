
<?php

$db = mysqli_connect('localhost','pawan','Tictactoe@123','CAR_PARKING');           // making database connection
if(isset($db))
{
  //echo "connected";
}
$price_per_hour = 30;

for($i = 0;$i<50;$i++)                                                              // update the array each time page reloads.
{
      $query = "SELECT * FROM all_slots WHERE slot_number = $i+1";
      $result_of_query = mysqli_query($db,$query);
      $query_rows = mysqli_fetch_assoc($result_of_query);
      $array[$i] = $query_rows['slot_status'];

}

if(isset($_POST['send']))                       // if the submit button is clicked, start process of entering to database.
{

          $vehicle_reg_number = mysqli_real_escape_string($db,$_POST['vehicle_reg_number']);                     //get reg number

          $vehicle_type = mysqli_real_escape_string($db,$_POST['vehicle_type']);                                 // get vehicle_type



          $driver_name = mysqli_real_escape_string($db,$_POST['driver_name']);                                   // get driver_name

          $driver_number = mysqli_real_escape_string($db,$_POST['driver_number']);
          $check_if_already_exixts = "SELECT COUNT(*) AS cnt FROM vehicle_information WHERE vehicle_reg_number = $vehicle_reg_number";                 // check if number reg number
                                                                                                                                                      //being entered already exists
                                                                                                                                                      //in the database
          $do_query = mysqli_query($db,$check_if_already_exixts);
          $get_above_rows = mysqli_fetch_assoc($do_query);
          $cnt = $get_above_rows['cnt'];


          for($i = 0;$i<50;$i++){
            $query = "SELECT * FROM all_slots WHERE slot_number = $i+1";
            $result_of_query = mysqli_query($db,$query);
            $query_rows = mysqli_fetch_assoc($result_of_query);
            $array[$i] = $query_rows['slot_status'];

          }

          if($cnt == 0)          // if entered reg number doesn't already exist
          {

                  $add_vehicle_information = "INSERT INTO vehicle_information (vehicle_reg_number,vehicle_type) VALUES('$vehicle_reg_number','$vehicle_type')";

                  $add_driver_information = "INSERT INTO driver_information (vehicle_reg_number,driver_name,driver_number) VALUES('$vehicle_reg_number','$driver_name','$driver_number')";
                  $in_time = date("Y-m-d H:i:s");
                  $get_minimum_slot = "SELECT MIN(slot_number) AS lowest FROM all_slots where slot_status = 0";
                  mysqli_query($db,$add_vehicle_information);
                  mysqli_query($db,$add_driver_information);
                  $result = mysqli_query($db,$get_minimum_slot);
                  $rows = mysqli_fetch_assoc($result);
                  $low = $rows['lowest'];
                  //$globals['low'];
                  $message =  "You have been assigned slot number ".$low;
                  $add_selected_slot = "INSERT INTO alloted_slots (slot_number,vehicle_reg_number,driver_name,driver_number) VALUES('$low','$vehicle_reg_number','$driver_name','$driver_number')";
                  mysqli_query($db,$add_selected_slot);
                  $update_all_slots = "UPDATE all_slots set slot_status = 1 where slot_number = $low";
                  mysqli_query($db,$update_all_slots);
                  $add_to_price_estimation = "INSERT INTO price_estimation (vehicle_reg_number,in_time) VALUES('$vehicle_reg_number','$in_time')";
                  mysqli_query($db,$add_to_price_estimation);
                  $array = array();

                  for($i = 0;$i<50;$i++)
                  {
                        $query = "SELECT * FROM all_slots WHERE slot_number = $i+1";
                        $result_of_query = mysqli_query($db,$query);
                        $query_rows = mysqli_fetch_assoc($result_of_query);
                        $array[$i] = $query_rows['slot_status'];

                  }
                  echo '<script type="text/javascript">alert("'.$message.'");</script>';
              }
              else
              {      // if reg number already exists.
                    echo '<script type = "text/javascript">alert("This number already exists !");</script>';
              }
            ?>

          <script  type="text/javascript"> var jArray = <?php echo json_encode($array);?>;</script> <!-- pass the array to script.js-->


<?php
//-------------------------------------------------------------Delete portion -----------------------------------------------------------------------------------
}
if(isset($_POST['delete']))
{
          $out_time = date("Y-m-d H:i:s");
          $revised_out_time = (int)(substr($out_time,11,2));


          $delete_vehicle_reg_number = mysqli_real_escape_string($db,$_POST['delete_vehicle_reg_number']);
          $get_info_to_be_deleted = "SELECT * FROM driver_information where vehicle_reg_number = $delete_vehicle_reg_number";
          $temp = mysqli_query($db,$get_info_to_be_deleted);
          $tuples = mysqli_fetch_assoc($temp);
          $name = $tuples['driver_name'];
          $number = $tuples['driver_number'];
          $get_in_time = "SELECT * FROM price_estimation WHERE vehicle_reg_number = $delete_vehicle_reg_number";
          $temp2 = mysqli_query($db,$get_in_time);
          $row = mysqli_fetch_assoc($temp2);
          $time_in = $row['in_time'];
          $revised_time_in = (int)(substr($time_in,11,2));
          echo $name;
          $goodbye = "Please pay Rs 20, ".$name;

          $check_for_entered_reg_number = "SELECT COUNT(*) as count FROM vehicle_information WHERE vehicle_reg_number = $delete_vehicle_reg_number";
          $result = mysqli_query($db,$check_for_entered_reg_number);                                // check if reg number to be deleted is present in the datbase to delete it.
          $all_rows = mysqli_fetch_assoc($result);
          $is_reg_number_present = $all_rows['count'];

          if($is_reg_number_present != 0)
          {
                  $delete_record = "DELETE FROM vehicle_information WHERE vehicle_reg_number = $delete_vehicle_reg_number";

                  mysqli_query($db,$delete_record);
                  $select_slot_number = "SELECT * FROM alloted_slots WHERE vehicle_reg_number = $delete_vehicle_reg_number";
                  $temp = mysqli_query($db,$select_slot_number);
                  $selected_row = mysqli_fetch_assoc($temp);
                  $slot_to_be_updated = $selected_row['slot_number'];
                  echo '..........\n....'.$slot_to_be_updated;
                  $delete_from_alloted_slot = "DELETE FROM alloted_slots WHERE vehicle_reg_number = $delete_vehicle_reg_number";
                  mysqli_query($db,$delete_from_alloted_slot);
                  $update_all_slots_after_delete = "UPDATE all_slots SET slot_status = 0 WHERE slot_number = $slot_to_be_updated";
                  mysqli_query($db,$update_all_slots_after_delete);
                  $insert_into_full_data = "INSERT INTO full_data (vehicle_reg_number,driver_name,driver_number,int_time,out_time) VALUES('$delete_vehicle_reg_number','$name','$number','$time_in','$out_time')";
                  mysqli_query($db,$insert_into_full_data);
                  //$result_of_procedure = mysqli_query($db,"CALL ticket_cost($revised_time_in,$revised_out_time,@cost)");
                  //$procedure = mysqli_fetch_assoc($result_of_procedure);
                  //$cost = $procedure['cost']

                  echo '<script type="text/javascript">alert("'.$goodbye.'");</script>';

                  for($i = 0;$i<50;$i++)
                  {
                        $query = "SELECT * FROM all_slots WHERE slot_number = $i+1";
                        $result_of_query = mysqli_query($db,$query);
                        $query_rows = mysqli_fetch_assoc($result_of_query);
                        $array[$i] = $query_rows['slot_status'];

                  }
          }

          else
          {                                                                               //update the array so that script.js can access it.
                for($i = 0;$i<50;$i++)
                {
                      $query = "SELECT * FROM all_slots WHERE slot_number = $i+1";
                      $result_of_query = mysqli_query($db,$query);
                      $query_rows = mysqli_fetch_assoc($result_of_query);
                      $array[$i] = $query_rows['slot_status'];
                }
                echo '<script type="text/javascript">alert("Sorry, the given registration number doesn\'t exist");</script>';
          }
}
?>
<script  type="text/javascript"> var jArray = <?php echo json_encode($array);?>;</script>
<?php

if(isset($_POST['slot_info_button']))
{
      //echo "slot_info pressed";
      $slot_info_number_string = mysqli_real_escape_string($db,$_POST['get_slot_info']);
      $slot_info_number = (int)$slot_info_number_string;
      $slot_query = "SELECT *,count(*) as cnt FROM alloted_slots WHERE slot_number = $slot_info_number";
      $temp3 = mysqli_query($db,$slot_query);

      $row3 = mysqli_fetch_assoc($temp3);
      $number_of_rows = $row3['cnt'];

      if($number_of_rows == 0)
      {
            $number_of_rows_to_html = "Sorry, given slot number is empty";
            echo '<script type = "text/javascript">alert("'.$number_of_rows_to_html.'");</script>';
      }

      else
      {
            $slot_info_name = $row3['driver_name'];
            $slot_info_phone_number = $row3['driver_number'];
            $slot_info_reg_number = $row3['vehicle_reg_number'];
            $to_display = 'Vehicle Registration Number: '.$slot_info_reg_number.' \n Name: '.$slot_info_name.'\n Number: '.$slot_info_phone_number;
            //echo $to_display;
            echo '<script>alert("'.$to_display.'");</script>';
      }
}

?>
