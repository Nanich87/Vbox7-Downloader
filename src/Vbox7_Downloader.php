<?php

class Vbox7_Downloader {

    private $_videoId = null;
    private $_videoUrl = null;

    public function setVideoId($videoId) {
        $this->_videoId = $videoId;
    }

    public function execute() {
        if (isset($this->_videoId)) {
            $url = 'http://vbox7.com/play/magare.do';
            $body = sprintf('vid=%s', $this->_videoId);
            $curl = curl_init($url);
            curl_setopt($curl, CURLOPT_POST, true);
            curl_setopt($curl, CURLOPT_POSTFIELDS, $body);
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
            $page = curl_exec($curl);
            curl_close($curl);
            $matches = array();
            if (preg_match('@(http:\/\/media[0-9]+\.vbox7\.com\/s\/[a-z0-9]{2}\/[a-z0-9]+\.)(flv|mp4)@ui', $page, $matches)) {
                $this->_videoUrl = $matches[0];
                return true;
            }
        }
        return false;
    }

    public function getVideoUrl() {
        return $this->_videoUrl;
    }

}