<?php

function generate_time_table($con, $dep, $sem){

    $query = "select * from subject where dep_id = $dep and sem_id = $sem";
    $que=mysqli_query($con, $query);
    $rows = mysqli_num_rows($que);

    if($rows != 0){
    
        $subjects = array();
        
        while($row = mysqli_fetch_assoc($que)){
            array_push($subjects, $row);
        }
        
        $weekTimeTable = array();
        
        for($i = 0; $i <= 4; $i++){
        
            $dayTimeTable = array();
            shuffle($subjects);
            $pointer = 0;
        
            for($j = 0; $j <= 5; $j++){
        
                try{
                    while($subjects[$pointer]['lec_per_week'] === 0){
                        $pointer++;
                    }
        
                    if($subjects[$pointer]['lec_type'] === "Practical"){
                        if($j === 1 || $j === 2 || $j === 4){
                            array_push($dayTimeTable, $subjects[$pointer]);
                            array_push($dayTimeTable, $subjects[$pointer]);
                            $subjects[$pointer]['lec_per_week']--;
                            if($pointer === count($subjects) - 1){
                                $pointer = 0;
                            }
                            else{
                                $pointer++;
                            }
                            $j++;
                        }
                        else{
                            if($pointer === count($subjects) - 1){
                                $pointer = 0;
                            }
                            else{
                                $pointer++;
                            }
                        }
                    }
                    else if($subjects[$pointer]['lec_type'] == "Theory"){
                        array_push($dayTimeTable, $subjects[$pointer]);
                        $subjects[$pointer]['lec_per_week']--;
                        if($pointer === count($subjects) - 1){
                            $pointer = 0;
                        }
                        else{
                            $pointer++;
                        }
                    }
                }
                catch(OutOfBoundsException $e){
                    array_push($dayTimeTable, "Empty");
                }
            }
        
            array_push($weekTimeTable, $dayTimeTable);
        
        }
         return $weekTimeTable;
    
    }
    else{
        return false;
    }

}

?>