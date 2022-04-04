<?php

namespace App\Components;

use Phalcon\Escaper;

class myescaper
{
    public function sanitize($data)
    {
        $escaper = new Escaper();

        // $name = $escaper->escapeHtml($name);
        // $email = $escaper->escapeHtml($email);

        // $data = array("name"=>$name, "email"=>$email);
        // return $data;

        $data = array(
            "name" => $escaper->escapeHtml($data['name']),
            "email" => $escaper->escapeHtml($data['email']),
            "password" => $escaper->escapeHtml($data['password']),
            "role" => $escaper->escapeHtml($data['role'])
        );
        return $data;
    }
}
