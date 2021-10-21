<?php
$str = './INFO-2021-10-16.log:2021-10-16 11:02:02 - INFO -->  ReceiveCallback param {"methodName":"GO Pay","orderId":"W211016105804822348249","channelId":"974","amount":"1591","status":"001","memo":"\u4e0b\u53d1\u529f\u80fd\u4e34\u65f6\u5173\u95ed","signature":"c05173556c99d9454a1063eee456b340"}
./vendor_java-2021-10-16.log:2021-10-16 11:02:02 - INFO --> uniqid:ag_payment_fana1905002_616a40a9a324a  java param:{"methodName":"GO Pay","orderId":"W211016105804822348249","channelId":"974","amount":"1591","status":0,"memo":"\u4e0b\u53d1\u529f\u80fd\u4e34\u65f6\u5173\u95ed"}
./vendor-2021-10-16.log:2021-10-16 11:02:01 - INFO --> uniqid:ag_payment_fana1905002_616a40a9a324a Gopay PAY{"sendid":"d11e5969-1cf4-4e46-b8b9-fb260a350198","orderid":"W211016105804822348249","amount":"1591.00","address":"eae5490aa4d1a661","sign":"37e54bcb720b402fadb2b0fecb76b869"}
./Job_Notify-2021-10-16.log:order:{"id":"33001","order_id":"W211016105804822348249","amount":"1591","real_amount":null,"card_no":"eae5490aa4d1a661","vendor_id":"301","order_param":"{\"merchantId\":\"974\",\"order_id\":\"W211016105804822348249\",\"level\":\"level_2\",\"amount\":\"1591\",\"card_no\":\"eae5490aa4d1a661\",\"name\":\"\\u5468\\u5409\",\"bank_code\":\"CNBK0995\",\"signature\":\"BA21F20C680AAFA6F03B33E40D78CF53\",\"virtual_amount\":\"1591.00\"}","create_time":"16-OCT-21","search_job_time":"16-OCT-21","status":"1","is_search":"0","notify_java_status":"0","callback_java_status":"0"}';
while (($tmp = strstr($str, '{'))) {
    $limit = 0;
    $endlimit = 0;
    for ($i = 0; $i < strlen($tmp); $i++) {
        if ($tmp[$i] == '{') $limit++;
        if ($tmp[$i] == '}') $endlimit++;
        if ($limit != 0 && $limit == $endlimit) {
            var_dump(json_decode(substr($tmp, 0, $i + 1), true));
            break;
        }
    }
    $str = strstr($tmp, '}');
}
