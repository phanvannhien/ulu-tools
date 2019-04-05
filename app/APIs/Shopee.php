<?php
namespace App\APIs;


use GuzzleHttp\Client;
use Pap_Api_SaleTracker;

class Shopee{

    public $base_uri = 'https://shopeeaffiliates.api.hasoffers.com/Apiv3/json';
    public $api_key = "e89bc7d00c04447caf93bfdb871dd67cde30b21c4876cc340730a74724f74017";
    public $filters = [];

    public $data = [];

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


    public function sysToULU(){


        if( $this->data['data'] && count( $this->data['data'] ) ){
            $saleTracker = new Pap_Api_SaleTracker('https://account.ulu.vn/scripts/sale.php', true);
            $saleTracker->setAccountId('b8e749d1');
            foreach ( $this->data['data']  as $conversion  ){


                if( $conversion['Stat']['offer_id'] == 16 ){
                    $sale = $saleTracker->createSale();
                    $sale->setTotalCost( $conversion['Stat']['sale_amount@VND'] );
                    $sale->setOrderID( $conversion['Stat']['ad_id'] );
                    $sale->setAffiliateID( $conversion['Stat']['affiliate_info1'] );
                    $sale->setStatus('P');
                    $sale->setCampaignID($conversion['Stat']['offer_id']);
                    $sale->setData1( $conversion['Stat']['affiliate_info2'] ); // URL product
                    $sale->setData2( $conversion['Stat']['id'] ); // URL product
                    //$sale->setProductID('pid');

                }

            }

            $saleTracker->register();
        }

        return false;

    }

}