@extends('admin.layout')

@section('main')
    <form action="">

        <div class="form-group">
            <label for="">Affiliate ULU URL</label>
            <input id="baseULUAffUrl" class="form-control" type="text" name="baseULUAffUrl" value="https://account.ulu.vn/scripts/cgolqd?publisher_id=5ca72b11d8120&banner_id=401b2741">
        </div>

        <div class="form-group">
            <label for="">Hub URL</label>
            <input id="hubUrl" class="form-control" type="text" name="hubUrl" value="http://blog.nhienphan.com/redirect.php?visitor_id={$visitorid}&aff_id=5ca72b11d8120&banner_id=401b2741">
        </div>


        <div class="form-group">
            <label for="">Shopee URL</label>
            <input id="deepUrl" class="form-control" type="text" name="deepUrl" value="https://shopee.vn/-C%E1%BB%B1c-R%E1%BA%BB-V%C3%AD-da-Mini-Unisex-da-PU-cao-c%E1%BA%A5p.-%C4%90%E1%BB%B1ng-th%E1%BA%BB-ng%C3%A2n-h%C3%A0ng-card-visit-ti%E1%BB%81n..-nh%E1%BB%8F-g%E1%BB%8Dn-th%E1%BB%9Di-trang-nhi%E1%BB%81u-ng%C4%83n-i.20548239.1578296009">
        </div>

        <div class="form-group">
            <label for="">Extract URL</label>
            <input id="extraUrl" class="form-control" type="text" name="extraUrl" value="%3Futm_source%3D%7Baffiliate_name%7D%26utm_medium%3Daffiliate%26utm_content%3D%7Baffiliate_id%7D%26utm_campaign%3D%7Btransaction_id%7D">
        </div>

        <button id="btn-build" type="button" class="btn btn-primary">GET LINK</button>

    </form>

    <div class="card mt-4">
        <div class="card-body" id="result"></div>
    </div>

@stop


@section('footer')

    <script>



        function wrap_shopee_link( baseULUAffUrl, hubUrl, deepUrl, extraUrl, cb ){
            return cb( baseULUAffUrl +'&url=' + encodeURIComponent( hubUrl + '&url=' + encodeURI( decodeURI( deepUrl )) ) );

        }

        $(function () {
            $('#btn-build').on('click', function (e) {
                e.preventDefault();
                $('#result').html('');

                const baseULUAffUrl = $("#baseULUAffUrl").val();
                const hubUrl = $("#hubUrl").val();
                const deepUrl = $("#deepUrl").val();
                const extraUrl = $("#extraUrl").val();

                const bitlyToken = "b3c1329e77097b986dcd7e5582140a6ec017ed6c";

                wrap_shopee_link( baseULUAffUrl, hubUrl , deepUrl, extraUrl, function( endUrl ){
                    console.log(endUrl);
                    $('#result').append( 'End Url: '+ endUrl );
                    $('#result').append('<hr/>');
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