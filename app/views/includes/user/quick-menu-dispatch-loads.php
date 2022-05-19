<section class="q-menu">

          <?php
          echo (in_array('DIS003', USER_PRIV)) ? '<button class="btn_blue"><a  href="../user/dispatch/loads/list">All Loads</a></button>' : "";
          echo (in_array('DIS003', USER_PRIV)) ? '<button class="btn_blue"><a  href="../user/dispatch/loads/available-loads">Available Loads</a></button>' : "";
          echo (in_array('DIS003', USER_PRIV)) ? '<button class="btn_blue"><a  href="../user/dispatch/loads/dispatch-loads">Dispatch Loads</a></button>' : "";
          echo (in_array('DIS003', USER_PRIV)) ? '<button class="btn_blue"><a  href="../user/dispatch/loads/empty-movements">Empty Movements</a></button>' : "";
          ?>

</section>