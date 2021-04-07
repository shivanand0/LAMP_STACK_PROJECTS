<?php
    if(!empty($_SERVER['HTTP_CLIENT_IP'])){
        //ip from share internet
        $ip = $_SERVER['HTTP_CLIENT_IP'];
    }elseif(!empty($_SERVER['HTTP_X_FORWARDED_FOR'])){
        //ip pass from proxy
        $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
    }else{
        $ip = $_SERVER['REMOTE_ADDR'];
    }
    echo $ip;
    echo "<br>";
    
    
?>
<?php
// $arp=`arp -a`;
// $lines=explode("\n", $arp);
// $devices = array();
// foreach($lines as $line){
//     $cols=preg_split('/\s+/', trim($line));
//     if(isset($cols[2]) && $cols[2]=='dynamic'){
//       $temp = array();
//       $temp['ip'] = $cols[0];
//       $temp['mac'] = $cols[1];
//       $devices[] = $temp;
//   }
// }
// foreach($devices as $device){
// $ip = $device['ip'];
// $mac = $device['mac'];
// echo "THis:   ";
// echo $ip;
// echo $mac;
// }


?>