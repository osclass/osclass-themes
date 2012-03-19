<?php
    
     if( !function_exists('osc_esc_js') ) {
        function osc_esc_js($str) {
            $str = htmlspecialchars($str, ENT_COMPAT) ;
            $str = str_replace("\r", '', $str) ;
            $str = str_replace("\n", '\\n', $str) ;
            $str = addslashes($str) ;

            return $str ;
        }
    }

?>