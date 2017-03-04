<!doctype html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Price</title>
    </head>
    <body>
        <p> For your records your IP is: <?php echo getUserIP() ?>
            <?php
              function getUserIP()
                {
                    $client  = @$_SERVER['HTTP_CLIENT_IP'];
                    $forward = @$_SERVER['HTTP_X_FORWARDED_FOR'];
                    $remote  = $_SERVER['REMOTE_ADDR'];

                    if(filter_var($client, FILTER_VALIDATE_IP)){
                        $ip = $client;
                    }
                    elseif(filter_var($forward, FILTER_VALIDATE_IP)){
                        $ip = $forward;
                    } else {
                        $ip = $remote;
                    }

                    return $ip;
                }
            ?>
        </p>
        <p>The price is: 
            <?php            
                $nstax = 0;
                $senior = 0;
                $child = 0;
                $loyalty = 0;
                $price = $_POST['price'];
                $tax = 0;
                $total = 0;
                
                    if(isset($_POST['customer'])) {
                        $nstax = $price * 0.2;
                        $tax = 0;
                    } else if (!isset($_POST['customer'])) {                        
                        $nstax = 0;
                        $tax = $price * 0.15;
                    }
                    if($_POST['age'] <= 12) {
                        $child = $price * 0.1;
                    } else if($_POST['age'] > 64){
                        $senior = $price * 0.05;
                    }
                    if(isset($_POST['loyal'])){
                        $loyalty = $price * 0.02;
                    } else if (!isset($_POST['loyal'])){
                        $loyalty = 0;
                    }
                    echo  $price + ($tax + $nstax - $child - $senior - $loyalty);                             
                
            ?>
        </p> 
    </body>
</html>