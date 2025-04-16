<?php 

namespace Projetux\infra;


class Debug {
    public function debug(string $texto): string
    {
         return "Debug: {$texto}";
    }
}

?>