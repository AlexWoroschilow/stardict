<?php 

namespace Stardict\Model;

interface DictInterface
{
    /**
     * Setter for text
     * @param string $text
     * @return string
     */
    public function setText($text);

    /**
     * Getter for text
     * @return string
     */
    public function getText();

    /**
     * Convert object to string
     */
    public function __toString();
}