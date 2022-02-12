<?php

session_start();

if (!$_SESSION["redirected"]) {
    header("Location: index.html");
} else {
    $_SESSION["redirected"] = false;
    $_SESSION["from_link"] = false;

    require("includes/database.php");
    $link = $conn;
    $min = 1;
    $max = 211;
    $varint = rand($min, $max); //generates random number from 1 to 211 for the variant
    $query = "SELECT * FROM variants WHERE variant_id = '$varint'";

    $result = mysqli_query($link, $query);
    $row = mysqli_fetch_array($result);

    //shuffles news to make sure that display is random
    $news_arr = array();
    $news_arr[0] = (int)$row['news1'];
    $news_arr[1] = (int)$row['news2'];
    $news_arr[2] = (int)$row['news3'];
    $news_arr[3] = (int)$row['news4'];
    $news_arr[4] = (int)$row['news5'];
    shuffle($news_arr);

    $query1 = "SELECT link_news, sentence FROM news WHERE newsId='$news_arr[0]'";
    $res1 = mysqli_query($link, $query1);
    $row1 = mysqli_fetch_array($res1);

    $query2 = "select link_news,sentence from news where newsId='$news_arr[1]'";
    $res2 = mysqli_query($link, $query2);
    $row2    = mysqli_fetch_array($res2);

    $query3 = "select link_news,sentence from news where newsId='$news_arr[2]'";
    $res3 = mysqli_query($link, $query3);
    $row3    = mysqli_fetch_array($res3);

    $query4 = "select link_news,sentence from news where newsId='$news_arr[3]'";
    $res4 = mysqli_query($link, $query4);
    $row4    = mysqli_fetch_array($res4);

    $query5 = "select link_news,sentence from news where newsId='$news_arr[4]'";
    $res5 = mysqli_query($link, $query5);
    $row5    = mysqli_fetch_array($res5);

    $news1 = $row1['link_news'];
    $news2 = $row2['link_news'];
    $news3 = $row3['link_news'];
    $news4 = $row4['link_news'];
    $news5 = $row5['link_news'];

    $sentence1 = $row1['sentence'];
    $sentence2 = $row2['sentence'];
    $sentence3 = $row3['sentence'];
    $sentence4 = $row4['sentence'];
    $sentence5 = $row5['sentence'];

    $_SESSION['news1'] = $news1;
    $_SESSION['news2'] = $news2;
    $_SESSION['news3'] = $news3;
    $_SESSION['news4'] = $news4;
    $_SESSION['news5'] = $news5;
    $_SESSION['newsId1'] = $news_arr[0];
    $_SESSION['newsId2'] = $news_arr[1];
    $_SESSION['newsId3'] = $news_arr[2];
    $_SESSION['newsId4'] = $news_arr[3];
    $_SESSION['newsId5'] = $news_arr[4];
    $_SESSION['variant'] = $varint;
}

?>

<!DOCTYPE HTML>

<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Internet News - Emotion Survey</title>
    <link rel="stylesheet" type="text/css" href="style.css">
    <link rel="icon" type="icon" href="images/icon.ico">
</head>

<body>
    <main>
        <h1>Internet News - Emotion Survey</h1>
        <div class="description">
            <p>Each article in the table below is followed by a short description and two buttons. Group the items into two groups <b>A</b> and <b>B</b> according to the similiarity in the emotions that the texts evoked in you.</p>
            <!-- <p>  The data collected from this survey will be statistically analysed to draw research
                conclusions in the domain of language communication and emotion. <b>The survey is anonymous.</b></p> -->
            <p><b>Note: </b>Please, click on each of the articles in order to open the link.</p>
        </div>
        <form action="response.php" method="post">

            <div class="articles-wrapper">
                <div class="article">
                    <label><a href="<?php echo $news1;  ?>" target="_blank">Article 1</a></label>
                    <span class="sentence"><?php echo $sentence1; ?></span>
                    <div class=radio-btn-wrapper>
                        <label>A</label>
                        <input type="radio" name="article1" value="A" required>
                        <label>B</label>
                        <input type="radio" name="article1" value="B" required>
                    </div>
                </div>
                <div class="article">
                    <label><a href="<?php echo $news2;  ?>" target="_blank">Article 2</a></label>
                    <span class="sentence"><?php echo $sentence2; ?></span>
                    <div class=radio-btn-wrapper>
                        <label>A</label>
                        <input type="radio" name="article2" value="A" required>
                        <label>B</label>
                        <input type="radio" name="article2" value="B" required>
                    </div>
                </div>
                <div class="article">
                    <label><a href="<?php echo $news3;  ?>" target="_blank">Article 3</a></label>
                    <span class="sentence"><?php echo $sentence3; ?></span>
                    <div class=radio-btn-wrapper>
                        <label>A</label>
                        <input type="radio" name="article3" value="A" required>
                        <label>B</label>
                        <input type="radio" name="article3" value="B" required>
                    </div>
                </div>
                <div class="article">
                    <label><a href="<?php echo $news4;  ?>" target="_blank">Article 4</a></label>
                    <span class="sentence"><?php echo $sentence4; ?></span>
                    <div class=radio-btn-wrapper>
                        <label>A</label>
                        <input type="radio" name="article4" value="A" required>
                        <label>B</label>
                        <input type="radio" name="article4" value="B" required>
                    </div>
                </div>
                <div class="article">
                    <label><a href="<?php echo $news5;  ?>" target="_blank">Article 5</a></label>
                    <span class="sentence"><?php echo $sentence5; ?></span>
                    <div class=radio-btn-wrapper>
                        <label>A</label>
                        <input type="radio" name="article5" value="A" required>
                        <label>B</label>
                        <input type="radio" name="article5" value="B" required>
                    </div>
                </div>
                <div class="survey-lower-row-wrapper">
                    <button class="button submit-btn" name="submit-btn" value="submit-btn">Submit</button>
                    <button class="button reset-btn" value="reset-btn" type="reset">Reset</button>
                </div>
            </div>
        </form>
    </main>

    <footer>
        <div class="footer-content">
            <div class="footer-img">
                <a href="https://computerscience.nbu.bg/">
                    <img id="logo" src="images/NBU.png" alt="logo">
                    <span id="dept-name">Department of Informatics</span>
                </a>
            </div>
            <a id="login-link" href="admin.php">Admin</a>
        </div>
    </footer>
    <div id="small-screen-warning">
        <img id="phone_rotate" src="images/phone_rotate.gif" alt="phone_rotate">
        <h3>Please, rotate your device to view the content of the page.</h3>
    </div>
</body>

</html>