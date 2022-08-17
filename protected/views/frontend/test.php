<?php $all_transctions=$db->get_all('account_transaction');
print_r($all_transctions);
echo "<br>";

foreach ($all_transctions as $alt){
$account_nature=$db->get_var('accounts',array('id'=>$alt['account_id']),'nature');
$account_name=$db->get_var('accounts',array('id'=>$alt['account_id']),'account_name');
$type=$alt['transaction_type'];
$am=$alt['amount'];


if ($type=="debit"){

    if ($account_nature=="assets" || $account_nature=="expense" || $account_nature=="cogs")
    {
        $sign="+";
    }else
    {
        $sign="-";

    }
    echo $type;
    echo "<br>";
    echo $account_nature;
    echo "<br>";
    echo $account_name;
    echo "<br>";
    echo $sign;
    echo "<br>";
    echo $am;
}
elseif ($type=="credit"){

    if ($account_nature=="assets" || $account_nature=="expense" || $account_nature=="cogs")	             {
        $sign="-";
    }else {
        $sign="+";
    }
   echo $type;
    echo "<br>";
    echo $account_nature;
    echo "<br>";
    echo $account_name;
    echo "<br>";
    echo $sign;
    echo "<br>";
    echo $am;
}


echo "<br>--------------------------------------------------------------";
echo "<br>";
}
?>