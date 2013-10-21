<?php

namespace Stardict;
use Stardict\Model\Translation;

use Stardict\History\ManagerHistory;

class Translator
{
    /**
     * Store array collection here
     * @var array
     */
    protected $collection = array ();
    
    /**
     * History manager object
     * @var ManagerHistory
     */
    protected $ManagerHistory;

    
    public function __construct($history_manager = null)
    {
        $this->ManagerHistory = $history_manager;
    }

    /**
     * Get manager history object
     * @return ManagerHistory
     */
    public function getManagerHistory()
    {
        return $this->ManagerHistory;
    }

    /**
     * Add new dictionary object into stack
     * @param Dictionary $dictionary
     */
    public function addDictionary($dictionary)
    {
        array_push($this->collection, $dictionary);
        return $this;
    }

    /**
     * Get current dictionary collection
     * @return array
     */
    public function getCollection ()
    {
        return $this->collection;
    }
    
    /**
     * List all elements from collection
     * @param unknown_type $callback
     * @return mixed
     */
    public function each($callback)
    {
        foreach ($this->collection as $dictionary) {
            call_user_func_array($callback, array ($dictionary));
        }
    }
    
    /**
     * Display words count
     * @param unknown_type $callback
     */
    public function count($callback)
    {
        foreach ($this->collection as $dictionary) {
            $dictionary->count(function ($ifo, $count) use ($callback) {
                return call_user_func_array($callback, array ($ifo, $count));
            });
        }
    }
    
    /**
     * Translate requested word using all registered dictionary
     * @param string $word
     * @return NULL|string
     */
    public function find($word = null)
    {
        $translation = new Translation();
        foreach ($this->collection as $dictionary) {
            $dictionary->find($word, function ($ifo, $idx, $dict) use (&$translation) {
                $translation->addIfo($ifo);
                $translation->addIdx($idx);
                $translation->addDict($dict);
            });
        }
        return $translation;
    }
}
