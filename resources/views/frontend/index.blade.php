<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="{{ mix('css/backstage.css') }}" rel="stylesheet">


    <title>Thunderbite</title>

    <style>
        html,
        body {
            height: 100%;
            margin: 0;
            padding: 0;
        }


        #logo {
            max-width: 100%;
            width: 200px;
        }
    </style>

</head>

<body onload="validationsCheck('{{ request()->get('a') }}')">
    <div class="wrapper">

            <div class="row text-center mb-3">
               <h3 id="reel1"></h3>
                <h3 id="reel2"></h3>
                 <h3 id="reel3"></h3>
            </div>

             <div class="row">
               <h3>Points: <span id="points"></span></h3>
               <h3>Game ID: <span id="gameid"></span></h3>
               <h3>Max Spins: <span id="gameFrequency"></span></h3>
               <h3>Spins: <span id="spinFrequency"></span></h3>
            </div>


            <div class="text-center">
                <button id="gameid" onclick="spin('{{ request()->get('a') }}')" class="submit-button" type="submit">
                    SPIN
                </button>
            </div>

     </div>

    <script src={{ asset('js/app.js') }}></script>
    <script src={{ asset('js/backstage.js') }}></script>
    <script>
        function invalidCampaign(data) {
            swal({
                title: "Alert!",
                text: data,
                icon: "info",
                buttons: false,
            });

            document.getElementById('spin').disabled = true;

        }

        function spin(username) {
            let game = document.getElementById("gameid").innerHTML
            let url = window.location.origin + "/spin"
            let payload = {
                username: username,
                game_id: game
            }
            axios.post(url, payload)
                .then(function(response) {
                    if (response.data.status == false) {
                        invalidCampaign(response.data.message)
                    }

                    document.getElementById("points").innerHTML = response.data.data.points
                    document.getElementById("spinFrequency").innerHTML = response.data.data.spin_count
                    document.getElementById("reel1").innerHTML = response.data.data.reel[0]
                    document.getElementById("reel2").innerHTML = response.data.data.reel[1]
                    document.getElementById("reel3").innerHTML = response.data.data.reel[2]

                });
        }

         function validationsCheck(username) {
            let url = window.location.origin + "/check_game_validity"
            let payload = {
                username: username
            }
            axios.post(url, payload)
                .then(function(response) {

                    if (response.data.status == false) {
                        invalidCampaign(response.data.message)
                    }

                    document.getElementById("gameid").innerHTML = response.data.data.game_id
                    document.getElementById("points").innerHTML = response.data.data.points
                    document.getElementById("gameFrequency").innerHTML = response.data.data.games_frequency
                    document.getElementById("spinFrequency").innerHTML = response.data.data.spin_count


                });
        }
    </script>
</body>

</html>
