<?php

namespace workpayment;

/**
 * Класс маршрутизатора
 */
class Router
{

    /**
     * Таблица всех маршрутов
     * @var array
     */
    protected static $routes = [];

    /**
     * Текущий маршрут
     * @var array
     */
    protected static $route = [];

    /**
     * Записывает правило в таблицу маршрутов
     * @param $regexp string Шаблон которому должен соответствовать адрес
     * @param $route array Опция для хранения специфики маршрута
     */
    public static function add($regexp, $route = [])
    {
        self::$routes[$regexp] = $route;
    }

    //

    /**
     * Метод для тестирования
     * @return array возвращает всю таблицу маршрутов
     */
    public static function getRoutes()
    {
        return self::$routes;
    }

    /**
     * Метод для тестирования
     * @return array возвращает текущий маршрут
     */
    public static function getRoute()
    {
        return self::$route;
    }

    /**
     * Метод вызывающий соответствующие маршруту Controller и Action
     * @param $url string Запрошенный url-адрес
     * @throws Exception Если что-то не найдено
     */
    public static function dispatch($url)
    {
        $url = self::removeQueryString($url);
        if (self::matchRoute($url))
        {   // Если url-адрес совпадает с маршрутом из таблицы маршрутов
            // формируем имя Controller с постфиксом
            $controller = 'app\controllers\\' . self::$route['prefix'] . self::$route['controller'] . 'Controller';
            // проверяем сущществует ли класс Контроллера
            if (class_exists($controller))
            {   // если класс Controller существует
                // создаем объект каласса и передаем в него параметры (текущий маршрут)
                $controllerObject = new $controller(self::$route);
                // формируем имя Action с постфиксом
                $action = self::lowerCamelCase(self::$route['action']) . 'Action';
                // Проверяем сущаствует ли такой метод в классе Controller
                if (method_exists($controllerObject, $action))
                {   // если метод существует вызываем его
                    $controllerObject->$action();
                    $controllerObject->getView();
                }
                else
                {   // если метод не существует - Ошибка
                    throw new \Exception("Метод $controller::$action не найден", 400);
                }
            }
            else
            {   // если класса Controller нет - Ошибка
                debug($url); die;
                throw new \Exception("Контроллер $controller не найден", 400);
            }
        }
        else
        {   // если в таблице маршрутов не найдено соотвествие - Ошибка
            throw new \Exception("Не найден маршрут в таблице маршрутов", 400);
        }
    }

    /**
     * Метод ищет соответствие адреса в таблице маршрутов
     * @param $url string Запрошенный url-адрес
     * @return bool Соответствие найдено - TRUE или не найдено - FALSE
     */
    public static function matchRoute($url)
    {
        foreach (self::$routes as $pattern => $route)
        {
            if (preg_match("#{$pattern}#", $url, $matches))
            {
                // если найдено соответствие
                foreach ($matches as $k => $v)
                {   // проходимся по всему массиву
                    if (is_string($k))
                    {   // если ключем является строка
                        // создадим переменную и поместим в нее значения ключа
                        $route[$k] = $v;
                    }
                }
                if (empty($route['action']))
                {   // если не указан Action
                    $route['action'] = 'index'; // Action по умолчанию index
                }
                if (!isset($route['prefix']))
                {   // если у нас не существует Prefix
                    $route['prefix'] = ''; // создаем его но пустым
                }
                else
                {   // если Prefix существует
                    $route['prefix'] .= '\\'; // добавляем обратный слеш
                }
                $route['controller'] = self::upperCamelCase($route['controller']);
                self::$route = $route;
                return true;
            }
        }
        return false;
    }

    /**
     * Метод приводит строку к формату CamelCase для имен Controller
     * @param $name string имя Controller для приведения
     * @return string имя Controller в формате CamelCase
     */
    protected static function upperCamelCase($name)
    {
        return str_replace(' ', '', ucwords(str_replace('-', ' ', $name)));
    }

    /**
     * Метод приводит строку к формату camelCase для имен Action
     * @param $name string имя Action для приведения
     * @return string имя Action в формате CamelCase
     */
    protected static function lowerCamelCase($name)
    {
        return lcfirst(self::upperCamelCase($name));
    }

    // метод для вырезания GET-параметров
    protected static function removeQueryString($url) {
        if ($url) {
            // если пареметр не пуст разбиваем на две части
            // неявные и явные GET-параметры
            $params = explode('&', $url, 2);
            // Проверяем первую часть
            if (false === strpos($params[0], '=')) {
                // если в ней отсутствует знак =
                // возвращаем эту часть без концевого слеша
                return rtrim($params[0], '/');
            } else {
                return '';
            }
        }
    }

}