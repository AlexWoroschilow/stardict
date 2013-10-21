<?php
namespace Stardict\History;

use Stardict\Model\Translation;

interface ManagerHistoryInterface
{
    /**
     * Add translation model to history stack
     * @param Translation $model
     */
    public function addHistory(Translation $model = null);

    /**
     * Get current history stack by word
     * @param string $word
     */
    public function getHistory($word = null);
}
