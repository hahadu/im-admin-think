<?php

namespace Hahadu\ThinkAdmin\Contract;

interface Htmlable
{
    /**
     * Get content as a string of HTML.
     *
     * @return string
     */
    public function toHtml();

}