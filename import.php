<?php

$conn=mysqli_connect("localhost","root","","csv");

if(isset($_POST["import"])){
    $fileName=$_FILES["file"]["tmp_name"];

    if($_FILES["file"]["size"]>0){
        $file=fopen($fileName,"r");

        while(($column=fgetcsv($file,10000,","))!==FALSE){
            $sqlInsert="Insert into data(name,type) values('".$column[0]."','".$column[1]."')";

            $result=mysqli_query($conn,$sqlInsert);

            if(!empty($result)){
                echo"CSV Data Imported into the database";
            }
            else{
                echo"problem in importing csv";
            }
        }
    }
}

?>


<form class="form-horizoontal" action="" method="post" name="uploadCsv" enctype="multipart/form-data">

<div>
<label>Choose csv file</label>
<input type="file" name="file" accept=".csv">
<button type="submit" name="import">Import</button>
</div>

</form>

<?php

$sqlSelect="SELECT * from data";

$result=mysqli_query($conn,$sqlSelect);

if(mysqli_num_rows($result)>0){
    ?>
    <table>
    <thead>
    <tr>
    <th>USER ID</th>
    <th>User Name</th>
    <th>Type</th>
    </tr>
    </thead>
    <?php
    while($row=mysqli_fetch_array($result)){
        
    ?>
    <tbody>
    <tr>
    <td><?php echo $row['id'];?></td>
    <td><?php echo $row['name'];?></td>
    <td><?php echo $row['type'];?></td>
    </tr>
    </tbody>
    <?php }?>
    </table>
<?php }

?>