<?php 
include("../../lib/config.inc.php");
function convert_to_csv($input_array, $output_file_name, $delimiter)
{
    // open raw memory as file, no need for temp files 
    $temp_memory = fopen('phpmemory', 'w');
    // loop through array  
    foreach ($input_array as $line)
	{
        // default php csv handler 
        fputcsv($temp_memory, $line, $delimiter);
    }
    // rewrind the file with the csv lines 
    //fseek($temp_memory, 0);
    // modify header to be downloadable csv file 
   // header('Content-Type applicationcsv');
   // header('Content-Disposition attachement; filename=' . $output_file_name . ';');
	 header('Content-Type: application/download');
     header('Content-Disposition: attachment; filename="'.$output_file_name.'"');
    // Send file to browser for download 
	
    fpassthru($temp_memory);
}

$array_to_csv = array(
    array(12566,    'Enmanuel',     'Corvo'   ),
    array(56544,  'John',   'Doe'  ),
    array(78550,    'Mark',   'Smith'  )
 
);
 
 //print_r($array_to_csv);
 
convert_to_csv($array_to_csv, 'report.csv', ',');

?>