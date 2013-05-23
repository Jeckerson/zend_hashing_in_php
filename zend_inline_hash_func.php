<?php

// Modified from: https://github.com/php/php-src/blob/81623d3a60599d05c83987dec111bf56809f901d/Zend/zend_hash.h#L263

function zend_inline_hash_func($arKey, $nKeyLength)
{
    $hash = 5381;
    $i = 0;

    /* variant with the hash unrolled eight times */
    for (; $nKeyLength >= 8; $nKeyLength -= 8) {
        $hash = (($hash << 5) + $hash) + ord($arKey[$i++]);
        $hash = (($hash << 5) + $hash) + ord($arKey[$i++]);
        $hash = (($hash << 5) + $hash) + ord($arKey[$i++]);
        $hash = (($hash << 5) + $hash) + ord($arKey[$i++]);
        $hash = (($hash << 5) + $hash) + ord($arKey[$i++]);
        $hash = (($hash << 5) + $hash) + ord($arKey[$i++]);
        $hash = (($hash << 5) + $hash) + ord($arKey[$i++]);
        $hash = (($hash << 5) + $hash) + ord($arKey[$i++]);
    }
    switch ($nKeyLength) {
        case 7: $hash = (($hash << 5) + $hash) + ord($arKey[$i++]); /* fallthrough... */
        case 6: $hash = (($hash << 5) + $hash) + ord($arKey[$i++]); /* fallthrough... */
        case 5: $hash = (($hash << 5) + $hash) + ord($arKey[$i++]); /* fallthrough... */
        case 4: $hash = (($hash << 5) + $hash) + ord($arKey[$i++]); /* fallthrough... */
        case 3: $hash = (($hash << 5) + $hash) + ord($arKey[$i++]); /* fallthrough... */
        case 2: $hash = (($hash << 5) + $hash) + ord($arKey[$i++]); /* fallthrough... */
        case 1: $hash = (($hash << 5) + $hash) + ord($arKey[$i++]); break;
        case 0: break;
    }
    return $hash;
}

 // Compute "raw" hash.
 $word = "raw";
 $h = zend_inline_hash_func($word, strlen($word));
 printf("Word: %s\nHash: %d\n", $word, $h);

 // Compute "war" hash.
 $word2 = "war";
 $h2 = zend_inline_hash_func($word2, strlen($word2));
 printf("Word: %s\nHash: %d\n", $word2, $h2);

 // Compute the index.
 $nTableSize = 64;
 $nTableMask = $nTableSize - 1;
 $nIndex = $h & $nTableMask;
 $nIndex2 = $h2 & $nTableMask;
 printf("Index for 'raw': %d Index for 'war': %d", $nIndex, $nIndex2);

 ?>