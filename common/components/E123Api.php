<?php
namespace common\components;

use common\models\E123Member;
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

        print_r($req);

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

            print_r($req);

            $response = $req->send();

            Yii::info('Got response: '.print_r($response, true));

            $this->storeCookies($response);
        }

        return $response;
    }

    public function callWebAgentInfo()
    {
        $url = 'https://www.enrollment123.com/manage/agents/index.cfm?pageindex=0&broker_id=&lIDs=&parent_id=&brokerType=&brokerType2=&brokerType3=&bActive=1&bWebsiteActive=&bListBillInvoice=&bGroup=&bLicensed=1&bInternalSales=&bVendor=&bMemberPortal=&bAgentPortal=&broker_label=&companyname=&firstname=&lastname=&city=&state=&zipcode=&email=&phone=&username=&code=&note=&productSearchType=ANY&product=&rd_product=1&rd_product_sort=label&lProductIDs=&underwriter=&prodcat3=&dtCreatedStart=&dtCreatedEnd=&dtLicenseActiveStart=&dtLicenseActiveEnd=&dtLicenseExpirationStart=&dtLicenseExpirationEnd=&dtEOExpirationStart=&dtEOExpirationEnd=&dtNoteStart=&dtNoteEnd=&dtNextStepStart=&dtNextStepEnd=&dtEstimatedCloseStart=&dtEstimatedCloseEnd=&dtLoggedInWithinStart=&dtLoggedInWithinEnd=&dtNotLoggedInSince=&brokerFlag=&brokerStage=&sicCode=&brokerSource=&brokerDetail=&licensestate=&licensenumber=&licenseunderwriter=&processorType=&processorSearchType=ANY&processor=&eocoverage=&doctype=&noteType=&submit=Search+Agents&reportid=5717&pagesize=100';

        $client = new Client();

        $req = $client->createRequest()
            ->setMethod('get')
            ->setUrl($url)
            ->setCookies($this->web_session_cookies);

        print_r($req);

        $response = $req->send();

        $this->storeCookies($response);

//        return $response;

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

        $url = 'https://www.enrollment123.com/manage/agents/downloadCommandHandler.cfc?method=run&returnFormat=plain&command=License&lSelectedIDs=&token='.$token;

        $req = $client->createRequest()
            ->setMethod('get')
            ->setUrl($url)
            ->setCookies($this->web_session_cookies);

        print_r($req);

        $response = $req->send();

        $this->storeCookies($response);





        return $response;
    }
}