<?php

namespace app\controllers;

/**
 * Главный контроллер приложения
 */
class MainController extends AppController
{

    public function indexAction()
    {
        $this->setMeta('Главная страница', 'Описание страницы', 'Ключевые слова');
    }

}