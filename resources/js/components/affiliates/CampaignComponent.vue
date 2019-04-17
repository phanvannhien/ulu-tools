<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Example Component</div>

                    <div class="card-body">
                        <div v-for="(campaign, index) in campaigns">
                            {{ campaign[0] }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        mounted() {
            console.log('Component mounted.')
        },
        data: function() {
            return {
                campaigns: []
            }
        },
        created() {
            this.fetchCampaign();
        },
        methods: {
            fetchCampaign() {
                const t = this;
                const data = 'D={"C":"Gpf_Rpc_Server",+"M":"run",+"requests":[{"C":"Pap_Affiliates_Promo_CampaignsGrid",+"M":"getRows",+"offset":0,+"limit":100,+"columns":[["id"],["id"],["name"],["description"],["logourl"],["banners"],["longdescriptionexists"],["commissionsdetails"],["rstatus"],["commissionsexist"],["affstatus"]]}],+"S":"67mk8azohb8387932p8jnp0ohz2mpxye"}';
                const url = 'https://account.ulu.vn/scripts/server.php';

//                const options = {
//                    method: 'POST',
//                    mode: 'no-cors',
//                    data: data,
//                    headers: {
//                        'Access-Control-Allow-Origin': '*',
//                        'Content-Type': 'application/x-www-form-urlencoded',
//                    },
//                    withCredentials: true,
//
//                };
//                axios( url, options).then( function (resp) {
//                    console.log(resp);
//                } )

                fetch('https://account.ulu.vn/scripts/server.php',{
                    method: 'POST',
                    mode: 'no-cors',
                    body: 'dsada',
                    headers: {
                        "Access-Control-Allow-Credentials": true,
                        "Access-Control-Allow-Origin": "*",
                        "Content-Type": "application/x-www-form-urlencoded"
                    },
                }).then((resp) => {
                    console.log(resp);
                });



            },
        }
    }
</script>
