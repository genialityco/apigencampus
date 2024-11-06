<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use PDF;
// models
use App\BingoCard;
use App\Attendee;

/**
 * @group BingoCard
 */

class BingoCardController extends Controller
{

    /**
     * _show_: Get a event user with bingo card
     * @urlParam bingocard required The id of the bingo card to retrive this and the owner's data.
    */
    public function show(string $code)
    {
        $bingo_card = BingoCard::where('code', $code)->first();
        $eventUser = Attendee::findOrFail($bingo_card->event_user_id);
        return ["bingo_card" => $bingo_card, "name_owner"=> $eventUser["properties"]["names"]];
    }

    /**
     * _destroy_: Delete a attendee's bingo card
     * @urlParam bingocard required The id of the bingo card to find this.
     *
     * @return 204 No Content
    */
    public function destroy(string $bingo_card)
    {
        $bingo_card = BingoCard::findOrFail($bingo_card);
        $bingo_card->delete();
        return response()->json([], 204);
    }

    //public function downloadBingoCard(BingoCard $bingocard)
    //{
        //$pdf = PDF::loadview('BingoCard', compact('bingocard'));

        //return $pdf->download('carton-bingo.pdf');
    //}
}
