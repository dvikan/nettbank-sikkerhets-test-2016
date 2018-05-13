<?php namespace vikan\hsts;

require 'vendor/autoload.php';

use GuzzleHttp\Client;

$investmentBanks = [
    new Bank('Bank Norwegian AS', 'https://www.banknorwegian.no/'),
    new Bank('Bank2 ASA', 'https://bank2.no/'),
    new Bank('BN Bank ASA', 'https://www.bnbank.no/'),
    new Bank('Eika Kredittbank AS', 'https://eika.no/om-oss/selskaper/produktselskaper/kredittbank'),
    new Bank('Gjensidige Bank ASA', 'https://www.gjensidige.no/privat/bank'),
    new Bank('KLP Banken AS', 'https://www.klp.no/person/bank'),
    new Bank('Komplett Bank ASA', 'https://www.komplettbank.no/'),
    new Bank('Landkreditt Bank AS', 'https://www.landkredittbank.no/'),
    new Bank('Netfonds Bank ASA', 'https://www.netfonds.no'), // NO TLS!
    new Bank('Nordea Bank Norge ASA', 'https://nettbanken.nordea.no/login/'), // NO TLS!
    new Bank('OBOS-banken ASA', 'https://bank.obos.no/'),
    new Bank('Pareto Bank ASA', 'https://paretobank.no/'),
    new Bank('Santander Consumer Bank AS', 'https://www.santanderonline.no/'),
    new Bank('Storebrand Bank ASA', 'https://www.storebrand.no/privat/bank-og-lan'),
    new Bank('Easybank', 'https://easybank.no/'),
    new Bank('Voss Veksel- og Landmandsbank ASA', 'https://vekselbanken.no/'),
    new Bank('yA Bank AS', 'https://ya.no/'),
];

$savingsBanks = [
    new Bank('DnB ASA', 'https://www.dnb.no/'),
    new Bank('SpareBank 1 SR-Bank', 'https://www.sparebank1.no/nb/sr-bank/privat.html'),
    new Bank('Sparebanken Vest', 'https://www.spv.no/'),
    new Bank('SpareBank 1 SMN', 'https://www.sparebank1.no/smn/'),
    new Bank('SpareBank 1 Nord-Norge', 'https://www.sparebank1.no/nb/nord-norge/privat.html'),
    new Bank('Sparebanken Møre', 'https://www.sbm.no/'),
    new Bank('Sparebanken Øst', 'https://www.oest.no/'),
    new Bank('Sparebanken Sør', 'https://www.sor.no/'),
    new Bank('Sandnes Sparebank', 'https://sandnes-sparebank.no/'),
    new Bank('Sparebanken Sogn og Fjordane', 'https://www.ssf.no/'),
    new Bank('SpareBank 1 Buskerud-Vestfold', 'https://www.sparebank1.no/nb/bv/privat.html'),
    new Bank('Helgeland Sparebank', 'https://www.hsb.no/'),
    new Bank('Sparebank 1 Telemark', 'https://www.sparebank1.no/nb/telemark/privat.html'),
    new Bank('Fana Sparebank', 'https://www.fanasparebank.no/'),
    new Bank('Totens Sparebank', 'https://totenbanken.no/'),
    new Bank('SpareBank 1 NordVest', 'https://www.sparebank1.no/nb/nordvest/privat.html'),
    new Bank('SpareBank 1 Ringerike Hadeland', 'https://www.sparebank1.no/nb/nordvest/privat.html'),
];

$allBanks = array_merge($investmentBanks, $savingsBanks);

// Most common ua according to https://techblog.willshouse.com/2012/01/03/most-common-user-agents/
$ua = 'Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/52.0.2743.116 Safari/537.36';

$client = new Client([
    'timeout'  => 20.0,
    'allow_redirects' => false, // Do not follow redirects
    'header' => [
        'User-Agent' => $ua,
    ],
]);

foreach ($allBanks as $bank) {

    $response = $client->get($bank->url);

    $hsts = $response->getHeader('Strict-Transport-Security');

    if (empty($hsts)) {
        print "MANGLER HSTS: {$bank->name}\n";
    }
}
