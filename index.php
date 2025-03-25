<?php
session_start();
$api_data = isset($_SESSION['api_data']) ? $_SESSION['api_data'] : null;
$error = isset($_SESSION['error']) ? $_SESSION['error'] : null;

unset($_SESSION['api_data']);
unset($_SESSION['error']);
?>

<!-- LICENSE 

########################################################
NAME      : CHRISTIAN INRISTA
EMAIL     : christianinrista@gmail.com
LINKEDIN  : https://www.linkedin.com/in/christianinrista
########################################################

-->

<!DOCTYPE html>
<html lang="id">
<head>
    <title>Youtube Seacrh</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <div class="navbar-container">
        <h1>Christian</h1>
        <div class="subnavbar">
            <ul>
                <li>Home</li>
                <li>Feature</li>
                <li>Pricing</li>
            </ul>
        </div>
    </div>
    
    <div class="input-container" id="start">
        <form action="get_result.php" method="POST">
            <h1>Input Keyword Seacrh</h1><br>
            <input class="input-class" type="text" id="textnya" name="textnya" placeholder="Input Here..." required> <br>
            <button class="button-class" type="submit">Search</button> 
        </form>
    </div>
    
    <?php 
    if (isset($api_data) && isset($api_data['results'])) { ?>
        <div id="result-container">
            <?php foreach ($api_data['results'] as $video) { ?>
                <div class="video-item">
                    <a href="<?php echo htmlspecialchars($video['url']); ?>" target="_blank">
                        <img class="thumb_video" src="<?php echo htmlspecialchars($video['thumbnails'][0]['url']); ?>" alt="<?php echo htmlspecialchars($video['title']); ?>">
                        <div class="output-container">
                            <img class="thumb_channel" src="<?php echo htmlspecialchars($video['channelThumbnail']); ?>" alt="Channel Thumbnail">
                            <div class="detail">
                                <p><?php echo htmlspecialchars($video['title']); ?></p>
                                <div class="subdetail">
                                    <h3><?php echo htmlspecialchars($video['channelName']); ?> |</h3>
                                    <h3><?php echo htmlspecialchars($video['viewCount']); ?></h3>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
            <?php } ?>
        </div>
    <?php } ?>



    <?php if ($error): ?>
        <div id="error-message">
            <p style="color: red;"><?php echo htmlspecialchars($error); ?></p>
        </div>
    <?php endif; ?>

    <script>
        <?php if ($api_data !== null): ?>
            document.getElementById("result-container").style.display = "block";
        <?php endif; ?>

        <?php if ($error): ?>
            document.getElementById("error-message").style.display = "block";
        <?php endif; ?>
    </script>
</body>
</html>
