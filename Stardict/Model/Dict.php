<?php 

namespace Stardict\Model;

class Dict implements DictInterface
{
    /**
     *  Text with translation
     * @var string
     */
    protected $text;
    
    /**
     * Setter for text
     * @param string $text
     * @return string
     */
    public function setText($text = null)
    {
        $this->text = $text;
        return $this;
    }

    /**
     * Getter for text
     * @return string
     */
    public function getText()
    {
        return $this->text;
    }

    /**
     * Convert object to string
     */
    public function __toString()
    {
        return $this->getText();
    }
}