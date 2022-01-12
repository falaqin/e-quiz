<?php 
include("../inc/database.php");
include("../assets/fpdf/fpdf.php");

$userid = $_GET['id'];

$sql_total_quiz = "SELECT COUNT(id) AS totalquiz FROM quiz_list WHERE u_id = $userid";
$query_quiz=$conn->query($sql_total_quiz);
$call_quiz=mysqli_fetch_assoc($query_quiz);

$sql_total_lecturer = "SELECT COUNT(u_id) AS totallecturer FROM user WHERE u_access_lvl = 2";
$query_lecturer=$conn->query($sql_total_lecturer);
$call_lecturer=mysqli_fetch_assoc($query_lecturer);

$SQLTotalStudents = "SELECT COUNT(std_id) AS totalstudents FROM student";
$QueryTotalStudents=$conn->query($SQLTotalStudents);
$CallTotalStudents=mysqli_fetch_assoc($QueryTotalStudents);

$sql_total_student_answer = "SELECT COUNT(student_score.id) AS students_answered FROM student_score INNER JOIN quiz_list WHERE student_score.quiz_id = quiz_list.id AND quiz_list.u_id = $userid";
$query_student = $conn->query($sql_total_student_answer);
$call_student = mysqli_fetch_assoc($query_student);

$pdf = new FPDF('P','mm','A4'); //use new class
$pdf->AddPage();
$pdf->SetTitle('E-Quiz Career Summary');

//			chart properties
//position
$chartX=10;
$chartY=10;

//dimension
$chartWidth=150;
$chartHeight=100;

//padding
$chartTopPadding=10;
$chartLeftPadding=20;
$chartBottomPadding=20;
$chartRightPadding=5;

//chart box
$chartBoxX=$chartX+$chartLeftPadding;
$chartBoxY=$chartY+$chartTopPadding;
$chartBoxWidth=$chartWidth-$chartLeftPadding-$chartRightPadding;
$chartBoxHeight=$chartHeight-$chartBottomPadding-$chartTopPadding;

//bar width
$barWidth=20;

//chart data
$data=Array(
	'Total Students in E-Quiz'=>[
		'color'=>[50,50,0],
		'value'=>$CallTotalStudents['totalstudents']],

	'Quiz You\'ve Created'=>[
		'color'=>[255,0,0],
		'value'=>$call_quiz['totalquiz']],

	'Student Answered your Quiz'=>[
		'color'=>[50,0,255],
		'value'=>$call_student['students_answered']]
	);

//$dataMax
$dataMax=0;
foreach($data as $item){
	if($item['value']>$dataMax)$dataMax=$item['value'];
}

//data step
$dataStep=10;

//set font, line width and color
$pdf->SetFont('Arial','',9);
$pdf->SetLineWidth(0.2);
$pdf->SetDrawColor(0);

//chart boundary
$pdf->Rect($chartX,$chartY,$chartWidth,$chartHeight);

//vertical axis line
$pdf->Line(
	$chartBoxX ,
	$chartBoxY , 
	$chartBoxX , 
	($chartBoxY+$chartBoxHeight)
	);
//horizontal axis line
$pdf->Line(
	$chartBoxX-2 , 
	($chartBoxY+$chartBoxHeight) , 
	$chartBoxX+($chartBoxWidth) , 
	($chartBoxY+$chartBoxHeight)
	);

///vertical axis
//calculate chart's y axis scale unit
$yAxisUnits=$chartBoxHeight/$dataMax;

//draw the vertical (y) axis labels
for($i=0 ; $i<=$dataMax ; $i+=$dataStep){
	//y position
	$yAxisPos=$chartBoxY+($yAxisUnits*$i);
	//draw y axis line
	$pdf->Line(
		$chartBoxX-2 ,
		$yAxisPos ,
		$chartBoxX ,
		$yAxisPos
	);
	//set cell position for y axis labels
	$pdf->SetXY($chartBoxX-$chartLeftPadding , $yAxisPos-2);
	//$pdf->Cell($chartLeftPadding-4 , 5 , $dataMax-$i , 1);---------------
	$pdf->Cell($chartLeftPadding-4 , 5 , $dataMax-$i, 0 , 0 , 'R');
}

///horizontal axis
//set cells position
$pdf->SetXY($chartBoxX , $chartBoxY+$chartBoxHeight);

//cell's width
$xLabelWidth=$chartBoxWidth / count($data);

//$pdf->Cell($xLabelWidth , 5 , $itemName , 1 , 0 , 'C');-------------
//loop horizontal axis and draw the bar
$barXPos=0;
foreach($data as $itemName=>$item){
	//print the label
	//$pdf->Cell($xLabelWidth , 5 , $itemName , 1 , 0 , 'C');--------------
	$pdf->Cell($xLabelWidth , 5 , $itemName , 0 , 0 , 'C');
	
	///drawing the bar
	//bar color
	$pdf->SetFillColor($item['color'][0],$item['color'][1],$item['color'][2]);
	//bar height
	$barHeight=$yAxisUnits*$item['value'];
	//bar x position
	$barX=($xLabelWidth/2)+($xLabelWidth*$barXPos);
	$barX=$barX-($barWidth/2);
	$barX=$barX+$chartBoxX;
	//bar y position
	$barY=$chartBoxHeight-$barHeight;
	$barY=$barY+$chartBoxY;
	//draw the bar
	$pdf->Rect($barX,$barY,$barWidth,$barHeight,'DF');
	//increase x position (next series)
	$barXPos++;
}

//axis labels
$pdf->SetFont('Arial','B',12);
$pdf->SetXY($chartX,$chartY);
$pdf->Cell(100,10,"Amount",0);
$pdf->SetXY(($chartWidth/2)-50+$chartX,$chartY+$chartHeight-($chartBottomPadding/2));
$pdf->Cell(100,5,"Summarization",0,0,'C');


$pdf->Output();
?>