<?php
include "../bmc/main.php"; //bodya

$str= /*utf8_encode($lang['stat_click']." = "*/'Total hits per page: '.$db->evaluate("SELECT count(*) FROM ".MY_PRF."stat WHERE click = ".a($_GET['post']));

$qq = "
SELECT count(click), FROM_UNIXTIME(time, '%Y-%m-%d') FROM `".MY_PRF."stat`
where click = ".a($_GET['post'])." AND to_days(now())-to_days(FROM_UNIXTIME(time, '%Y-%m-%d %H:%i:%s')) <= 30
	group by 2";
//echo $qq;die;
	
$raw = $db->query($qq);

for($i=0; $i<31; $i++){
			$ary1[$i]=0;
			$ary2[$i]=Date('Y-m-d', time()-(30-$i)*60*60*24);

	foreach($raw as $r){
		if($r["FROM_UNIXTIME(time, '%Y-%m-%d')"] == $ary2[$i])
			$ary1[$i]=$r["count(click)"];
//			unset($r);
//			break;
	}
	$ary2[$i] = substr($ary2[$i],5);
}

$qq = "
SELECT count(click), FROM_UNIXTIME(time, '%Y-%m-%d') FROM `".MY_PRF."stat`
where click = ".a($_GET['post'])." AND to_days(now())-to_days(FROM_UNIXTIME(time, '%Y-%m-%d %H:%i:%s')) > 30 AND to_days(now())-to_days(FROM_UNIXTIME(time, '%Y-%m-%d %H:%i:%s')) <= 60
	group by 2";
//echo $qq;die;
	
$raw = $db->query($qq);

for($i=31; $i<61; $i++){
			$ary3[$i]=0;
			$ary4[$i]=Date('Y-m-d', time()-(91-$i)*60*60*24);

	foreach($raw as $r){
		if($r["FROM_UNIXTIME(time, '%Y-%m-%d')"] == $ary4[$i])
			$ary3[$i]=$r["count(click)"];
//			unset($r);
//			break;
	}
	$ary4[$i] = substr($ary4[$i],5);
}
/*
print_r($raw);
print_r($ary1);
print_r($ary2);die;
*/









 include_once("pChart/pData.class");
 include_once("pChart/pChart.class");

 // Dataset definition 
 $DataSet = new pData;
 $DataSet->AddPoint($ary3,"Serie1");
 $DataSet->AddPoint($ary4,"Serie3");
 $DataSet->AddPoint($ary1,"Serie1");
 $DataSet->AddPoint($ary2,"Serie3");
 $DataSet->AddAllSeries();
 $DataSet->RemoveSerie("Serie3");
 $DataSet->SetAbsciseLabelSerie("Serie3");
 $DataSet->SetYAxisName("H I T S");

 // Initialise the graph
 $Test = new pChart(910,320);
// $Test->loadColorPalette('palette.txt');  
 $Test->drawGraphAreaGradient(132,173,131,50,TARGET_BACKGROUND);

 $Test->setFontProperties("Fonts/tahoma.ttf",8);
 $Test->setGraphArea(60,45,875,250);
 $Test->drawGraphArea(213,217,221,FALSE);
 $Test->setFontProperties("Fonts/tahoma.ttf",9);
 $Test->drawScale($DataSet->GetData(), $DataSet->GetDataDescription(), SCALE_ADDALL,213,217,221,TRUE,90,0,TRUE);
 $Test->drawGraphAreaGradient(163,203,167,50);
 $Test->drawGrid(4,TRUE,230,230,230,20);

 // Draw the bar chart
 $Test->drawStackedBarGraph($DataSet->GetData(),$DataSet->GetDataDescription(),80);

 // Draw the legend
 $Test->setFontProperties("Fonts/tahoma.ttf",8);
 $DataSet->SetSerieName(Date('F', time()),"Serie1");
 $Test->drawLegend(810,30,$DataSet->GetDataDescription(),236,238,240,52,58,82);
 $DataSet->SetSerieName(Date('F', time()-60*60*24*31),"Serie1");
 $Test->drawLegend(810,8,$DataSet->GetDataDescription(),236,238,240,52,58,82);

 // Render the picture
 $Test->setFontProperties("Fonts/tahoma.ttf",15);
 $Test->drawTitle(349,28,$str,255,20,20,-1,-1,1);
 $Test->addBorder(1,100,100,250);
$Test->Stroke();


?>