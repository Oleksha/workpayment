<?php

namespace workpayment;

class App
{

    public static $app;

    /**
     * Конструктор класса
     */
    public function __construct()
    {
        // получаем адрес из строки браузера
        $query = trim($_SERVER['QUERY_STRING'], '/');
        session_start();
        //set_time_limit(0); // для сброса ограничений на время выполнения операции
        self::$app = Registry::instance();
        $this->getParams();
        new ErrorHandler();
        Router::dispatch($query); // передаем маршрутизатору запрошенный адрес
    }

    /**
     * Заполнение параметров приложения по умолчанию
     */
    protected function getParams()
    {
        // Получаем массив с параметрами
        $params = require_once  CONF . '/params.php';
        // Если массив не пуст
        if (!empty($params)) {
            foreach ($params as $k => $v) {
                self::$app->setProperty($k, $v);
            }
        }
    }

}