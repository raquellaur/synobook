<?php

namespace App\Ui;

class Template implements TemplateInterface
{
    protected $template;

    /**
     * @return mixed
     */
    public function getTemplate()
    {
        return $this->template;
    }

    /**an
     * @param mixed $template
     */
    public function setTemplate($template): void
    {
        $this->template = $template;
    }

    public function render():string
    {
        ob_start();

        include($this->getTemplate());

        return ob_get_clean();
    }
}
