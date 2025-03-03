<?php

use Illuminate\Support\Facades\Http;

if (! function_exists('formatBalance')) {
    /**
     * Format the balance to a string with up to 8 decimal places,
     * keeping minimum 2 decimal places. Displays '0.00' if the balance is zero.
     *
     * @param  float  $balance
     * @return string
     */
    function formatBalance($balance) {
        // Check if the balance is zero
        if ((float) $balance === 0.0) {
            return '0.00';
        }

        // Format the balance with 8 decimal places
        $formattedBalance = number_format((float) $balance, 8, '.', '');

        // Remove unnecessary trailing zeros but keep minimum 2 decimal places
        $trimmed = rtrim($formattedBalance, '0');

        // Count decimal places
        $decimalPos = strpos($trimmed, '.');
        if ($decimalPos === false) {
            return $trimmed . '.00';
        }

        $decimalPlaces = strlen($trimmed) - $decimalPos - 1;
        if ($decimalPlaces < 2) {
            return $trimmed . str_repeat('0', 2 - $decimalPlaces);
        }

        return $trimmed;
    }
}
if (! function_exists('formatUsdBalance')) {
    /**
     * Format the balance to a string with up to 2 decimal places,
     * keeping minimum 2 decimal places. Displays '0.00' if the balance is zero.
     *
     * @param  float  $balance
     * @return string
     */
    function formatUsdBalance($balance) {
        // Check if the balance is zero
        if ((float) $balance === 0.0) {
            return '0.00';
        }

        // Format the balance with 8 decimal places
        $formattedBalance = number_format((float) $balance, 2, '.', '');

        // Remove unnecessary trailing zeros but keep minimum 2 decimal places
        $trimmed = rtrim($formattedBalance, '0');

        // Count decimal places
        $decimalPos = strpos($trimmed, '.');
        if ($decimalPos === false) {
            return $trimmed . '.00';
        }

        $decimalPlaces = strlen($trimmed) - $decimalPos - 1;
        if ($decimalPlaces < 2) {
            return $trimmed . str_repeat('0', 2 - $decimalPlaces);
        }

        return $trimmed;
    }
}

if (! function_exists('convertUsdToEur')) {
    /**
     * Convert USD to EUR using the Frankfurter API.
     *
     * @param  float  $amount
     * @return float|null
     */
    function convertUsdToEur($amount) {
        $response = Http::get('https://api.frankfurter.app/latest', [
            'from' => 'USD',
            'to'   => 'EUR',
        ]);

        if ($response->successful()) {
            $data            = $response->json();
            $convertedAmount = $amount * $data['rates']['EUR'];

            return $convertedAmount;
        }

        return null;
    }
}

if (! function_exists('convertToUsd')) {
    /**
     * Convert any asset amount to it's USD equivalent using the Frankfurter API.
     *
     * @param  float  $assetAmount
     * @param  float  $assetSymbol
     * @return float|null
     */
    function convertToUsd($assetAmount, $assetSymbol) {
        $response = Http::get('https://api.frankfurter.app/latest', [
            'from' => $assetSymbol,
            'to'   => 'USD',
        ]);

        if ($response->successful()) {
            $data            = $response->json();
            $convertedAmount = $assetAmount * $data['rates']['USD'];

            return $convertedAmount;
        }

        return null;
    }
}

if (! function_exists('convertAssetToUsd')) {
    /**
     * Convert a crypto asset amount to its USD equivalent using Coinbase API.
     *
     * @param  float  $assetAmount
     * @param  string  $assetSymbol
     * @return float|null
     */
    function convertAssetToUsd($assetAmount, $assetSymbol) {
        $response = Http::get('https://api.coinbase.com/v2/exchange-rates', [
            'currency' => $assetSymbol,
        ]);

        if ($response->successful()) {
            $data = $response->json();

            if (isset($data['data']['rates']['USD'])) {
                $rateToUsd = $data['data']['rates']['USD'];

                return $assetAmount * $rateToUsd;
            }
        }

        return null;
    }
}
