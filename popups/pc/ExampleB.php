<?php
 /*
     Example23 : Playing with background bis
 */

 // Standard inclusions   
 include_once("pChart/pData.class");
 include_once("pChart/pChart.class");

 // Dataset definition 
 $DataSet = new pData;
 $DataSet->AddPoint(array(9,9,9,10,10,11,12,14,16,17,18,18,19,19,18,15,12,10,9),"Serie1");
 $DataSet->AddPoint(array(4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20,21,22),"Serie3");
 $DataSet->AddAllSeries();
 $DataSet->RemoveSerie("Serie3");
 $DataSet->SetAbsciseLabelSerie("Serie3");
 $DataSet->SetSerieName("January","Serie1");
 $DataSet->SetYAxisName("Temperature");
 $DataSet->SetYAxisUnit("°C");
// $DataSet->SetXAxisUnit("h");

 // Initialise the graph
 $Test = new pChart(700,230);
// $Test->loadColorPalette('palette.txt');  
 $Test->drawGraphAreaGradient(132,173,131,50,TARGET_BACKGROUND);

 $Test->setFontProperties("Fonts/tahoma.ttf",8);
 $Test->setGraphArea(120,20,675,190);
 $Test->drawGraphArea(213,217,221,FALSE);
 $Test->drawScale($DataSet->GetData(),$DataSet->GetDataDescription(),SCALE_ADDALL,213,217,221,TRUE,0,2,TRUE);
 $Test->drawGraphAreaGradient(163,203,167,50);
 $Test->drawGrid(4,TRUE,230,230,230,20);

 // Draw the bar chart
 $Test->drawStackedBarGraph($DataSet->GetData(),$DataSet->GetDataDescription(),70);

 // Draw the legend
 $Test->setFontProperties("Fonts/tahoma.ttf",8);
 $Test->drawLegend(610,10,$DataSet->GetDataDescription(),236,238,240,52,58,82);

 // Render the picture
 $Test->addBorder(2);
 $Test->Render("exampleB.png");
?>
