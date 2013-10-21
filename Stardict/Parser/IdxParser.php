<?php

namespace Stardict\Parser;

use Stardict\Model\IdxInterface;

use Stardict\Model\Idx;
use Stardict\Parser\IdxParserInterface;

class IdxParser implements IdxParserInterface
{
    /**
     * Normalize string
     * @param unknown_type $str
     */
    protected function doNormalizeString($str)
    {
        return mb_strtolower(trim($str));
    }
    
    /**
     * Try to indexate dictionary
     * @param string $block
     * @param closure $callback
     */
    public function each($block = null, $callback = null)
    {
        $search = null;
    
        return $this->parse($block, $search, $callback);
    }
    
    /**
     * Find needed word in current block
     * @param string $block
     * @param string $word
     */
    public function find($block = null, $search= null)
    {
        return $this->parse($block, $search, function (IdxInterface $entity = null) use ($search) {
            if($entity instanceof IdxInterface) {
                $word = $this->doNormalizeString($entity->getWord()); 
                $search = $this->doNormalizeString($search);
                if($word == $search) {
                    return $entity;
                }
            }
            return null;
        });
    }
    
    /**
     * Get all words from current block
     * @param string $block
     */
    public function collection($block = null)
    {
        $search = null;
        $collection = array ();
        
        return $this->parse($block, $search, function (IdxInterface $entity = null) use (&$collection) {
            if($entity instanceof IdxInterface) {
                array_push($collection, $entity);
                return null;
            }
            return $collection;
        });
    }
        
    /**
     * Get all words from current block
     * @param string $block
     */
    public function count($block = null)
    {
        $count = 0;
        $search = null;
        
        return $this->parse($block, $search, function (IdxInterface $entity = null) use (&$count) {
            if($entity instanceof IdxInterface) {
                $count++;
                return null;
            }
            return $count;
        });
    }
    
    /**
     * Parse current block and find word options
     * @param string $block
     * @param string $search
     * @return Idx model
     */
    protected function parse($block = null, $search = null, $callback = null)
    {
        $index = 0;
        $next_zero = 0;

        while ($next_zero !== false) {

            $next_zero = @mb_strpos($block, "\0", $index);

            $word = mb_substr($block, $index, $next_zero - $index);
            $start = @unpack("I", strrev(mb_substr($block, $next_zero + 1, 4)));
            $length = @unpack("I", strrev(mb_substr($block, $next_zero + 5, 4)));

            $model = new Idx();
            $model->setWord(sprintf("%s", $word));
            $model->setStart(sprintf("%u", array_shift($start)));
            $model->setLength(sprintf("%u", array_shift($length)));
            
            $result = call_user_func_array($callback, array($model));
            
            if(!is_null($result)) {
                return $result;
            }

            # Calculate start of next word
            $index = $next_zero + 8 + 1;
        }
        
        return null;
    }
}
