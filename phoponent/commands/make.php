<?php
namespace phoponent\framework\command;

use phoponent\framework\traits\command;

class make {
	use command;

	public function component() {
		if(($tag = $this->argument('tag')) !== null) {
			$tag = ucfirst($tag);
			if(!is_dir("phoponent/app/components/{$tag}")) {
				mkdir("phoponent/app/components/{$tag}/models", 0777, true);
				mkdir("phoponent/app/components/{$tag}/views/src", 0777, true);
			}
			file_put_contents("phoponent/app/components/{$tag}/{$tag}.php", "<?php
namespace phoponent\app\component\\".$tag.";

use phoponent\\framework\\classe\\xphp_tag;
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

			file_put_contents("phoponent/app/components/{$tag}/views/my_{$tag}_view.view.php", "<?php
namespace phoponent\app\component\\".$tag."\mvc\\view;

use phoponent\\framework\\traits\\view;
    class my_{$tag}_view {
        use view;
    }");

			file_put_contents("phoponent/app/components/{$tag}/views/src/my_{$tag}_view.view.html", "<div> @class@ </div>");

			file_put_contents("phoponent/app/components/{$tag}/models/my_{$tag}_model.php", "<?php
namespace phoponent\app\component\\".$tag."\mvc\model;

use phoponent\\framework\\traits\\model;
    class my_{$tag}_model {
        use model;
        
        public function get_hello_world() {
            return 'Hello World';
        }
    }");
		}
	}
}