<?php

use Phalcon\Mvc\Controller;


class OrderController extends Controller
{
    public function indexAction()
    {
        $this->view->orders = Orders::find();
    }

    public function addorderAction()
    {
        $this->view->products = Products::find();
    }

    public function orderAction()
    {
        $order = new Orders();
        // print_r($this->request->getPost());
        // die();
        $data = $_POST;
        $eventmanager = $this->di->get('eventManager');
        $settings = Settings::find();
        $array = $eventmanager->fire('notifications:afterSend', (object)$data, $settings);

        $values = array(
            'name' => $array->name,
            'address' => $array->address,
            'zipcode' => $array->zipcode,
            'product' => $array->product,
            'quantity' => $array->quantity,
        );
        if ($this->request->getPost()) {
            $order->assign(
                $values,
                [
                    'name',
                    'address',
                    'zipcode',
                    'product',
                    'quantity',
                ]
            );
            // print_r(json_encode($order));
            // die();
            $order->save();
            $bearer = $this->request->get('bearer');
            $this->response->redirect("/order/addorder?bearer=".$bearer);
        }
    }
}
