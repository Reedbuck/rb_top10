<?php 
echo "<div class='rb_top10_head'>";
echo "<h1>Таблицы просмотров</h1>";
echo "</div>";
    
echo "<input name='start_date' type='text'>";
echo "<input name='end_date' type='text'>";
require_once RBGL_PLUGIN_DIR . '/datepicker.php';
    

$table_name = $wpdb->prefix . "top_ten_daily"; 

$GMId = $wpdb->get_results( //собираем данные из базы в массив
    "
    SELECT * 
    FROM $table_name
    "
);

if($GMId) {
    count($GMId);
}

$date_array = array(
    0 => "2018-02-18 00:00:00",
    1 => "2018-02-30 00:00:00",
);

if(count($GMId) >= 1) { //если в массиве есть данные
    echo "<table class='rb_top10_reports'>";
    echo "  <tr>";
    echo "      <td>";
    echo "      </td>";
    $n = 1;
    $current_date_array = array();
    for($i = 0; count($GMId) > $i; $i++){ // проходим по элементам массива    
        if( $GMId[$i]->dp_date >= $date_array[0] && $GMId[$i]->dp_date <= $date_array[1] ){ //если даты входят в выборку от до
            $current_day = DateTime::createFromFormat("Y-m-d H:i:s", $GMId[$i]->dp_date); // выхватываем дату текущего элемента массива
            $current_day_num = date_format($current_day, "d");
            if(!$first_day){
                $first_day = DateTime::createFromFormat("Y-m-d H:i:s", $date_array[0]);
                $first_day = date_format($first_day, "d");
            } elseif (($first_day + 6) <= $current_day_num ) {
                $first_day = $first_day + 7;
            } 
            $last_day = $first_day + 6;
            if ( $last_day && $current_day_num && $current_day_num <= $last_day && $first_day && $current_day_num >= $first_day ) {   
                if(!in_array($current_day_num, $current_date_array)){
                    $current_date_array[] = $current_day_num;    
                    if ($n == 1 || $n % 7 == 0) {
                        echo "<td>week ";
                        if ($n == 1){
                            echo $n;
                        }
                        else {
                            echo ($n / 7) + 1;
                        }
                        echo "<br>" . $first_day . "-" . $last_day . "</td>";
                    } else {
                    }
                }
                $n++;
                if ($last_day && $current_day_num && $last_day >= $current_day_num) {
                                        
                }
            }
        } 
    }
    
    echo "  </tr>";
    echo "  <tr>";
    echo "      <td>";
    echo "          total";
    echo "      </td>";
    if($GMId){
        for($i = 0; $i < count($GMId); ++$i){
            if( $GMId[$i]->dp_date >= $date_array[0] && $GMId[$i]->dp_date <= $date_array[1]){
                echo "<td>";
                echo $GMId[$i]->cntaccess;
                echo "</td>";
            }
        }
    }
    echo "</tr>";
    echo "</table>";
} else {
    echo "Нет данных";
}
?>