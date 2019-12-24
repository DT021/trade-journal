<?php

namespace App\Helpers;

class TradesHelper
{
    /**
     * Groups trade executions for displaying to the user.
     * 
     * @param \Illuminate\Support\Collection
     * @return 2-dimensional array that represents trade execution groupings
     */
    //TODO: Handle open trades
    public static function groupTrades($executions)
    {
        $result = array();

        // Loop through all executions while keeping track of quantity per symbol in order to create groupings
        $groups = array();      // $groups[symbol] = [execution1, executions2, ...]
        $quantities = array();
        foreach ($executions as $exec) {
            $symbol = $exec->symbol;
            $quantity = $exec->quantity;

            // If action was a sell, make quantity negative
            if (strpos($exec->action, 'SELL') !== false) {
                $quantity *= -1;
            }


            if (array_key_exists($symbol, $quantities) && array_key_exists($symbol, $groups)) {
                $quantities[$symbol] += $quantity;
                array_push($groups[$symbol], $exec);

                // If quantity is 0, then trade is closed.
                if ($quantities[$symbol] == 0) {

                    // Add to result
                    array_push($result,  $groups[$symbol]);

                    // Remove symbol from arrays
                    unset($quantities[$symbol]);
                    unset($groups[$symbol]);
                }
            } else {
                $quantities[$symbol] = $quantity;
                $groups[$symbol] = array($exec);
            }
        }

        return $result;
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
