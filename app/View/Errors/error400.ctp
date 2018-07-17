 <?php 
 $msg = "Error";
               $array_result = array("command"=>"","code"=>404,"reason"=>$msg);
               echo json_encode($array_result);
               die();
               
 ?>