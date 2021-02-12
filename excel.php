<?PHP
require_once 'Classes/PHPExcel.php';
 // Имя загружаемого файла. 
 //В моём примере получится users.xls
$filename = "users" . ".xls";



// Подключение к бд
$con = mysqli_connect("localhost","mysql","mysql", "test2.shershen");// Хост юзер и пароль
if( !$con){
  echo mysqli_error($con);
  exit;
}

$excel = new PHPExcel();

$excel->setActiveSheetIndex(0);

$query = mysqli_query($con, "select * from users");
$row = 4;
while ($data = mysqli_fetch_object($query)){
  $excel->getActiveSheet()
  ->setCellValue('A'.$row , $data->id)
  ->setCellValue('B'.$row , $data->email)
  ->setCellValue('C'.$row , $data->password);

  $row++;
}

$excel->getActiveSheet()->getColumnDimension('A')->setWidth(10);
$excel->getActiveSheet()->getColumnDimension('B')->setWidth(30);
$excel->getActiveSheet()->getColumnDimension('C')->setWidth(100);

//redirect to browser (download) instead of saving the result as a file
//this is for MS Office Excel xls format
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment; filename="users.xlsx"');
header('Cache-Control: max-age=0');

//write the result to a file
$file = PHPExcel_IOFactory::createWriter($excel,'Excel2007');
//output to php output instead of filename
$file->save('php://output');
?>