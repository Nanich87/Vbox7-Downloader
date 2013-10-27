class Vbox7_Downloader {
    private $vid = null;
    private $url = null;
 
    public function setVideo($vid){
        $this->vid = $vid;
    }
 
    public function execute(){
        if (isset($this->vid)) {
            $url = 'http://vbox7.com/play/magare.do';
            $body = sprintf('vid=%s', $this->vid);
            $c = curl_init($url);
            curl_setopt($c, CURLOPT_POST, true);
            curl_setopt($c, CURLOPT_POSTFIELDS, $body);
            curl_setopt($c, CURLOPT_RETURNTRANSFER, true);
            $page = curl_exec($c);
            curl_close($c);
            if (preg_match('@(http:\/\/media[0-9]+\.vbox7\.com\/s\/[a-z0-9]{2}\/[a-z0-9]+\.)(flv|mp4)@ui', $page, $matches)) {
                $this->url = $matches[0];
                return true;
            }
        }
        return false;
    }
 
    public function getVideo(){
        return $this->url;
    }
 
}
