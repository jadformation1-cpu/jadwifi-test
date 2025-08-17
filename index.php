<?php
require 'routeros_api.class.php';

$ip       = "hgr0afnb6jp.sn.mynetname.net";  // ton cloud mikrotik
$user     = "apiuser";                       // l'utilisateur API que tu as créé
$password = "motdepasse!solide";             // son mot de passe
$profile  = "1Jour";                         // profil hotspot présent dans Mikrotik

$amount   = 100; // montant fictif juste pour test local

$code     = substr(str_shuffle("ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789"), 0, 6);

$api = new RouterosAPI();
if (!$api->connect($ip, $user, $password)) {
    die("ÉCHEC de connexion au MikroTik");
}

$api->write('/ip/hotspot/user/add', false);
$api->write('=name='.$code, false);
$api->write('=password='.$code, false);
$api->write('=profile='.$profile, false);
$api->write('=limit-uptime=1d', false);
$api->write('=comment=testDepuisRender', true);
$api->read();

echo "Utilisateur créé: ".$code;
