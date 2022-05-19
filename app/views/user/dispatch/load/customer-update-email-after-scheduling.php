<?php
require_once APPROOT . '/views/includes/user/header-quick-view.php';
$details = $data['details'];
?>
<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="table.css" />
    <!-- <link rel="stylesheet" type="text/css" href="main_ui.css" /> -->

    <style>
        table,
        th,
        td {
            border: 1px solid #eee;
            border-collapse: collapse;
        }
    </style>
</head>

<body style="background:lightgrey;">
    <?php
    //require_once APPROOT.'/views/includes/user/header.php';
    ?>
    <br><br>
    <section class="list-200 content-box" style="margin: auto;max-width: 1250px !important;background:white;">
        <div style="margin:10px;">
            <br>
            <h3>PO# : <?php echo $details['po_number']; ?></h3>
            <br>
            <h2>Hello Team</h2>
            <br>
            <p>Please check the case and pallet count as per the shipper and let us know if we are good to roll with this. If any changes are required please reply all to the email.</p>
            <p>Recommended Reefer temperature as per the contract: <b><?php echo $details['reefer_temperature']; ?></b></p>
        </div>
        <br><br>
        <div class="table  table-a fixedheader">
            <table>
                <thead>
                    <tr>
                        <th rowspan="2">Shipper</th>
                        <th rowspan="2">Appointment</th>
                        <th rowspan="2">P/U Number</th>
                        <th colspan="2">Per PO</th>
                        <th colspan="2">Per Shipper</th>
                        <th colspan="2">Loaded</th>
                        <th rowspan="2">Reefer Temperature Required</th>
                        <th rowspan="2">Seal</th>
                        <th rowspan="2">Remarks</th>
                    </tr>
                    <tr>
                        <!-- <th></th>
                        <th></th>
                        <th></th> -->
                        <th>Cases</th>
                        <th>Pallets</th>
                        <th>Cases</th>
                        <th>Pallets</th>
                        <th>Cases</th>
                        <th>Pallets</th>
                        <!-- <th></th>
                        <th></th>
                        <th></th> -->
                    </tr>
                </thead>
                <tbody id="tabledata">
                    <?php
                    $counter = 1;
                    $shipper_counter = 0;

                    $row_colors=['FIRST'=>'white','SECOND'=>'lightblue','THIRD'=>'#fff3b6','FOURTH'=>'#8ac988'];

                    foreach ($details['pick_ups'] as $pick_up) {
                       // echo "<pre>";
                        //print_r($pick_up);
                       // echo "</pre>";
                        $pick_up_number='';
                        $cases_po='';
                        $pallet_po='';
                        $cases_ship='';
                        $pallet_ship='';                        
                        $cases_bol='';
                        $pallet_bol='';
                        foreach ($pick_up['quantity_details'] as $qd) {
                        $pick_up_number.=$qd['pd_number']."<br>";
                        $cases_po.=$qd['case_count_roc']."<br>";
                        $pallet_po.=$qd['pallet_count_roc']."<br>";
                        $cases_ship.=$qd['case_count_ship']."<br>";
                        $pallet_ship.=$qd['pallet_count_ship']."<br>";
                        $cases_bol.=$qd['case_count_bol']."<br>";
                        $pallet_bol.=$qd['pallet_count_bol']."<br>";
                        }
                        echo "<tr style='background:".$row_colors[$pick_up['stage']]."'>
                        <td>" . $pick_up['shipper'] . "</td>
                        <td>" . $pick_up["appointment_type"].'<br>'.$pick_up["appointment_date"].' '.$pick_up["appointment_time"]."</td>
                        <td>$pick_up_number</td>
                        <td>$cases_po</td>
                        <td>$pallet_po</td>
                        <td>$cases_ship</td>
                        <td>$pallet_ship</td>
                        <td>$cases_bol</td>
                        <td>$pallet_bol</td>
                        <td>" . $pick_up["reefer_temperature"] . "</td>
                        <td>" . $pick_up["seal_numbers"] . "</td>
                        <td>-</td>
                        </tr>
                        ";
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </section>
    <?php
    //require_once APPROOT.'/views/includes/user/footer.php';
    ?>
</body>

</html>
<?php
require_once APPROOT . '/views/includes/user/footer.php';
?>