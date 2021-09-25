<?php

namespace Hahadu\ThinkAdmin\Contract;

interface MessageProvider
{
    /**
     * Get the messages for the instance.
     *
     * @return MessageBagContract
     */
    public function getMessageBag();

}