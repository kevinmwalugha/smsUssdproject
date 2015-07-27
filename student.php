<?php
//A student exam system where a student send a text where he/she enters her index number
error_reporting(0);
require_once('connect.php');

$sms=getStudentIndexNo();
$student=selectStudentIndexNoFromDb($sms['message']);

    if($student['index_no'] != 0){
    $reply= $student['index_no']." ".$student['fName']." ".$student['LName'].". Overall Grade: ".$student['overall'];

    }else{
    $reply =  "No Student with that Index Number Exists. Please Enter the correct Index Number.";
    }

//He/she gets a text reply displaying his/her exam results

sendSmsToUser($sms['from'],$reply);
exit;//end program

//FUNCTIONS DEFINED BELOW

function getStudentIndexNo(){
  $sms['from']=$_REQUEST['from'];
  $sms['message']=trim($_REQUEST['message']);

  return $sms;

}//end function getStudentIndexNo
//Database with table student
//Records fname,lname,index_no(unique),subject and grades, overall grade
function selectStudentIndexNoFromDb($index_no){
  $query=mysql_query("SELECT * FROM student WHERE index_no='$index_no'");

  if(mysql_num_rows($query)>0){
    $row=mysql_fetch_assoc($query);
  }else{
    $row['index_no']=0;
  }
  return $row;
}

function sendSmsToUser($number, $msg){

  if(is_array($msg)){
  			$records[0]= array( 'message' => $msg[0], 'to' => $number[0]);
  			$records[1]= array( 'message' => $msg[1], 'to' => $number[1]);
  			}else{
  			  	$records[]= array( 'message' => $msg, 'to' => $number);
  				}
  		 $sms_array= array();
  		 $sms_array[] = array('success'=>"true",'secret'=>"",'task'=>"send",'messages'=>$records);
  		 $payload= array('payload'=>$sms_array[0]);
  		 header('content-type: application/json; charset=utf-8');
  		 echo json_encode($payload);
}
?>
