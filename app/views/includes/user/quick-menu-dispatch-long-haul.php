<section class="q-menu">

          <?php
          echo (in_array('DIS053', USER_PRIV)) ? '<button class="btn_blue"><a  href="../user/dispatch/lh-assignment/driver-wise">Driver Wise</a></button>' : "";
          echo (in_array('DIS053', USER_PRIV)) ? '<button class="btn_blue"><a  href="../user/dispatch/lh-assignment/load-wise">Load Wise</a></button>' : "";
          ?>

</section>

