<?php

class ControllerApiProducts extends Controller
{
    public function get()
    {
        $this->load->model('setting/api');

        $api_info = $this->model_setting_api->login($this->request->get['username'], $this->request->get['api_token']);

        if ($api_info) {
            $this->load->model('catalog/product');
            $product_info = $this->model_catalog_product->getProducts();
        } else {
            $product_info = 'Invalid Api key';
        }
        $this->response->addHeader('Content-Type: application/json');
        $this->response->setOutput(json_encode($product_info));
    }
}