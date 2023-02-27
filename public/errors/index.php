<?php

const DEBUG = 1;

/**
 * Класс обработки ошибок
 */
class ErrorHandlers
{

    /**
     * Конструктор класса
     */
    public function __construct()
    {
        if (DEBUG)
        {   // если установлен режим разработки показываем все ошибки
            error_reporting(-1);
        }
        else
        {   // если разработка завершена скрываем все ошибки
            error_reporting(0);
        }
        set_error_handler([$this, 'errorHandler']);
        ob_start();
        register_shutdown_function([$this, 'fatalErrorHandler']);
        set_exception_handler([$this, 'exceptionHandler']);
    }

    /**
     * Пользовательский обработчик ошибок
     */
    public function errorHandler($errno, $errstr, $errfile, $errline): bool
    {
        $this->logErrors($errstr, $errfile, $errline);
        $this->displayError((string)$errno, $errstr, $errfile, $errline);
        return true;
    }

    /**
     * Функция получения фатальной ошибки
     */
    public function fatalErrorHandler()
    {   // выполняется после завершения работы скрипта
        $error = error_get_last(); // данные о последней фатальной ошибке
        if (!empty($error) && $error['type'] & (E_ERROR | E_PARSE | E_COMPILE_ERROR | E_CORE_ERROR))
        {   // Если такая ошибка есть
            $this->logErrors($error['message'], $error['file'], $error['line']);
            ob_end_clean(); // Получаем содержимое буфера и удаляем его
            $this->displayError((string)$error['type'], $error['message'], $error['file'], $error['line']);
        }
        else
        {   // Если ошибки нет
            ob_end_flush(); // Сбросываем буфер и отключаем буферизацию вывода
        }
    }

    public function exceptionHandler($e)
    {
        $this->logErrors($e->getMessage(), $e->getFile(), $e->getLine());
        $this->displayError('Исключение', $e->getMessage(), $e->getFile(), $e->getLine(), $e->getCode());
    }

    public function displayError($errno, $errstr, $errfile, $errline, $response = 500)
    {
        http_response_code($response); // отправляем код ответа браузера
        if (DEBUG)
        {   // Если режим разработчика подключаем соответствующий шаблон
            require 'dev.php';
        }
        else
        {   // Если режим пользователя подключаем соответствующий шаблон
            require 'prod.php';
        }
        die;
    }

    protected function logErrors($message = '', $file = '', $line = '')
    {
        error_log("[" . date('Y-m-d H:i:s') . "] Текст ошибки: {$message} | Файл: {$file} | Строка: {$line}\n--------------------\n", 3, 'error.log');
    }

}

new ErrorHandlers();
//echo $test;
//test();
/*try {
    if (empty($test))
    {
        throw new Exception('Упс, исключение');
    }
} catch (Exception $e)
{
    var_dump($e);
}*/
//throw new Exception('Упс, исключение', 404);
