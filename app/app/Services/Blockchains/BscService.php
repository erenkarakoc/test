<?php
namespace App\Services\Blockchains;

use Elliptic\EC;
use kornrunner\Keccak;

class BscService {
    public function createWallet() {
        // Initialize the elliptic curve
        $ec = new EC('secp256k1');

        // Generate keys
        $keyPair    = $ec->genKeyPair();
        $privateKey = $keyPair->getPrivate('hex');
        $publicKey  = $keyPair->getPublic(false, 'hex');

        // Derive the address from the public key
        $address = '0x' . substr(Keccak::hash(substr(hex2bin($publicKey), 1), 256), 24);

        return [
            'address'    => $address,
            'privateKey' => $privateKey,
        ];
    }
}
