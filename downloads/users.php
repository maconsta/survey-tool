<?php

session_start();

if ($_SESSION["from_link"] == true) {

    require "../includes/database.php";

    $query = $conn->query("SELECT * FROM users ORDER BY id ASC");

    if ($query->num_rows > 0) {
        $delimiter = ",";
        $filename = "members-data_" . date('Y-m-d') . ".csv";

        // Create a file pointer 
        $f = fopen('php://memory', 'w');
        $fields = array('NATIVE LANGUAGE', 'ENGLISH LEVEL');
        // Set column headers 

        fputcsv($f, $fields, $delimiter);

        // Output each row of the data, format line as csv and write to file pointer 
        while ($row = $query->fetch_assoc()) {
            // $status = ($row['trial'] == 1) ? 'Active' : 'Inactive'; # remove, maybe?
            $lineData = array($row['nlanguage'], $row['english_level']);
            fputcsv($f, $lineData, $delimiter);
        }

        // Move back to beginning of file 
        fseek($f, 0);

        // Set headers to download file rather than displayed 
        header('Content-Type: text/csv');
        header('Content-Disposition: attachment; filename="' . $filename . '";');

        //output all remaining data on a file pointer 
        fpassthru($f);
    }
} else {
    header("Location: ../index.html");
}
