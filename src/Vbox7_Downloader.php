<?php

class Vbox7_Downloader {

    private $_videoId = null;
    private $_videoUrl = '';

    public function __construct($videoId) {
        if (self::isValidVideoId($videoId)) {
            $this->_video = $videoId;
        } else {
            throw new Exception('Невалиден идентификатор на видео клип!');
        }
    }

    /*
      public function setVideoId($videoId) {
      $this->_videoId = $videoId;
      }
     */

    private function executeCurl() {
        $url = 'http://vbox7.com/play/magare.do';
        $body = sprintf('vid=%s', $this->_videoId);
        $curl = curl_init($url);
        curl_setopt($curl, CURLOPT_POST, true);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $body);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        $page = curl_exec($curl);
        curl_close($curl);

        $matches = [];
        if (preg_match('@(http:\/\/media[0-9]+\.vbox7\.com\/s\/[a-z0-9]{2}\/[a-z0-9]+\.)(flv|mp4)@ui', $page, $matches)) {
            $this->_videoUrl = $matches[0];
        }
    }

    public function getVideoUrl() {
        $this->executeCurl();

        return $this->_videoUrl;
    }

    public static function isValidVideoId($videoId) {
        if (preg_match("/^[a-z0-9]+$/u", $videoId)) {
            return true;
        }

        return false;
    }

}