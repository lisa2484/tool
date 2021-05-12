<?php

/**
 * 隨機亂數
 * @param int $strlen 字串數量 小寫a-z
 * @param int $intlen 數字數量 0-9
 * @param int $type 0:混和 1:字串在前 2:數字在前
 * @return string
 */
function getRandom(int $strlen = 4, int $intlen = 4, int $type = 0): string
{
    $s = '';
    $alllen = $strlen + $intlen;
    switch ($type) {
        case 0:
            $ts = $strlen;
            $ti = $intlen;
            for ($i = 0; $i < $alllen; $i++) {
                if ($ts <= 0) {
                    $s .= random_int(0, 9);
                    continue;
                }
                if ($ti <= 0) {
                    $s .= chr(random_int(97, 122));
                    continue;
                }
                $rd = random_int(0, 1);
                if ($rd === 0) {
                    $s .= random_int(0, 9);
                    $ti -= 1;
                } else {
                    $s .= chr(random_int(97, 122));
                    $ts -= 1;
                }
            }
            break;
        case 1:
            for ($i = 0; $i < $strlen; $i++) {
                $s .= chr(random_int(97, 122));
            }
            for ($i = 0; $i < $intlen; $i++) {
                $s .= random_int(0, 9);
            }
            break;
        case 2:
            for ($i = 0; $i < $intlen; $i++) {
                $s .= random_int(0, 9);
            }
            for ($i = 0; $i < $strlen; $i++) {
                $s .= chr(random_int(97, 122));
            }
            break;
    }
    return $s;
}
