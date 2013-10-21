<?php 

namespace Stardict\Model;

class Idx implements IdxInterface 
{
    /**
     * Word variable
     * @var string
     */
    protected $word;
    
    /**
     * Start position in dict file
     * @var int
     */
    protected $start;
    
    /**
     * Translation length
     * @var int
     */
    protected $length;
    
    /**
     * Setter for current word
     * @param string $word
     * @return string
     */
    public function setWord($word = null)
    {
        return $this->word = $word;
    }

    /**
     * Getter for word
     * @return string
     */
    public function getWord()
    {
        return $this->word;
    }
    
    /**
     * Setter for start position
     * @param int $start
     */
    public function setStart($start = null)
    {
        return $this->start = $start;
    }

    /**
     * Getter for start position
     * @return number
     */
    public function getStart()
    {
        return $this->start;
    }

    /**
     * Setter for translation length
     * @param int $length
     * @return int
     */
    public function setLength ($length = null)
    {
        return $this->length = $length;
    }

    /**
     * Getter for translation length
     * @return int
     */
    public function getLength ()
    {
        return $this->length;
    }

    /**
     * Convert object to string
     */
    public function __toString()
    {
        return $this->getWord();
    }
}