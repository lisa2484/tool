<?php
class SYSDT
{
    static $timeZone;

    static function setTime(DateTimeZone $tz)
    {
        self::$timeZone = $tz;
    }


    static function getDate(string $dateFormat, int $time = 0)
    {
        $DateTime = new DateTime('now', self::$timeZone);
        if ($time != 0) $DateTime->setTimestamp($time);
        return $DateTime->format($dateFormat);
    }

    static function getTimeForStr(string $dateStr)
    {
        $DateTime = new DateTime($dateStr, self::$timeZone);
        return $DateTime->getTimestamp();
    }
}
SYSDT::setTime(new DateTimeZone('+0800'));
echo SYSDT::getDate('Y-m-d H:i:s P', 10000086399);
// echo SYSDT::getTimeForStr('2020-01-01');
// echo date('Y-m-d H:i:s P');
