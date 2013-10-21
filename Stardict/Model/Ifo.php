<?php 
namespace Stardict\Model;

class Ifo implements IfoInterface
{
    /**
     * @var string
     */
    private $version;
    
    /**
     * @var integer
     */
    private $count;
    
    /**
     * @var string
     */
    private $name;
    
    /**
     * @var string
     */
    private $description;
    
    
    /**
     * Set version
     *
     * @param string $version
     * @return StardictIfo
     */
    public function setVersion($version)
    {
        $this->version = $version;
    
        return $this;
    }
    
    /**
     * Get version
     *
     * @return string
     */
    public function getVersion()
    {
        return $this->version;
    }
    
    /**
     * Set count
     *
     * @param integer $count
     * @return StardictIfo
     */
    public function setCount($count)
    {
        $this->count = $count;
    
        return $this;
    }
    
    /**
     * Get count
     *
     * @return integer
     */
    public function getCount()
    {
        return $this->count;
    }
    
    /**
     * Set name
     *
     * @param string $name
     * @return StardictIfo
     */
    public function setName($name)
    {
        $this->name = $name;
    
        return $this;
    }
    
    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }
    
    /**
     * Set description
     *
     * @param string $description
     * @return StardictIfo
     */
    public function setDescription($description)
    {
        $this->description = $description;
    
        return $this;
    }
    
    /**
     * Get description
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }
    
    /**
     * @var string
     */
    private $fileIfo;
    
    /**
     * @var string
     */
    private $fileIdx;
    
    /**
     * @var string
     */
    private $fileDict;
    
    
    /**
     * Set fileIfo
     *
     * @param string $fileIfo
     * @return StardictIfo
     */
    public function setFileIfo($fileIfo)
    {
        $this->fileIfo = $fileIfo;
    
        return $this;
    }
    
    /**
     * Get fileIfo
     *
     * @return string
     */
    public function getFileIfo()
    {
        return $this->fileIfo;
    }
    
    /**
     * Set fileIdx
     *
     * @param string $fileIdx
     * @return StardictIfo
     */
    public function setFileIdx($fileIdx)
    {
        $this->fileIdx = $fileIdx;
    
        return $this;
    }
    
    /**
     * Get fileIdx
     *
     * @return string
     */
    public function getFileIdx()
    {
        return $this->fileIdx;
    }
    
    /**
     * Set fileDict
     *
     * @param string $fileDict
     * @return StardictIfo
     */
    public function setFileDict($fileDict)
    {
        $this->fileDict = $fileDict;
    
        return $this;
    }
    
    /**
     * Get fileDict
     *
     * @return string
     */
    public function getFileDict()
    {
        return $this->fileDict;
    }
    
    /**
     * @var string
     */
    private $hash;
    
    
    /**
     * Set hash
     *
     * @param string $hash
     * @return StardictIfo
     */
    public function setHash($hash)
    {
        $this->hash = $hash;
    
        return $this;
    }
    
    /**
     * Get hash
     *
     * @return string
     */
    public function getHash()
    {
        return $this->hash;
    }
    
    /**
     * Convert object to string
     * @return string
     */
    public function __toString()
    {
        return $this->getName();
    }
}