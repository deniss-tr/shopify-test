<?php
namespace Controllers;

require_once __DIR__ . '/../../vendor/autoload.php';

use GuzzleHttp\Client;

abstract class BaseController {
    private const CONFIG_LOCATION = __DIR__ . '/../../app/etc/config.php';

    public const STORE_BASE_URL = 'https://deniss-tarasevics.myshopify.com';

    public function __construct()
    {
        $this->config = $this->loadConfig();
        $this->client = $this->initGuzzleClient();
    }

    /**
     * @return mixed|null
     */
    private function loadConfig()
    {
        $config = null;

        if (file_exists(self::CONFIG_LOCATION)) {
            $config = require self::CONFIG_LOCATION;
        }

        return $config;
    }

    /**
     * @return Client|null
     */
    protected function initGuzzleClient() {
        if (!$this->config) {
            return null;
        }

        return new Client([
            'base_uri' => self::STORE_BASE_URL,
            'headers' => [
                'Content-Type' => 'application/json',
                'X-Shopify-Access-Token' => $this->config['shopify_access_token'],
            ],
        ]);
    }
}