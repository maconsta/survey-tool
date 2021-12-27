<?php
session_start();
if (!isset($_SESSION["redirected"])) {
    header("Location: index.html");
}

session_unset();
?>

<!DOCTYPE HTML>

<html>

<head>
    <meta charset="UTF-8">
    <title>Internet News - Emotion Survey</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>

<body>
    <div class="main-wrapper">
        <h1>Please click on each of the articles in order to open the link.</h1>
        <div class="description">
            <p>You need to group each of these articles in either <b>A</b> or <b>B</b> group.</p>
            <p> <b>Note:</b> The data collected from this survey will be statistically analysed to draw research
                conclusions in the domain of language communication and emotion. <b>The survey is anonymous.</b></p>
        </div>
        <form action="response.php" method="post">

            <div class="articles-wrapper">
                <div class="article">
                    <label><a href="here we should put query to db to get news link" target="_blank">Article 1</a></label>
                    <div class=radio-btn-wrapper>
                        <label>A</label>
                        <input type="radio" name="article1" value="A" required>
                        <label>B</label>
                        <input type="radio" name="article1" value="B" required>
                    </div>
                </div>
                <div class="article">
                    <label><a href="here we should put query to db to get news link" target="_blank">Article 2</a></label>
                    <div class=radio-btn-wrapper>
                        <label>A</label>
                        <input type="radio" name="article2" value="A" required>
                        <label>B</label>
                        <input type="radio" name="article2" value="B" required>
                    </div>
                </div>
                <div class="article">
                    <label><a href="here we should put query to db to get news link" target="_blank">Article 3</a></label>
                    <div class=radio-btn-wrapper>
                        <label>A</label>
                        <input type="radio" name="article3" value="A" required>
                        <label>B</label>
                        <input type="radio" name="article3" value="B" required>
                    </div>
                </div>
                <div class="article">
                    <label><a href="here we should put query to db to get news link" target="_blank">Article 4</a></label>
                    <div class=radio-btn-wrapper>
                        <label>A</label>
                        <input type="radio" name="article4" value="A" required>
                        <label>B</label>
                        <input type="radio" name="article4" value="B" required>
                    </div>
                </div>
                <div class="article">
                    <label><a href="here we should put query to db to get news link" target="_blank">Article 5</a></label>
                    <div class=radio-btn-wrapper>
                        <label>A</label>
                        <input type="radio" name="article5" value="A" required>
                        <label>B</label>
                        <input type="radio" name="article5" value="B" required>
                    </div>
                </div>
                <div class="lower-row-wrapper">
                    <button class="button submit-btn" value="submit-btn">Submit</button>
                    <button class="button reset-btn" value="reset-btn" type="reset">Reset</button>
                </div>
            </div>
        </form>
    </div>
</body>

</html>