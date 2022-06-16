<?php
class ProxyCurl
{
    /** 代理位置 */
    // const ProxyIP = "127.0.0.1";
    /** https port */
    // const Https = 8443;
    /** http port */
    // const Http = 8080;
    /** https */
    private $https = false;
    /** 請求位置 */
    private $host = '';
    /** 路徑 */
    private $path = '';
    /** 請求參數 */
    private $param;
    /** Port, 8080:http, 8443:https */
    private $port = '80';
    /** 請求方法 POST:0 GET:1 */
    private $method = 0;
    /** header */
    private $header = [];
    /** 連線逾時時間 */
    private $timeOut = 30;
    /** 其他setopt */
    private $setopt = [];
    /** 錯誤訊息 導出用 */
    private $error = '';
    /** 連線是否發生錯誤 */
    private $errno = 0;
    /** 回傳 */
    private $result = '';
    /** curl_getinfo */
    private $getinfo = false;
    /** curl_getinfo options */
    private $infoOptions = [];
    /** culr_getinfo constants return */
    private $infoData = [];
    /** culr_getinfo array return */
    private $infoArray = [];

    /**
     * 以post送出
     * @param mixed $param CURLOPT_POSTFIELDS value
     * @return string 網頁回傳
     */
    public function post($param = [])
    {
        $this->param = $param;
        return $this->request();
    }

    /**
     * 以get送出
     * @param array $param 要送出的資料 [key => value]
     * @return string 網頁回傳
     */
    public function get($param = '')
    {
        $this->param = $param;
        $this->method = 1;
        return $this->request();
    }

    /**
     * 連線位置
     * @param string $host 連線位置
     */
    public function host($host)
    {
        $this->host = $host;
        return $this;
    }

    /**
     * 路徑 aaa.com/$path
     * @param string $path 路徑位置
     */
    public function path($path)
    {
        if ($path[0] === '/')
            $this->path = $path;
        else
            $this->path = '/' . $path;
        return $this;
    }

    /**
     * 設置header
     * @param array $header header陣列
     */
    public function header($header)
    {
        foreach ($header as $k => $v) {
            if (is_int($k)) {
                $varr = explode(':', $v, 2);
                $key = trim($varr[0]);
                $this->header[trim($varr[0])] = trim($varr[1]);
            } else {
                $key = trim($k);
                $this->header[$key] = trim($v);
            }
        }
        return $this;
    }

    /**
     * 設置port
     */
    public function port(int $port)
    {
        $this->port = $port;
        return $this;
    }

    /**
     * 連線逾時時間
     * @param int $timeOut 逾時時間(秒)
     */
    public function timeOut($timeOut)
    {
        $this->timeOut = $timeOut;
        return $this;
    }

    /**
     * 其他setopt就這裡了
     * @param int $option curl_setopt option
     * @param mixed $value value
     * 
     * @link https://php.net/manual/en/function.curl-setopt.php
     */
    public function setopt($option, $value)
    {
        $this->setopt[$option] = $value;
        return $this;
    }

    /**
     * 設置為https,不使用時走http
     */
    public function https()
    {
        $this->https = true;
        return $this;
    }

    public function errno()
    {
        return $this->errno;
    }

    public function error()
    {
        return $this->error;
    }

    public function toArray()
    {
        return get_object_vars($this);
    }

    public function followsLocation()
    {
        return $this->setopt(CURLOPT_AUTOREFERER, 1)
            ->setopt(CURLOPT_FOLLOWLOCATION, 1);
    }

    /**
     * 設定是否取得curl_getinfo 呼叫時啟用
     * @param null|int $option 依curl_getinfo constants
     */
    public function info($option = null)
    {
        $this->getinfo = true;
        if (!in_array($option, $this->options))
            $this->options[] = $option;
        return $this;
    }
    /**
     * 取得curl_getinfo回傳值
     * @param int|string|null $option null:取得陣列 不包括curl_getinfo constants, string:取得陣列指定值, int:curl_getinfo constants
     * @return mixed 看你傳什麼給你什麼
     */
    public function getInfo($option = null)
    {
        if (!isset($option))
            return $this->infoArray;
        if (is_int($option))
            return isset($this->infoData[$option]) ? $this->infoData[$option] : '';
        if (is_string($option))
            return isset($this->infoArray[$option]) ? $this->infoArray[$option] : '';
        return '';
    }

    private function request()
    {
        $url = ($this->https ? 'https' : 'http') . '://' . $this->host . ':' . $this->port . $this->path;
        if (empty($this->param)) {
            $this->setopt(CURLOPT_URL, $url);
        } else {
            if ($this->method === 0) {
                $this->setopt(CURLOPT_URL, $url);
                $this->setopt(CURLOPT_POSTFIELDS, $this->param);
                $this->setopt(CURLOPT_CUSTOMREQUEST, 'POST');
            } else {
                $this->setopt(CURLOPT_URL, $url . '?' . http_build_query($this->param));
                $this->setopt(CURLOPT_CUSTOMREQUEST, 'GET');
            }
        }
        foreach ($this->header as $k => $v) {
            $header[] = $k . ': ' . $v;
        }
        $this->setopt(CURLOPT_HTTPHEADER, $header);

        $this->setopt(CURLOPT_TIMEOUT, $this->timeOut);
        $this->setopt(CURLOPT_RETURNTRANSFER, true);
        $this->setopt(CURLOPT_SSL_VERIFYHOST, 0);
        $this->setopt(CURLOPT_SSL_VERIFYPEER, false);
        $curl = curl_init();
        foreach ($this->setopt as $k => $v) {
            curl_setopt($curl, $k, $v);
        }

        try {
            $result = curl_exec($curl);
            $this->result = $result;
            if (($this->errno = curl_errno($curl)) !== 0) {
                $this->error = curl_error($curl);
                $this->log();
            }
        } catch (Exception $e) {
            $this->errno = 2;
            $this->error = $e->getMessage();
            $this->log($e);
            $result = '';
        }

        if ($this->getinfo) {
            foreach ($this->infoOptions as $v) {
                if (isset($v))
                    $this->infoData[$v] = curl_getinfo($curl, $v);
                else
                    $this->infoArray = curl_getinfo($curl);
            }
        }

        curl_close($curl);
        return $result;
    }

    private function log(Exception $error = null)
    {
        // if (class_exists('LogForm') && $error !== null) {
        //     $logform = new LogForm;
        //     $logform->setErrno(E_ERROR)
        //         ->setErrstr($error->getMessage())
        //         ->setErrfile($error->getFile())
        //         ->setErrline($error->getLine());
        //     log_message('ERROR', json_encode($this->toArray()), $logform);
        // } else {
        //     log_message('ERROR', json_encode($this->toArray()));
        // }
    }
}
