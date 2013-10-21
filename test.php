<?php
require_once './Stardict/Compressor/CompressorInterface.php';
require_once './Stardict/History/ManagerHistoryInterface.php';
require_once './Stardict/Parser/IdxParserInterface.php';
require_once './Stardict/Parser/DictParserInterface.php';
require_once './Stardict/Parser/IfoParserInterface.php';
require_once './Stardict/Model/IfoInterface.php';
require_once './Stardict/Model/IdxInterface.php';
require_once './Stardict/Model/DictInterface.php';

require_once './Stardict/Compressor/GzfileCompressor.php';
require_once './Stardict/Parser/IdxParser.php';
require_once './Stardict/Parser/DictParser.php';
require_once './Stardict/Parser/IfoParser.php';

require_once './Stardict/Model/Ifo.php';
require_once './Stardict/Model/Dict.php';

require_once './Stardict/Model/Translation.php';
require_once './Stardict/Model/Idx.php';
require_once './Stardict/History/ManagerHistory.php';
require_once './Stardict/Dictionary.php';
require_once './Stardict/Translator.php';


use Stardict\History\ManagerHistory;
use Stardict\Compressor\GzfileCompressor;
use Stardict\Parser\DictParser;
use Stardict\Parser\IdxParser;
use Stardict\Parser\IfoParser;
use Stardict\Dictionary;
use Stardict\Translator;

$compressor   = new GzfileCompressor ();
$idxparser    = new IdxParser ();
$dictparser   = new DictParser ();
$ifoparser    = new IfoParser();

$translator   = new Translator(new ManagerHistory ());

$dictionary = new Dictionary($compressor, $idxparser, $dictparser, $ifoparser);
$dictionary->setResources(
    dirname(__FILE__).'/Stardict/dict/ActiveDeRu.idx.gz',
    dirname(__FILE__).'/Stardict/dict/ActiveDeRu.dict.dz',
    dirname(__FILE__).'/Stardict/dict/ActiveDeRu.ifo'
);
$translator->addDictionary($dictionary);

$dictionary = new Dictionary($compressor, $idxparser, $dictparser, $ifoparser);
$dictionary->setResources(
    dirname(__FILE__).'/Stardict/dict/ArtDeRu.idx.gz',
    dirname(__FILE__).'/Stardict/dict/ArtDeRu.dict.dz',
    dirname(__FILE__).'/Stardict/dict/ArtDeRu.ifo'
);
$translator->addDictionary($dictionary);

print_r($translator->find('Baum'));
