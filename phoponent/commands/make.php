<?php
namespace phoponent\framework\command;

use phoponent\framework\static_classe\debug;
use phoponent\framework\traits\command;

class make {
	use command;

	private function create_component($type, $tag) {
        if(!is_dir("phoponent/app/components/{$type}/{$tag}")) {
            mkdir("phoponent/app/components/{$type}/{$tag}/models", 0777, true);
            mkdir("phoponent/app/components/{$type}/{$tag}/views/src", 0777, true);
        }
        file_put_contents(
            "phoponent/app/components/{$type}/{$tag}/{$tag}.php",
            "<?php
namespace phoponent\app\component\\$type;

".( $type === 'core' ? "use phoponent\\framework\\classe\\xphp_tag;" : '' )."
    class {$tag} extends ".($type === 'custom' ? '\phoponent\app\component\core\\'.$tag : 'xphp_tag')." {
        public function render():string {
            \$hello_world = \$this->get_model('{$tag}')->get_hello_world();
            \$view = \$this->get_view('{$tag}')->set_vars([
                'value' => \$hello_world,
                'class' => __CLASS__,
            ])->render();
            return \$view;
        }
    }"
        );

        file_put_contents(
            "phoponent/app/components/{$type}/{$tag}/views/{$tag}.view.php",
            "<?php
namespace phoponent\app\component\\$type\\$tag\mvc\\view;

use phoponent\\framework\\traits\\view;
    class {$tag}".($type === 'custom' ? ' extends \phoponent\app\component\\core\\'.$tag.'\\mvc\\view\\'.$tag : '')." {
        use view;
    }"
        );

        file_put_contents(
            "phoponent/app/components/{$type}/{$tag}/views/src/{$tag}.view.html",
            $type === 'core' ? "<div> @class@ </div>" : '@parent@'
        );

        file_put_contents(
            "phoponent/app/components/{$type}/{$tag}/models/{$tag}.php",
            "<?php
namespace phoponent\app\component\\$type\\$tag\mvc\model;

use phoponent\\framework\\traits\\model;
    class {$tag}".($type === 'custom' ? ' extends \phoponent\app\component\core\\'.$tag.'\\mvc\\model\\'.$tag : '')." {
        use model;
        
        public function get_hello_world() {
            return 'Hello World';
        }
    }"
        );
    }

	public function component() {
		if(($tag = $this->argument('tag')) !== null) {
			$tag = ucfirst($tag);
			$type = $this->argument('type') ? $this->argument('type') : 'core';
			if($type === 'custom' && !is_dir("phoponent/app/components/core/{$tag}")) {
                $this->create_component('core', $tag);
                $this->create_component('custom', $tag);
            }
            else {
                $this->create_component($type, $tag);
            }
		}
	}

	public function debug() {
        debug::set_debug();
    }
}