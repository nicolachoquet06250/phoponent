<?php
require_once 'lib/Autoload.php';

class create_component {
    use static_class;

    public static function start($argv) {
        if(isset($argv[1])) {
            $tag = ucfirst($argv[1]);
            mkdir("components/{$tag}/models", 0777, true);
            mkdir("components/{$tag}/views/src", 0777, true);
            file_put_contents("components/{$tag}/{$tag}.php", "<?php
    class {$tag} extends xphp_tag {
        public function render():string {
            \$hello_world = \$this->get_model('my_{$tag}_model')->get_hello_world();
            \$view = \$this->get_view('my_{$tag}_view')->set_vars([
                'value' => \$hello_world,
                'class' => __CLASS__,
            ])->render();
            return \$view;
        }
    }");

            file_put_contents("components/{$tag}/views/my_{$tag}_view.view.php", "<?php
    class my_{$tag}_view {
        use view;
    }");

            file_put_contents("components/{$tag}/views/src/my_{$tag}_view.view.html", "<div> @class@ </div>");

            file_put_contents("components/{$tag}/models/my_{$tag}_model.php", "<?php
    class my_{$tag}_model {
        use model;
        
        public function get_hello_world() {
            return 'Hello World';
        }
    }");
        }
    }
}

create_component::start($argv);