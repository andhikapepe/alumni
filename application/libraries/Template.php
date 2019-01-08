<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}
/**
 * Dikembangkan Oleh Andhika Putra Pratama.
 */
class Template
{
    private $_ci;
    private $_app_name = 'Sistem Informasi Alumni';
    private $_app_slogan = '';
    private $_title_separator = ' | ';

    public function _render_page($view, $data = null, $returnhtml = false)
    {
        $this->_ci = &get_instance();

        if (empty($this->_title)) {
            $this->_title = $this->_set_title();
        }
        if (empty($data['title'])) {
            $data['title'] = $this->_title;
        }

        $data['_app_name'] = $this->_app_name;
        $data['_app_slogan'] = $this->_app_slogan;

        $this->viewdata = (empty($data)) ? $this->data : $data;

        $view_html = $this->_ci->load->view($view, $this->viewdata, $returnhtml);

        if ($returnhtml) {
            return $view_html;
        }
    }

    public function set_app_name()
    {
        $_app_name = $this->_app_name;

        return $_app_name;
    }

    public function set_app_slogan()
    {
        $_app_slogan = $this->_app_slogan;

        return $_app_slogan;
    }

    public function title()
    {
        if (func_num_args() >= 1) {
            $title_segments = func_get_args();
            $this->_title = implode($this->_title_separator, $title_segments);
        }

        return $this;
    }

    private function _set_title()
    {
        $this->_ci->load->helper('inflector');

        if (method_exists($this->_ci->router, 'fetch_module')) {
            $this->_module = $this->_ci->router->fetch_module();
        }

        $this->_controller = $this->_ci->router->fetch_class();
        $this->_method = $this->_ci->router->fetch_method();

        $title_parts = '';
        if ($this->_method != 'index') {
            $title_parts = $this->_method;
        } else {
            $title_parts = $this->_controller;
        }

        $title = humanize(implode($this->_title_separator, array($this->_app_name, $title_parts)));

        return $title;
    }
}
