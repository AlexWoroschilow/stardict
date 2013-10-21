<?php

namespace Stardict;

use Stardict\Model\IfoInterface;

use Stardict\Model\DictInterface;

use Stardict\Model\IdxInterface;

use Stardict\Model\Ifo;
use Stardict\Model\Idx;
use Stardict\Model\Translation;

class Dictionary
{
    /**
     * Store unique dictionary name here
     * @var string
     */
    protected $hash;
    
    protected $Model;
    
    protected $Compressor;
    protected $ParserIdx;
    protected $ParserDict;
    protected $ParserIfo;

    public function __construct($compressor = null, $parser_idx = null, $parser_dict = null, $parser_ifo = null)
    {
        $this->Compressor = $compressor;
        $this->ParserIdx = $parser_idx;
        $this->ParserDict = $parser_dict;
        $this->ParserIfo = $parser_ifo;
        
        $this->setModel(new Ifo());
    }
    
    /**
     * Dictionary name
     * @param string $name
     */
    public function setHash ($hash)
    {
        $this->hash = $hash;
        $this->getModel()->setHash($this->hash);
        return $this;
    }

    /**
     * Get current dictionary hash
     * @return string
     */
    public function getHash()
    {
        return $this->hash;
    }
    
    /**
     * Set current dictionary model
     * @param DictionaryModel $model
     */
    protected function setModel ($model)
    {
        $this->Model = $model;
    }

    /**
     * Get dictionary model
     * @return DictionaryModel
     */
    protected function getModel ()
    {
        return $this->Model;
    }
    
    /**
     * Get current compressor interface
     * @return CompressorInterface
     */
    protected function getCompressor()
    {
        return $this->Compressor;
    }
    
    /**
     * Get current parser for ifo files
     * @return ParserIfo
     */
    protected function getParserIfo()
    {
        return $this->ParserIfo;
    }
    
    /**
     * Get parser for idx files
     * @return IdxParser
     */
    protected function getParserIdx()
    {
        return $this->ParserIdx;
    }
    
    /**
     * Get parser for dict files
     * @return DictParser
     */
    protected function getParserDict()
    {
        return $this->ParserDict;
    }

    /**
     * Set current dictionary resources
     * @param string $idx
     * @param string $dict
     * @param string $ifo
     */
    public function setResources($idxFile = null, $dictFile = null, $ifoFile = null)
    {
        if(($stream = $this->getCompressor()->uncompress($ifoFile))) {
            
            $this->getParserIfo()->parse($stream, function ($ifo) use ($ifoFile, $idxFile, $dictFile) {
                
                $ifo->setFileIfo($ifoFile);
                $ifo->setFileIdx($idxFile);
                $ifo->setFileDict($dictFile);
                $ifo->setHash($this->getHash());
                
                $this->setModel($ifo);
            });
            
        }
    }
    
    /**
     * Get word count for current dictionary
     * @param unknown_type $callback
     */
    public function count ($callback)
    {
        if(($entity = $this->getModel()) && $entity instanceof IfoInterface) {
            return call_user_func_array($callback, array ($entity, $entity->getCount()));
        }
        return null;
    }
    
    /**
     * Process each element in dictionary
     * @param Closure $callback
     */
    public function each ($callback)
    {
        if(($ifo = $this->getModel ())) {
            if(($stream = $this->getCompressor()->uncompress($ifo->getFileIdx()))) {
                $this->getParserIdx()->each($stream, function (IdxInterface $idx) use ($ifo, $callback) {
                    return call_user_func_array($callback, array ($ifo, $idx));
                });
            }
        }
    }
    
    /**
     * Translate requested word using all registered dictionary
     * @param string $word
     * @return NULL|string
     */
    public function find($string = null, $callback)
    {
        if(($ifo = $this->getModel ())) {
            if(($streamIdx = $this->getCompressor()->uncompress($ifo->getFileIdx()))) {
                if(($idx = $this->getParserIdx()->find($streamIdx, $string))) {
                    if(($streamDict = $this->getCompressor()->uncompress($ifo->getFileDict()))) {
                        if(($dict = $this->getParserDict()->find($streamDict, $idx))) {
                            return call_user_func_array($callback, array ($ifo, $idx,  $dict));
                        }
                    }
                }
            }
        }
        
        return null;
    }    
}
