<?Php
include("../inc/database.php");
include("../assets/fpdf/fpdf.php");

$class = $_GET['class'];
$id = $_GET['id'];
$sqlMarksTable = "SELECT s.std_id, sc.std_points, sc.total_points, s.std_matric, s.std_name FROM student_quiz sq JOIN student_score sc, student s WHERE sq.quiz_id = sc.quiz_id AND s.std_id = sc.std_id AND sq.class_id = s.class_id AND sq.class_id = $class";

$sql = "SELECT title FROM quiz_list WHERE id = $id";
$query = $conn->query($sql);
$callTitle = mysqli_fetch_assoc($query);
$quizTitle = $callTitle['title'];

$sql2 = "SELECT class_section FROM class WHERE class_id = $class";
$query2 = $conn->query($sql2);
$callClass = mysqli_fetch_assoc($query2);
$classTitle = $callClass['class_section'];

$pdf = new FPDF('P','mm','A4');
$pdf->AddPage();
$pdf->SetFont('Arial','B',10);



$width_cell=array(15,110,35,15,20);
$pdf->SetFillColor(193,229,252); // Background color of header 
// Header starts /// 

$pdf->Cell($width_cell[0],10,'ID',1,0,'C',true); // First header column 
$pdf->Cell($width_cell[1],10,'NAME',1,0,'C',true); // Second header column
$pdf->Cell($width_cell[2],10,'STUDENT MATRIC',1,0,'C',true); // Third header column 
$pdf->Cell($width_cell[3],10,'MARKS',1,0,'C',true); // Fourth header column
$pdf->Cell($width_cell[4],10,'TOTAL',1,1,'C',true); // Fourth header column
//// header is over ///////

$pdf->SetFont('Arial','',10);
// row of data 
foreach ($conn->query($sqlMarksTable) as $row) {
	$pdf->Cell($width_cell[0],10,$row['std_id'],1,0,'C',$fill);
	$pdf->Cell($width_cell[1],10,$row['std_name'],1,0,'L',$fill);
	$pdf->Cell($width_cell[2],10,$row['std_matric'],1,0,'C',$fill);
	$pdf->Cell($width_cell[3],10,$row['std_points'],1,0,'C',$fill);
	$pdf->Cell($width_cell[4],10,$row['total_points'],1,1,'C',$fill);
	//to give alternate background fill  color to rows//
	$fill = !$fill;
	}
// row of data is over 
$pdf->Cell(40,10,$quizTitle);
$pdf->Cell(40,10,$classTitle);
$pdf->Output();

?>