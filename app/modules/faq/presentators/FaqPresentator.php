<?php

namespace app\modules\faq\presentators;

use app\modules\faq\models\Faq;
use app\modules\faq\readModels\FaqReadRepository;

class FaqPresentator
{
    private $faqs;

    public function __construct(FaqReadRepository $faqs)
    {
        $this->faqs = $faqs;
    }

    public function getPreviewFaqs()
    {
        return array_map(function (Faq $faq) {
            return [
                'question' => $faq->question,
                'answer' => $faq->answer
            ];
        }, $this->faqs->getActive());
    }
}