<?php 

namespace Projetux\infra;


class Debug {
    public function debug(string $texto): void
    {
        echo "Debug: {$texto}";
    }
}

?>