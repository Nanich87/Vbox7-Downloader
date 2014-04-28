<html>
    <head>
        <title>Сваляне на клипчета от VBox7</title>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <link href="style.css" rel="stylesheet">
    </head>
    <body>
        <div id="wrapper">
            <h1>Сваляне на видео от Vbox7</h1>
            <form method="post" action="">
                http://www.vbox7.com/play: 
                <input placeholder="video-id" class="text" name="videoID" type="text" /> 
                <input class="button" name="submit" type="submit" value="Свали" />
            </form>
            <div class="link">
                <?php
                try
                {
                    require './Vbox7_Downloader.php';

                    if (isset($_POST['submit'], $_POST['videoID']))
                    {
                        if (empty($_POST['videoID']))
                        {
                            throw new Exception('Няма въведен идентификатор на видео клип!');
                        }

                        if (!preg_match("/$[a-z0-9]+^/", $_POST['videoID']))
                        {
                            throw new Exception('Невалиден идентификатор на видео клип!');
                        }

                        $downloader = new Vbox7_Downloader;
                        $downloader->setVideoId($_POST['videoID']);
                        if ($downloader->execute())
                        {
                            echo '<a href="' . $downloader->getVideoUrl() . '">Връзка към файла</a>';
                        }
                        else
                        {
                            echo 'Не може да намери файла!';
                        }
                    }
                }
                catch (Exception $ex)
                {
                    echo $ex->getMessage();
                }
                ?>
            </div>
        </div>
    </body>
</html>