<?php

use Phalcon\Mvc\Controller;

class SettingsController extends Controller
{
    public function indexAction()
    {
        print_r(json_encode($_POST));

        $title = $this->request->getPost('title');
        $dp = $this->request->getPost('default_price');
        $ds = $this->request->getPost('default_stock');
        $dz = $this->request->getPost('default_zipcode');

        $row = Settings::findFirst(
            [
                "id = 1",
            ]
        );

        $row->title_optimization = $title;
        $row->default_price = $dp;
        $row->default_stock = $ds;
        $row->default_zipcode = $dz;

        $row->save();
    }
}
