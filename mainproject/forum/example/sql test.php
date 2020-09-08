<?php

// 併兩張表並模糊搜尋
$leftjoin_sql =
    "SELECT * 
FROM `podcast_audio` 
-- A LEFT JOIN B => B表併到A表
LEFT JOIN `podcast_channel_info` 
-- ON什麼條件
ON `podcast_channel_info`.`podcaster_id`=`podcast_audio`.`podcaster_id` 
-- 在`channel_name`欄位模糊搜尋'%台%'
WHERE `channel_name` LIKE '%台%'";
