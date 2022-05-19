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
    <tbody>
        <td colspan="10" style="font-weight:bolder; background-color: #486e94; color: #fff; text-align:center;">DRIVER <?php echo $details['code'] . ' ' . $details['name']; ?>
        </td>
        <tr></tr>
        <tr>
            <td colspan="2" align="center" style="background-color: #486e94; color: #fff;">Personal Details</td>
            <td></td>
            <td></td>
            <td colspan="2" align="center" style="background-color: #486e94; color: #fff">------</td>
            <td></td>
            <td></td>
            <td colspan="2" align="center" style="background-color: #486e94; color: #fff">Followups / Technical Details</td>
        </tr>
        <tr>
            <td>Status</td>
            <td align="left"><?php echo $details['status']; ?></td>
            <td></td>
            <td></td>
            <td>Company</td>
            <td align="left"><?php echo $details['company']; ?></td>
            <td></td>
            <td></td>
            <td>Last Annual Review Date</td>
            <td align="left"><?php echo $details['last_annual_review_date']; ?></td>
        </tr>
        <tr>
            <td>Driver ID</td>
            <td align="left"><?php echo $details['code']; ?></td>
            <td></td>
            <td></td>
            <td>Joining Date</td>
            <td align="left"><?php echo $details['date_of_joining']; ?></td>
            <td></td>
            <td></td>
            <td>Next Annual Review Date</td>
            <td align="left"><?php echo $details['next_annual_review_date']; ?></td>
        </tr>
        <tr>
            <td>Name</td>
            <td align="left"><?php echo $details['prefix'] . ' ' . $details['name']; ?></td>
            <td></td>
            <td></td>
            <td>Route Type</td>
            <td align="left"><?php echo $details['route_type']; ?></td>
            <td></td>
            <td></td>
            <td>Truck Assigned</td>
            <td align="left"><?php echo $details['truck_code']; ?></td>
        </tr>
        <tr>
            <td>Date Of Birth</td>
            <td align="left"><?php echo $details['dob']; ?></td>
            <td></td>
            <td></td>
            <td>CDL No.</td>
            <td align="left"><?php echo $details['cdl_number']; ?></td>
            <td></td>
            <td></td>
            <td>Insurance Added</td>
            <td align="left"><?php echo $details['insurance_added_status']; ?></td>
        </tr>
        <tr>
            <td>Moblie Number</td>
            <td align="left"><?php echo $details['mobile_number_display']; ?></td>
            <td></td>
            <td></td>
            <td>CDL State</td>
            <td align="left"><?php echo $details['cdl_state']; ?></td>
            <td></td>
            <td></td>
            <td>Group</td>
            <td align="left"><?php echo $details['group']; ?></td>
        </tr>
        <tr>
            <td>Email Number</td>
            <td align="left"><?php echo $details['email']; ?></td>
            <td></td>
            <td></td>
            <td>CDL Issue Date</td>
            <td align="left"><?php echo $details['cdl_issue_date']; ?></td>
            <td></td>
        </tr>
        <tr>
            <td>Address Line</td>
            <td align="left"><?php echo $details['address_line']; ?> </td>
            <td></td>
            <td></td>
            <td>CDL Expiry Date</td>
            <td align="left"><?php echo $details['cdl_expiry_date']; ?></td>
            <td></td>
        </tr>
        <tr>
            <td>State</td>
            <td align="left"><?php echo $details['address_state_name']; ?> </td>
            <td></td>
            <td></td>
            <td>SSN No.</td>
            <td align="left"><?php echo $details['ssn_number_enc']; ?></td>
            <td></td>
        </tr>
        <tr>
            <td>City</td>
            <td align="left"><?php echo $details['address_city_name']; ?> </td>
            <td></td>
            <td></td>
            <td>Residency</td>
            <td align="left"><?php echo $details['residency_type']; ?></td>
            <td></td>
        </tr>
        <tr>
            <td>ZIP Code</td>
            <td align="left"><?php echo $details['address_zipcode_name']; ?> </td>
            <td></td>
            <td></td>
            <td>Residency Expiry Date</td>
            <td align="left"><?php echo $details['residency_expiry_date']; ?></td>
            <td></td>
        </tr>
        <tr>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td>Medical Issue Date</td>
            <td align="left"><?php echo $details['medical_issue_date']; ?></td>
            <td></td>
        </tr>
        <tr>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td>Medical Expiry Date</td>
            <td align="left"><?php echo $details['medical_expiry_date']; ?></td>
            <td></td>
        </tr>
        <tr>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td>GFR</td>
            <td align="left"><?php echo $details['gfr']; ?></td>
            <td></td>
        </tr>
        <tr>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td>EPN Enroll</td>
            <td align="left"><?php echo $details['epn_enroll_status']; ?></td>
            <td></td>
        </tr>
        <tr>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
        </tr>
        <tr></tr> 
        <tr>
            <td colspan="8" style="font-weight:bolder; background-color: #486e94; color: #fff; text-align:center;">Driver Trips List</td>
        </tr>
        <tr>
            <th>Sr. No.</th>
            <th>Trip ID</th>
            <th>Trip Date</th>
            <th>Truck ID</th>
            <th style="text-align: right;">Miles</th>
            <th>PPM</th>
            <th style="text-align: right;">Basic Earnings</th>
            <th style="text-align: right;">Incentive</th>
            <th></th>
        </tr>
        <tr id="trip_excel"></tr>
        <tr></tr>
        <tr></tr>
        <tr></tr>
        <tr>
            <td colspan="10" style="font-weight:bolder; background-color: #486e94; color: #fff; text-align:center;">Settlements of <?php echo $details['code'] . ' ' . $details['name']; ?></td>
        </tr>
        <tr>
            <th>Sr. No.</th>
            <th>Payment ID</th>
            <th>Type</th>
            <th style="text-align: left;">Category</th>
            <th>Trip ID</th>
            <th>Parameter ID</th>
            <th style="text-align: right;">Payable</th>
            <th style="text-align: right;">Paid</th>
            <th style="text-align: right;">Balance</th>
            <th style="max-width:160px;word-wrap: break-word;">Remarks</th>
            <th></th>
        </tr>
        <tr id="payment_excel"></tr>
        <tr></tr>
        <tr></tr>
        <tr></tr>
        <tr>
            <td colspan="13" style="font-weight:bolder; background-color: #486e94; color: #fff; text-align:center;">All Drivers Documents</td>
        </tr>
        <tr>
          <th>Sr. No.</th>
          <th style='text-align:left' data-table-sort-by-none="driver">Driver</th>
          <th style='text-align:left' data-table-sort-by-none="document">Document</th>
          <th>Is Required</th>
          <th>Is Uploaded</th>
          <th data-table-sort-by-none="expiryleft">Expiry Days Left</th>
          <th data-table-sort-by-none="expiryd">Expiry Date</th>
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



</table>
