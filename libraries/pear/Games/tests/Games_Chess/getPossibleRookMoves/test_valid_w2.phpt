--TEST--
Games_Chess->getPossibleRookMoves() valid white #2
--SKIPIF--
--FILE--
<?php
require_once dirname(__FILE__) . '/setup.php.inc';
$board->resetGame();
$err = $board->getPossibleRookMoves('b2', 'W');
$phpunit->assertEquals(array('b3', 'b4', 'b5', 'b6', 'b7'), $err, 1);
echo 'tests done';
?>
--EXPECT--
tests done