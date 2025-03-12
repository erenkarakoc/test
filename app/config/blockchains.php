<?php
return [
    'bscscan_api_key'     => env('BSCSCAN_API_KEY'),
    'etherscan_api_key'   => env('ETHERSCAN_API_KEY'),
    'main_tron_addresses' => [
        'address_1' => [
            'hex'    => env('MAIN_TRON_ADDRESS_1_HEX'),
            'base58' => env('MAIN_TRON_ADDRESS_1_BASE58'),
            'pk'     => env('MAIN_TRON_ADDRESS_1_PK'),
        ],
        'address_2' => [
            'hex'    => env('MAIN_TRON_ADDRESS_2_HEX'),
            'base58' => env('MAIN_TRON_ADDRESS_2_BASE58'),
            'pk'     => env('MAIN_TRON_ADDRESS_2_PK'),
        ],
        'address_3' => [
            'hex'    => env('MAIN_TRON_ADDRESS_3_HEX'),
            'base58' => env('MAIN_TRON_ADDRESS_3_BASE58'),
            'pk'     => env('MAIN_TRON_ADDRESS_3_PK'),
        ],
        'address_4' => [
            'hex'    => env('MAIN_TRON_ADDRESS_4_HEX'),
            'base58' => env('MAIN_TRON_ADDRESS_4_BASE58'),
            'pk'     => env('MAIN_TRON_ADDRESS_4_PK'),
        ],
    ],
    'main_bsc_addresses'  => [
        'address_1' => [
            'hex' => env('MAIN_BSC_ADDRESS_1_HEX'),
            'pk'  => env('MAIN_BSC_ADDRESS_1_PK'),
        ],
        'address_2' => [
            'hex' => env('MAIN_BSC_ADDRESS_2_HEX'),
            'pk'  => env('MAIN_BSC_ADDRESS_2_PK'),
        ],
        'address_3' => [
            'hex' => env('MAIN_BSC_ADDRESS_3_HEX'),
            'pk'  => env('MAIN_BSC_ADDRESS_3_PK'),
        ],
        'address_4' => [
            'hex' => env('MAIN_BSC_ADDRESS_4_HEX'),
            'pk'  => env('MAIN_BSC_ADDRESS_4_PK'),
        ],
    ],
];
