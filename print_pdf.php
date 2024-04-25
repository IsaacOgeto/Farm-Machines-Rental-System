<?php
require_once('tcpdf/tcpdf.php');

// HTML content
$html = '
<div class="container">
    <div class="jumbotron">
        <h1 class="text-center" style="color: green;"><span class="glyphicon glyphicon-ok-circle"></span> Car Returned</h1>
    </div>
</div>
<br>
<h2 class="text-center"> Thank you for visiting Farm Rentals! We wish you have a lovely time. </h2>
<h3 class="text-center"> <strong>Your Order Number:</strong> <span style="color: blue;"><?php echo "$ID"; ?></span> </h3>
<div class="container">
    <h5 class="text-center">Please read the following information about your order.</h5>
    <div class="box">
        <div class="col-md-10" style="float: none; margin: 0 auto; text-align: center;">
            <h3 style="color: orange;">Your booking has been received and placed into out order processing system.</h3>
            <br>
            <h4>Please make a note of your <strong>order number</strong> now and keep in the event you need to communicate with us about your order.</h4>
            <br>
            <h3 style="color: orange;">Invoice</h3>
            <br>
        </div>
        <div class="col-md-10" style="float: none; margin: 0 auto; ">
            <h4> <strong>Machine Name: </strong> <?php echo $MACHINE_NAME;?></h4>
            <br>
            <h4> <strong>Machine Registration No.:</strong> <?php echo $MACHINE_REGISTRATION_NO; ?></h4>
            <br>
            <h4> <strong>Fare:&nbsp;</strong>  Kshs. <?php 
            if($CHARGE_TYPE == "days"){
                echo ($CHARGE . "/day");
            } else {
                echo ($CHARGE . "/hr");
            }
            ?></h4>
            <br>
            <h4> <strong>Booking Date: </strong> <?php echo date("Y-m-O"); ?> </h4>
            <br>
            <h4> <strong>Start Date: </strong> <?php echo $RENT_START_DATE; ?></h4>
            <br>
            <h4> <strong>Rent End Date: </strong> <?php echo $RENT_END_DATE; ?></h4>
            <br>
            <h4> <strong>Machine Return Date: </strong> <?php echo $MACHINE_RETURN_DATE; ?> </h4>
            <br>
            <?php if($CHARGE_TYPE == "days"){?>
                <h4> <strong>Number of days:</strong> <?php echo $HOURS_OR_DAYS; ?>day(s)</h4>
            <?php } else { ?>
                <h4> <strong>Time taken:</strong> <?php echo $HOURS_OR_DAYS; ?>hr(s)</h4>
            <?php } ?>
            <br>
            <?php
                if($extra_days > 0){
            ?>
            <h4> <strong>Total Fine:</strong> <label class="text-danger"> Kshs. <?php echo $total_fine; ?>/- </label> for <?php echo $extra_days;?> extra days.</h4>
            <br>
            <?php } ?>
            <h4> <strong>Total Amount: </strong> Kshs. <?php echo $TOTAL_AMOUNT; ?>/-     </h4>
            <br>
        </div>
    </div>
    <div class="col-md-12" style="float: none; margin: 0 auto; text-align: center;">
        <h6>Warning! <strong>Do not reload this page</strong> or the above display will be lost. If you want a hardcopy of this page, please print it now.</h6>
    </div>
</div>
';

// Create new PDF document
$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

// Set document information
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('Your Name');
$pdf->SetTitle('Farm Rentals Invoice');
$pdf->SetSubject('Invoice');
$pdf->SetKeywords('TCPDF, PDF, invoice, Farm Rentals');

// Remove default header/footer
$pdf->setPrintHeader(false);
$pdf->setPrintFooter(false);

// Add a page
$pdf->AddPage();

// Write HTML content into PDF
$pdf->writeHTML($html, true, false, true, false, '');

// Output the PDF to the browser or save it to a file
$pdf->Output('farm_rentals_invoice.pdf', 'I');

?>
