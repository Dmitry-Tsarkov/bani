<?php

namespace app\modules\portfolio\services;

use app\modules\portfolio\forms\PortfolioForm;
use app\modules\portfolio\models\Portfolio;
use app\modules\portfolio\repositories\PortfolioRepository;
use app\modules\seo\valueObjects\Seo;
use DomainException;

class PortfolioService
{
    private $portfolios;

    public function __construct(PortfolioRepository $portfolios)
    {
        $this->portfolios = $portfolios;
    }

    public function create(PortfolioForm $form): Portfolio
    {
        $portfolio = Portfolio::create(
            $form->title,
            $form->alias,
            $form->description,
            $form->image,
            new Seo(
                $form->seo->title,
                $form->seo->description,
                $form->seo->keywords,
                $form->seo->h1
            )
        );

        $this->portfolios->save($portfolio);
        return $portfolio;
    }

    public function update($id, PortfolioForm $form): void
    {
        $portfolio = $this->portfolios->getById($id);

        $portfolio->edit(
            $form->title,
            $form->alias,
            $form->description,
            $form->image,
            new Seo(
                $form->seo->title,
                $form->seo->description,
                $form->seo->keywords,
                $form->seo->h1
            )
        );

        $this->portfolios->save($portfolio);
    }

    public function delete($id)
    {
        $portfolio = $this->portfolios->getById($id);

        if ($portfolio->status == Portfolio::STATUS_ACTIVE) {
            throw new DomainException('Нельзя удалить активное портфолио');
        }

        $this->portfolios->delete($portfolio);
    }

    public function activate($id)
    {
        $portfolio = $this->portfolios->getById($id);
        $portfolio->activate();
        $this->portfolios->save($portfolio);
    }

    public function draft($id)
    {
        $portfolio = $this->portfolios->getById($id);
        $portfolio->draft();
        $this->portfolios->save($portfolio);
    }

    public function deleteImage($id, $photoId)
    {
        $portfolio = $this->portfolios->getById($id);
        $portfolio->deleteImage($photoId);
        $this->portfolios->save($portfolio);
    }
}
