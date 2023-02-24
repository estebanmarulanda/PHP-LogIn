<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<style>
body {
  font-family: Arial;
  font-size: 17px;
  padding: 8px;
}

* {
  box-sizing: border-box;
}

.row {
  display: -ms-flexbox; /* IE10 */
  display: flex;
  -ms-flex-wrap: wrap; /* IE10 */
  flex-wrap: wrap;
  margin: 0 -16px;
}

.col-25 {
  -ms-flex: 25%; /* IE10 */
  flex: 25%;
}

.col-50 {
  -ms-flex: 50%; /* IE10 */
  flex: 50%;
}

.col-75 {
  -ms-flex: 75%; /* IE10 */
  flex: 75%;
}

.col-25,
.col-50,
.col-75 {
  padding: 0 16px;
}

.container {
  background-color: #f2f2f2;
  padding: 5px 20px 15px 20px;
  border: 1px solid lightgrey;
  border-radius: 3px;
}
table {
        border-collapse: collapse;
        border-spacing: 0;
        width: 100%;
        border: 1px solid #ddd;
}

th, td {
        text-align: left;
        padding: 16px;
        }

        tr:nth-child(even) {
        background-color: #f2f2f2;
        }
        
input[type=text] {
  width: 100%;
  margin-bottom: 20px;
  padding: 12px;
  border: 1px solid #ccc;
  border-radius: 3px;
}
select {
  width: 100%;
  margin-bottom: 20px;
  padding: 12px;
  border: 1px solid #ccc;
  border-radius: 3px;
}

label {
  margin-bottom: 10px;
  display: block;
}

.icon-container {
  margin-bottom: 20px;
  padding: 7px 0;
  font-size: 24px;
}

.btn {
  background-color: #04AA6D;
  color: white;
  padding: 12px;
  margin: 10px 0;
  border: none;
  width: 100%;
  border-radius: 3px;
  cursor: pointer;
  font-size: 17px;
}

.btn:hover {
  background-color: #45a049;
}

a {
  color: #2196F3;
}

hr {
  border: 1px solid lightgrey;
}

span.price {
  float: right;
  color: grey;
}

/* Responsive layout - when the screen is less than 800px wide, make the two columns stack on top of each other instead of next to each other (also change the direction - make the "cart" column go on top) */
@media (max-width: 800px) {
  .row {
    flex-direction: column-reverse;
  }
  .col-25 {
    margin-bottom: 20px;
  }
}
</style>
</head>
<body>

    <div class="row">
        <div class="col-75">
            <div class="container">
            <form method="POST">
                <div class="row">
                <div class="col-50">
                    <div class="row">
                    <div class="col-50">
                        <label for="state">Search by title</label>
                        <input type="text" id="title" name="title" placeholder="Write Title">
                    </div>
                    <div class="col-50">
                        <label for="Sort">Date start</label>
                        <input type="text" id="start_date" name="start_date" placeholder="Write start date.">
                    </div>
                    </div>
                </div>
                <div class="col-50">
                    <div class="row">
                    <div class="col-50">
                        <label for="state">Date end</label>
                        <input type="text" id="end_date" name="end_date" placeholder="write end date">
                    </div>
                    <div class="col-50">
                        <label for="zip">Sort</label>
                            <select name="sort" id="cars">
                                    <option value="title">Title</option>
                                    <option value="date">Date</option>
                                    
                            </select>
                    </div>
                    </div>
                </div>
                <div class="col-50">
                    <div class="row">
                    <div class="col-50">
                        <input type="submit" value="Submit" class="btn" name="button1">
                    </div>
                    <div class="col-50">
                        <input type="submit" value="Reset" class="btn" name="button2">
                    </div>
                    </div>
                </div>
                </div> 
            </form>

            <table>
                    <tr>
                        <th>Title</th>
                        <th>Year</th>
                        <th>Type</th>
                        <th>Poster</th>
                    </tr>
                    
                    
                    <?php

                        
                        if(array_key_exists('button1', $_POST)) {
                            
                           $title= $_POST['title'];
                           if($title==''){
                            $title='Avenger';
                          }
                           $start_date= $_POST['start_date'];
                           $end_date= $_POST['end_date'];
                           $sort_value=$_POST['sort'];
                            button1($title,$start_date,$end_date,$sort_value);
                        }
                        else if(array_key_exists('button2', $_POST)) {
                            button2();
                        }
                        
                        function button1($title,$start_date,$end_date,$sort) {
                            //echo "This is Button1 that is selected";
                          
                            $url='https://www.omdbapi.com/?s=';
                            $url.=$title.'&';
                            if($start_date!='' and $end_date!=''){
                                $url.='y=';
                                $url.=$start_date.'-'.$end_date.'&';
                            }
                            else if($start_date!='' || $end_date!=''){
                                $url.='y=';
                                if($start_date!=''){
                                    $url.=$start_date.'&';
                                }
                                else if($end_date!=''){
                                    $url.=$end_date.'&';
                                }
                               
                            } 
                            
                           
                            $url.='apiKey=fc59da33';
                            echo $url;
                            $data = file_get_contents($url);
                            $decoded_data = json_decode($data,true);
                           
                           
                            $search_results = $decoded_data['Search'];
                            if($sort=='title'){
                                usort($search_results, function($a, $b) {
                                    return strcmp($a['Title'], $b['Title']);
                                });
                            }
                            else{
                                usort($search_results, function($a, $b) {
                                    return strcmp($a['Year'], $b['Year']);
                                }); 
                            }
                            

                            // Output sorted search results
                            $decoded_data['Search'] = $search_results;
                          
                            $sorted_data= json_encode($decoded_data);
                            file_put_contents('movie_data.json',$sorted_data);
                            
                            $searchdata=json_decode($sorted_data,true);
                          
                            // echo $decoded_data;
                            $list_length=sizeof(json_decode($sorted_data)->Search);
                            //echo  $decoded_data['Search'];
                                                      
                             for ($x = 0; $x < $list_length; $x++) {
                                $item=$searchdata['Search'][$x];
                                $title=$item["Title"];
                                $year=$item["Year"];;
                                $type=$item["Type"];;
                                $poster=$item["Poster"];;
                    ?>
                            <tr>
                                <td><?php echo $title; ?></th>
                                <td><?php echo $year; ?></th>
                                <td><?php echo $type; ?></th>
                                <td><?php echo $poster ?></th>
                            </td>
                    <?php 
                             }   
                            }
                            function button2() {
                                $status=unlink('movie_data.json');
                                if($status){  
                                     echo "List reseted";    
                                    }else{  
                                      echo "Sorry!";    
                                 }  
                            } 
                    
                    
                    
                    
                    ?>
                    
            </table>
            </div>

        </div>  
    </div>

</body>
</html>
