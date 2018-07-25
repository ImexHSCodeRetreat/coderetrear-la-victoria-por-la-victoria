<?php

namespace App\Service;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

use App\Service\GameService;
use App\Entity\Board;

class GameServiceTest extends WebTestCase
{

	private $serv;
    private $secret = 'def000004ba8fee5d13ac2b2d8f13d3762bd732df2513df86da00f96da48c36623de3fe1bd45d0e63b82066fe31ccd1f090883d60312c989cd4893797b143c4a33495263';

	public function setUp(){

        $client = static::createClient();
        $container = $client->getContainer();
        $doctrine = $container->get('doctrine');
        $entityManager = $doctrine->getManager();
        $this->serv = new GameService($entityManager, $this->secret);
    }


 
    public function testGameVictory()
    {  

       $b= new Board;
       $board = $b->setPositions(array(
           'o','x','o',
           'x','o','x',
           'o','o','x'));
       $p = $this->serv->gameVictory($board);
       $this->assertEquals($p,[2,4,6],'Ganador');
      
    }

    public function testGameVictory2()
    {  

       $b= new Board;
       $board = $b->setPositions(array(
           'o','x','o',
           'x','o','x',
           'x','o','x'));
       $p = $this->serv->gameVictory($board);
       $this->assertEquals($p,[],'Ganador');
      
    }
    
    public function testGameVictory3()
    {  

       $b= new Board;
       $array1=array(
        '','o','x',
        'o','x','o',
        'o','x','x');
        $array2=array(
         'o','x','o',
         'x','o','x',
         'o','o','x');
       $board = $b->setPositions(rand($array2,$array1));
       $p = $this->serv->gameVictory($board);
       $this->assertEquals($p,[],'Ganador');
       $this->assertEquals($p,[2,4,6],'Ganador');
      
    }

    
    public function testGameVictory4()
    {  

       $b= new Board;
       $array1=array(
        null,'o','x',
        'o',null,'o',
        'o','x',null);
        
       $board = $b->setPositions($array1);
       $p = $this->serv->gameVictory($board);
       $this->assertEquals($p,[0,4,9],'Ganador');
      
    }
}
