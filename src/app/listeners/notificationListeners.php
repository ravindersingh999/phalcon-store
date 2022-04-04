<?php

namespace App\Listeners;

use Phalcon\Events\Event;
use Phalcon\Security\JWT\Builder;
use Phalcon\Security\JWT\Signer\Hmac;
use Phalcon\Security\JWT\Token\Parser;
use Phalcon\Security\JWT\Validator;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;


class notificationListeners
{
    public function beforesend(Event $event, $data, $settings)
    {
        echo "<pre>";
        print_r($data);
        echo "</pre>";
        echo "----------------------------------------";

        echo "<pre>";
        print_r(json_decode(json_encode($settings[0])));
        echo "</pre>";
        // die();
        if ($settings[0]->title_optimization == "with tags") {
            $data->name = $data->name . $data->tags;
        }
        if ($data->price == '') {
            $data->price = $settings[0]->default_price;
        }
        if ($data->stock == '') {
            $data->stock = $settings[0]->default_stock;
        }
        echo "after";
        echo "<pre>";
        print_r($data);
        echo "</pre>";
        //  die();
        return $data;
    }

    public function aftersend(Event $event, $data, $settings)
    {
        if ($data->zipcode == "") {
            $data->zipcode = $settings[0]->default_zipcode;
        }
        return $data;
    }

    public function beforeHandleRequest(Event $event, \Phalcon\Mvc\Application $application)
    {
        $aclfile = APP_PATH . '/security/acl.cache';
        if (is_file($aclfile) == true) {
            $acl = unserialize(
                file_get_contents($aclfile)
            );

            $bearer = $application->request->get('bearer');
            if ($bearer) {
                try {
                    $key = "example_key";
                    $decoded = JWT::decode($bearer, new Key($key, 'HS256'));
                    $role = $decoded->role;
                    $controller = $application->router->getControllerName();
                    $action = $application->router->getActionName();
                    if (!$role || true !== $acl->isAllowed($role, $controller, $action)) {
                        echo "access denied";
                        die();
                    }
                } catch (\Exception $e) {
                    $e->getMessage();
                    die;
                }
            } else {
                echo "token not provided";
                die;
            }
        } else {
            echo "No ACL";
            die();
        }
    }
}
