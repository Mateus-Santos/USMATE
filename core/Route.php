<?php


namespace Core;

class Route
{
    private $routes;

    /* 
    Essa função é a qual o bootstrap chama e envia como parametro 
    todas as rotas criadas pelo programador para que seja feita todas 
    as operações. 
    */
    public function __construct(array $routes){
        $this->setRoutes($routes);
        $this->run();
    }
    /*
    Essa função serve para criar o padrão de criação de rotas para 
    o programador ela utiliza o padrão com o caractere @, mais especificamente 
    essa função trata a parte na qual o progromador utiliza o controller 
    como por exemplo HomeController@index, esse padrão depende desta função.
    */
    private function setRoutes($routes)
    {
        foreach ($routes as $route)
        {
            $explode1 = explode('@', $route[1]);
            $r = [$route[0], $explode1[0], $explode1[1]];
            $newRoutes[] = $r;
        }
        $this->routes = $newRoutes;
    }
    private function GetRequest()
    {
        $obj = new \stdClass;
        foreach ($_GET as $key => $value){
            @$obj->get->$key = $value;
        }
        foreach ($_POST as $key => $value){
            @$obj->post->$key = $value;
        }
        return $obj;
    }
    private function getUrl()
    {
        //Metodo que para capturar a roda digitada pelo usuario.
        return parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
    }
    /*Metodo que compara a rota criada pelo programador e a rota enviada 
    pelo usuario, também envia as informações para os controllers caso tudo de certo*/
    private function run()
    {
        $url = $this->getUrl();
        $urlArray = explode('/', $url);
        //Esse foreach foi feito para percorrer o Array que tem todas as rotas criada pelo programador.
        foreach ($this->routes as $route)
        {
            $routeArray = explode('/', $route[0]);
            /*Esse for logo abaixo foi feito para criar encontrar os parametros
            no caso os {id}, como padrão ele é encontrado atraves do caractere {*/
            for($i = 0; $i < count($routeArray); $i++)
            {
                if ((strpos($routeArray[$i], "{") !== false) && (count($urlArray) == count($routeArray)))
                    {
                        $routeArray[$i] = $urlArray[$i];
                        $param[] = $urlArray[$i];
                    }
                    $route[0] = implode($routeArray, '/');
            }
            if($url == $route[0])
            {
                $found = true;
                $controller = $route[1];
                $action = $route[2];
            break;
            }
        }
        /*Aqui é onde caso found seja true então a ação pela qual o 
        programador definiu para o Controller será chamada. Está 
        limitada a apenas 3 parametros mas isso pode ser mudado para 4 ou mais.*/
        if($found){
            $controller = Container::newController($controller);
            switch (count($param)){
                case 1:
                    $controller->$action($param[0], $this->getRequest());
                break;
                case 2:
                    $controller->$action($param[0], $param[1], $this->getRequest());
                break;
                case 3:
                    $controller->$action($param[0], $param[1], $param[2], $this->getRequest());
                break;
                default:
                    $controller->action($this->getRequest());
            }
        }else{
            echo "Página não encontrada.";
        }
    }
}
?>