<?php $this->load->view(isset($content) ? $content : $this->router->directory . '/' . $this->router->class . '/' . $this->router->method); ?>
