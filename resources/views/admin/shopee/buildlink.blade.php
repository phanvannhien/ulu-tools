@extends('admin.layouts.app')

@section('main')
    <div class="card">
        <div class="card-body">
            <form action="">
                <div class="form-group">
                    <label for="">Link type</label>
                    <select id="type" name="type" class="form-control">
                        <option value="web_shopee">web_shopee</option>
                        <option value="app_shopee">app_shopee</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="">Affiliate ULU link</label>
                    <input id="baseULUAffUrl" class="form-control" type="text" name="baseULUAffUrl" value="https://account.ulu.vn/scripts/cgolqd?publisher_id=5ca72b11d8120&banner_id=ae40411f">
                </div>

                <div class="form-group">
                    <label for="">Shopee hasoffer link</label>
                    <input id="targetShopeeUrl" class="form-control" type="text" name="targetShopeeUrl" value="http://shopeeaffiliates.go2cloud.org/aff_c?offer_id=22&aff_id=1176&aff_sub2={$visitorid}&aff_sub=5ca72b11d8120&aff_sub3={$bannerid}">
                </div>

                <div class="form-group">
                    <label for="">Shopee deep link</label>
                    <input id="deepUrl" class="form-control" type="text" name="deepUrl" value="https://shopee.vn/LOA-Bluetooth-SUNTEK-SC211-X%C3%A1m-%C4%91en-T%E1%BA%B7ng-Jack-3.5mm-i.11824260.230290812">
                </div>

                <div class="form-group">
                    <label for="">Extract link</label>
                    <input id="extraUrl" class="form-control" type="text" name="extraUrl" value="%3Futm_source%3D%7Baffiliate_name%7D%26utm_medium%3Daffiliate%26utm_content%3D%7Baffiliate_id%7D%26utm_campaign%3D%7Btransaction_id%7D">
                </div>


                <button id="btn-build" type="button" class="btn btn-primary">GET LINK</button>

            </form>

            <div class="card mt-4">
                <div class="card-body" id="result"></div>
            </div>
        </div>
    </div>


@stop


@section('footer')
<script src="https://rawgit.com/carlo/jquery-base64/master/jquery.base64.min.js"></script> 
<script>
    function base64Encode( string, cb ){
        return cb( $.base64.encode( string ) );
    }
    
    function encode_app_deeplink( deepUrl, cb ){
        const webNav = `{"paths":[{"webNav":{"url":"${encodeURI( decodeURI(deepUrl) )}"}}]}`;
        $('#result').append('webNav: ' + webNav );
        $('#result').append('<hr/>');

        base64Encode( webNav, function( base64DeepUrl ){
            $('#result').append('base64DeepUrl: ' + base64DeepUrl );
            $('#result').append('<hr/>');

            $('#result').append('base64DeepUrl Relace =/==: ' + base64DeepUrl.replace(/=/gi,'') );
            $('#result').append('<hr/>');
            return cb( encodeURIComponent("shopeevn://home?navRoute=" + base64DeepUrl.replace(/=/gi,'') ));
        });

    }


    function shopee_one_link( encodeAppDeepLink , cb ){
        const oneLinkUrl = 'https://shopeevn.onelink.me/3249649563?pid=affiliate&is_retargeting=true&af_click_lookback=7d&af_reengagement_window=7d&clickid={transaction_id}&c={offer_name}&af_c_id={offer_id}&af_siteid={affiliate_id}&af_sub_siteid={aff_sub}&af_sub1={source}&af_sub2={aff_sub2}&af_sub3={aff_sub3}&af_sub4={aff_sub4}&af_sub5={aff_sub5}&utm_source={affiliate_name}&utm_medium=affiliate&utm_content={affiliate_id}&utm_campaign={transaction_id}&af_dp='+encodeAppDeepLink;
        $('#result').append('oneLinkUrl: ' + oneLinkUrl );
        $('#result').append('<hr/>');

        cb( encodeURIComponent( oneLinkUrl ) );
    }


    function wrap_shopee_link( type, baseULUAffUrl, targetShopeeUrl, deepUrl, extraUrl, cb ){
        if( type == 'web_shopee' ){
            const shopee_web_url = targetShopeeUrl + "&url="+ encodeURIComponent( deepUrl ) + extraUrl ;
            $('#result').append('Shopee hasoffer:' + shopee_web_url );
            $('#result').append('<hr/>');

            const UluUrl = baseULUAffUrl + '&url='+ encodeURIComponent( shopee_web_url );
            $('#result').append( 'ULU link: '+ UluUrl );
            $('#result').append('<hr/>');

            return cb( UluUrl);
        }

        if( type == 'app_shopee' ){
            encode_app_deeplink( deepUrl, function( encodeAppDeepLink ){

                $('#result').append('encodeAppDeepLink: ' + encodeAppDeepLink );
                $('#result').append('<hr/>');

                shopee_one_link( encodeAppDeepLink, function( oneLinkUrl ){
                    const urlShopeeAff = targetShopeeUrl + "&url="+  oneLinkUrl  ;

                    $('#result').append('Shopee hasoffer:' + urlShopeeAff );
                    $('#result').append('<hr/>');

                    const UluUrl = baseULUAffUrl + '&url='+ encodeURIComponent( urlShopeeAff );

                    $('#result').append( 'ULU link: '+ UluUrl );
                    $('#result').append('<hr/>');

                    return cb( UluUrl);
                });
            });
        }
    }

    $(function () {
        $('#btn-build').on('click', function (e) {
            e.preventDefault();
            $('#result').html('');
            
            const type = $('#type').val();
            const baseULUAffUrl = $("#baseULUAffUrl").val();
            const targetShopeeUrl = $("#targetShopeeUrl").val();
            const deepUrl = $("#deepUrl").val();
            const extraUrl = $("#extraUrl").val();

            const bitlyToken = "b3c1329e77097b986dcd7e5582140a6ec017ed6c";
            
            wrap_shopee_link( type, baseULUAffUrl, targetShopeeUrl , deepUrl, extraUrl, function( endUrl ){
                console.log(endUrl);
                $.ajax({
                    type: 'get',
                    url: `https://api-ssl.bitly.com/v3/shorten?access_token=${bitlyToken}&longUrl=${encodeURIComponent(endUrl)}`,
                    success: function (data) {
                        if(data) {
                            if (data.status_code == 200){
                                resultUrl = data.data.url;
                                $('#result').append( 'Bit link: '+ resultUrl );
                                $('#result').append('<hr/>');
                            }
                        }
                    }
                });
            });
        });
    });

</script>
@endsection