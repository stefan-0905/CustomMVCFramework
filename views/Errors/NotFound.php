


<?php

$responseBody = headers_list()[2];
$responseBody = str_replace("Body: ", "", $responseBody);
$responseBody = json_decode($responseBody, true);

?>

<div style="height: 100vh" class="container text-center d-flex justify-content-center">

    <div class="w-50 align-self-center">
        <h2 class="text-danger"><?php echo http_response_code(); ?>, </h2>
        <p><?php echo $responseBody["message"] ?></p>

    </div>

</div>
