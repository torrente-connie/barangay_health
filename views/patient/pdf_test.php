<?php 
   require_once '../../assets/vendors/dompdf/autoload.inc.php';
   use Dompdf\Dompdf;
   $dompdf = new Dompdf();
   ob_start();
   
   ?>

   <?php
	$path = '../../assets/img/bh-logo-2.png';
	$type = pathinfo($path, PATHINFO_EXTENSION);
	$data = file_get_contents($path);
	$base64 = 'data:image/' . $type . ';base64,' . base64_encode($data);

	$path2 = '../../assets/img/liloan-logo-2.png';
	$type2 = pathinfo($path2, PATHINFO_EXTENSION);
	$data2 = file_get_contents($path2);
	$base642 = 'data:image/' . $type2 . ';base64,' . base64_encode($data2);

   ?>

   <?php 

   $fullname = 'Connie Rose Torrente';


   ?>


<!doctype html>
<html lang="en">
   <head>
	  <meta charset="UTF-8">
	  <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
	  <title>BRGYHEALTH: Barangay Health Center Appointment, Scheduling and Online Consultation System</title>
	  <link rel="icon" type="image/png" sizes="96x96" href="../../assets/img/favicon.ico">
 
      <style type="text/css">
         @page {
         margin: 0px;
         }
         body {
         margin: 0px;
         }
         * {
         font-family: Verdana, Arial, sans-serif;
         }
         a {
         color: #fff;
         text-decoration: none;
         }
         table {
         font-size: x-small;
         }
         tfoot tr td {
         font-weight: bold;
         font-size: x-small;
         }
         .invoice table {
         margin: 15px;
         }
         .invoice h3 {
         margin-left: 15px;
         }
         .invoice h4 {
         margin-left: 15px;
         }
         .information {
         background-color:rgba(40, 102, 199, 0.97)
         color: white;
         }
         .information .logo {
         margin: 5px;
         }
         .information table {
         padding: 10px;
         }

         .rounded-circle {
         	border-radius: 50%;
         }

         .text-uppercase {
         	text-transform: uppercase;
         }

         .text-capitalize {
         	text-transform: capitalize;
         }

         .text-success {
         	color: green;
         }

      </style>
   </head>
   <body>
      <div class="information">
         <table width="100%">

            <tr>
               <td align="left">
               	 <h2 style="color:white">BRGYHEALTH: Barangay Health Center Appointment, Scheduling and Online Consultation System</h2>
               </td>
               <td align="left" style="width: 10%;">
               	  <img src="<?php echo $base64?>" alt="Logo" class="logo"/>
               </td>
               <td align="left" style="width:10%">
               	  <img src="<?php echo $base642?>" alt="Logo" style="height: 85px; width: 90px; border-radius: 45px 45px 45px 45px;"/>
               </td>
            </tr>

         </table>
      </div>
      <br/>

         <div class="invoice">
      	 	<h3>Dear <span class="text-uppercase"><?php echo $fullname ?></span> </h3> 
      	 	<h3 class="text-capitalize">good day! </h3>
      	 	<h3 class="text-capitalize text-success">you have successfully confirmed your appointment booking </h3>
      	 </div>

      <div class="invoice">
         <h4>The following are the details for your appointment:</h4>
         <hr>
         <table width="100%">
            <tbody>
               <tr>
                  <td width="40%" style="font-size: 30px;">Appointment Code #: </td>
                  <td width="60%" align="left" style="font-size: 24px;">BHAC0123</td>
               </tr>
                <tr>
                  <td width="40%" style="font-size: 30px;">Site Name: </td>
                  <td width="60%" align="left" style="font-size: 24px;">Barangay San Vincente Liloan, Medical Clinic</td>
               </tr>
                <tr>
                  <td width="40%" style="font-size: 30px;">Date: </td>
                  <td width="60%" align="left" style="font-size: 24px;">Monday, July 21, 2021</td>
               </tr>

               <tr>
                  <td width="40%" style="font-size: 30px;">Time: </td>
                  <td width="60%" align="left" style="font-size: 24px;">15:00 - 16:00</td>
               </tr>
              
            </tbody>
         </table>
         <hr>
      </div>

      <div style="height: 100px;"></div>

      <div class="invoice" style="border:1px solid black;padding:10px;margin:20px;">
         <h4>Note:</h4>
         <table width="100%">
            <tbody>
            	
               <tr>
                  <td width="60%" align="left" style="font-size: 20px;">1. Bring One Valid ID and This Printed Copy of the Appointment Booking</td>
               </tr>

                <tr>
                  <td width="60%" align="left" style="font-size: 20px;">2. Wear Always Face Mask and Face Shield</td>
               </tr>
              
              
            </tbody>
         </table>
       </div>

      <div class="information" style="position: absolute; bottom: 0;">
         <table width="100%">
            <tr>
               <td align="left" style="width: 50%;">
                 <span style="color:white;font-weight: bold;">BRGYHEALTH: Barangay Health Center Appointment, Scheduling and Online Consultation System</span>
               </td>
              
            </tr>
         </table>
      </div>

   </body>
</html>
<?php
   $html = ob_get_clean();
   $dompdf->loadHtml($html);
   $dompdf->setPaper('A4', 'portrait');
   $dompdf->render();
   $dompdf->stream("codexworld",array("Attachment"=>0));
   
   ?>