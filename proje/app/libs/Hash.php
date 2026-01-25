<?php
    /**
     * Created by PhpStorm.
     * User: user
     * Date: 28.12.2016
     * Time: 10:27
     */
    class Hash
    {
        public function create($type, $data, $key)
        {
            $context = hash_init($type, HASH_HMAC, $key);
            hash_update($context, $data);
            return hash_final($context);
        }
    }