<?php

namespace app\traits\active;

trait ActiveQueryTrait
{
    /**
     * @param bool $state
     * @return static
     */
    public function active($state = true)
    {
        return $this->andWhere(['active' => $state]);
    }

    /**
     * @return static
     */
    public function activeDate()
    {
        return $this->andWhere(['OR',['<', 'active_from', time()], ['active_from' => NULL]])
            ->andWhere(['OR',['>', 'active_to', time()], ['active_to' => NULL]]);
    }

    /**
     * @param $condition
     * @param array $params
     * @return static
     */
    abstract function andWhere($condition, $params = []);
}