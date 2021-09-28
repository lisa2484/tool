<?php
for ($i = 0; $i < 15; $i++) {
    pclose(popen('start /B php time_sleep_attack.php', 'w'));
}
