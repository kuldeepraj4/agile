<ul id="menu-main">
  <li><a  href="../user/task-management/dashboard">Dashboard</a></li>

   <?php
    echo (in_array('TMS0002', USER_PRIV)) ? ' <li><a>Tickets</a>':""; ?>
    <ul>
      <?php
    echo (in_array('TMS0002', USER_PRIV)) ? '<li><a href="../user/task-management/tickets/summary">Summary</a></li>':"";
      ?>   
    </ul>
  </li>

</ul>
</li>

</ul> 

