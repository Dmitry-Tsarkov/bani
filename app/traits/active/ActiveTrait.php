<?php

namespace app\traits\active;

/**
 * @property int $active
 */
trait ActiveTrait
{
    public function isActive()
    {
        return $this->active == 1;
    }

    public function isDraft()
    {
        return !$this->isActive();
    }

    public function activate()
    {
        $this->active = true;
    }

    public function draft()
    {
        $this->active = false;
    }

    public static function activeList()
    {
        return [
            1 => 'Да',
            0 => 'Нет',
        ];
    }

    public function getActiveIcon()
    {
        if ($this->isActive()) {
            return '<i class="glyphicon glyphicon-ok text-success"></i>';
        }

        return '<i class="glyphicon glyphicon-remove text-danger"></i>';
    }

    public function isEnabled()
    {
        if (!$this->isActive()) {
            return false;
        }

        $isActiveFrom = empty($this->active_from) || $this->active_from <= time();
        $isActiveTo = empty($this->active_to) || $this->active_to > time();

        return $isActiveFrom && $isActiveTo;
    }

    public function getActiveFromText()
    {
        $date = !empty($this->active_from)? date('d.m.Y H:i', $this->active_from) : '-';

        if (!empty($this->active_from) && $this->active_from > time()) {
            return '<span class="text-danger">' . $date . '</span>';
        } else {
            return '<span>' . $date . '</span>';
        }
    }

    public function getActiveToText()
    {
        $date = !empty($this->active_to)? date('d.m.Y H:i', $this->active_to) : '-';

        if (!empty($this->active_to) && $this->active_to < time()) {
            return '<span class="text-danger">' . $date . '</span>';
        } else {
            return '<span>' . $date . '</span>';
        }
    }
}