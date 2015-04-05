--TEST--
Games_Chess->getPathToKing() rook check 4
--SKIPIF--
--FILE--
<?php
require_once dirname(__FILE__) . '/setup.php.inc';
$board->addPiece('B', 'R', 'h4');
$board->addPiece('W', 'K', 'e4');
$err = $board->_getPathToKing('h4', 'e4');
$phpunit->assertEquals(array('f4', 'g4', 'h4'), $err, 'wrong squares');
echo 'tests done';
?>
--EXPECT--
tests done