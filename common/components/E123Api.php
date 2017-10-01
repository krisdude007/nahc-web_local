<?php
namespace common\components;

use common\models\Agent;
use common\models\E123Member;
use common\models\User;
use Sunra\PhpSimple\HtmlDomParser;
use Yii;
use yii\base\Component;
use yii\helpers\ArrayHelper;
use yii\httpclient\Client;

/**
 * Class E123Api
 * @package common\components
 *
 *
 * For an ADD: https://[username]:[password]@api.1administration.com/v1/[brokerID]/member/0.json
 * For an UPDATE: https://[username]:[password]@api.1administration.com/v1/[brokerID]/member/[memberid].json
 *
 *
 */

class E123Api extends Component {
    const DEFAULT_USERNAME = 'testuser';
    const DEFAULT_PASS = 'Test123uSer';
    const DEFAULT_CORP = 1063;
    const DEFAULT_AGENT = 264934;
    const DEFAULT_PDID = 18240;

    const REST_URL_BASE = 'api.1administration.com/v1/';
    const V2_REST_URL_BASE = 'api.1administration.com/v2/';
    const DO_LOOKUP_URL = 'https://www.enrollment123.com/api/user.cfc';
    const API_SEARCH_URL = 'https://www.enrollment123.com/api/user.getall/';
    const WEB_BASE = 'www.enrollment123.com/';

    const AGENT_INFO_FULL = 'FULL';
    const AGENT_INFO_USERS = 'Logins';
    const AGENT_INFO_PRODUCT = 'Product';
    const AGENT_INFO_PRICING = 'Pricing';
    const AGENT_INFO_COMISSION = 'Commission';
    const AGENT_INFO_BANK = 'Bank';
    const AGENT_INFO_LICENSE = 'License';
    const AGENT_INFO_LICENSE_FILTER = 'LicenseFilter';
    const AGENT_INFO_APPOINTMENT = 'Appointment';
    const AGENT_INFO_DOCUMENTS = 'Documents';
    const AGENT_INFO_PROCESSORS = 'Processors';
    const AGENT_INFO_TREE = 'Tree';
    const AGENT_INFO_PRODUCTIVITY = 'Productivity';

    public $username;
    public $password;
    public $corpid;
    public $agentid;

    public $testMode = false;

    public $web_session_cookies = [];

    public function __construct(array $config = [])
    {
        $uname = ArrayHelper::getValue($config, 'username', null);

        if(empty($uname))
            $this->username = self::DEFAULT_USERNAME;

        $pass = ArrayHelper::getValue($config, 'password', null);

        if(empty($pass))
            $this->password = self::DEFAULT_PASS;

        $corp = ArrayHelper::getValue($config, 'corpid', null);

        if(empty($corp))
            $this->corpid = self::DEFAULT_CORP;

        if(empty($uname) && empty($pass) && empty($corp)) {
            $this->testMode = true;
        }

        parent::__construct($config);
    }

    public function callMemberRest(E123Member &$model)
    {
        $client = new Client();

        $url = 'https://'.$this->username.':'.$this->password.'@'.self::REST_URL_BASE;

        $agent = $model->agent;

        if(empty($agent) || $this->testMode) {
            $agent = self::DEFAULT_AGENT;
            $model->agent = $agent;
        }

        if(!empty($model->products) && $this->testMode) {
            foreach($model->products as &$prod) {
                $prod['pdid'] = self::DEFAULT_PDID;
            }
        }

        if($model->mode == E123Member::MODE_ADD) {
            $url .= $agent.'/member/0.json';
        } elseif($model->mode == E123Member::MODE_UPDATE) {
            $url .= $agent.'/member/'.$model->uniqueid.'.json';
        }

        echo 'Calling: '.$url.PHP_EOL;

        $payload = $model->toArray();
        $payload['corpid'] = $this->corpid;

        echo 'Payload Array: '.print_r($payload, true).PHP_EOL;

        $payload_str = json_encode($payload, JSON_UNESCAPED_SLASHES);

        //$payload_str_ascii = iconv('UTF-8', 'ASCII//TRANSLIT', $payload_str);

        echo 'Payload Json: '.print_r($payload_str, true).PHP_EOL;

        $response = $client->createRequest()
            ->setMethod('post')
            ->setUrl($url)
            ->setData(['member' => $payload_str])
            ->send();

        if ($response->isOk) {
            Yii::info('Response: '.print_r($response, true));

//            $newUserId = $response->data['MEMBER']["ID"];
        }

        return $response->data;
    }

    public function callArrayRest(array $memAr, bool $update = null) {
        $client = new Client();

        $agent = self::DEFAULT_AGENT;
        $corp = self::DEFAULT_CORP;

        $memAr['agent'] = $agent;
        $memAr['corpid'] = $corp;

        if(!$update) {
            $url = 'https://' . $this->username . ':' . $this->password . '@' . self::REST_URL_BASE . $agent . '/member/0.json';
        } else {
            $url = 'https://' . $this->username . ':' . $this->password . '@' . self::REST_URL_BASE . $agent . '/member/'.$memAr['uniqueid'].'.json';
        }

        Yii::info('Calling: '.$url);

        $payload_str = json_encode($memAr, JSON_UNESCAPED_SLASHES|JSON_PRETTY_PRINT);

        Yii::info('Payload Json: '.$payload_str);

        $response = $client->createRequest()
            ->setMethod('post')
            ->setUrl($url)
            ->setData(['member' => $payload_str])
            ->send();

        Yii::info('Response: '.print_r($response, true));

        if ($response->isOk && $response->data['SUCCESS'] == 1) {
            $newUserId = ArrayHelper::getValue($response->data, 'MEMBER.ID', null);
        }

        return $response->data;
    }

    public function callV2Rest($endpoint, $payload)
    {
        $site_username = $this->username;
        $site_pass = $this->password;

        $auth = base64_encode("{$site_username}:{$site_pass}");

        $url = 'https://'.self::V2_REST_URL_BASE.$endpoint;

        $payload_str = json_encode($payload, JSON_UNESCAPED_SLASHES|JSON_PRETTY_PRINT);

        Yii::info('Calling '.$url.' with auth: '.$auth.' with payload: '.$payload_str);

        $client = new Client();

        $req = $client->createRequest()
            ->setMethod('post')
            ->setUrl($url)
            ->setFormat(Client::FORMAT_JSON)
            ->setHeaders(['Authorization' => 'Basic '.$auth])
            ->setData($payload);

        $response = $req->send();

        Yii::info('Got response: '.print_r($response));

        return $response;
    }

    private function storeCookies($response)
    {
        if(empty($response))
            return;

        //$this->web_session_cookies = $response->cookies;

        foreach($response->cookies as &$cookie) {
            $cookie->value = urlencode($cookie->value);
            $this->web_session_cookies[$cookie->name] = $cookie;
        }
    }

    public function initWebSession()
    {
        $url = 'https://'.self::WEB_BASE.'manage/index.cfm';

        $client = new Client();

        $req = $client->createRequest()
            ->setMethod('get')
            ->setUrl($url);

        $response = $req->send();

        Yii::info('Got response: '.print_r($response, true));

        $this->storeCookies($response);

        return $response;
    }

    public function callWebLogin()
    {
        $site_username = $this->username;
        $site_pass = $this->password;

        $url = 'https://'.self::WEB_BASE.'manage/index.cfm';

        $client = new Client();

        $req = $client->createRequest()
            ->setMethod('post')
            ->setUrl($url)
            ->setCookies($this->web_session_cookies)
            ->setData(['username' => $site_username, 'password' => $site_pass, 'authenticate'=>'']);

//        print_r($req);

        $response = $req->send();

        Yii::info('Got response: '.print_r($response, true));

        $this->storeCookies($response);

        if(strpos($response->content, 'skipinfo') !== false) {
            echo 'Doing skipinfo'.PHP_EOL;

            $req = $client->createRequest()
                ->setMethod('post')
                ->setUrl($url)
                ->setCookies($this->web_session_cookies)
                ->setData(['phone'=>'', 'emailaddress'=>'','skipinfo'=>'']);

//            print_r($req);

            $response = $req->send();

            Yii::info('Got response: '.print_r($response, true));

            $this->storeCookies($response);
        }

        return $response;
    }

    public function callWebAgentInfo($info_type = self::AGENT_INFO_FULL)
    {
        $url = 'https://www.enrollment123.com/manage/agents/index.cfm?pageindex=0&broker_id=&lIDs=&parent_id=&brokerType=&brokerType2=&brokerType3=&bActive=1&bWebsiteActive=&bListBillInvoice=&bGroup=&bLicensed=1&bInternalSales=&bVendor=&bMemberPortal=&bAgentPortal=&broker_label=&companyname=&firstname=&lastname=&city=&state=&zipcode=&email=&phone=&username=&code=&note=&productSearchType=ANY&product=&rd_product=1&rd_product_sort=label&lProductIDs=&underwriter=&prodcat3=&dtCreatedStart=&dtCreatedEnd=&dtLicenseActiveStart=&dtLicenseActiveEnd=&dtLicenseExpirationStart=&dtLicenseExpirationEnd=&dtEOExpirationStart=&dtEOExpirationEnd=&dtNoteStart=&dtNoteEnd=&dtNextStepStart=&dtNextStepEnd=&dtEstimatedCloseStart=&dtEstimatedCloseEnd=&dtLoggedInWithinStart=&dtLoggedInWithinEnd=&dtNotLoggedInSince=&brokerFlag=&brokerStage=&sicCode=&brokerSource=&brokerDetail=&licensestate=&licensenumber=&licenseunderwriter=&processorType=&processorSearchType=ANY&processor=&eocoverage=&doctype=&noteType=&submit=Search+Agents&reportid=5717&pagesize=100';

        $client = new Client();

        $req = $client->createRequest()
            ->setMethod('get')
            ->setUrl($url)
            ->setCookies($this->web_session_cookies);

//        print_r($req);

        $response = $req->send();

        $this->storeCookies($response);

        $location = $response->headers->get('location');
        $pos = strpos($location, 'token=');

        if($pos === false)
            return null;

        $token = substr($location,$pos+6);

        /*
         * <select id="downloadfilter" name="downloadfilter" class="selectBox2">
         *     <option value="FULL">Agent Information</option>
         *     <option value="Logins">Agent Users</option>
         *     <option value="Product">Agent Product Information</option>
         *     <option value="Pricing">Agent Product Pricing</option>
         *     <option value="Commission">Agent Commissions</option>
         *     <option value="Bank">Agent Bank Accounts</option>
         *     <option value="License">Agent Licenses</option>
         *     <option value="LicenseFilter">Agent Filtered Licenses</option>
         *     <option value="Appointment">Agent Appointments</option>
         *     <option value="Documents">Agent Documents</option>
         *     <option value="Processors">Agent Payment Processors</option>
         *     <option value="Tree">Agent Hierarchy Tree</option>
         *     <option value="Productivity">Agent Productivity Report</option>
         * </select>
        */

        $url = 'https://www.enrollment123.com/manage/agents/downloadCommandHandler.cfc?method=run&returnFormat=plain&command='.$info_type.'&lSelectedIDs=&token='.$token;

        $req = $client->createRequest()
            ->setMethod('get')
            ->setUrl($url)
            ->setCookies($this->web_session_cookies);

//        print_r($req);

        $response = $req->send();

        $this->storeCookies($response);

        return $response;
    }

    public function callSetPassword($agent_id, $user_id, $username, $password)
    {
        if (empty($agent_id) || empty($user_id) || empty($username) || empty($password))
            return null;



        $url = 'https://www.enrollment123.com/manage/agents/manage.cfm?id='.$agent_id.'&method=security&bsid='.$user_id;

        $client = new Client();

        $req = $client->createRequest()
            ->setMethod('get')
            ->setUrl($url)
            ->setCookies($this->web_session_cookies);

//        print_r($req);

        $response = $req->send();

        $this->storeCookies($response);

        $dom = HtmlDomParser::str_get_html($response->content);

//        print_r($response->content);

        $inputs = [];


        foreach($dom->find('input') as $e) {
            $inputs[] = $e->getAllAttributes();
            //echo ArrayHelper::getValue($e, 'name', '').' / '.ArrayHelper::getValue($e, 'value', '').PHP_EOL;
        }

        foreach($dom->find('select') as $sel) {
            $sel_value = ['name' => $sel->getAttribute('name')];

            foreach($sel->children as $child) {
                if($child->getAttribute('selected')) {
                    $sel_value['value'] = $child->getAttribute('value');
                }
            }

            if(!isset($sel_value['value']))
                $sel_value['value'] = '';

            echo 'Got Select: '.print_r($sel_value, true).PHP_EOL;

            $inputs[] = $sel_value;
        }


        $req2 = $client->createRequest()
            ->setMethod('post')
            ->setUrl($url)
            ->setCookies($this->web_session_cookies);

        $contentParts = [];

        $submit_flag = false;

        foreach($inputs as $i) {
            if($i['name'] == 'password') {
                $contentParts[] = 'Content-Disposition: form-data; name="' . $i['name'] . "\"\r\n\r\n".$password;
//                $req2->addContent($i['name'], $password);
            }
            else if(isset($i['name']) && $i['name'] == 'cancel') {
                continue;
            }
            else if(isset($i['name']) && $i['name'] == 'submit') {
                if(!$submit_flag) {
                    $contentParts[] = 'Content-Disposition: form-data; name="' . $i['name'] . "\"\r\n\r\n".$i['value'];
                    $submit_flag = true;
                }
            }
            else if(isset($i['name']) && $i['name'] == 'passwordScore') {
                $contentParts[] = 'Content-Disposition: form-data; name="' . $i['name'] . "\"\r\n\r\n".'100';
//                $req2->addContent($i['name'], 100);
            }
            else if(isset($i['type']) && $i['type'] == 'checkbox')
            {
                echo 'Found checkbox: '.$i['name'].' / '.ArrayHelper::getValue($i, 'checked','NULL').PHP_EOL;
                if(isset($i['checked']) && $i['checked'] == 1) {
                    $contentParts[] = 'Content-Disposition: form-data; name="' . $i['name'] . "\"\r\n\r\n".$i['value'];
//                    $req2->addContent($i['name'], $i['value']);
                }
            }
            else if(isset($i['type']) && $i['type'] == 'radio')
            {
                echo 'Found radio: '.$i['name'].' / '.ArrayHelper::getValue($i, 'checked','NULL').PHP_EOL;
                if(isset($i['checked']) && $i['checked'] == 1) {
                    $contentParts[] = 'Content-Disposition: form-data; name="' . $i['name'] . "\"\r\n\r\n".$i['value'];
//                    $req2->addContent($i['name'], $i['value']);
                }
            }
            else {
                $contentParts[] = 'Content-Disposition: form-data; name="' . $i['name'] . "\"\r\n\r\n".$i['value'];
//                $req2->addContent($i['name'], $i['value']);
            }
        }

        do {
            $boundary = '---------------------' . md5(mt_rand() . microtime());
        } while (preg_grep("/{$boundary}/", $contentParts));

        array_walk($contentParts, function (&$part) use ($boundary) {
            $part = "--{$boundary}\r\n{$part}";
        });

        $contentParts[] = "--{$boundary}--";
        $contentParts[] = '';

        $req2->getHeaders()->set('content-type', "multipart/form-data; boundary={$boundary}");
        $content = implode("\r\n", $contentParts);

        echo 'Content: '.$content.PHP_EOL;

        $req2->setContent($content);

        $response = $req2->send();
//
//        print_r($req2);

        $this->storeCookies($response);

        return $response;
    }
}