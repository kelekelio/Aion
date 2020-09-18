<?php

function translate ($name, $language, $aionDB) {

    $sql = $aionDB->query('SELECT
              t.body    ko,
              t.LAN_EN  en,
              t.LAN_DE  de,
              t.LAN_FR  fr,
              t.LAN_ES  es,
              t.LAN_IT  it,
              t.LAN_PL  pl,
              t.LAN_US  us
           FROM  translation_small t
           WHERE t.name = ?', $name)->fetchArray();

    return !empty($sql[$language]) ? $sql[$language] : $sql['ko'];

}