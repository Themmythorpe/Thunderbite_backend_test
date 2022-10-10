<?php

function uploadDocument($file, $name = null)
{
    $destinationPath = 'symbols';
    $myimage = $file->getClientOriginalName();
    $file->move(public_path($destinationPath), $myimage);

    return  '/symbols/'.  $myimage;
}

function generateSpinArray()
{
    $symbol_array = [1,2,3,4,5,6,7,8,9,10,11,12,13,14,15];

        function getArray($symbol_array) {
            $mh = [];
            for ($x = 1; $x <= 5; $x++) {
                $symbol = Arr::random($symbol_array);
                array_push($mh, $symbol);
            }

            return $mh;
        }

        $spin_reel[0] = getArray($symbol_array);
        $spin_reel[1] = getArray($symbol_array);
        $spin_reel[2] = getArray($symbol_array);

    return $spin_reel;

}

function getReelMatches($spin_reel)
{
    //possible paylines
    $paylines[0] = [1,2,3,4,5];
    $paylines[1] = [6,7,8,9,10];
    $paylines[2] = [11,12,13,14,15];
    $paylines[3] = [1,7,13,9,5];
    $paylines[4] = [11,7,3,9,15];
    $paylines[5] = [6,2,3,4,10];
    $paylines[6] = [6,12,13,14,10];
    $paylines[7] = [1,2,8,14,15];
    $paylines[8] = [11,12,8,4,5];
    //define matches
    $x = 0;

//check if reel matches paylines
    foreach ($spin_reel as $item) {
        foreach ($paylines as $payline) {
            if($item == $payline){
                //increment matches if there is a match
                $x = $x + 1;
            }
        }
      }
    return  $x;
}
