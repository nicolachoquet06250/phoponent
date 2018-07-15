<?php
    use phoponent\framework\traits\static_class;
    use phoponent\framework\static_classe\xphp;

    class index {
        use static_class;
        public static function start($argv) {
            return xphp::parse($argv[1]);
        }
    }