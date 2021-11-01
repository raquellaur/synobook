<?php

namespace App\Ui;

class ListTemplate implements TemplateInterface
{
    protected $templates;

    public function addChild(TemplateInterface $template)
    {
        $this->templates[] = $template;
    }

    /**
     * @return string
     */
    public function render(): string
    {
        $content = '';

        foreach ($this->templates as $template) {
            $content .= $template->render();
        }
        return $content;
    }
}
