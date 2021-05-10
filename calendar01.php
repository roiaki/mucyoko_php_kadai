<?php
//タイムゾーン設定
date_default_timezone_set('Asia/Tokyo');

// 今日の日付のDateTimeインスタンスを作成
$today = new DateTime();

// 月始め
$start_day = new DateTime('first day of this month');

$year_month = $start_day->format('Y-m');

// 月初めの曜日を数値で取得
$w = $start_day->format('w');

$start_day->modify('-'. $w .' day');

echo $start_day;

echo $year_month;
