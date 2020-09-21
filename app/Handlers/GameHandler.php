<?php
/**
 * Created by PhpStorm.
 * User: Mohamed.Gaber
 * Date: 21/09/2020
 * Time: 01:03 م
 */

namespace App\Handlers;


use App\Models\Game;

class GameHandler
{
//    private $fa = [
//        [0,0] , [0,1] , [0,2],
//        [1,0] , [1,1] , [1,2],
//        [2,0] , [2,1] , [2,2],
//    ];
    private $board;
    private $win_pos=[];
    private $current_symbol;

    private function __construct($game)
    {
        $game->loadMissing('moves');
        $this->current_symbol = 'x';
        $this->initEmptyBoard();
        $this->generateBoard($game->moves);
    }

    private function initEmptyBoard()
    {
        for($i = 0 ; $i < 3 ; $i++){
            for($j = 0 ; $j < 3 ; $j++){

                $this->board[$i][$j] = null;
            }
        }

    }

    /**
     * @param $game
     * @return \App\Handlers\GameHandler
     */
    public static function handle($game)
    {
        $handler = new self($game);
        return $handler;
    }

    private function generateBoard($moves)
    {
        foreach ($moves as $move){
            $this->board [$move->pos_x] [$move->pos_y] = $move->symbol;
            $this->changeSymbol();
        }
        return $this;
    }

    public function checkForWin()
    {
        return $this->checkColumns() || $this->checkRows() || $this->checkCross();
    }

    public function checkForDraw()
    {
        $drawn = true;
        for($i = 0 ; $i < 3 ; $i++)
        {
            for($j = 0 ; $j < 3 ; $j++)
            {
                if( is_null( $this->board[$i][$j] ) )
                {
                    $drawn = false;
                }
            }
        }
        return $drawn;
    }

    private function checkRows()
    {
        for($i = 0 ; $i < 3 ; $i++)
        {
            if($this->board[$i][0] == $this->board[$i][1] && $this->board[$i][1] == $this->board[$i][2] && !is_null( $this->board[$i][2] ) )
            {
                $this->win_pos[] = [$i,0];
                $this->win_pos[] = [$i,1];
                $this->win_pos[] = [$i,2];
                return true;
            }
        }
        return false;
    }

    private function checkColumns()
    {
        for($i = 0 ; $i < 3 ; $i++)
        {
            if($this->board[0][$i] == $this->board[1][$i] && $this->board[1][$i] == $this->board[2][$i] && !is_null( $this->board[2][$i] )  )
            {
                $this->win_pos[] = [0,$i];
                $this->win_pos[] = [1,$i];
                $this->win_pos[] = [2,$i];
                return true;
            }
        }
        return false;
    }

    private function checkCross()
    {
        if($this->board[0][0] == $this->board[1][1] && $this->board[1][1] == $this->board[2][2] && !is_null( $this->board[2][2]  ))
        {
            $this->win_pos[] = [0,0];
            $this->win_pos[] = [1,1];
            $this->win_pos[] = [2,2];
            return true;
        }
        return false;
    }

    private function checkMoveAvailable($pos_x,$pos_y,$symbol)
    {
//        dd(is_null($this->board[$pos_x][$pos_y]));
        return is_null($this->board[$pos_x][$pos_y]) && $symbol == $this->current_symbol;
    }

    private function changeSymbol()
    {
        $this->current_symbol = $this->current_symbol == 'x' ? 'o' : 'x';
    }

    public function playMove($pos_x,$pos_y,$symbol)
    {
        $played = false;
        if($this->checkMoveAvailable($pos_x,$pos_y,$symbol)){
            $this->board[$pos_x][$pos_y] = $symbol;
            $played = true;
        }
        return $played;
    }
}
