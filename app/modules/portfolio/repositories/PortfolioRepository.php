<?php

namespace app\modules\portfolio\repositories;

use app\modules\portfolio\models\Portfolio;
use DomainException;
use RuntimeException;

class PortfolioRepository
{
    public function save(Portfolio $portfolio)
    {
        if(!$portfolio->save()) {
            throw new RuntimeException('Portfolio saving error');
        }
    }

    public function getById($id): Portfolio
    {
        if (!$portfolio = Portfolio::findOne($id)) {
            throw new DomainException('Portfolio not found');
        }

        return $portfolio;
    }

    public function delete(Portfolio $portfolio): void
    {
        if (!$portfolio->delete()) {
            throw new DomainException('Portfolio deleting error');
        }
    }
}
