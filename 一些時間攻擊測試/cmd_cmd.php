<?php
for ($i = 0; $i < 5; $i++) {
    pclose(popen('start /B php cmd.php', 'w'));
}
