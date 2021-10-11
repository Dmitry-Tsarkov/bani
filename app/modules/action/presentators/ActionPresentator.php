<?php


namespace app\modules\action\presentators;


use app\modules\action\models\Action;
use app\modules\action\readModels\ActionReader;
use app\modules\action\transformers\ActionTransformer;
use app\modules\page\components\Pages;
use app\modules\page\models\Page;

class ActionPresentator
{

    private $actions;
    private $actionTransformer;

    public function __construct(ActionReader $actions, ActionTransformer $actionTransformer)
    {
        $this->actions = $actions;
        $this->actionTransformer = $actionTransformer;
    }

    public function getActions()
    {
        $dataProvider = $this->actions->getActions();
        $page = Page::getOrCreate('actions');

        return [
            'meta' => $page->getMetaTags(),
            'actions' => array_map(function (Action $action) {
                return $this->actionTransformer->card($action);
            }, $dataProvider->getModels()),
            'pagination' => $dataProvider->getPagination(),
        ];
    }

    public function getAction($alias)
    {
        $action = $this->actions->getAction($alias);

        return [
            'action' => $this->actionTransformer->view($action),
            'meta' => $action->getMetaTags()
        ];
    }
}