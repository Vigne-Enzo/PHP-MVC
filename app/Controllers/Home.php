<?php

require_once 'app/Models/Article.php';
require_once 'app/View.php';

class Home
{
    function index()
    {
        $article_model = new Article();
        $articles = $article_model->list();

        $view_aside = new View([], [
            'form' => 'articles/form',
            'blocks' => [
                'blocks/link_session_variables',
                'blocks/link_get_parameters'
            ]
        ], 'aside', false);

        new View(['articles' => $articles], ['content' => 'articles/list', 'aside' => $view_aside]);


    }

    function add()
    {
        if (isset($_POST['ajout_article'])) {
            $article_model = new Article();
            $article_model->add($_POST);
        }
        $this->index();
    }

    function delete($id)
    {
        $article_model = new Article();
        $article_model->delete($id);
        $this->index();
    }

    function edit($id)
    {

        if (isset($_POST['edition_article'])) {
            $article_model = new Article();
            $article_model->update($_POST);
            return $this->index();
        }

        $article_model = new Article();
        $article_model = $article_model->get($id);

        $view_aside = new View([], ['form' => 'articles/form', 'get' => 'blocks/link_get_parameters', 'session' => 'blocks/link_session_variables'], 'aside', false);

        new View(['article' => $article_model], ['content' => 'articles/edit', 'aside' => $view_aside]);
    }
}
