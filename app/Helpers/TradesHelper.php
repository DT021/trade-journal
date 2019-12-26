<?php

namespace App\Helpers;

class TradesHelper
{
    /**
     * Groups trade executions for displaying to the user.
     * 
     * @param \Illuminate\Support\Collection
     * @return array
     */
    //TODO: Handle open trades
    // TODO: Refactor function name
    public static function groupTrades($executions)
    {
        $groups = array();

        // Loop through all executions while keeping track of quantity per symbol in order to create groupings
        $executionsBySymbol = array();
        $quantitiesBySymbol = array();
        foreach ($executions as $exec) {
            $symbol = $exec->symbol;
            $quantity = $exec->quantity;

            // If action was a sell, make quantity negative
            if (strpos($exec->action, 'SELL') !== false) {
                $quantity *= -1;
            }


            if (array_key_exists($symbol, $quantitiesBySymbol) && array_key_exists($symbol, $executionsBySymbol)) {
                $quantitiesBySymbol[$symbol] += $quantity;
                array_push($executionsBySymbol[$symbol], $exec);

                // If quantity is 0, then trade is closed.
                if ($quantitiesBySymbol[$symbol] == 0) {

                    // Add to result
                    array_push($groups,  $executionsBySymbol[$symbol]);

                    // Remove symbol from arrays
                    unset($quantitiesBySymbol[$symbol]);
                    unset($executionsBySymbol[$symbol]);
                }
            } else {
                $quantitiesBySymbol[$symbol] = $quantity;
                $executionsBySymbol[$symbol] = array($exec);
            }
        }

        return $groups;
    }

    /**
     * Returns an associative array of all column values need for displaying a trade.
     * 
     * @param array
     * @return array
     */
    public static function getTradeValues($trade)
    {
        // Get all executions associated with a trade
        $executions = $trade->executions()->orderBy('executed_at')->get();

        $total_entry_value = 0;
        $total_exit_value = 0;
        $total_quantity = 0;
        foreach ($executions as $execution) {
            // If action contains 'OPEN', it is an entry
            if (strpos($execution->action, 'OPEN') !== false) {
                $total_entry_value -= $execution->value;
                $total_quantity += $execution->quantity;
            }

            // If action contains 'CLOSE;, it is an EXIT
            if (strpos($execution->action, 'CLOSE') !== false) {
                $total_exit_value += $execution->value;
                $total_quantity += $execution->quantity;
            }
        }

        $volume = $total_quantity/2;
        $avg_entry_price = $total_entry_value / $volume;
        $avg_exit_price = $total_exit_value / $volume;
        $profit_loss = ($avg_exit_price - $avg_entry_price) * $volume;

        return [
            'symbol' => $executions->first()->symbol,
            'entered_at' => $executions->first()->executed_at,
            'exited_at' => $executions->last()->executed_at,
            'volume' => $volume, 
            'avg_entry_price' => $avg_entry_price,
            'avg_exit_price' => $avg_exit_price,
            'profit_loss' => $profit_loss
        ];
    }
}
