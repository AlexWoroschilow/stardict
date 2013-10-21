<?php 

namespace Stardict\Model;

interface IdxInterface 
{
    /**
     * Setter for current word
     * @param string $word
     * @return string
     */
    public function setWord($word);

    /**
     * Getter for word
     * @return string
     */
    public function getWord();
    
    /**
     * Setter for start position
     * @param int $start
     */
    public function setStart($start);

    /**
     * Getter for start position
     * @return number
     */
    public function getStart();

    /**
     * Setter for translation length
     * @param int $length
     * @return int
     */
    public function setLength ($length);

    /**
     * Getter for translation length
     * @return int
     */
    public function getLength ();

    /**
     * Convert object to string
     */
    public function __toString();
}