<?php

namespace workpayment;

class Registry
{

    use TSingletone;

    protected static $properties = []; // содержит все свойства

    /**
     * Запись параметра в реестр параметров приложения
     * @param $name string ключ (имя) параметра
     * @param $value string значение параметра
     */
    public function setProperty($name, $value)
    {
        self::$properties[$name] = $value;
    }

    /**
     * Чтение значения параметра приложения по ключу (имени)
     * @param $name string ключ параметра
     * @return mixed|null значение параметра
     */
    public function getProperty($name)
    {
        if (isset(self::$properties[$name])) {
            // если свойство существует возвращаем его
            return self::$properties[$name];
        }
        return null; // иначе ничего не возвращаем
    }

    /**
     * Возвращает все параметры приложения
     * @return array - массив со всеми свойствами
     */
    public function getProperties()
    {
        return self::$properties;
    }

}