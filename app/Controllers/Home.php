<?php

require_once 'app/Models/Article.php';
require_once 'app/View.php';

class Home
{
    function index()
    {
        $article_model = new Article();
        $articles = $article_model->list();

        $view_aside = new View([], ['form' => 'articles/form'], 'aside', false);

        new View(['articles' => $articles], ['content' => 'articles/list', 'aside' => $view_aside]);
        // affichier blocks/link_session_variables.php et  blocks/link_get_parameters.php dans l'aside
        
        
    }   

    function add()
    {
        if (isset($_POST['ajout_article'])) {
            $article_model = new Article();
            $article_model->add($_POST);
        }

        $articles = $article_model->list();
        require "resources/views/template.php";
    }
}
