<?php
$fileId = $_GET['file_id'];
$pdfFile = 'uploads/';
$con=mysqli_connect("localhost","root","","apoint");
$sql="select filelink from files where id=$fileId";
$res=mysqli_query($con,$sql);
$value=mysqli_fetch_array($res);
// Fetch PDF content from the database (replace with actual PDF content)
// SELECT file_content FROM pdf_files WHERE file_id = :fileId
// Set appropriate headers
header('Content-Type: application/pdf');
header('Content-Disposition: inline; filename="'.$value[0].'"');
header('Content-Transfer-Encoding: binary');
header('Accept-Ranges: bytes');
$pdfFile = 'uploads/'.$value[0];
// Output the PDF content
readfile($pdfFile); // Replace with actual PDF content
?>
