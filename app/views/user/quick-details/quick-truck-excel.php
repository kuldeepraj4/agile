<script type="text/javascript">
    var tableToExcel = (function tableToExcel() {
        // Define your style class template.
        var uri = 'data:application/vnd.ms-excel;base64,',
            template = '<html xmlns:o="urn:schemas-microsoft-com:office:office" xmlns:x="urn:schemas-microsoft-com:office:excel" xmlns="http://www.w3.org/TR/REC-html40"><head><!--[if gte mso 9]><xml><x:ExcelWorkbook><x:ExcelWorksheets><x:ExcelWorksheet><x:Name>{worksheet}</x:Name><x:WorksheetOptions><x:DisplayGridlines/></x:WorksheetOptions></x:ExcelWorksheet></x:ExcelWorksheets></x:ExcelWorkbook></xml><![endif]--></head><body><table>{table}</table></body></html>',
            base64 = function(s) {
                return window.btoa(unescape(encodeURIComponent(s)))
            },
            format = function(s, c) {
                return s.replace(/{(\w+)}/g, function(m, p) {
                    return c[p];
                })
            }
        return function(table, name) {
            if (!table.nodeType) table = document.getElementById(table)
            var ctx = {
                worksheet: name || 'Worksheet',
                table: table.innerHTML
            }
             var link = document.createElement("a");
            link.download = name;
            link.href = uri + base64(format(template, ctx));
            link.click();
            //window.location.href = uri + base64(format(template, ctx))
        }
    })()
</script>
<table id="personal" style="display: none;">
    </thead>
    <tbody>
        <td colspan="11" style="font-weight:bolder; background-color: #486e94; color: #fff; text-align:center;">TRUCK ID <?php echo $details['code']; ?>
        </td>
        <tr></tr>
        <tr>
            <td colspan="2" align="center" style="background-color: #486e94; color: #fff;">Basic Details</td>
            <td></td>
            <td></td>
            <td colspan="2" align="center" style="background-color: #486e94; color: #fff">Insurance details</td>
            <td></td>
            <td></td>
            <td colspan="2" align="center" style="background-color: #486e94; color: #fff">Permits</td>
        </tr>
        <tr>
            <td>Status</td>
            <td align="left"><?php echo $details['status']; ?></td>
            <td></td>
            <td></td>
            <td>Insurance status</td>
            <td align="left"><?php echo $details['insurance_status']; ?></td>
            <td></td>
            <td></td>
            <td>FHVUT</td>
            <td align="left"><?php echo $details['fhvut_status']; ?></td>
        </tr>
        <tr>
            <td>Equipment group</td>
            <td align="left"><?php echo $details['group']; ?></td>
            <td></td>
            <td></td>
            <td>Insurance carrier</td>
            <td align="left"><?php echo $details['insurance_company_name']; ?></td>
            <td></td>
            <td></td>
            <td>Paid date</td>
            <td align="left"><?php echo $details['fhvut_paid_date']; ?></td>
        </tr>
        <tr>
            <td>Company</td>
            <td align="left"><?php echo $details['company']; ?></td>
            <td></td>
            <td></td>
            <td>Insurance start date</td>
            <td align="left"><?php echo $details['insurance_start_date']; ?></td>
            <td></td>
            <td></td>
            <td>Oregon permit issue</td>
            <td align="left"><?php echo $details['oregon_permit_status']; ?></td>
        </tr>
        <tr>
            <td>Make Year</td>
            <td align="left"><?php echo $details['make_year']; ?></td>
            <td></td>
            <td></td>
            <td>Insurance expiry date</td>
            <td align="left"><?php echo $details['insurance_expiry_date']; ?></td>
            <td></td>
            <td></td>
            <td>Family engine no.</td>
            <td align="left"><?php echo $details['family_engine_number']; ?></td>
        </tr>
        <tr>
            <td>Make</td>
            <td align="left"><?php echo $details['make']; ?></td>
            <td></td>
            <td></td>
            <td>Liability</td>
            <td align="left"><?php echo $details['liability_status']; ?></td>
            <td></td>
            <td></td>
            <td>IFTA</td>
            <td align="left"><?php echo $details['ifta_status']; ?></td>
        </tr>
        <tr>
            <td>Model</td>
            <td align="left"><?php echo $details['model']; ?></td>
            <td></td>
            <td></td>
            <td>Cargo</td>
            <td align="left"><?php echo $details['cargo_status']; ?></td>
            <td></td>
            <td></td>
            <td>PIFTA</td>
            <td align="left"><?php echo $details['pifta_status']; ?></td>
        </tr>
        <tr>
            <td>Color</td>
            <td align="left"><?php echo $details['color']; ?> </td>
            <td></td>
            <td></td>
            <td>P/D value</td>
            <td align="left"><?php echo $details['pd_value']; ?></td>
            <td></td>
            <td></td>
            <td>NM permit</td>
            <td align="left"><?php echo $details['nm_status']; ?></td>
        </tr>
        <tr>
            <td>VIN</td>
            <td align="left"><?php echo $details['vin']; ?> </td>
            <td></td>
            <td></td>
            <td>Loss pay info</td>
            <td align="left"><?php echo $details['loss_pay_info']; ?></td>
            <td></td>
            <td></td>
            <td>Pre pass</td>
            <td align="left"><?php echo $details['pre_pass']; ?></td>
        </tr>
        <tr>
            <td>Licence tag no.</td>
            <td align="left"><?php echo $details['licence_tag_no']; ?> </td>
            <td></td>
            <td></td>
            <td>P/D value new</td>
            <td align="left"><?php echo $details['new_pd_value']; ?></td>
            <td></td>
            <td></td>
            <td>Pre pass remark</td>
            <td align="left"><?php echo $details['pre_pass_remark']; ?></td>
        </tr>

        <tr>

            <td>Licence tag expiry</td>
            <td align="left"><?php echo $details['licence_tag_expiry_date']; ?> </td>
            <td></td>
            <td></td>
            <td colspan="2" style="font-weight:bolder; background-color: #486e94; color: #fff; text-align:center;">-------</td>
            
            <td></td>
            <td></td>
            <td>HUT</td>
            <td align="left"><?php echo $details['hut']; ?></td>
        
            
           
            
           
        </tr>
        <tr>
            <td>State</td>
            <td align="left"><?php echo $details['licence_state']; ?></td>
            <td></td>
            <td></td>
            <td>Device type</td>
            <td align="left"><?php echo $details['device_company_name']; ?></td>
            <td></td>
            <td></td>
            <td>HUT remarks</td>
            <td align="left"><?php echo $details['hut_remark']; ?></td>
        </tr>
        <tr>
            <td colspan="2" style="font-weight:bolder; background-color: #486e94; color: #fff; text-align:center;">Lease details</td>
            
            <td> </td>
             <td></td>
            
            <td>Gateway serial no.</td>
            <td align="left"><?php echo $details['device_serial_no']; ?></td>
            <td></td>
            <td></td>
            <td colspan="2" style="font-weight:bolder; background-color: #486e94; color: #fff; text-align:center;">IoT Devices</td>
            <td></td>
            <td></td>
        </tr>
        <tr>
             <td>Ownership Type</td>
            
            <td align="left"><?php echo $details['ownership_type']; ?> </td>
            
            <td></td>
            <td></td>
            
             <td>Dash cam No.</td>
            <td align="left"><?php echo $details['device_dash_cam_no']; ?></td>
            <td></td>
            <td></td>
            <td>Odometer update type</td>
            <td align="left"><?php echo $details['odometer_update_type']; ?></td>
        </tr>
        <tr>
            <td>Lease Ref No.</td>
            <td align="left"><?php echo $details['lease_ref_no']; ?> </td>
          
            <td></td>
            <td></td>
            <td>Halo no.</td>
            <td align="left"><?php echo $details['halo']; ?></td>
            <td></td>
            <td></td>
            <td>Current Odometer Reading</td>
            <td align="left"><?php echo $details['current_odometer_reading']; ?></td>
        </tr>
        <tr>
            <td>Leasing company</td>
            <td align="left"><?php echo $details['lease_company']; ?> </td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td>Odometer Updated On</td>
            <td align="left"><?php echo $details['odometer_updated_on']; ?></td>
        </tr>
        <tr>
            <td>Leasing expiry</td>
            <td align="left"><?php echo $details['lease_expiry_date']; ?></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td>Engine Hours Update Type</td>
            <td align="left"><?php echo $details['engine_hours_update_type']; ?></td>
        </tr>
        <tr>
            <td></td>
            <td> </td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td>Current Engine Hours</td>
            <td align="left"><?php echo $details['current_engine_hours']; ?></td>
        </tr>
        <tr>
            <td></td>
            <td> </td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td>Updated On</td>
            <td align="left"><?php echo $details['engine_updated_on']; ?></td>
        </tr>
        <tr></tr>
        <tr>
            <td colspan="11" style="font-weight:bolder; background-color: #486e94; color: #fff; text-align:center;">Truck Documents</td>
        </tr>
        <tr>
            <th>Sr. No.</th>
            <th style='text-align:left'>Document Name</th>
            <th>Is Required</th>
            <th>Is Uploaded</th>
            <th>Expiry Days Left</th>
            <th>Expiry Date</th>
            <th></th>
            <th>Verify</th>
            <th>Uploaded By</th>
            <th>Verified By</th>
            <th>Rejected By</th>
            <th>Remarks</th>
            <!-- <th></th> -->
        </tr>
        <tr id="document_excel"></tr>
        <tr></tr>
        <tr></tr>
        <tr></tr>
        <tr>
            <td colspan="19" style="font-weight:bolder; background-color: #486e94; color: #fff; text-align:center;">Repair Order List</td>
        </tr>
        <tr>
                    <th>Sr. No.</th>
                    <th data-table-sort-by-none="id">Order ID</th>
                    <th data-table-sort-by-none="created_on">Created on</th>
                    <th data-table-sort-by-none="status">Status</th>
                    <th data-table-sort-by-none="class">Class</th>
                    <th data-table-sort-by-none="type">Type</th>
                    <th data-table-sort-by-none="driver">Driver</th>
                    <th data-table-sort-by-none="stage">Stage</th>
                    <th data-table-sort-by-none="vehicle">Vehicle</th>
                    <th data-table-sort-by-none="vehicle_id">Vehicle ID</th>
                    <th data-table-sort-by-none="start_date">Start Date</th>
                    <th data-table-sort-by-none="end_date">End Date</th>
                    <th style="min-width:500px;" data-table-sort-by-none="last_follow_up">Last Follow Up</th>
                    <th data-table-sort-by-none="next_follow_up">Next Follow Up Date</th>
                    <th style="text-align: left;" data-table-sort-by-none="issues_reported">Issues Reported</th>
                    <th style="text-align: left;" data-table-sort-by-none="issues_description">Issues Description</th>
                    <th>Created By</th>
                    <th>Resolved By</th>
                    <th>Closed By</th>
                    <!-- <th></th>
                    <th></th> -->
                </tr>
        <tr id="rolist_excel"></tr>
        <tr></tr>
        <tr></tr>
        <tr></tr>
        <tr>
            <td colspan="21" style="font-weight:bolder; background-color: #486e94; color: #fff; text-align:center;">Work Order List</td>
        </tr>
         <tr>
                    <th>Sr. No.</th>
                    <th data-table-sort-by-none="id">ID</th>
                    <th data-table-sort-by-none="date">Date</th>
                    <th data-table-sort-by-none="repair_order_id">Repair Order ID</th>
                    <th data-table-sort-by-none="repair_order_status">Repair Order Status</th>
                    <th data-table-sort-by-none="vehicle">Vehicle</th>
                    <th data-table-sort-by-none="vehicle_code">Vehicle Code</th>
                    <th data-table-sort-by-none="vehicle_hours">Vehicle Hours</th>
                    <th data-table-sort-by-none="odometer">Odometer</th>
                    <th data-table-sort-by-none="vendor">Vendor</th>
                    <th data-table-sort-by-none="city">Vendor City, State</th>
                    <th data-table-sort-by-none="amount">Amount</th>
                    <th data-table-sort-by-none="invoice_no">Invoice No.</th>
                    <th data-table-sort-by-none="Invoice">Invoice</th>
                    <th data-table-sort-by-none="payment_status">Payment Status</th>
                    <th data-table-sort-by-none="payment_mode">Payment Mode</th>
                    <th data-table-sort-by-none="payment_ref">Payment Ref No.</th>
                    <th data-table-sort-by-none="payment_date">Payment Date</th>
                    <th data-table-sort-by-none="payment_remarks">Payment Remarks</th>
                    <th>Reconciliation Status</th>
                    <th>Created By</th>
                    <!-- <th></th> -->
                </tr>
        <tr id="wolist_excel"></tr>
        <tr></tr>
        <tr></tr>
        <tr></tr>
        <tr>
            <td colspan="23" style="font-weight:bolder; background-color: #486e94; color: #fff; text-align:center;">Schedule / UnSchedule</td>
        </tr>
        <tr>
                    <th>Sr. No.</th>
                    <th>Unit No.</th>
                    <th>Location</th>
                    <th>RO No - Schedule</th>
                    <th data-table-sort-by-none="sc_repairorder_date">Date Created</th>
                    <th data-table-sort-by-none="sc_tat">TAT - Turn Around Time</th>
                    <th>Stage</th>
                    <th>Criticality Level</th>
                    <th>Job Work</th>
                    <th style="min-width:250px; padding:0px 0px; margin: 0px 0px;">Last Note</th>
                    <th data-table-sort-by-none="sc_next_followup">Followup Date</th>
                    <!-- <th>Followup</th>
                    <th>Gen WO</th> -->
                    <th>Followup Added By</th>
                    <th>RO No - Unschedule</th>
                    <th data-table-sort-by-none="un_repairorder_date">Date Created</th>
                    <th data-table-sort-by-none="un_tat">TAT - Turn Around Time</th>
                    <th>Stage</th>
                    <th>Criticality Level</th>
                    <th>Issue Reported</th>
                    <th style="min-width:250px; padding:0px 0px; margin: 0px 0px;">Last Note</th>
                    <th data-table-sort-by-none="un_next_followup">Followup Date</th>
                    <th>Followup Added By</th>
                    <!-- <th>Followup</th>
                    <th>Gen WO</th> -->
                </tr>
        <tr id="unsc_excel"></tr>



</table>