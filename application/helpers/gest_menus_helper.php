<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

function create_sub_menus($code_smenu_bd,$url,$name_showing, $name_class_css)
{
      if(isset($code_smenu_bd))
      {
      ?>
        <li>
          <a href="<?php echo site_url($url); ?> ">
          <i class="<?php echo $name_class_css; ?>"></i><span><?php echo $name_showing; ?></span>
          </a>
        </li>
      <?php 
      }
}

