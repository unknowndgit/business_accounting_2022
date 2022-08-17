








<?php

if (isset($_REQUEST['selling_page']) && $_REQUEST['selling_page']=="invoice")
{
require SERVER_ROOT . '/protected/views/frontend/selling_invoice.php';

}
 elseif (isset($_REQUEST['selling_page']) && $_REQUEST['selling_page']=="can")
{
require SERVER_ROOT . '/protected/views/frontend/selling_can.php';

}
 elseif (isset($_REQUEST['selling_page']) && $_REQUEST['selling_page']=="receive_money")
{
require SERVER_ROOT . '/protected/views/frontend/selling_receive_money.php';

}else
{
	require SERVER_ROOT . '/protected/views/frontend/selling_estimates.php';
}?>



