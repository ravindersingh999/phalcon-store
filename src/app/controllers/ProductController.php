<?php

use Phalcon\Mvc\Controller;


class ProductController extends Controller
{
    public function indexAction()
    {
        $this->view->products = Products::find();
    }

    public function addAction()
    {
        
    }

    public function addproductAction()
    {
        $name = $this->request->getPost('name');
        $description = $this->request->getPost('description');
        $tags = $this->request->getPost('tags');
        $price = $this->request->getPost('price');
        $stock = $this->request->getPost('stock');
        $product = new Products();

        $data = $_POST;
        // print_r(json_encode($data));
        // die();
        $eventmanager = $this->di->get('eventManager');
        $settings = Settings::find();
        // print_r(json_encode($settings));
        // die();
        $array = $eventmanager->fire('notifications:beforeSend', (object)$data, $settings);

        // print_r(json_encode($array));
        // die();
        $values = array(
            'name' => $array->name,
            'description' => $array->description,
            'tags' => $array->tags,
            'price' => $array->price,
            'stock' => $array->stock,
        );

            $product->assign(
                $values,
                [
                    'name',
                    'description',
                    'tags',
                    'price',
                    'stock',
                ]
            );
            // print_r(json_encode($product));
            // die();
            $product->save();
            $bearer = $this->request->get('bearer');
            $this->response->redirect("/product/add?bearer=".$bearer);
    }
}
