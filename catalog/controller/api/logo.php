<?php

class ControllerApiLogo extends Controller
{

    public function get()
    {
        $this->load->model('setting/api');
        $api_info = $this->model_setting_api->login($this->request->get['username'], $this->request->get['api_token']);

        if ($api_info) {
            if ($this->request->server['HTTPS']) {
                $server = $this->config->get('config_ssl');
            } else {
                $server = $this->config->get('config_url');
            }
            if (is_file(DIR_IMAGE . $this->config->get('config_logo'))) {
                $image = $server . 'image/' . $this->config->get('config_logo');
            } else {
                $image = '';
            }
        } else {
            $image = 'Invalid Api key';
        }
        $this->response->addHeader('Content-Type: application/json');
        $this->response->setOutput(json_encode($image));

    }
}

