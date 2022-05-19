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
        <tr>
            <td colspan="8" style="font-weight:bolder; background-color: #486e94; color: #fff; text-align:center;">Trip Details</td>
        </tr>
        <tr>
            <th>ID</th>
            <th>Truck ID</th>
            <th>Team/Solo</th>
            <th>Miles</th>
            <th>Start Date</th>
            <th>End Date</th>
            <th>Created By</th>
            <th>Created Datetime</th>
        </tr>
        <tr>
            <?php
            echo "<td>" . $details['id'] . "</td>
          <td>" . $details['truck_code'] . "</td>
          <td>" . $details['driver_group_name'] . "</td>
          <td>" . $details['miles'] . "</td>
          <td>" . $details['start_date'] . "</td>
          <td>" . $details['end_date'] . "</td>
          <td>" . $details['added_by_user_code'] . "<br>" . $details['added_by_user_name'] . "</td>
          <td>" . $details['added_on_date'] . " " . $details['added_on_time'] . "</td>
          ";  ?>
        </tr>
        <tr></tr>
        <tr></tr>
        <tr></tr>
        <tr>
            <td colspan="4" style="font-weight:bolder; background-color: #486e94; color: #fff; text-align:center;">Trip Stops</td>
        </tr>
        <tr>
            <th>Date</th>
            <th>Type</th>
            <th>Location</th>
            <th>Miles</th>
        </tr>
        <?php
        foreach ($details['trip_stops'] as $ts) {
            echo "<tr>
            <td>" . $ts['date'] . "</td>
            <td>" . $ts['stop_type_name'] . "</td>
            <td>" . $ts['location'] . "</td>
            <td>" . $ts['miles'] . "</td>
            <tr>";
        }
        ?>
</table>