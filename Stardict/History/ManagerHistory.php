<?php
namespace Stardict\History;

use Stardict\Model\Translation;

use Stardict\History\ManagerHistoryInterface;

class ManagerHistory implements ManagerHistoryInterface
{
    /**
     * Current history stack value
     * @var array
     */
    protected $HistoryStack = array();
    
    /**
     * Add translation model to history stack
     * @param Translation $model
     */
    public function addHistory(Translation $model = null)
    {
        $this->HistoryStack[md5($model->getWord())][] = $model;
        return $this;
    }

    /**
     * Get current history stack by word
     * @param string $word
     */    
    public function getHistory($word = null)
    {
        if($hash = md5($word)) {
            if (isset($this->HistoryStack[$hash])) {
                return $this->HistoryStack[$hash];
            }
        }
        
        return $this->HistoryStack;
    }
}
