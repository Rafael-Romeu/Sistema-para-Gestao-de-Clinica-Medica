<?php

$rs = $cid->query('SELECT * FROM commissions');// your query
for ($i = 0; $i < $rs->field_count(); $i++) {/// count nu of column
    $col = $rs->fetch_fields()($i);//Returns metadata for a column in a result set
    $columns[] = $col['name'];// get name from metedata
}
print_r($columns);