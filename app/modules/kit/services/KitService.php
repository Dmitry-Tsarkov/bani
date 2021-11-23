<?php

namespace app\modules\kit\services;

use app\modules\kit\forms\KitForm;
use app\modules\kit\models\Kit;
use app\modules\kit\repositories\KitRepository;

class KitService
{
    private $kits;

    public function __construct(KitRepository $kits)
    {
        $this->kits = $kits;
    }

    public function create(KitForm $form): Kit
    {
        $kit = Kit::create(
            $form->title,
            $form->hint,
            $form->price,
            $form->price_type,
            $form->text,
            $form->bottom_text
        );

        $this->kits->save($kit);

        return $kit;
    }

    public function edit(int $id, KitForm $form)
    {
        $kit = $this->kits->getById($id);

        $kit->edit(
            $form->title,
            $form->hint,
            $form->price,
            $form->price_type,
            $form->text,
            $form->bottom_text
        );

        $this->kits->save($kit);
    }

    public function delete(int $id): void
    {
        $kit = $this->kits->getById($id);
        $kit->delete();
    }
}