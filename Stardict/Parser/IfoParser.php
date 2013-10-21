<?php
namespace Stardict\Parser;

use Stardict\Model\Ifo;

use Stardict\Parser\IfoParserInterface;

class IfoParser implements IfoParserInterface
{
    /**
     * Get info from current ifo file 
     * @param string $stream
     * @param string $callback
     * @return mixed
     */
    public function info ($stream, $callback)
    {
        $count = $this->doParse($stream, "wordcount=", "\n");
        $name = $this->doParse($stream, "bookname=", "\n");
        $description = $this->doParse($stream, "description=", "\n");
        
        return call_user_func_array($callback, array ($name, $description, $count));
    }

    /**
     * (non-PHPdoc)
     * @see Stardict\Parser.IfoParserInterface::parse()
     */
    public function parse ($stream, $callback)
    {
        $entity = new Ifo();
        $entity->setCount($this->doParse($stream, "wordcount=", "\n"));
        $entity->setDescription($this->doParse($stream, "description=", "\n"));
        $entity->setName($this->doParse($stream, "bookname=", "\n"));
    
        return call_user_func_array($callback, array ($entity));
    }
    
    /**
     * Parse current file and return values
     * @param string $stream
     * @param string $start
     * @param string $end
     */
    protected function doParse($stream, $start, $end)
    {
        if (($string = substr($stream, (mb_strpos($stream, $start) + mb_strlen($start))))) {
            if (($string = substr($string, 0, (mb_strpos($string, $end))))) {
                return $string;
            }
        }
    
        return null;
    }    
}
