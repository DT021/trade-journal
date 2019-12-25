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
     * Calculates average entry price, average exit price, and volume for a group of trades
     * 
     * @param array
     * @return array
     */
    public static function getCalculatedVals($group)
    {
        $total_entry_value = 0;
        $total_exit_value = 0;
        $total_quantity = 0;
        foreach ($group as $item) {
            // If action contains 'OPEN', it is an entry
            if (strpos($item->action, 'OPEN') !== false) {
                $total_entry_value -= $item->value;
                $total_quantity += $item->quantity;
            }

            // If action contains 'CLOSE;, it is an EXIT
            if (strpos($item->action, 'CLOSE') !== false) {
                $total_exit_value += $item->value;
                $total_quantity += $item->quantity;
            }
        }

        $volume = $total_quantity/2;
        $avg_entry_price = $total_entry_value / $volume;
        $avg_exit_price = $total_exit_value / $volume;
        $profit_loss = ($avg_exit_price - $avg_entry_price) * $volume;

        return [
            'volume' => $volume, 
            'avg_entry_price' => $avg_entry_price,
            'avg_exit_price' => $avg_exit_price,
            'profit_loss' => $profit_loss
        ];
    }
}
