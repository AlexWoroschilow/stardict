<?php
namespace Stardict\Model;

class Translation
{
    /**
     * Current translated word
     * @var string
     */
    protected $idx = array ();

    /**
     * Translation for current word
     * @var string
     */
    protected $dict = array ();
    
    /**
     * Dictionary model for current word
     * @var string
     */
    protected $ifo = array ();

    /**
     * Add idx
     *
     * @param IfoInterface $ifo
     * @return StardictIfo
     */
    public function addIfo(IfoInterface $ifo)
    {
        $this->ifo[] = $ifo;
    
        return $this;
    }
    
    /**
     * Get idx
     *
     * @return Array
     */
    public function getIfo($id = null)
    {
        if(!is_null($id)) {
            if(array_key_exists($id, $this->ifo)) {
                return $this->ifo[$id];
            }
            return null;
        }
        return $this->ifo;
    }
    
    /**
     * Add idx
     *
     * @param IdxInterface $idx
     * @return StardictIfo
     */
    public function addIdx(IdxInterface $idx)
    {
        $this->idx[] = $idx;
    
        return $this;
    }
    
    /**
     * Get idx
     *
     * @return Array
     */
    public function getIdx($id = null)
    {
        if(!is_null($id)) {
            if(array_key_exists($id, $this->idx)) {
                return $this->idx[$id];
            }
            return null;
        }
        
        return $this->idx;
    }
    
    /**
     * Add dict
     *
     * @param DictInterface $dict
     * @return StardictIfo
     */
    public function addDict(DictInterface $dict)
    {
        $this->dict[] = $dict;
    
        return $this;
    }
    
    /**
     * Get dict
     *
     * @return Array
     */
    public function getDict($id = null)
    {
        if(!is_null($id)) {
            if(array_key_exists($id, $this->dict)) {
                return $this->dict[$id];
            }
            return null;
        }
        
        return $this->dict;
    }
}
