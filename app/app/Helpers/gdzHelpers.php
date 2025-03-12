<?php

use Illuminate\Support\Facades\Http;

if (! function_exists('formatBalance')) {
    /**
     * Format the balance to a string with up to 8 decimal places,
     * truncating after 8 decimals and keeping minimum 2 decimal places.
     *
     * @param  float  $balance
     * @return string
     */
    function formatBalance($balance) {
        if ((float) $balance === 0.0) {
            return '0.00';
        }

        // Convert to string first to handle scientific notation
        $stringBalance = sprintf('%.8f', $balance);

        // Convert to string and split at decimal
        $parts = explode('.', $stringBalance);

        // Handle the decimal part
        $decimals = isset($parts[1]) ? substr($parts[1], 0, 8) : '00';

        // Remove unnecessary trailing zeros but keep minimum 2 decimal places
        $trimmed = rtrim($decimals, '0');
        if (strlen($trimmed) < 2) {
            $trimmed .= str_repeat('0', 2 - strlen($trimmed));
        }

        return $parts[0] . '.' . $trimmed;
    }
}

if (! function_exists('formatUsdBalance')) {
    /**
     * Format the USD balance to a string with exactly 2 decimal places.
     *
     * @param  float  $balance
     * @return string
     */
    function formatUsdBalance($balance) {
        if ((float) $balance === 0.0) {
            return '0.00';
        }

        // Convert to string first to handle scientific notation
        $stringBalance = sprintf('%.2f', $balance);

        // Convert to string and split at decimal
        $parts = explode('.', $stringBalance);

        // Handle the decimal part
        $decimals = isset($parts[1]) ? substr($parts[1], 0, 2) : '00';

        // Ensure exactly 2 decimal places
        if (strlen($decimals) < 2) {
            $decimals .= str_repeat('0', 2 - strlen($decimals));
        }

        return $parts[0] . '.' . $decimals;
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
