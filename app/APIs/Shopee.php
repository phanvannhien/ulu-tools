<?php
namespace App\APIs;


use App\Models\Affiliate;
use App\Models\Log;
use App\Models\Sale;
use GuzzleHttp\Client;
use Matrix\Exception;
use Pap_Api_SaleTracker;
use Pap_Api_Session;
use Pap_Api_Transaction;

class Shopee{

    public $base_uri = '';
    public $api_key = '';
    public $filters = [];

    public $data = [];

    public function __construct()
    {
        $this->base_uri =config('ulu.shopee_api_url');
        $this->api_key =config('ulu.shopee_api_key');
    }

    public function applyFilters( $field,  $value ){

        $this->filters[$field] = $value;
        return $this;
    }

    public function getConversions(){
        $client = new Client();


        $query = [
            "Target" => "Affiliate_Report",
            "Format" => "json",
            "Service" => "HasOffers",
            "Version" => "2",
            "api_key" =>  $this->api_key,
            "Method" => "getConversions",
            "fields" => [
                "Stat.year",
                "Stat.week",
                "Stat.user_agent",
                "Stat.session_ip",
                "Stat.source",
                "Stat.session_datetime",
                "Stat.sale_amount",
                "Stat.refer",
                "Stat.pixel_refer",
                "Stat.offer_url_id",
                "Stat.offer_id",
                "Stat.month",
                "Stat.is_adjustment",
                "Stat.ip",
                "Stat.id",
                "Stat.hour",
                "Stat.goal_id",
                "Stat.datetime",
                "Stat.date",
                "Stat.currency",
                "Stat.count_approved",
                "Stat.conversion_status",
                "Stat.affiliate_info5",
                "Stat.approved_payout",
                "Stat.affiliate_info4",
                "Stat.affiliate_info3",
                "Stat.affiliate_info2",
                "Stat.affiliate_info1",
                "Stat.ad_id",
                "PayoutGroup.name",
                "PayoutGroup.id",
                "OfferUrl.preview_url",
                "OfferUrl.name",
                "OfferUrl.id",
                "Offer.name",
                "Goal.name",
                "Country.name",
                "ConversionsMobile.windows_aid_sha1",
                "ConversionsMobile.windows_aid_md5",
                "ConversionsMobile.windows_aid",
                "ConversionsMobile.unknown_id",
                "ConversionsMobile.mobile_carrier",
                "ConversionsMobile.ios_ifa_sha1",
                "ConversionsMobile.ios_ifa_md5",
                "ConversionsMobile.ios_ifa",
                "ConversionsMobile.google_aid_sha1",
                "ConversionsMobile.google_aid_md5",
                "ConversionsMobile.google_aid",
                "ConversionsMobile.device_os_version",
                "ConversionsMobile.device_os",
                "ConversionsMobile.device_model",
                "ConversionsMobile.device_brand",
                "ConversionsMobile.affiliate_unique5",
                "ConversionsMobile.affiliate_unique3",
                "ConversionsMobile.affiliate_unique4",
                "ConversionsMobile.affiliate_unique1",
                "ConversionsMobile.affiliate_unique2",
                "ConversionsMobile.affiliate_click_id",
                "ConversionMeta.note",
                "Browser.id",
                "Browser.display_name"
            ],
            "filters" => $this->filters,
            "limit" => 1000,
            "totals" => 1,
            "count" => 1,
        ];


        $response =  $client->request('GET', $this->base_uri, [
            'query' => $query
        ]);

        $data = $response->getBody()->getContents();
        $data = json_decode( $data, true );

        if(isset($data['response']['status']) && $data['response']['status'] === 1){
            $this->data = $data['response']['data'];
        }

        return $this;
    }


    public function syncToULU( $offer_type ){


        if( $this->data['data'] && count( $this->data['data'] ) ){

            $session = new Pap_Api_Session( config('ulu.server') );
            if(! $session->login('pap-support@ulf.vn','xoWC$WBG89#z')) {
                return false;
            }


            if( $offer_type == 'tracking' ){
                
                foreach ( $this->data['data']  as $conversion  ){

                    $currentSale  = Sale::where('t_orderid', $conversion['Stat']['ad_id'] )->first();
                    if( !$currentSale ){

                        $saleTracker = new Pap_Api_SaleTracker( config('ulu.sale') );
                        $saleTracker->setVisitorId( $conversion['Stat']['affiliate_info2'] );

                        $accountID = 'b8e749d1'; //web shopee account
                        // save lead to PAP
                        $sale = $saleTracker->createSale();
                        $sale->setTotalCost( $conversion['Stat']['sale_amount@VND'] );
                        $sale->setOrderID( $conversion['Stat']['ad_id'] );
                        $sale->setAffiliateID( $conversion['Stat']['affiliate_info1'] );
                        $sale->setStatus('P');
                        $sale->setData1( $conversion['Stat']['affiliate_info2'] );
                        $sale->setData2( $conversion['Stat']['offer_id'] );
                        $sale->setCustomCommission( 0 );
                        //$sale->setTimeStamp( $conversion['Stat']['datetime'] );

                        if( $conversion['Stat']['offer_id'] == 22 ){
                            $accountID = 'd794e8f3';
                        }

                        $saleTracker->setAccountId( $accountID  );
                        $saleTracker->register();
                        // Save to local
                        $sysSale = Sale::create([
                            't_orderid' =>  $conversion['Stat']['ad_id'],
                            'userid' =>  $conversion['Stat']['affiliate_info1'],
                            'accountid' =>  $accountID,
                            'commission' =>  0,
                            'totalcost' =>  $conversion['Stat']['sale_amount@VND'],
                            'rstatus' =>  'P',
                            'data1' =>  $conversion['Stat']['affiliate_info2'],
                            'data2' =>  $conversion['Stat']['offer_id']
                        ]);

                        Log::create([
                           'action' => 'sync_shopee_PAP',
                            'detail' => 'Sync transaction:  ' . $conversion['Stat']['ad_id']
                        ]);


                    }

                }


            }

            if( $offer_type == 'payment' ){

                foreach ( $this->data['data']  as $conversion  ){
                    if( $conversion['Stat']['conversion_status'] == 'approved' ){

                        $sale = Sale::where('data1', $conversion['Stat']['affiliate_info2'])
                            ->where('rstatus', 'P')
                            ->first();

                        if( $sale ){
                            $transaction = new Pap_Api_Transaction($session);
                            $transaction->setOrderId($sale->t_orderid);

                            try{
                                $transaction->load();

                                // Get affiliate
                                $affiliate = Affiliate::where( 'userid', $sale->userid  )->first();
                                if( $affiliate ){
                                    $transaction->setStatus('A');
                                    $commission = $conversion['Stat']['approved_payout'] * $affiliate->commission_rate/100;
                                    $transaction->setCommission( $commission );
                                    $transaction->save();

                                    $sale->rstatus = 'A';
                                    $sale->save();

                                }

                            }catch (Exception $e){
                                Log::create([
                                    'action' => 'update_commission',
                                    'detail' => 'Fail to find order_id:  '.$sale->t_orderid
                                ]);
                            }

                        }


                    }
                }

            }

        }

        return true;

    }

}