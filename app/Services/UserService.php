<?php

    namespace App\Services;
    class UserService extends \App\Services\ApiService
    {
        public function __construct()
        {
            $this->endpoint='user_accounting_backend:8001/api';
        }
    }
