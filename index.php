<?php
require 'routeros_api.class.php';

// ==> Infos de ton Mikrotik
$ip       = "hgr0afnb6jp.sn.mynetname.net"; // Cloud DDNS Mikrotik
$user     = "apiuser";                     // utilisateur API (créé sur MikroTik)
$password = "motdepasse!solide";           // mot de passe
$profile  = "1Jour";                       // nom du profil hotspot à utiliser

$amount   = 100; // montant fictif juste pour test

// Génération d’un code aléatoire (login = password)
$code = substr(str_shuffle("ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789"), 0, 6);

// Connexion via API Mikrotik
$api = new RouterosAPI();
if (!$api->connect($ip, $user, $password)) {
    die("ÉCHEC de connexion au MikroTik");
}

// Création utilisateur Hotspot
$api->write('/ip/hotspot/user/add', false);
$api->write('=name='.$code, false);
$api->write('=password='.$code, false);
$api->write('=profile='.$profile, false);
$api->write('=limit-uptime=1d', false);
$api->write('=comment=testDepuisRender', true);
$api->read();

// Affichage résultat
echo "Utilisateur hotspot créé: ".$code;
