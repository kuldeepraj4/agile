<?php
// echo "<pre>";
// print_r($data['details']);
// echo "</pre>";
?>
<html>

<head>
    <style>
        .section {
            width: 1000px;
            border-right: 1px solid black;
            border-left: 1px solid black;
            border-bottom: 1px solid black;
            margin: auto;
            margin-top: 50px;
            font-family: 'calibri';
        }

        .bold {
            font-weight: bolder;
            padding: 3px 7px;
            border-bottom: 1px solid black;
            border-top: 1px solid black;
            background-color: #486e94;
            color: white;
            font-size: 15px;
        }

        label {
            font-weight: bold;
            min-width: 110px;
            display: inline-block;

        }

        .box {
            white-space: pre-wrap;
            white-space: -moz-pre-wrap !important;
            white-space: -webkit-pre-wrap;
            white-space: -pre-wrap;
            white-space: -o-pre-wrap;
            white-space: pre-wrap;
            word-wrap: break-word;
            word-break: break-all;
            white-space: normal;
            width: 180px !important;
            max-width: 180px !important;
            display: inline-block;
        }

        .divflex {
            display: flex;
            /* align-items: center; */
            flex-wrap: wrap;
            font-size: 15px;
        }

        .tableflex {
            display: flex;
            /* align-items: center; */
            flex-wrap: wrap;
            justify-content: center;
        }

        table,
        th,
        td {
            border: 1px solid grey;
            border-collapse: collapse;
            font-size: 13px;
            text-align: center;
        }
        th, td{
            max-width: 150px;
            word-wrap: break-word;
        }
        table{
            table-layout: fixed;
        }
        td{
            padding: 2px;
        }
    </style>
</head>

<body>
    <section class="section">
        <?php $dtl = $data['details']; ?>

        <div class="bold">
            <span>Load Information</span>
        </div>
        <div style="display: flex;flex-direction:row;justify-content: space-between;padding:5px 15px;">
            <div style="display: flex;flex-direction:column;margin-left:30px;">
                <div class="divflex"><label>Load ID: </label><span><?php echo $dtl['load_id']; ?></span></div>

            </div>
            <div style="display: flex;flex-direction:column;margin-right:30px;">
                <div class="divflex"><label>Reefer Temp: </label><span><?php echo $dtl['reefer_temperature'] . " " . $dtl['reefer_mode']; ?></span></div>
            </div>
        </div>




        <?php

        foreach ($dtl['stops'] as $stop) {
        ?>
            <div class="bold">
                <span><?php echo $stop['stop_category_abbr'];
                        if ($stop['stop_category_abbr'] !== 'SHIPPER' && $stop['stop_category_abbr'] != 'CONSIGNEE') {
                            echo " " . $stop['stop_type'];
                        } ?></span><span style="float:right;"><?php echo $stop['appointment_day']; ?>, <?php echo $stop['appointment_short_date']; ?>, <?php echo $stop['appointment_time']; ?></span>
            </div>
            <div style="display: flex;flex-direction:row;justify-content: space-between;padding:5px 15px;">
                <div style="display: flex;flex-direction:column;margin-left:30px;">
                    <div class="divflex"><label>Name: </label><span><?php echo $stop['location_name']; ?></span></div>
                    <div class="divflex"><label>Address: </label><span><?php echo $stop['location_address']; ?></span></div>
                    <div class="divflex"><label>City/St/zip: </label><span class="box"><?php echo $stop['location_city_state_zip']; ?></span></div>



                </div>
                <div style="display: flex;flex-direction:column;margin-right:30px;">
                    <div class="divflex"><label>Service Level: </label><span><?php echo $stop['appointment_type']; ?></span></div>
                    <div class="tableflex" style="justify-content: flex-start;">
                        <table>
                            <thead>
                                <tr>
                                    <th style="min-width: 40px;">#</th>
                                    <th style="min-width: 50px;">Pallet</th>
                                    <th style="min-width: 60px;">Case</th>
                                    <th style="min-width: 70px;">Reference</th>
                                </tr>
                            </thead>

                            <tbody>
                                <?php
                                foreach ($stop['quantity_roc'] as $quantity) {
                                ?>
                                    <tr>
                                        <td style="min-width: 40px;"><?php echo $quantity['pd_number']; ?></td>
                                        <td style="min-width: 50px;"><?php echo $quantity['pallet_count_ship']; ?></td>
                                        <td style="min-width: 60px;"><?php echo $quantity['case_count_ship']; ?></td>
                                        <td style="min-width: 70px;"><?php echo $quantity['reference_number']; ?></td>
                                    </tr>
                                <?php
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        <?php

        }
        ?>
    </section>

</body>

</html>