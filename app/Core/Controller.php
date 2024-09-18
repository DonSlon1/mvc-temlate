<?php
    namespace App\Core;

    use Symfony\Component\HttpFoundation\Request;
    use Symfony\Component\HttpFoundation\Response;

    class Controller {
        protected Request $request;
        protected Response $response;
        protected View $view;

        public function __construct(Request $request, Response $response) {
            $this->request = $request;
            $this->response = $response;
            $this->view = new View();
        }

        protected function render($template, $data = []) : Response
        {
            $content = $this->view->render($template, $data);
            $this->response->setContent($content);
            return $this->response;
        }
    }
