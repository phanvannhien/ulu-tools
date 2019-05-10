<?php

namespace App\Http\Controllers\Affiliate;

use App\Models\Affiliate\AffiliateCampaign;
use App\Models\Campaign;
use App\Models\Merchant;
use App\Services\GoUlu;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Pagination\LengthAwarePaginator as Paginator;

use Illuminate\Validation\ValidationException;
use Matrix\Exception;
use Session;
use Validator;
use GuzzleHttp\Client;

class CampaignController extends Controller
{

    public function index(){

    }

    public function getCampaign()
    {
        $campaigns = auth()->user()->campaigns()->get();
        return view('affiliate.campaign.index', compact('campaigns'));
    }

    public function getLinkHistory( Request $request, GoUlu $ulu, $campaign_id ){
        if( $request->ajax() && $request->isMethod('GET') ){

            $perPage = $request->per_page ? $request->per_page : 50;
            $page = $request->page ? $request->page : 1;
            $offset = ( $page-1 ) * $perPage;

            if( $request->has('created_at') ){
                $arrDate = explode( '-', $request->get('created_at') );
                $startDate = str_replace('/','-',trim($arrDate[0]));
                $endDate = str_replace('/','-',trim($arrDate[1]));
                $queryDate = $startDate.','.$endDate;
            }

            $params = [
                'page' => $page,
                'per_page' => $perPage,
                'campaign_id' => $campaign_id,
                'created_at' => isset($queryDate) ? $queryDate : '',
            ];

            try{
                $conversions = $ulu->getLinkHistory( auth()->user()->jwt_token, $params );
                $data = new Paginator(
                    $conversions->payloads->data,
                    $conversions->payloads->count,
                    $perPage,
                    $page, ['path'  => $request->url(), 'query' => $request->query()]);


                $dataCampaigns = auth()->user()
                    ->campaigns()
                    ->select('campaigns.campaign_id', 'campaign_name')
                    ->get()->toArray();

                $campaigns = array();
                foreach ($dataCampaigns as $campaign){
                    $campaigns[$campaign['campaign_id']] = $campaign['campaign_name'];
                }

                return response()->json([
                    'success' => true,
                    'html' => view('affiliate.renders.link', compact( 'data', 'campaigns' ) )->render()
                ]);
            }catch (Exception $e){
                throw ValidationException::withMessages(['message','Vui lòng thử lại']);
            }




        }
    }


    public function getCampaignDetail( $id ){
        $campaign = Campaign::findOrFail($id);
        return view('affiliate.campaign.show', compact( 'campaign'));

    }

    // Method POST
    public function registerCampaign(Request $request, $id ){
        if( $request->ajax() && $request->isMethod('POST') ){
            $register = AffiliateCampaign::firstOrCreate([
                'userid' => auth()->user()->userid,
                'campaign_id' => $id
            ]);

            if($register)

                return response()->json(['success' => true ]);
            return response()->json(['success' => false, 'message' => 'Đăng ký lỗi, vui lòng thử lại' ]);
        }
    }


    public function createLink(Request $request,  GoUlu $ulu, $campaign_id){
        $rules = [
            'target_url' => 'required|string|active_url',
        ];

        $validator = Validator::make($request->all(), $rules,[
            'target_url.required' => 'Nhập Url đích',
            'target_url.string' => 'Nhập Url dạng chuỗi',
            'target_url.active_url' => 'Url không hoạt động',
        ]);


        if ($validator->fails()) {
            return response()->json( ['success' => false, 'err' => $validator->errors() ]);
        }

        $params = [
            'campaign_id' => $campaign_id,
            'merchant_id' => $request->get('merchant_id'),
            'utm_source' => $request->has('utm_source') ? $request->get('utm_source') : '',
            'utm_medium' => $request->has('utm_medium') ? $request->get('utm_medium') : '',
            'utm_campaign' => $request->has('utm_campaign') ? $request->get('utm_campaign') : '',
            'urls' => [
                $request->get('target_url')
            ]
        ];

        $data = $ulu->createShortLink( auth()->user()->jwt_token, $params);

        return response()->json([
            'success' => true,
            'url' => $data->payloads->urls[0]->short_url
        ]);


    }

}
