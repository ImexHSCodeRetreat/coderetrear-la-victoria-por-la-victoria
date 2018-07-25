<?php

namespace App\Service;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

use App\Service\GameService;
use App\Entity\Board;
class GameServiceTest extends WebTestCase
{
    public function testGameVictory()
    {   $b= new Board();
        $board=$b->setPositions(array('o','o','o', 'o','o','o','o','o','o'));
        $p = $this->serv->gameVictory($board);
        $this->assertEquals(count($p),0,'empate');
        
        $this->assertGreaterThan(count($p),0,'GANO');
    }
}