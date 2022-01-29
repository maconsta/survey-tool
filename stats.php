<?php

session_start();

if (!$_SESSION["redirected"]) {
    header("Location: index.html?error=unauthorised");
    exit();
} else {
    $_SESSION["redirected"] = false;
    $_SESSION["from_link"] = true;
    require "includes/database.php";

    //the following check will make sure that the session has not expired
    if (!array_key_exists('user', $_SESSION)) {
        header("Location: index.html?error=session_expired");
        exit();
    }
}
?>


<!DOCTYPE HTML>

<html>

<head>
    <meta charset="UTF-8">
    <title>Internet News - Emotion Survey</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>

<body>

    <main>
        <div>
            <span class="download-links">Click <a href="downloads/evaluations.php" target="_blank">here </a>to download evaluations.</span>
            <span class="download-links">Click <a href="downloads/users.php" target="_blank">here </a>to download users.</span>
            <span class="download-links">Click <a href="downloads/user_variants.php" target="_blank">here </a>to download user_variants.</span>
            <span class="download-links">Click <a href="downloads/feedback.php" target="_blank">here </a>to download feedback.</span>
        </div>
        <?php
        include_once 'includes/database.php';

        /*	if (($open = fopen("source.csv", "r")) !== FALSE) 
	{
		fgetcsv($open); // Skips the first line of CSV file
		while (($data = fgetcsv($open, 1000, ",")) !== FALSE) 
		{
			$inputArr[] = $data; 
		}
		fclose($open);
	}*/

        $query = $conn->query("SELECT newsId, grouped FROM evaluations");

        $inputArr = array();
        $num = mysqli_num_rows($query);
        if ($num > 0) {
            while ($row = mysqli_fetch_assoc($query)) {
                $inputArr[] = $row;
            }
        }


        echo "<pre>";

        /*
	// To display array data
    echo "NewsId ID\tGrouped";
    foreach ( $inputArr as $var ) {
        echo "\n", $var['newsId'], "\t\t", $var['grouped'];
    }
    */
        $fiveArr = array_chunk($inputArr, 5);

        // Fill 2D array with zeroes to index it
        $matrix = array_fill(0, 30, array_fill(0, 30, 0));

        foreach ($fiveArr as $innerArr) {
            for ($i = 0; $i <= 3; $i++) {
                for ($j = 4; $j > $i; $j--) {
                    if ($innerArr[$i]['grouped'] == $innerArr[$j]['grouped']) {
                        // Prints each combination of articles in the same group, comment out if you want to see that
                        // echo $innerArr[$i][1] . " + " . $innerArr[$j][1] . "\r\n";

                        $matrix[$innerArr[$i]['newsId'] - 1][$innerArr[$j]['newsId'] - 1] += 1;

                        // Because the matrix is mirrored, add the value to the other side of the matrix as well.
                        $matrix[$innerArr[$j]['newsId'] - 1][$innerArr[$i]['newsId'] - 1] += 1;
                    }
                }
            }
        }

        // Dumps the array, comment out if you want to see it
        // var_dump($matrix);

        // Output a table
        $out  = "";
        $out .= "<table>";
        foreach ($matrix as $key => $element) {
            $out .= "<tr>";
            foreach ($element as $subkey => $subelement) {
                $out .= "<td>$subelement</td>";
            }
            $out .= "</tr>";
        }
        $out .= "</table>";

        echo $out;
        ?>

    </main>


    <footer>
        <div class="footer-content">
            <div class="footer-img">
                <a href="https://computerscience.nbu.bg/">
                    <img id="logo" src="images/NBU.png" alt="logo">
                    <span id="dept-name">Department of Informatics</span>
                </a>
            </div>
        </div>
    </footer>

</body>

</html>