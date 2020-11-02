<?php
Class SMS{


  public static function send($receipient, $message){
    $api_key = "709d65740b1ca881b60e07706281035";
    $source = "ViraPay";
    $destination = $receipient;
    $message = urlencode($message);
    $type = 0;
    $report = 1;

    $curl = curl_init();

    curl_setopt_array($curl, [
      CURLOPT_URL => "https://api.ikelvin.co/sms/query?type=$type&dir=$type&source=$source&destination=$destination&message=$message&api_key=$api_key",
      CURLOPT_RETURNTRANSFER => true,
      CURLOPT_ENCODING => "",
      CURLOPT_MAXREDIRS => 10,
      CURLOPT_TIMEOUT => 30,
      CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
      CURLOPT_CUSTOMREQUEST => "POST",
      CURLOPT_POSTFIELDS => "",
    ]);

    $response = curl_exec($curl);
    $err = curl_error($curl);

    curl_close($curl);

    if ($err) {
      echo "cURL Error #:" . $err;
      return False;
    } else {
      echo $response;
      return True;
    }



    //
    // $curl = curl_init();
    //
    // curl_setopt_array($curl, array(
    //   CURLOPT_URL => "https://api.nalosolutions.com/bulksms/?username=ikelvin&password=kerrison41%40&type=".$type."&dlr=".$report."&destination=.$destination.&source=".$source."&message=".$message,
    //   CURLOPT_RETURNTRANSFER => true,
    //   CURLOPT_ENCODING => "",
    //   CURLOPT_MAXREDIRS => 10,
    //   CURLOPT_TIMEOUT => 30,
    //   CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    //   CURLOPT_CUSTOMREQUEST => "POST",
    //   CURLOPT_POSTFIELDS => "",
    // ));
    //
    // $response = curl_exec($curl);
    // $err = curl_error($curl);
    //
    // curl_close($curl);
    //
    // if ($err) {
    //   echo "cURL Error #:" . $err;
    //   return False;
    // } else {
    //   echo $response;
    //   return True;
    // }
  }
}

?>
