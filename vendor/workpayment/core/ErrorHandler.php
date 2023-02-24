<?php

namespace workpayment;

class ErrorHandler
{

    /**
     * Конструктор класса ошибок
     */
    public function __construct()
    {
        if (DEBUG) {
            // если включен режим разработки показываем все ошибки
            error_reporting(-1);
        } else {
            // иначе ошибки не показываем
            error_reporting(0);
        }
        // обрабатываем ошибки
        set_exception_handler([$this, 'exceptionHandler']);
    }

    /**
     * Метод обрабатывающий перехваченные исключения
     * @param $e \Exception объект, представляющий выброшенное исключение
     */
    public function exceptionHandler($e)
    {
        $this->logErrors($e->getMessage(), $e->getFile(), $e->getLine());
        $this->displayError('Исключение', $e->getMessage(), $e->getFile(), $e->getLine(), $e->getCode());
    }

    // метод для логирования ошибок

    /**
     * Метод для записи ошибок в log-файл ошибок
     * @param $message string описание исключения
     * @param $file string файл, в котором возникло исключение
     * @param $line string строка, в которой возникло исключение
     */
    protected function logErrors($message = '', $file = '', $line = '')
    {
        error_log("[" . date('Y-m-d H:i:s') . "] Текст ошибки: {$message} | Файл: {$file} | Строка: {$line}\n--------------------\n", 3, ROOT . '/tmp/errors.log');
    }

    /**
     * метод показывающий ошибку на экране
     * @param $errno string номер исключения или ошибки
     * @param $errstr string описание исключения или ошибки
     * @param $errfile string файл, в котором возникло исключение
     * @param $errline string строка, в которой возникло исключение
     * @param $responce integer код ошибки отправляемый заголовку браузера, по умолчанию 404
     */
    protected function displayError($errno, $errstr, $errfile, $errline, $responce = 404)
    {
        http_response_code($responce); // сообщаем браузеру код ошибки
        // Подключаем соответствующий шаблон вывода ошибки
        if ($responce == 404 && !DEBUG) {
            // сюда попадают конечные пользователи работающие с прложением
            require WWW . '/errors/404.php';
            die;
        }
        if (DEBUG) {
            require WWW . '/errors/dev.php';
        } else {
            require WWW . '/errors/prod.php';
        }
        die;
    }

}