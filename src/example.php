$vbox = new Vbox7_Downloader;

$vbox->setVideo($_POST['video']);

if ($vbox->execute()) {
    echo '<a href="'.$vbox->getVideo().'">свали видео файл</a>';
}
