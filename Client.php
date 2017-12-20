<?php
/**
 * PHP Soap Client
 * @author ueaner <ueaner@gmail.com> www.aboutc.net
 */

class Client {

    private $mode = 'wsdl';

    private $trace = true;  // 开启调试

    private $soapVersion = SOAP_1_2;  // SOAP 版本

    private $encoding = 'UTF-8'; // 编码

    private $compression = 0;

    private $options = array();

    private $serverIP = '127.0.0.1';

    private $serverPort = '58080';

    private $serverDir = 'soap';

    private $serviceUri = '';

    private $serviceName = '';

    public function __construct($params = array()) {
        if (count($params) > 0) {
            foreach ($params as $key => $val) {
                if (isset($this->$key)) {
                    $this->$key = $val;
                }
            }
        }

        $this->options = array(
            'trace' => $this->trace,
            'soap_version' => $this->soapVersion,
            'encoding' => $this->encoding,
            'compression' => SOAP_COMPRESSION_ACCEPT | SOAP_COMPRESSION_GZIP
        );

        if ($this->serviceUri == '') {
            // $this->serverDir = '/' . trim('/' . $this->serverDir . '/', '/') . '/';
            $this->serverDir = '/' . pathinfo(dirname($_SERVER['SCRIPT_NAME']), PATHINFO_FILENAME) . '/';
            $this->serviceUri = 'http://localhost:58080/soap/wsdl/PersonService.php';
        }

        if ($this->mode == 'wsdl') {
            $this->serviceUri .= '?wsdl';
        } else {
            $this->options['uri'] = 'http://' . $_SERVER['SERVER_NAME']; // non-WSDL 模式参数
            $this->options['location'] = $this->serviceUri;	// non-WSDL 模式参数，server 端具体路径
            $this->serviceUri = null;
        }

    }

    public function getClient() {
//        try {
//            return new SoapClient($this->serviceUri, $this->options);
//        }
//        catch (SoapFault $fault){
//            echo 'Error Message: ' . $fault->getMessage();
//        }

//        var_dump($this->serviceUri, $this->options);exit;

        return new SoapClient($this->serviceUri, $this->options);
    }
}

