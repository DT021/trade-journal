<?php

/**
 * Calculates the avg entry prices for a group of trades
 * 
 * @param array of trades
 * @return integer
 */
function avgEntryPrice($group) {
    $total_value = 0;
    $total_quantity = 0;
    foreach($group as $item) {
        if ($item->value < 0) {
            $total_value -= $item->value;
            $total_quantity += $item->quantity;
        } 
    }

    return number_format($total_value/$total_quantity, 2);
}

/**
 * Calculates the avg exit prices for a group of trades
 * 
 * @param array of trades
 * @return integer
 */
function avgExitPrice($group) {
    $total_value = 0;
    $total_quantity = 0;
    foreach($group as $item) {
        if ($item->value > 0) {
            $total_value += $item->value;
            $total_quantity += $item->quantity;
        } 
    }

    return number_format($total_value/$total_quantity, 2);
}