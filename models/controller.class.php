<?php 

class controller {
    
    public function load($controller) {
        include ROOT . "/controllers/{$controller}Controller.php";
        if (class_exists($controller)) {
            $controller = (new $controller);
            if (method_exists($controller, 'index'))
                $controller->index();
            
            if (helper::POST() && method_exists($controller, 'post')) $controller->post();
        }
    }
}