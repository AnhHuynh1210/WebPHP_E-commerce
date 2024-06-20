<?php
    require("./../../XuLy/conSQL.php");

    $step=1000000;
    $output="";
    $label="";
    $data=[];

    $by="month";
    $where='';
    $groupBy="";
    $sortYear = date('Y');
    $sortMonth = date('m');

    $colMonth = [];
    for($i = 0 ; $i < 12 ; $i++)
    {
        $colMonth[$i] = "Tháng ".($i+1);
    }
    $colDate = [];
    for($i = 0 ; $i < 31 ; $i++)
    {
        $colDate[$i] = ($i+1);
    }
    
    if(isset($_POST['orderBy']))
    {
        $by=$_POST['orderBy'];
    }

    if($by == 'day')
    {
        for($i = 0 ; $i < count($colDate) ; $i++)
        {
            $data[$i] = 0;
        }
        $label = ArraytoString($colDate);
    }
    else{
        for($i = 0 ; $i < count($colMonth) ; $i++)
        {
            $data[$i] = 0;
        }
        $label = ArraytoString($colMonth);
    }
    
    $whereData=array();
    array_push($whereData,"receipt.status = 1");
    
    $groupByData=array();
    array_push($groupByData,"month");
    array_push($groupByData,"year");
    
    if(isset($_POST['year']))
    {
        $sortYear = $_POST['year'];
    }
    array_push($whereData,"YEAR(receiptDate) = ".$sortYear);

    // Theo Ngày
    if(isset($_POST['month']) && $by == 'day')
    {
        $sortMonth = $_POST['month'];
        array_push($whereData,"MONTH(receiptDate) = ".$sortMonth);
        array_push($groupByData,"day");
    }
    /////////////////////
    foreach ($whereData as $i => $s)
    {
        if($i+1 == count($whereData))
        {
            $where .= $s ;
        }
        else
        {
            $where .= $s." AND ";
        }
    }

    foreach ($groupByData as $i => $s)
    {
        if($i+1 == count($groupByData))
        {
            $groupBy .= $s ;
        }
        else
        {
            $groupBy .= $s.",";
        }
    }

    $sql='  SELECT SUM(receiptTotal) total,DAY(receiptDate) day,MONTH(receiptDate) month,YEAR(receiptDate) year 
            FROM `receipt` WHERE '.$where.' GROUP BY '.$groupBy.''; 
    // echo $sql;

    $rs = conSQL :: executeQuery($sql);
    while($row = mysqli_fetch_array($rs))
    {
        $n = $row[$by];
        $data[$n-1] = round($row['total']/$step); 
    }

    $myChart = new stdClass();
    $myChart->label = $label;
    $myChart->value = ArraytoString($data);
    echo json_encode($myChart);

    function ArraytoString($data)
    {
        $out ="";
        foreach($data as $i => $n)
        {
            if($i+1 == count($data))
            {
                $out .= $n;
            }
            else{
                $out .= $n.",";
            }
        }
        return $out;
    }
?>