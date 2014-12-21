<html>
    <head>
        <title>Сваляне на видео клипове от Vbox7</title>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <link href="style.css" rel="stylesheet">
    </head>
    <body>
        <div id="wrapper">
            <h1>Сваляне от Vbox</h1>
            <p><a target="blank" title="Vbox7 Downloader" href="https://github.com/Nanich87/Vbox7-Downloader">Vbox7 Downloader</a> е безплатна open source онлайн услуга за сваляне на видео клипчета от сайта Vbox7.com</p>
            <p>Поставете идентификатора на клипа, който искате да изтеглите в полето video-id и кликнете върху бутона Свали!</p>
            <p>Готово! Вашият видео клип е готов за сваляне :)</p>
            <form method="post" action="">
                http://www.vbox7.com/play: 
                <input placeholder="video-id" class="text" name="videoID" type="text" /> 
                <input class="button" name="submit" type="submit" value="Свали" />
            </form>
            <div class="link">
                <?php
                try {
                    require './Vbox7_Downloader.php';

                    if (isset($_POST['submit'], $_POST['videoID'])) {
                        if (empty($_POST['videoID'])) {
                            throw new Exception('Няма въведен идентификатор на видео клип!');
                        }

                        if (!preg_match("/^[a-z0-9]+$/u", $_POST['videoID'])) {
                            throw new Exception('Невалиден идентификатор на видео клип!');
                        }

                        $downloader = new Vbox7_Downloader($_POST['videoID']);
                        $url = $downloader->getVideoUrl();
                        if (empty($url)) {
                            echo 'Не може да намери файла!';
                        } else {
                            echo '<a href="' . $downloader->getVideoUrl() . '">Връзка към файла</a>';
                        }
                    }
                } catch (Exception $ex) {
                    echo $ex->getMessage();
                }
                ?>
            </div>
        </div>
    </body>
</html>