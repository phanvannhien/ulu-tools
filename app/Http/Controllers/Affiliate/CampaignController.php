<?php

namespace App\Http\Controllers\Affiliate;

use App\Models\Merchant;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Pap_Api_Session;
use Gpf_Rpc_GridRequest;
use Gpf_Rpc_FormRequest;
use Gpf_Rpc_Request;
use Gpf_Data_Filter;
use Gpf_Rpc_Array;
use Session;

use GuzzleHttp\Client;

class CampaignController extends Controller
{

    public function index(){

    }

    public function getCampaign()
    {


        $data = Merchant::where('status',1)->get();
        return view('affiliate.campaign.index', compact('data'));

    }



    public function getBanner( $campaign_id ){
        $sessionId = Session::get('affiliate')->getSessionId();
        $client = new Client();
        $data = 'D={"C":"Gpf_Rpc_Server",+"M":"run",+"requests":[{"C":"Pap_Affiliates_Promo_BannersGrid",+"M":"getRows",+"offset":0,+"limit":30,+"filters":[["campaignid","E","'.$campaign_id.'"]],+"columns":[["id"],["id"],["destinationurl"],["name"],["campaignid"],["campaignname"],["bannercode"],["bannerdirectlinkcode"],["bannerpreview"],["rtype"],["displaystats"],["channelcode"],["campaigndetails"],["urlData1"],["urlData2"]]}],+"S":"'.$sessionId.'"}';

        $response =  $client->request('POST', 'https://account.ulu.vn/scripts/server.php', [
            'body' => $data,
            'headers' => [
                "Access-Control-Allow-Credentials"=> true,
                "Access-Control-Allow-Origin" => "*",
                "content-type" => "application/x-www-form-urlencoded"
            ]
        ]);

        $data = $response->getBody()->getContents();
        $data = json_decode($data);

        $requestDataCampaign = 'D={"C":"Gpf_Rpc_Server",+"M":"run",+"requests":[{"C":"Gpf_Db_Table_FormFields",+"M":"getTranslatedFields",+"formId":"longdescription",+"status":"M,O,R"},{"C":"Pap_Affiliates_Promo_CampaignsGrid",+"M":"getLongDescription",+"filters":[["id","E","'.$campaign_id.'"]]}],+"S":"'.$sessionId.'"}';
        $responseCampaign =  $client->request('POST', 'https://account.ulu.vn/scripts/server.php', [
            'body' => $requestDataCampaign,
            'headers' => [
                "Access-Control-Allow-Credentials"=> true,
                "Access-Control-Allow-Origin" => "*",
                "content-type" => "application/x-www-form-urlencoded"
            ]
        ]);
        $dataCampaign = $responseCampaign->getBody()->getContents();
        $dataCampaign = json_decode($dataCampaign);

        return view('affiliate.banners.index', compact('data', 'dataCampaign'));

    }

}
